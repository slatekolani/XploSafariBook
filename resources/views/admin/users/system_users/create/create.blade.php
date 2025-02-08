@extends('layouts.main', ['title' => __('label.create_user'), 'header' => trans('label.create_user')])

@include('includes.validate_assets')



@section('content')
    {{ Form::open(['route' => 'admin.user_manage.store_system_user', 'autocomplete' => 'off', 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}

    <section class="card">
        <div class="card-body">
            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
            {{-- User account type(Administrative) --}}

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        {{-- Left --}}
                        <div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('username', __('label.username'), ['class' => 'required_asterik']) }}
                                {{ Form::text('username', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'username', 'required']) }}
                                {!! $errors->first('username', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>


                        <div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('phone', __('label.phone'), ['class' => 'required_asterik']) }}
                                {{ Form::text('phone', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'phone', 'aria-describedby' => 'phoneHelp', 'required']) }}
                                <small id="phoneHelp" class="form-text text-muted"></small>
                                {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        {{-- Right --}}
                        <div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('email', __('label.email'), ['class' => 'required_asterik']) }}
                                {{ Form::text('email', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'email', 'aria-describedby' => 'emailHelp', 'required']) }}
                                <small id="emailHelp" class="form-text text-muted">{{ __('label.email_helper') }}</small>
                                {!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>

                        <div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('roles', __('Role'), ['class' => 'required_asterik']) }}
                                {{ Form::select('role_id', $roles, null, ['class' => 'form-control select2', 'placeholder' => '', 'autocomplete' => 'off',  'id' => 'role_id', 'aria-describedby' => '', 'required']) }}
                                {!! $errors->first('role_id', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('password', __('label.password'), ['class' => 'required_asterik']) }}
                                {{ Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password', 'required']) }}
                                {!! $errors->first('password', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        {{-- Right --}}
                        <div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('password_confirmation', __('label.password_confirmation'), ['class' => 'required_asterik']) }}
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password_confirmation', 'required']) }}
                                {!! $errors->first('password_confirmation', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


        <br />
        {{-- Buttons --}}
        <div class="row">
            <div class="col-md-6">
                <div class="element-form">
                    <div class="form-group pull-left">
                        {{ link_to_route('admin.user_manage.system_users', trans('buttons.general.cancel'), [], ['id' => 'cancel', 'class' => 'btn btn-primary cancel_button']) }}
                        {{ Form::button(trans('label.register'), ['class' => 'btn btn-primary', 'type' => 'submit', 'style' => 'border-radius: 5px;']) }}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <br />
    {{ Form::close() }}
@endsection

@push('after-scripts')
    <script>
        $(function() {
            $(".select2").select2();

        });
    </script>
@endpush
