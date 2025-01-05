@extends('auth.auth-master')

@section('title', 'Login')

@section('css')
<!-- Add any additional CSS if required -->
@endsection

@section('content')
    <div class="col-lg-4 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
                <img src="{{ URL::asset('assets/images/logo.svg') }}" alt="logo">
            </div>
            <h4>Hello! Let's get started</h4>
            <h6 class="font-weight-light">Sign in to continue.</h6>
            
            <form method="POST" action="{{ route('login.authenticate') }}" class="pt-3">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>

                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <label class="form-check-label text-muted">
                            <input type="checkbox" class="form-check-input" name="remember"> Keep me signed in
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
                </div>

                {{-- <div class="mb-2">
                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                        <i class="ti-facebook mr-2"></i> Connect using Facebook
                    </button>
                </div> --}}
            </form>
        </div>
    </div>
@endsection

@section('script')

@endsection
