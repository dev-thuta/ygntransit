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
                <a href="{{ url('/admin/bus-stops/add')}}" class="btn btn-primary float-end">Add</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Road</th>
                                    <th>Township</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($busstops instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $busstops->firstItem() : 1; @endphp
                                @foreach ($busstops as $busstop)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $busstop['name'] }}</td>
                                        <td>{{ $busstop['road'] }}</td>
                                        <td>{{ $busstop->township->name }}</td>
                                        <td>{{ $busstop['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $busstop->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/admin/bus-stops/edit/$busstop->id") }}" class="btn btn-warning mb-1"><i class="bi bi-pencil-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/admin/bus-stops/delete/$busstop->id") }}" onclick="return confirm('Are you sure you want to delete this Bus Stop?');"><i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $busstops->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
