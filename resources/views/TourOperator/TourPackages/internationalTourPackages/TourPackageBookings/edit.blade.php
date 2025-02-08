@extends('layouts.main', ['title' => 'Trip Editing', 'header' => __('Trip Editing')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($tourPackageBooking,['enctype="multipart/form-data"','route' => ['tourPackageBookings.update', $tourPackageBooking->uuid], 'method'=>'put','autocomplete' => 'off',
    'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $tourPackageBooking->id, []) }}
    @csrf
    <section>
        <div class="row" style="margin: auto">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);margin-top: 3px">
                        <div class="col-md-12">
                            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_name', __("Full Name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('tourist_name',$tourPackageBooking->tourist_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_name', 'required']) }}
                                        {!! $errors->first('tourist_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_email_address', __("Email Address"), ['class' => 'required_asterik']) }}
                                        {{ Form::email('tourist_email_address',$tourPackageBooking->tourist_email_address, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_email_address', 'required']) }}
                                        {!! $errors->first('tourist_email_address', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_country', __("Country of Residence"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('tourist_country',$tourPackageBooking->tourist_country, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_country', 'required']) }}
                                        {!! $errors->first('tourist_country', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_phone_number', __("Phone Number"), ['class' => 'required_asterik']) }}
                                        {{ Form::tel('tourist_phone_number', $tourPackageBooking->tourist_phone_number, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_phone_number', 'required']) }}
                                        {!! $errors->first('tourist_phone_number', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_adult_travellers', __("Number of Travellers (Adults)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_adult_travellers',$tourPackageBooking->total_adult_travellers, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'total_adult_travellers', 'required']) }}
                                        {!! $errors->first('total_adult_travellers', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_children_travellers', __("Number of Travellers (Children)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_children_travellers', $tourPackageBooking->total_children_travellers, ['class' => 'form-control', 'placeholder'=>'If none write 0','autocomplete' => 'off', 'id' => 'total_children_travellers', 'required']) }}
                                        {!! $errors->first('total_children_travellers', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('message', __("Your Message"), ['class' => 'required_asterik']) }}<br>
                                        {{ Form::textarea('message',$tourPackageBooking->message, ['class' => 'form-control','style'=>'height:100px', 'autocomplete' => 'off', 'id' => 'message', 'required']) }}
                                        {!! $errors->first('message', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input name="tour_operator_id" value="{{$tourPackageBooking->tourOperator->id}}" hidden>
                                    <input name="tour_package_id" value="{{$tourPackageBooking->tour_package_id}}" hidden>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Update Request'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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

