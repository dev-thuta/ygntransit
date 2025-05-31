<?php

namespace App\Http\Controllers;

use App\Models\BusLine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BusLineController extends Controller
{
    public function index()
    {
        $data = BusLine::orderBy('name', 'asc')->paginate(7);
        return view('admin.bus-line.index', [
            'buslines' => $data
        ]);
    }

    public function add()
    {
        return view('admin.bus-line.add');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:bus_lines,name'],
            'isCardAvailable' => ['required', 'in:true,false'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $busline = new BusLine();
        $busline->name = request()->name;
        $busline->isCardAvailable = request('isCardAvailable') === 'true';
        $busline->save();

        return redirect('/admin/bus-lines')->with('success', 'New Bus Line has been created successfully.');
    }

    public function edit($id)
    {
        $data = BusLine::findOrFail($id);

        return view('admin.bus-line.edit', [
            'busline' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $busline = BusLine::findOrFail($id);
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255', Rule::unique('bus_lines', 'name')->ignore($busline->id)],
            'isCardAvailable' => ['required', 'in:true,false'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $busline->name = $request->name;
        $busline->isCardAvailable = $request->isCardAvailable === 'true';
        $busline->save();

        return redirect('/admin/bus-lines')->with('success', 'Bus Line updated successfully.');
    }

    public function delete($id)
    {
        $busline = BusLine::find($id);
        $busline->delete();

        return redirect('/admin/bus-lines')->with('success', 'Bus Line deleted successfully.');
    }
}
