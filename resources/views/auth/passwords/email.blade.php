@extends('app')

@section('content')
@guest
<div class="container h-100 px-0 login-container">
    <div class="row justify-content-center h-100 no-margin">
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

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <p class="" style="font-size: 16px; color: rgba(0, 28, 56, 1); margin-bottom: 20px;">Please enter your account email in the box below to get the password reset link.</p>
                    <div class="form-group row no-margin">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12 px-0">
                            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0 no-margin">
                        <div class="col-md-12 px-0">
                            <button type="submit" class="btn btn-primary login-btn w-100">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
                <div class="signup-link-container clearfix">
                    <a class="btn btn-link float-right forget-pass-link mt-3 p-0" href="{{ url('/') }}/login">
                        Go Back to Login Page
                    </a>                                   
                </div>
            </div>
        </div>
    </div>
    <div class="social-icons">
        <ul class="p-0 m-0">
            <li class="mr-2"><a target="_blank" href="https://www.facebook.com/atlhrbd"><b-icon icon="facebook" font-scale="3" style="color: #fff;"></b-icon></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/company/atlhr/"><b-icon icon="linkedin" font-scale="3" style="color: #fff;"></b-icon></a></li>
        </ul>
    </div>
</div>
@else
    <script type="text/javascript">
        window.location = "{{ route('home') }}";//here double curly bracket
    </script>
@endguest
@endsection
