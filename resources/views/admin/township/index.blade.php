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
                <div class="card-header">{{ __('List of Townships') }}
                <a href="{{ url('/admin/townships/add')}}" class="btn btn-primary float-end">Add</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($townships instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $townships->firstItem() : 1; @endphp
                                @foreach ($townships as $township)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $township['name'] }}</td>
                                        <td>{{ $township['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $township->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/admin/townships/edit/$township->id") }}" class="btn btn-warning mb-1"><i class="bi bi-pencil-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/admin/townships/delete/$township->id") }}" onclick="return confirm('Are you sure you want to delete this Township?');"><i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $townships->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
