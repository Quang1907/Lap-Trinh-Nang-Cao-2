@extends('layouts.app')

@section('content')
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo">
                        <img src="../../images/logo.svg" alt="logo">
                    </div>
                    <h4>Hello! let's get started</h4>
                    <h6 class="font-weight-light">Sign in to continue.</h6>
                    <form class="pt-3" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group my-2">
                            <input type="email" class="form-control @error('email') is-invalid @enderror form-control-lg"
                                id="exampleInputEmail1" placeholder="Username" value="{{ old('email') }}" name="email"
                                autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password"
                                class="form-control @error('password') is-invalid @enderror form-control-lg"
                                id="exampleInputPassword1" placeholder="Password" name="password"
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit"
                                class="btn btn-block btn-primary btn-sm font-weight-medium auth-form-btn">SIGN IN</button>
                        </div>
                        <hr>
                        <div class="my-2 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <label class="form-check-label text-muted">
                                    <input type="checkbox" class="form-check-input">
                                    Keep me signed in
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}"
                                class="auth-link text-black text-decoration-none">Forgot password?</a>
                        </div>
                        <div class="mb-2">
                            <a href="{{ route('auth.facebook') }}" class="btn btn-block btn-primary auth-form-btn">
                                <i class="ti-facebook mr-2"></i>Facebook
                            </a>
                            <span>or</span>
                            <a href="{{ route('auth.google') }}" class="btn btn-danger btn-sm"><i
                                    class="fa-brands fa-google"></i> Google</a>
                        </div>
                        <div class="text-center mt-4 font-weight-light">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-primary text-decoration-none">Create</a>
                        </div>
                        <div class="text-center mt-4 font-weight-light ">
                            <a href="{{ route('home') }}" class="text-primary text-decoration-none">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
