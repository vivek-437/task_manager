@extends('layouts.master')
@section('title', 'Create Shift')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Shift</h4>
                    <form action="{{ route('shift.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        <!-- Shift Type -->
                        <div class="mb-3">
                            <label for="shift_type">Shift Type</label>
                            <select name="shift_type" id="shift_type" class="form-control" required>
                                <option value="">Select Shift Type</option>
                                <option value="morning">Morning</option>
                                <option value="evening">Evening</option>
                                <option value="night">Night</option>
                            </select>
                        </div>

                        <!-- Start Time -->
                        <div class="mb-3">
                            <label for="start_time">Start Time</label>
                            <input type="time" name="start_time" id="start_time" class="form-control" required>
                        </div>

                        <!-- End Time -->
                        <div class="mb-3">
                            <label for="end_time">End Time</label>
                            <input type="time" name="end_time" id="end_time" class="form-control" required>
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control">
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Create Shift</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
