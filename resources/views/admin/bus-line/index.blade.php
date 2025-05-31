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
                <div class="card-header">{{ __('List of Bus Lines') }}
                <a href="{{ url('/admin/bus-lines/add')}}" class="btn btn-primary float-end">Add</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>New Route</th>
                                    <th>is Card Available</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($buslines instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $buslines->firstItem() : 1; @endphp
                                @foreach ($buslines as $busline)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $busline['name'] }}</td>
                                        <td>
                                            <a href="{{ url("/admin/bus-routes/add/$busline->id") }}" class="btn btn-outline-success mb-1"><i class="bi bi-sign-turn-right-fill"></i></a>
                                        </td>
                                        <td>
                                            @if ($busline['isCardAvailable'])
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-danger">No</span> 
                                            @endif
                                        </td>
                                        <td>{{ $busline['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $busline->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/admin/bus-lines/edit/$busline->id") }}" class="btn btn-warning mb-1"><i class="bi bi-pencil-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/admin/bus-lines/delete/$busline->id") }}" onclick="return confirm('Are you sure you want to delete this Bus Line?');"><i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $buslines->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
