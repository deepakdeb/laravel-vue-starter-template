@extends('app')

@section('content')
<div class="container login-container px-0">
    <div class="row justify-content-center  h-100 no-margin">
        <div class="col-md-4 login-left d-flex align-items-center h-100">
            <div class="login-inner-wrapper">
                <div class="logo-area">
                    <span>Smarter HR</span>
                </div>
                <div class="logo-content-area">
                    <p>A comprehensive cloud based Saas software for Bangladesh capable of carrying out all your HR and payroll processing functions at one place</p>
                    <p>Go to <a class="" target="_blank" href="http://www.atlhr.com/">ATL HR</a> website</p>
                </div>
            </div>
        </div>
        <div class="col-md-8 login-right d-flex align-items-center h-100">
            <div class="users-style">
                <p class="text-center mb-5" style="color: #001C38; font-weight: 700;">{{ __('Reset Password') }}</p>
                <div role="alert" class="alert alert-success">
                    You will be redirect to login page after password reset.
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
    
                    <input type="hidden" name="token" value="{{ $token }}">
    
                    <div class="form-group">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                        <div class="">
                            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
    
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                        <div class="">
                            <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                        <div class="">
                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
    
                    <div class="form-group mb-0">
                        <div class="">
                            <button type="submit" class="btn btn-primary login-btn w-100">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
