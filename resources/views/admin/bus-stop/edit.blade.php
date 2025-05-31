@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Bus Stop') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/admin/bus-stops/update/' . $busstop->id) }}">
                        @csrf
                        @method('PUT')
                        
                        {{-- name field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $busstop->name) }}" autocomplete="name" autofocus>

                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- road field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="road" type="text" class="form-control @error('road') is-invalid @enderror" name="road" value="{{ old('road', $busstop->road) }}" autocomplete="road">

                                <label for="road" class="form-label">{{ __('Road') }}</label>
                                @error('road')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- township field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select id="township_id" class="form-select @error('township_id') is-invalid @enderror" name="township_id" value="{{ old('township_id', $busstop->township_id) }}" autocomplete="township_id">
                                    <option value="" disabled selected>{{ __('Select Township') }}</option>
                                    @foreach($townships as $township)
                                        <option value="{{ $township->id }}" {{ old('township_id', $busstop->township_id) == $township->id ? 'selected' : '' }}>{{ $township->name }}</option>
                                    @endforeach
                                </select>

                                <label for="township_id" class="form-label">{{ __('Township') }}</label>
                                @error('township_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- submit cancel buttons --}}
                        <div class="row mb-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/admin/bus-stops') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
