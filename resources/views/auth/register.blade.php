@extends('layouts.app')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="../../images/logo.svg" alt="logo">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3" action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="form-group my-2">
                                    <input type="text"
                                        class="form-control  @error('name') is-invalid @enderror form-control-lg"
                                        placeholder="Name" name="name" value="{{ old('name') }}" autocomplete="name"
                                        autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group my-2">
                                    <input type="text"
                                        class="form-control  @error('phonenumber') is-invalid @enderror form-control-lg"
                                        placeholder="Phonenumber" value="{{ old('phonenumber') }}" name="phonenumber">
                                    @error('phonenumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group my-2">
                                    <input type="date"
                                        class="form-control  @error('birthday') is-invalid @enderror form-control-lg"
                                        placeholder="Birthday" value="{{ old('birthday') }}" name="birthday">
                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group my-2">
                                    <input type="text"
                                        class="form-control  @error('address') is-invalid @enderror form-control-lg"
                                        placeholder="Address" value="{{ old('address') }}" name="address">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group my-2">
                                    <input type="email"
                                        class="form-control  @error('name') is-invalid @enderror form-control-lg"
                                        placeholder="Email" value="{{ old('email') }}" name="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group my-2">
                                    <select class="form-control form-control-lg" name="gender">
                                        <option value='0'>Male</option>
                                        <option value='1'>Famale</option>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1"
                                        placeholder="Password" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group my-2">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1"
                                        placeholder="Password" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            I agree to all Terms & Conditions
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">SIGN UP</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="{{ route('login') }}"
                                        class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
