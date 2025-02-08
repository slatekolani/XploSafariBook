@extends('layouts.main', ['title' => __("label.stakeholder.edit_contact_person"), 'header' => __("label.stakeholder.edit_contact_person")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    <style>

    </style>
@endpush

@section('content')

    <section class="card">
        <div class="card-body">


            {{ Form::model($user,['route' => ['stakeholder.contact_person.update'],'method'=>'put',
            'name' => 'update']) }}


            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">


                        <div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('name', __("label.firstname"), ['class' => 'required_asterik']) }}
                                {{ Form::text('name', $user->name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'name', 'aria-describedby' => 'firstnameHelp', 'required']) }}
                                <small id="firstnameHelp" class="form-text text-muted"></small>
                                {!! $errors->first('name', '<span class="badge badge-danger">:message</span>') !!}
                             </div>
                         </div>


                         <div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                             <div class="form-group">
                                 {{ Form::label('othernames', __("label.othernames"), ['class' => 'required_asterik']) }}
                                 {{ Form::text('othernames', $user->othernames, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'othernames', 'aria-describedby' => 'othernamesHelp', 'required']) }}
                                 <small id="othernamesHelp" class="form-text text-muted">{{ __("label.othernames_helper") }}</small>
     {!! $errors->first('othernames', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>


</div>
</div>
</div>




<div class="row">
<div class="col-sm-12">

<div class="row">


<div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
<div class="form-group">
    {{ Form::label('email', __("label.email.index"), ['class' => 'required_asterik']) }}
    {{ Form::text('email', $user->email, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'email', 'aria-describedby' => 'emailHelp', 'required']) }}
    <small id="emailHelp" class="form-text text-muted">{{ __("label.email_helper") }}</small>
    {!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>



<div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
<div class="form-group">
    {{ Form::label('country', __("label.country"), ['class' => 'required_asterik']) }}
    {{ Form::select('country', code_value()->getCountryForSelect(), $user->country->code, ['class' => 'form-control select2', 'placeholder' => '', 'autocomplete' => 'off', 'id' => 'country', 'aria-describedby' => 'countryHelp', 'required']) }}
    <small id="countryHelp" class="form-text text-muted">{{ __("label.country_helper") }}</small>
    {!! $errors->first('country', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>


</div>
</div>
</div>



<div class="row">
<div class="col-sm-12">

<div class="row">

<div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
<div class="form-group">
    {{ Form::label('phone', __("label.phone"), ['class' => 'required_asterik']) }}
    {{ Form::text('phone', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'phone', 'aria-describedby' => 'phoneHelp', 'required']) }}
    <small id="phoneHelp" class="form-text text-muted"></small>
    {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>



<div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
<div class="form-group">
    {{ Form::label('region', __("label.region"), ['class' => 'required_asterik']) }}
    {{ Form::select('region',  code_value()->getRegionForSelect(), isset($user->region_id) ? $user->region_id : [], [ 'class' => 'form-control select2', 'placeholder' => '', 'autocomplete' => 'off', 'id' => 'region', 'aria-describedby' => '', 'required']) }}

    {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>
</div>
</div>
</div>



<div class="row">
<div class="col-sm-12">

<div class="row">


<div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
<div class="form-group">
    {{ Form::label('user_account_cv_id', __("label.account_type"), ['class' => 'required_asterik']) }}
    {{ Form::select('user_account_cv_id[]', code_value()->getPortalUserForSelect(), $account_types, ['id'=> 'account_select',  'class' => 'form-control select2', 'placeholder' => '', 'autocomplete' => 'off', 'id' => 'user_account_cv_id', 'aria-describedby' => 'accounttypeHelp', 'required']) }}
    <small id="accounttypeHelp" class="form-text text-muted">{{ __("label.account_type_helper") }}</small>
    {!! $errors->first('user_account_cv_id', '<span class="badge badge-danger">:message</span>') !!}
 </div>
 </div>



 <div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 col-xs-12">
 <div class="form-group">
     {{ Form::label('city', __("label.city"), ['class' => 'required_asterik']) }}
     {{ Form::text('province', $user->province, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'province', 'aria-describedby' => '', 'required']) }}
     {!! $errors->first('province', '<span class="badge badge-danger">:message</span>')!!}
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
{{ link_to_route('stakeholder.contact_person.profile',trans('buttons.general.cancel'),[],['id'=> 'cancel', 'class' => 'btn btn-primary cancel_button', ]) }}
{{ Form::button(trans('label.submit'), ['class' => 'btn btn-primary', 'type'=>'submit', 'style' => 'border-radius: 5px;']) }}
</div>
</div>
</div>
</div>




{{ Form::close() }}


</div>

</section>


@endsection

@push('after-scripts')
{{ Html::script(url('vendor/select2/js/select2.min.js')) }}
<script>
$(function() {
$(".select2").select2();



region_province_option('country', 'region', 'province', 'region_origin_div', 'province_origin_div');
$("#country").on('change', function (e){
region_province_option('country', 'region', 'province', 'region_origin_div', 'province_origin_div');
});


/*Region / city input option depend on country selected*/
function region_province_option(country_id, region_id, city_id, $region_div, $city_div) {
var choice = $("#"+country_id).val();
switch (choice) {
case 'TZ':
enable_disable('enable', region_id);
enable_disable('disable', city_id);
$("#" + city_id).val(' ').change();
break;
default:
$("#" + region_id).val('0').change();
enable_disable('disable', region_id);
enable_disable('enable', city_id);
}
}


/*Enable / disable inputs*/
function enable_disable(choice, element_id){
switch (choice) {
case 'enable':
$("#"+element_id).prop("disabled", false);
break;
case 'disable':
$("#"+element_id).prop("disabled", true);
break;
}
}


});
</script>
@endpush















