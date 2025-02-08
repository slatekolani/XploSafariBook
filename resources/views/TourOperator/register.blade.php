@extends('layouts.main', ['title' => __("label.registration"), 'header' => __("label.registration")])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['enctype="multipart/form-data"','route'=>'tourOperator.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
    @csrf
    <section>
        <div class="row" style="margin: auto">
            <div class="col-md-12">
                <div class="card" style="margin: auto">
                    <div class="card-body">
                        <div class="col-md-12">
                            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('company_name', __("Company name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('company_name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'company_name', 'required']) }}
                                        {!! $errors->first('company_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('email_address', __("label.email"), ['class' => 'required_asterik']) }}
                                        {{ Form::email('email_address', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'email_address', 'required']) }}
                                        {!! $errors->first('email_address', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('phone_number', __("Phone number"), ['class' => 'required_asterik']) }}
                                        {{ Form::tel('phone_number', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'phone_number', 'required']) }}
                                        {!! $errors->first('phone_number', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('region', __("Company headquarter region"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('region',$regionsOfOperations,null, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'region', 'required']) }}
                                        {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('postal_code', __("Postal Code"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('postal_code',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'postal_code','maxLength'=>'10', 'required']) }}
                                        {!! $errors->first('postal_code', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tin_number', __("Tin Number"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('tin_number',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tin_number','maxLength'=>'9', 'required']) }}
                                        {!! $errors->first('tin_number', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('physical_location', __("Physical Location"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('physical_location',null, ['class' => 'form-control', 'autocomplete' => 'off','placeholder'=>'NSSF Kaloleni Plaza,Ground Floor', 'id' => 'physical_location','maxLength'=>'50', 'required']) }}
                                        {!! $errors->first('physical_location', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('established_date', __("Company establishment date"), ['class' => 'required_asterik']) }}
                                        {{ Form::date('established_date',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'established_date', 'required']) }}
                                        {!! $errors->first('established_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_employees', __("Total employees"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_employees',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'total_employees', 'required']) }}
                                        {!! $errors->first('total_employees', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('about_company', __("Company short description"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('about_company',null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder'=>'eg. We provide services to take you higher!','maxLength'=>'100','id' => 'about_company', 'required']) }}
                                        {!! $errors->first('about_company', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ Form::label('role', __("Do you accept custom bookings?"), ['class' => 'required_asterik']) }}
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="agreeCustomBooking" id="Yes" value="Yes">
                                                    <label for="agreeCustomBooking" class="form-check-label">Yes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="agreeCustomBooking" id="No" value="No">
                                                    <label for="agreeCustomBooking" class="form-check-label">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_company_touristic_activities', __("Activities a Company can offer"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('tour_company_touristic_activities[]',$touristicActivities,null, ['class' => 'form-control select2','multiple', 'autocomplete' => 'off', 'id' => 'tour_company_touristic_activities', 'required']) }}
                                        {!! $errors->first('tour_company_touristic_activities', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('company_nation', __("Company nation"), ['class' => 'required_asterik']) }}
                                                {{ Form::select('company_nation',$nations,null, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'company_nation', 'required']) }}
                                                {!! $errors->first('company_nation', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('company_logo', __("Company logo"), ['class' => 'required_asterik']) }}
                                                {{ Form::file('company_logo',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'company_logo', 'required']) }}
                                                {!! $errors->first('company_logo', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('company_team_image', __("Company team image"), ['class' => 'required_asterik']) }}
                                                {{ Form::file('company_team_image',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'company_team_image', 'required']) }}
                                                {!! $errors->first('company_team_image', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('verification_certificate', __("Company registration licence"), ['class' => 'required_asterik']) }}
                                                {{ Form::file('verification_certificate',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'verification_certificate', 'required']) }}
                                                {!! $errors->first('verification_certificate', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('tato_membership_certificate', __("TATO membership certificate"), ['class' => 'required_asterik']) }}
                                                {{ Form::file('tato_membership_certificate',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tato_membership_certificate', 'required']) }}
                                                {!! $errors->first('tato_membership_certificate', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('terms_and_conditions', __("Company Terms and Conditions"), ['class' => 'required_asterik']) }}
                                                {{ Form::file('terms_and_conditions',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'terms_and_conditions', 'required']) }}
                                                {!! $errors->first('terms_and_conditions', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('website_url', __("Company website url"), ['class' => 'required_asterik']) }}
                                                {{ Form::url('website_url', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'website_url', 'required']) }}
                                                {!! $errors->first('website_url', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('instagram_url', __("Company instagram url"), ['class' => 'required_asterik']) }}
                                                {{ Form::url('instagram_url',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'instagram_url', 'required']) }}
                                                {!! $errors->first('instagram_url', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('whatsapp_url', __("WhatsApp url"), ['class' => 'required_asterik']) }}
                                                {{ Form::url('whatsapp_url',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'whatsapp_url', 'required']) }}
                                                {!! $errors->first('whatsapp_url', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('gps_url', __("Company GPS location url"), ['class' => 'required_asterik']) }}
                                                {{ Form::url('gps_url',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'gps_url', 'required']) }}
                                                {!! $errors->first('gps_url', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('support_time_range', __("Support time range"), ['class' => 'required_asterik']) }}
                                                {{ Form::text('support_time_range',null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder'=>'24 hours after request received','id' => 'support_time_range', 'required']) }}
                                                {!! $errors->first('support_time_range', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('safari_area_preferences', __("Safari Area Preferences"), ['class' => 'required_asterik']) }}
                                                {{ Form::select('safari_area_preferences[]',$tourist_attractions,null, ['class' => 'form-control select2','multiple', 'autocomplete' => 'off', 'id' => 'safari_area_preferences', 'required']) }}
                                                {!! $errors->first('safari_area_preferences', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('regions_of_operation', __("Regions of operation"), ['class' => 'required_asterik']) }}
                                                {{ Form::select('regions_of_operation[]',$regionsOfOperations,null, ['class' => 'form-control select2','multiple', 'autocomplete' => 'off', 'id' => 'regions_of_operation', 'required']) }}
                                                {!! $errors->first('regions_of_operation', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('insurance_types_offered', __("Insurances you provide"), ['class' => 'required_asterik']) }}
                                                {{ Form::select('insurance_types_offered[]',$tourInsuranceTypes,null, ['class' => 'form-control select2','multiple', 'autocomplete' => 'off', 'id' => 'insurance_types_offered', 'required']) }}
                                                {!! $errors->first('insurance_types_offered', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        {{ Form::label('role', __("What safari do you provide?"), ['class' => 'required_asterik']) }}
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="safariClass" id="localTours" value="localTours">
                                                            <label for="localTours" class="form-check-label">Local Safari Tours</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="safariClass" id="internationalTours" value="internationalTours">
                                                            <label for="internationalTours" class="form-check-label">International Safari Tours</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="safariClass" id="bothLocalAndInternationalTours" value="bothLocalAndInternationalTours">
                                                            <label for="bothLocalAndInternationalTours" class="form-check-label">Both International & Local Tours</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('label.register'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
                                        </div>
                                    </div>
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
@push('after-scripts')

    <script>
        $(function () {
            $(".select2").select2();


        });

    </script>
@endpush

