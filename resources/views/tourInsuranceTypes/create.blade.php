@extends('layouts.main', ['title' => __("Add Tour Insurance Type"), 'header' => __('Add Tour Insurance Type')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['route'=>'tourInsuranceType.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
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
                                        {{ Form::label('tour_insurance_name', __("Tour insurance name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('tour_insurance_name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tour_insurance_name', 'required']) }}
                                        {!! $errors->first('tour_insurance_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_insurance_description', __("Tour insurance description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('tour_insurance_description', null, ['class' => 'form-control','style'=>'width:400px;height:150px','maxLength'=>'200', 'autocomplete' => 'off', 'id' => 'tour_insurance_description', 'required']) }}
                                        {!! $errors->first('tour_insurance_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Add'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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

