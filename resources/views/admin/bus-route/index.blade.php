@extends('layouts.app')

@section('content')
<div class="container">
    @if(@session('success'))
        <div id="alert-success" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('List of Bus Stops') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bus Line</th>
                                    <th>Bus Stop</th>
                                    <th>Road</th>
                                    <th>Stop Order</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($busroutes instanceof 
                                \Illuminate\Pagination\LengthAwarePaginator) ? $busroutes->firstItem() : 1; @endphp
                                @foreach ($busroutes as $busroute)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $busroute->busline->name }}</td>
                                        <td>{{ $busroute->busstop->name }}</td>
                                        <td>{{ $busroute->busstop->road }}</td>
                                        <td>{{ $busroute['stop_order'] }}</td>
                                        <td>{{ $busroute['created_at']->format('Y-m-d') }}

                                        </td>
                                        <td>{{ $busroute->updated_at->diffForHumans() }}

                                        </td>
                                        <td>
                                            <a href="{{ url("/admin/bus-routes/edit/$busroute->id") }}" class="btn btn-warning mb-1"><i class="bi bi-pencil-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/admin/bus-routes/delete/$busroute->id") }}" onclick="return confirm('Are you sure you want to delete this Bus Route?');"><i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $busroutes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
