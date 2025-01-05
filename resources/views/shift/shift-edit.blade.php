@extends('layouts.master')
@section('title', 'Edit Shift')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Shift</h4>
                    <form action="{{ route('shift.update', $shift->id) }}" method="POST">
                        @csrf
                        @method('POST')

                        <!-- Shift Type -->
                        <div class="mb-3">
                            <label for="shift_type">Shift Type</label>
                            <select name="shift_type" id="shift_type" class="form-control" required>
                                <option value="morning" {{ $shift->shift_type == 'morning' ? 'selected' : '' }}>Morning</option>
                                <option value="evening" {{ $shift->shift_type == 'evening' ? 'selected' : '' }}>Evening</option>
                                <option value="night" {{ $shift->shift_type == 'night' ? 'selected' : '' }}>Night</option>
                            </select>
                        </div>

                        <!-- Start Time -->
                        <div class="mb-3">
                            <label for="start_time">Start Time</label>
                            <input type="time" name="start_time" id="start_time" class="form-control" value="{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }}" required>
                        </div>
                        

                        <!-- End Time -->
                        <div class="mb-3">
                            <label for="end_time">End Time</label>
                            <input type="time" name="end_time" id="end_time" class="form-control" value="{{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}" required>
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control" value="{{ ucwords($shift->location) }}">
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" class="form-control">{{ $shift->notes }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Update Shift</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
