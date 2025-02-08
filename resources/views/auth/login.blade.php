@extends('layouts.main', ['title' => __("label.login"), 'header' => __("label.login")])

@include('includes.validate_assets')

@push('after-styles-end')
<style>
    body {
        background: url('https://source.unsplash.com/1600x900/?travel,landscape') no-repeat center center fixed;
        background-size: cover;
    }
    .login-container {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-top: 50px;
    }
    .login-header {
        background-color: #3498db;
        color: white;
        padding: 20px;
        border-radius: 10px 10px 0 0;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin: -30px -30px 30px -30px;
    }
    .form-control {
        border-radius: 20px;
    }
    .btn-login {
        background-color: #3498db;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    .btn-login:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }
    .forgot-password {
        color: #3498db;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .forgot-password:hover {
        color: #2980b9;
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="container" style="background-color:white">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login-container">
                <div class="login-header" style="font-size: 20px;text-align:center;padding:20px 20px 20px 20px;color:dodgerblue">
                    {{ __('Welcome to Your Next Adventure!') }}
                </div>
                {{ Form::open(['url' => 'login', 'autocomplete' => 'off', 'class' => 'needs-validation', 'novalidate' , 'name' => 'login']) }}
                @csrf
                <div class="form-group">
                    {{ Form::label('email', __("label.email")) }}
                    {{ Form::text('email', null, ['class' => 'form-control create', 'autocomplete' => 'off', 'id' => 'email', 'aria-describedby' => 'emailHelp', 'required', 'placeholder' => 'Enter your email']) }}
                    <small id="emailHelp" class="form-text text-muted">{{ __('label.email_helper') }}</small>
                    {!!  $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('password', __("label.password")) }}
                    {{ Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password', 'required', 'placeholder' => 'Enter your password']) }}
                    {!! $errors->first('password', '<span class="badge badge-danger">:message</span>') !!}
                </div>
                <div class="form-group form-check">
                    {{ Form::checkbox('remember', '1', false, ['class' => 'form-check-input', 'id' => 'remember']) }}
                    {{ Form::label('remember', __("label.remember"), ['class' => 'form-check-label']) }}
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-block btn-login">@lang("label.submit")</button>
                </div>
                <div class="form-group text-center">
                    <a href="{{ route('password.request') }}" class="forgot-password">{{ __('passwords.forgot_password') }}</a>
                </div>
                <hr>
                <p class="text-center">@lang('label.account?')
                    <a href="{{ route('register') }}">@lang("Register an account")</a>
                </p>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script type="text/javascript">
    $('body').on('submit', 'form[name=login]', function (e) {
        e.preventDefault();
        var $email = $('#email').val();
        var lower_email = $email.toLowerCase();
        $("input[name=email]").val(lower_email);
        this.submit();
    });
</script>
@endpush