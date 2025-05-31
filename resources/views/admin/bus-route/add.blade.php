@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Bus Route') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/admin/bus-routes/create') }}">
                        @csrf
                        
                        {{-- bus line field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('bus_line_id') is-invalid @enderror" 
                                name="bus_line_id" id="bus_line_id" @readonly(true)>
                                    <option value="{{ $busline['id'] }}" {{ old('bus_line_id') == 
                                    $busline['id'] ? 'selected' : '' }}>
                                    {{ $busline['name'] }}
                                    </option>
                                </select>

                                <label for="bus_line_id" class="form-label">{{ __('Bus Line') }}</label>
                                @error('bus_line_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- township field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select id="township_id" class="form-select value="{{ old('township_id') }}" 
                                autocomplete="township_id">
                                    <option value="" disabled selected>{{ __('Select Township') }}</option>
                                    @foreach($townships as $township)
                                        <option value="{{ $township->id }}" {{ old('township_id') == 
                                        
                                        $township->id ? 'selected' : '' }}>{{ $township->name }}</option>
                                    @endforeach
                                </select>

                                <label for="township_id" class="form-label">{{ __('Township') }}</label>
                            </div>
                        </div>

                        {{-- bus stop field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select id="bus_stop_id" class="form-select @error('bus_stop_id') is-invalid 
                                @enderror" name="bus_stop_id" value="{{ old('bus_stop_id') }}" 
                                autocomplete="bus_stop_id">
                                    <option value="" disabled selected>{{ __('Select Bus Stop') }}</option>
                                </select>

                                <label for="bus_stop_id" class="form-label">{{ __('Bus Stop') }}</label>
                                @error('bus_stop_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- submit cancel buttons --}}
                        <div class="row mb-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/admin/bus-routes') }}" class="btn btn-danger">Cancel</a>
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
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const townshipSelect = document.getElementById('township_id');
        const busStopSelect = document.getElementById('bus_stop_id');

        const allBusStops = @json($busstops);
        const oldBusStopId = "{{ old('bus_stop_id') }}";

        function filterBusStopsByTownship(townshipId) {
            busStopSelect.innerHTML = '<option value="" disabled selected>Select Bus Stop</option>';

            if (!townshipId) return;

            allBusStops.forEach(function (busStop) {
                if (busStop.township_id == townshipId) {
                    const option = document.createElement('option');
                    option.value = busStop.id;

                    option.textContent = busStop.name + ' - ' + busStop.road;

                    if (oldBusStopId && oldBusStopId == busStop.id) {
                        option.selected = true;
                    }

                    busStopSelect.appendChild(option);
                }
            });
        }

        townshipSelect.addEventListener('change', function () {
            filterBusStopsByTownship(this.value);
        });

        // Optional: trigger filter on page load if old township selected
        const oldTownshipId = "{{ old('township_id') }}";
        if (oldTownshipId) {
            filterBusStopsByTownship(oldTownshipId);
        }
    });
</script>
@endpush

