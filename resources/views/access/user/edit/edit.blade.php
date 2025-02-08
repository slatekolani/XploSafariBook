@extends('layouts.main', ['title' => __("label.user_registration.edit_user"), 'header' => __("label.user_registration.edit_user")])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($user,['route' => ['user.update', $user->uuid],'method'=>'put',
    'name' => 'update']) }}

    {{ Form::hidden('user_id', $user->id, ['class' =>'']) }}
    <section class="card">
        <div class="card-body">
            <div class="row">

                {{--First col for Registration fields--}}
                <div class="col-md-6">
                    <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>



                    <div class="row">

                        {{--Left--}}
                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('username', __("label.username"), ['class' => 'required_asterik']) }}
                                {{ Form::text('username', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'username', 'required']) }}
    {!! $errors->first('username', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>

<div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {{ Form::label('email', __("label.email"), ['class' => 'required_asterik']) }}
        {{ Form::text('email', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'email', 'aria-describedby' => 'emailHelp', 'required']) }}
        <small id="emailHelp" class="form-text text-muted">{{ __("label.email_helper") }}</small>
        {!!  $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
   </div>
</div>


</div>


<div class="row">
<div class="col-sm-12">

<div class="row">

   {{--Left--}}
  


  {{--Right--}}
  <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
          {{ Form::label('phone', __("label.phone"), ['class' => 'required_asterik']) }}
          {{ Form::text('phone', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'phone', 'aria-describedby' => 'phoneHelp', 'required']) }}
          <small id="phoneHelp" class="form-text text-muted"></small>
   {!!  $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>

</div>
</div>
</div>



<br/>

<div class="row">
<div class="col-md-6">
<div class="element-form">
<div class="form-group pull-left">
{{ link_to_route('user.profile',trans('buttons.general.cancel'),[$user->uuid],['id'=> 'cancel', 'class' => 'btn btn-primary cancel_button', ]) }}
{{ Form::button(trans('label.submit'), ['class' => 'btn btn-primary', 'type'=>'submit', 'style' => 'border-radius: 5px;']) }}
</div>
</div>
</div>
</div>
</div>

</div>

</div>
</section>
<br/>

{{ Form::close() }}
@endsection

@push('after-script')
<script>
function refreshCaptcha(){
$.ajax({
url: "/refereshcapcha",
type: 'get',
dataType: 'html',
success: function(json) {
$('.refereshrecapcha').html(json);
},
error: function(data) {
alert('Try Again.');
}
});
}


</script>
@endpush


