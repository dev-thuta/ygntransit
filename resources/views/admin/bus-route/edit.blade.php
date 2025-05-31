@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Bus Route') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/admin/bus-routes/update/' . $busroute->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select" @readonly(true)>
                                    <option>{{ $busroute->busLine->name }}</option>
                                </select>
                                <input type="hidden" name="bus_line_id" value="{{ $busroute->bus_line_id }}">
                                <label for="bus_line_id" class="form-label">{{ __('Bus Line') }}</label>
                            </div>
                        </div>

                        {{-- township field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select id="township_id" class="form-select" autocomplete="township_id">
                                    <option value="" disabled>{{ __('Select Township') }}</option>
                                    @foreach($townships as $township)
                                        <option value="{{ $township->id }}"
                                            {{ old('township_id', $busroute->busStop->township_id) == $township->id ? 'selected' : '' }}>
                                            {{ $township->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="township_id">{{ __('Township') }}</label>
                            </div>
                        </div>

                        {{-- bus stop field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select id="bus_stop_id" name="bus_stop_id" class="form-select @error('bus_stop_id') is-invalid @enderror" autocomplete="bus_stop_id">
                                    <option value="" disabled>{{ __('Select Bus Stop') }}</option>
                                </select>
                                <label for="bus_stop_id">{{ __('Bus Stop') }}</label>
                                @error('bus_stop_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit/Cancel --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ url('/admin/bus-routes') }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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
        const oldBusStopId = "{{ old('bus_stop_id', $busroute->bus_stop_id ?? '') }}";
        const oldTownshipId = "{{ old('township_id', $busroute->busStop->township_id ?? '') }}";

        function filterBusStopsByTownship(townshipId) {
            busStopSelect.innerHTML = '<option value="" disabled>Select Bus Stop</option>';

            allBusStops.forEach(function (busStop) {
                if (busStop.township_id == townshipId) {
                    const option = document.createElement('option');
                    option.value = busStop.id;
                    option.textContent = busStop.name + ' - ' + busStop.road;

                    if (oldBusStopId == busStop.id) {
                        option.selected = true;
                    }

                    busStopSelect.appendChild(option);
                }
            });
        }

        townshipSelect.addEventListener('change', function () {
            filterBusStopsByTownship(this.value);
        });

        if (oldTownshipId) {
            filterBusStopsByTownship(oldTownshipId);
        }
    });
</script>
@endpush
