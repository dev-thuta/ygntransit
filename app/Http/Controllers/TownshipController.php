<?php

namespace App\Http\Controllers;

use App\Models\Township;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TownshipController extends Controller
{
    public function index()
    {
        $data = Township::orderBy('name', 'asc')->paginate(7);
        return view('admin.township.index', [
            'townships' => $data
        ]);
    }

    public function add()
    {
        return view('admin.township.add');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:townships,name'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $township = new Township();
        $township->name = request()->name;
        $township->save();

        return redirect('/admin/townships')->with('success', 'New Township has been created successfully.');
    }

    public function edit($id)
    {
        $data = Township::findOrFail($id);

        return view('admin.township.edit', [
            'township' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $township = Township::findOrFail($id);
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255', Rule::unique('townships', 'name')->ignore($township->id)],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $township->name = $request->name;
        $township->save();

        return redirect('/admin/townships')->with('success', 'Township updated successfully.');
    }

    public function delete($id)
    {
        $township = Township::find($id);
        $township->delete();

        return redirect('/admin/townships')->with('success', 'Township deleted successfully.');
    }
}
