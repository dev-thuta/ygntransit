@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Bus Line') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/admin/bus-lines/create') }}">
                        @csrf

                        {{-- name field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- is card available field --}}
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="hidden" name="isCardAvailable" value="false">
                                <input id="isCardAvailable" name="isCardAvailable" type="checkbox" class="form-check-input @error('isCardAvailable') is-invalid @enderror" role="switch" value="true" {{ old('isCardAvailable') === 'true' ? 'checked' : '' }}>

                                <label for="isCardAvailable" class="form-label">{{ __('is Card Available?') }}</label>
                                @error('isCardAvailable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- submit cancel buttons --}}
                        <div class="row mb-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/admin/bus-lines') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
