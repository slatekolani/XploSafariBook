<div class="col-sm-4 mx-auto">
    <section class="body-sign col-sm-12 mx-auto">
        <div class="top-sign">
            <a href="{{ url('/') }}" class="logo float-left">
                <img src="{{ url("img/np_logo.png") }}"   height="54" alt="NEXTPROJECT" />
            </a>

            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-right ">
                    <h2 class="title text-uppercase font-weight-bold m-0" style="background-color: #32464a"><i class="fas fa-user mr-1"></i>{{ __('label.login') }}</h2>
                </div>
                <div class="card-body" style="border-top-color:#32464a">
                    {{ Form::open(['url' => 'login', 'autocomplete' => 'off', 'class' => 'needs-validation', 'novalidate']) }}
                    {{--<form action="index.html" method="post">--}}
                    <div class="form-group mb-3">
                        {{ Form::label('email', __("label.email")) }}
                        <div class="input-group">
                            {{--<input name="username" type="text" class="form-control form-control-lg" />--}}
                            {{ Form::text('email', null, ['class' => 'form-control form-control-lg create', 'autocomplete' => 'off', 'id' => 'email', 'aria-describedby' => 'emailHelp', 'required','placeholder' => 'info@gmail.com']) }}
                            <span class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-user"></i>
										</span>
									</span>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">{{ __('label.email_helper') }}</small>
{!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
</div>

<div class="form-group mb-3">
<div class="clearfix">
    {{ Form::label('password', __("label.password")) }}
    <a href="{{ route('password.request') }}" class="float-right">{{ __('passwords.forgot_password') }}</a>
</div>
<div class="input-group">
    {{ Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password', 'required']) }}
    <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
            </span>
</div>
{!!  $errors->first('password', '<span class="badge badge-danger">:message</span>') !!}

</div>

<div class="row">
<div class="col-sm-8">
    <div class="checkbox-custom checkbox-default">
        {{ Form::checkbox('remember', '1', false, ['class' => 'form-check-input', 'id' => 'remember']) }}
        {{ Form::label('remember', __("label.remember"), ['class' => 'form-check-label']) }}
    </div>
</div>
<div class="col-sm-4 text-right">
    <button type="submit" class="btn btn-dark">@lang("label.submit")</button>
</div>
</div>

<br>
<span >

@lang("label.account?dont")  <span class="separator"></span>
{{--{{ link_to('/login', __("label.login"), ['class' => 'btn btn-sm btn-default']) }}--}}
{{ link_to('/register', __("label.registration"), ['class' => 'btn btn-lg btn-outline-info']) }}
&nbsp;
</span>
{{ Form::close() }}
{{--</form>--}}
</div>
</div>
</div>

</section>

</div>