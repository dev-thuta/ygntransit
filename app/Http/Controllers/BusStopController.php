<?php

namespace App\Http\Controllers;

use App\Models\BusStop;
use App\Models\Township;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BusStopController extends Controller
{

    public function index()
    {
        $data = BusStop::with('township')->orderBy('name', 'asc')->paginate(7);
        return view('admin.bus-stop.index', [
            'busstops' => $data
        ]);
    }

    public function add()
    {
        $townships = Township::orderBy('name', 'asc')->get();
        return view('admin.bus-stop.add', [
            'townships' => $townships
        ]);
    }

    public function create(Request $request)
    {
        $validator = validator(request()->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bus_stops')->where(function ($query) use ($request) {
                    return $query->where('road', $request->road);
                }),
            ],
            'road' => ['required', 'string', 'max:255'],
            'township_id' => ['required', 'exists:townships,id'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $busstop = new BusStop();
        $busstop->name = request()->name;
        $busstop->road = request()->road;
        $busstop->township_id = request()->township_id;
        $busstop->save();

        return redirect('/admin/bus-stops')->with('success', 'New Bus Stop has been created successfully.');
    }

    public function edit($id)
    {
        $data = BusStop::findOrFail($id);
        $townships = Township::orderBy('name', 'asc')->get();

        return view('admin.bus-stop.edit', [
            'busstop' => $data,
            'townships' => $townships
        ]);
    }

    public function update(Request $request, $id)
    {
        $busstop = BusStop::findOrFail($id);
        $validator = validator(request()->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bus_stops')
                    ->where(function ($query) use ($request) {
                        return $query->where('road', $request->road);
                    })
                    ->ignore($busstop->id),
            ],
            'road' => ['required', 'string', 'max:255'],
            'township_id' => ['required', 'exists:townships,id'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $busstop->name = $request->name;
        $busstop->road = $request->road;
        $busstop->township_id = $request->township_id;
        $busstop->save();

        return redirect('/admin/bus-stops')->with('success', 'Bus Stop updated successfully.');
    }

    public function delete($id)
    {
        $busstop = BusStop::find($id);
        $busstop->delete();

        return redirect('/admin/bus-stops')->with('success', 'Bus Stop deleted successfully.');
    }

    public function publicIndex(Request $request)
    {
        $search = $request->input('search');

        $busStops = BusStop::with('buslines')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('front.bus-stops', compact('busStops'));
    }
}
