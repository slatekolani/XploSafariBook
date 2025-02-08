@extends('layouts.main', ['title' => __("label.home"), 'header' => __("label.user_registration.account_confirmation")])
@include('includes.validate_assets')

@push('after-styles-end')
    <style>

    </style>
@endpush

@section('content')

    <section class="card">
        <div class="card-body">

            <div class="row">

                <div class="col-md-6 offset-md-3">
                    <center>
                        <i class="far fa-check-square" style="font-size: 50px;"></i>
                    </center>
                    <p style="text-align: center">
                        {{ getLanguageBlock('lang.auth.registered',  ['email' => $user->email]) }}
                    </p>

                    {{ Form::open(['route' => ["auth.account.sms_confirm",$user->uuid],'method'=>'get', 'autocomplete' => 'off', 'class' => 'needs-validation', 'novalidate']) }}

                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                {{ Form::label('token', trans("label.confirmation_code")) }}
                                {{ Form::text('token', null, ['class' => 'form-control create', 'autocomplete' => 'off', 'id' => 'email', 'aria-describedby' => 'emailHelp', 'required']) }}
                                {{--<small id="emailHelp" class="form-text text-muted">{{ trans('label.confirmation_helper') }}</small>--}}
    {!! $errors->first('token', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>

</div>


<div class="table-responsive" style="margin-left: 230px;margin-top: 20px">
<button type="submit" class="btn btn-primary">@lang("label.submit")</button>

</div>

{{ Form::close() }}



{{--resend--}}
{{ Form::open(['route' => ["auth.account.confirm.resend",$user->uuid],'method'=>'post', 'autocomplete' => 'off', 'class' => 'needs-validation', 'novalidate']) }}

<div class="table-responsive" style="margin-left: 230px;margin-top: 20px">
<button type="submit" class="btn btn-info">@lang("label.resend")</button>
{{--<a href="{{ route('auth.account.confirm.resend',$user->uuid) }}" style="margin-left: 30px;margin-top: 20px">@lang('label.resend')</a>--}}
</div>
{{ Form::close() }}
</div> <!-- /.row -->


</div>
</div>

</section>


@endsection

@push('after-scripts')

@endpush
