<?php

namespace App\Http\Controllers;

use App\Models\BusLine;
use App\Models\BusStop;
use App\Models\BusRoute;
use App\Models\Township;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BusRouteController extends Controller
{
    public function index()
    {
        $data = BusRoute::with(['busline', 'busstop'])->orderBy('bus_line_id', 'asc')->paginate(7);
        return view('admin.bus-route.index', [
            'busroutes' => $data
        ]);
    }

    public function add($id)
    {
        $busline = BusLine::findOrFail($id);
        $townships = Township::orderBy('name', 'asc')->get();
        $busstops = BusStop::orderBy('name', 'asc')->get();
        return view('admin.bus-route.add', [
            'busline' => $busline,
            'townships' => $townships,
            'busstops' => $busstops,
        ]);
    }

    public function create(Request $request)
    {
        $validator = validator(request()->all(), [
            'bus_line_id' => ['required', 'exists:bus_lines,id'],
            'bus_stop_id' => [
                'required',
                'exists:bus_stops,id',
                Rule::unique('bus_routes', 'bus_stop_id')
                    ->where('bus_line_id', $request->bus_line_id)
            ],

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $stoporder = BusRoute::where('bus_line_id', $request->bus_line_id)->max('stop_order') + 1;


        $busroute = new BusRoute();
        $busroute->bus_line_id = request()->bus_line_id;
        $busroute->bus_stop_id = request()->bus_stop_id;
        $busroute->stop_order = $stoporder;
        $busroute->save();

        return redirect('/admin/bus-lines')->with('success', 'New Bus Route has been created successfully.');
    }

    public function edit($id)
    {
        $busroute = BusRoute::findOrFail($id);
        $townships = Township::orderBy('name', 'asc')->get();
        $busstops = BusStop::orderBy('name', 'asc')->get();
        return view('admin.bus-route.edit', [
            'busroute' => $busroute,
            'townships' => $townships,
            'busstops' => $busstops,
        ]);
    }

    public function update(Request $request, $id)
    {
        $busroute = BusRoute::findOrFail($id);
        $validator = validator(request()->all(), [
            'bus_line_id' => ['required', 'exists:bus_lines,id'],
            'bus_stop_id' => [
                'required',
                'exists:bus_stops,id',
                Rule::unique('bus_routes', 'bus_stop_id')
                    ->where('bus_line_id', $request->bus_line_id)
                    ->ignore($busroute->id)
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $busroute->bus_line_id = $request->bus_line_id;
        $busroute->bus_stop_id = $request->bus_stop_id;
        $busroute->save();

        return redirect('/admin/bus-routes')->with('success', 'Bus Route updated successfully.');
    }

    public function delete($id)
    {
        $busroute = BusRoute::find($id);
        $busroute->delete();

        return redirect('/admin/bus-routes')->with('success', 'Bus Route deleted successfully.');
    }

    public function publicIndex(Request $request)
{
    $search = $request->input('search');

    if ($search) {
        $busLinesQuery = BusLine::where('name', 'like', "%$search%")
            ->orWhereHas('busstops', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('road', 'like', "%$search%")
                  ->orWhereHas('township', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });

        $paginatedBusLines = $busLinesQuery->paginate(1)->withQueryString();

        $paginatedBusLines->load([
            'busroutes' => function ($q) {
                $q->orderBy('stop_order');
            },
            'busroutes.busstop',
        ]);

        foreach ($paginatedBusLines as $line) {
            $stopIds = $line->busroutes->pluck('bus_stop_id')->unique();

            $altLines = BusLine::where('id', '!=', $line->id)
                ->whereHas('busroutes', function ($q) use ($stopIds) {
                    $q->whereIn('bus_stop_id', $stopIds);
                })
                ->get();

            $line->alternative_lines = $altLines;
        }

        return view('front.bus-routes', [
            'busLines' => $paginatedBusLines,
            'search' => $search,
        ]);
    } else {
        return view('front.bus-routes', [
            'busLines' => null,
            'search' => null,
        ]);
    }
}

}
