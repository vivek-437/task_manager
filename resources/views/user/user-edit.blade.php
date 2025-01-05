@extends('layouts.master')

@section('title', 'Edit User Details')

@section('css')
    <!-- Add custom CSS if needed -->
@endsection

@section('content')
    <div class="container">
        <h3>Edit User Details</h3>
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <!-- Name and Email -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->userDetails->address ?? '') }}">
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->userDetails->phone ?? '') }}">
            </div>

            <!-- Date of Birth -->
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->userDetails->date_of_birth ?? '') }}">
            </div>

            <!-- Gender -->
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="male" {{ old('gender', $user->userDetails->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $user->userDetails->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $user->userDetails->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Profile Image -->
            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" class="form-control" id="profile_image" name="profile_image">
                @if ($user->userDetails && $user->userDetails->profile_image_path)
                    <div class="mt-2">
                        <img src="{{ asset($user->userDetails->profile_image_path) }}" alt="Profile Image" width="100">
                    </div>
                @endif
            </div>

            <!-- Bio -->
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control" id="bio" name="bio">{{ old('bio', $user->userDetails->bio ?? '') }}</textarea>
            </div>

            <!-- Nationality -->
            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $user->userDetails->nationality ?? '') }}">
            </div>

            <!-- Occupation -->
            <div class="form-group">
                <label for="occupation">Occupation</label>
                <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation', $user->userDetails->occupation ?? '') }}">
            </div>

            <!-- Resume -->
            <div class="form-group">
                <label for="resume">Resume (PDF, DOC, DOCX)</label>
                <input type="file" class="form-control" id="resume" name="resume">
                @if ($user->userDetails && $user->userDetails->resume_path)
                    <div class="mt-2">
                        <a href="{{ asset($user->userDetails->resume_path) }}" target="_blank">View Resume</a>
                    </div>
                @endif
            </div>

            <!-- Shift -->
            <div class="form-group">
                <label for="tbl_shift_id">Shift</label>
                <select class="form-control" id="tbl_shift_id" name="tbl_shift_id">
                    <option selected>Select Shift</option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}"
                            {{ old('tbl_shift_id') == $shift->start_time ? 'selected' : '' }}
                            {{ $user->userDetails->tbl_shift_id == $shift->id ? 'selected' : '' }}>
                            {{ ucwords($shift->shift_type) }} ({{ $shift->start_time }} - {{ $shift->end_time }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Role -->
            <div class="form-group">
                <label for="tbl_role_id">Role</label>
                <select class="form-control" id="tbl_role_id" name="tbl_role_id">
                    <option selected>Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('tbl_role_id', $userRole) == $role->id ? 'selected' : '' }}>
                            {{ ucwords($role->role_name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection

@section('script')
    <!-- Add custom scripts if needed -->
@endsection
