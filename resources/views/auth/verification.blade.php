@extends('layouts.main', ['title' => __("label.home"), 'header' => __("label.account_verification")])

@push('after-styles-end')
    <style>

    </style>
@endpush

@section('content')

    <section class="card">
        <div class="card-body">

            <div class="row">

                <div class="col-md-6  offset-md-3">
                    <center>
                        <i class="fas fa-lock" style="font-size: 50px;color: darkred;"></i>
                    </center>
                    <p>
                        @lang("label.dear"),
                    </p>
                    <p>
                        {{ getLanguageBlock('lang.auth.verification', ['mobile' => $user->company()->first()->mobile, 'email' => $user->company()->first()->email ]) }}
                    </p>

                    <center>

                        {{ Form::open(['route' => ['auth.account.confirm.code', $user->uuid], 'autocomplete' => 'off', 'class' => 'needs-validation', 'novalidate']) }}
                        {{ Form::label('confirmation_code', __("label.confirmation_code"), ['class' => 'required_asterik']) }}
                        <div class="col-3">
                        {{ Form::text('confirmation_code', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                        </div>
    {!! $errors->first('confirmation_code', '<span class="badge badge-danger">:message</span>') !!}
    <br>
    {{ Form::button(trans('label.sms.confirm_account'), ['class' => 'btn btn-primary', 'type'=>'submit', 'style' => 'border-radius: 6px;margin-bottom: 10px;']) }} {{ Form::close() }}



    {{ Form::open(['route' => ['auth.account.confirm.resend.sms', $user->uuid]]) }}
    {{ Form::button(trans('label.sms.resend'), ['class' => 'btn btn-success', 'type'=>'submit', 'style' => 'border-radius: 6px;margin-bottom: 10px;']) }}
    {{ Form::close() }}
</center>
</div> <!-- /.col-md-8 -->

</div> <!-- /.row -->

</div>
</section>
<br/>
<div class="row">
<div class="col-md-10">
{{--@include("includes/news/recent")--}}
</div>
<div class="col-md-2">
{{--We place advertisement here--}}
{{--@include("includes/ads/right_advert")--}}
</div>
</div>

<div class="row">
<div class="col-md-12">
{{--@include("includes/forums/recent_article")--}}
</div>
</div>

@endsection

@push('after-scripts')

@endpush
