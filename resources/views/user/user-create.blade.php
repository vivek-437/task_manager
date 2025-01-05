@extends('layouts.master')

@section('title', 'Create User')

@section('css')
    <!-- No need for Select2 CSS since we won't be using Select2 -->
@endsection

@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Create New User</h3>
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Name and Email -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Address and Phone -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Date of Birth and Gender -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Profile Image and Bio -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" id="bio" name="bio">{{ old('bio') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Nationality and Occupation -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nationality">Nationality</label>
                        <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality') }}" placeholder="Enter your nationality">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="occupation">Occupation</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation') }}" placeholder="Enter your occupation">
                    </div>
                </div>
            </div>
            

            <div class="row">
                <!-- Resume and Shift -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="resume">Resume (PDF, DOC, DOCX)</label>
                        <input type="file" class="form-control" id="resume" name="resume">
                        @if (old('resume') && file_exists(public_path(old('resume'))))
                            <div class="mt-2">
                                <a href="{{ asset(old('resume')) }}" target="_blank" class="btn btn-info btn-sm">View Resume</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tbl_shift_id">Shift</label>
                        <select class="form-control" id="tbl_shift_id" name="tbl_shift_id">
                            <option selected>Select Shift</option>
                            @foreach ($shifts as $shift)
                                <option value="{{ $shift->id }}" {{ old('tbl_shift_id') == $shift->id ? 'selected' : '' }}>
                                    {{ ucwords($shift->shift_type) }} ({{ $shift->start_time }} - {{ $shift->end_time }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tbl_role_id">Role</label>
                        <select class="form-control" id="tbl_role_id" name="tbl_role_id">
                            <option selected>Select Role</option>
                            @foreach ($roles as $role)
                                <option  value="{{ $role->id }}" {{ old('tbl_role_id') == $role->id ? 'selected' : '' }}>
                                    {{ ucwords($role->role_name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Create User</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <!-- No need for Select2 JS -->
    <script>
        // You can add custom JavaScript here if needed, otherwise leave it empty.
    </script>
@endsection
