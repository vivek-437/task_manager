@extends('layouts.master')
@section('title', 'User Profile')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Add custom styles here */
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <nav class="nav flex-column">
                <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard"><i
                        class="bi bi-house-door"></i> Dashboard</a>
                <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders"><i class="bi bi-box"></i> Orders</a>
                <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses"><i class="bi bi-geo-alt"></i>
                    Addresses</a>
                <a class="nav-link" id="account-details-tab" data-toggle="tab" href="#account-details"><i
                        class="bi bi-person-circle"></i> Account Details</a>
                <a class="nav-link" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </nav>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <!-- Dashboard Tab -->
                <div class="tab-pane fade show active" id="dashboard">
                    <h3 class="text-primary">Dashboard</h3>
                    <p>Hello <strong>{{ $user->name }}</strong> (not <strong>{{ $user->name }}</strong>? <a
                            href="{{ route('logout') }}">Log out</a>)</p>
                    <p>From your account dashboard, you can view your <a href="#">recent orders</a>, manage your <a
                            href="#">shipping and billing addresses</a>, and <a href="#">edit your password and
                            account details</a>.</p>
                </div>

                <!-- Orders Tab -->
                <div class="tab-pane fade" id="orders">
                    <h3>Your Orders</h3>
                    <!-- Order table goes here -->
                </div>

                <!-- Addresses Tab -->
                <div class="tab-pane fade" id="addresses">
                    <h3>Addresses</h3>
                    <p>The following addresses will be used on the checkout page by default.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Billing Address</h5>
                            <address class="address">
                                {{ $user->details->address ?? 'No address provided' }}
                            </address>
                            <a href="#" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                        </div>
                        <div class="col-md-6">
                            <h5>Shipping Address</h5>
                            <address class="address">
                                {{ $user->details->address ?? 'No address provided' }}
                            </address>
                            <a href="#" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                        </div>
                    </div>
                </div>

                <!-- Account Details Tab -->
                <div class="tab-pane fade" id="account-details">
                    <h3>Account Details</h3>
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="account_first_name">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="account_first_name" name="account_first_name"
                                value="{{ $user->first_name }}">
                        </div>
                        <div class="form-group">
                            <label for="account_last_name">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="account_last_name" name="account_last_name"
                                value="{{ $user->last_name }}">
                        </div>
                        <div class="form-group">
                            <label for="account_email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="account_email" name="account_email"
                                value="{{ $user->email }}">
                        </div>

                        <!-- Gender and Bio -->
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="male" {{ $user->userDetails->gender == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ $user->userDetails->gender == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other" {{ $user->userDetails->gender == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea class="form-control" id="bio" name="bio">{{ $user->userDetails->bio }}</textarea>
                        </div>

                        <!-- Password Reset Option -->
                        <fieldset>
                            <legend>Password Change</legend>
                            <div class="form-group">
                                <label for="password_current">Current Password</label>
                                <input type="password" class="form-control" id="password_current" name="password_current"
                                    autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password_1">New Password</label>
                                <input type="password" class="form-control" id="password_1" name="password_1"
                                    autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password_2">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_2" name="password_2"
                                    autocomplete="off">
                            </div>
                        </fieldset>

                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Optionally, you can add some JS for interactivity here
    </script>
@endsection
