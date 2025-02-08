@extends('layouts.main', ['title' => __('label.registration'), 'header' => __('label.registration')])

@include('includes.validate_assets')

@push('after-styles-end')
<style>
    .register-container {
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 40px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .register-header {
        text-align: center;
        margin-bottom: 35px;
        position: relative;
        padding-bottom: 15px;
    }

    .register-header:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #2ecc71, #3498db);
        border-radius: 2px;
    }

    .register-header h2 {
        color: #2c3e50;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .register-header p {
        color: #7f8c8d;
        font-size: 16px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        color: #34495e;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .form-control {
        height: 48px;
        border-radius: 12px;
        border: 2px solid #e0e0e0;
        padding: 10px 15px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
    }

    .role-options {
        display:flex;
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .role-options .form-check {
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .role-options .form-check:hover {
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .role-options .form-check-input {
        margin-top: 3px;
    }

    .role-options .form-check-label {
        font-weight: 500;
        color: #2c3e50;
        margin-left: 8px;
    }

    .captcha-section {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .captcha {
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .reflash {
        color: #3498db;
        text-decoration: none;
        font-size: 14px;
        margin-left: 10px;
    }

    .reflash:hover {
        text-decoration: underline;
    }

    .terms-check {
        margin: 20px 0;
    }

    .terms-check a {
        color: #3498db;
        text-decoration: none;
    }

    .terms-check a:hover {
        text-decoration: underline;
    }

    .btn-register {
        height: 50px;
        background: linear-gradient(to right, #2ecc71, #3498db);
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        font-size: 16px;
        letter-spacing: 0.5px;
        padding: 0 30px;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(46, 204, 113, 0.2);
    }

    .badge-danger {
        background-color: #e74c3c;
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 12px;
        margin-top: 5px;
        display: inline-block;
    }
</style>
@endpush

@section('content')
<div class="container" style="background-color:white">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="register-container">
                <div class="register-header">
                    <h2 style="color: dodgerblue">{{ __('Start Your Journey') }}</h2>
                    <p>{{ __('Join our community of travelers and adventure seekers') }}</p>
                </div>

                {{ Form::open(['url' => 'register', 'autocomplete' => 'off', 'class' => 'needs-validation', 'novalidate']) }}
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('username', __("label.username"), ['class' => 'required_asterik']) }}
                            {{ Form::text('username', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'username', 'required']) }}
                            {!! $errors->first('username', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('email', __("label.email"), ['class' => 'required_asterik']) }}
                            {{ Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'email', 'aria-describedby' => 'emailHelp', 'required']) }}
                            {!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('phone', __("label.phone"), ['class' => 'required_asterik']) }}
                            {{ Form::tel('phone', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'phone', 'aria-describedby' => 'phoneHelp', 'required']) }}
                            {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('password', __("label.password"), ['class' => 'required_asterik']) }}
                            {{ Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password', 'required']) }}
                            {!! $errors->first('password', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('password_confirmation', __("label.password_confirmation"), ['class' => 'required_asterik']) }}
                            {{ Form::password('password_confirmation', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password_confirmation', 'required']) }}
                            {!! $errors->first('password_confirmation', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="form-group">
                                    {{ Form::label('role', __("Register as?"), ['class' => 'required_asterik']) }}
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="role" id="TourOperator" value="2">
                                        <label for="TourOperator" class="form-check-label">Tour Operator</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="role" id="Tourist" value="3">
                                        <label for="Tourist" class="form-check-label">Tourist</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="captcha-section">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            {{ Form::label('captcha', trans('label.captcha')) }}
                            <div class="d-flex align-items-center">
                                <img src="{{ captcha_src() }}" onclick="this.src='/captcha/default?'+Math.random()"
                                    id="captchaCode" alt="" class="captcha">
                                <a rel="nofollow" href="javascript:;"
                                    onclick="document.getElementById('captchaCode').src='captcha/default?'+Math.random()"
                                    class="reflash">@lang('label.refresh')</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{ Form::text('captcha', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'captcha', 'required', 'placeholder' => 'Enter captcha']) }}
                            {!! $errors->first('captcha', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>

                <div class="terms-check">
                    <div class="form-check">
                        {{ Form::checkbox('term_check', '1', false, ['class' => 'form-check-input', 'required']) }}
                        <label class="form-check-label">
                            I agree to the <a href="#">Privacy Policy</a> & <a href="#">Terms and Conditions</a>
                        </label>
                    </div>
                </div>

                <div class="text-center" style="padding: 20px 20px 20px 20px">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i>
                        @lang('label.register')
                    </button>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script type="text/javascript">
    $('body').on('submit', 'form', function(e) {
        e.preventDefault();
        this.submit();
    });
</script>
@endpush