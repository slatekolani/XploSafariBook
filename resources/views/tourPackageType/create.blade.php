@extends('layouts.main', ['title' => __("Create Tour Package Type"), 'header' => __('Create Tour Package Type')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['enctype="multipart/form-data"','route'=>'tourPackageType.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
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
                                        {{ Form::label('tour_package_type_image', __("Tour package type image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('tour_package_type_image', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tour_package_type_image', 'required']) }}
                                        {!! $errors->first('tour_package_type_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_package_type_name', __("Tour package type"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('tour_package_type_name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tour_package_type_name', 'required']) }}
                                        {!! $errors->first('tour_package_type_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_package_type_description', __("Tour package type description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('tour_package_type_description', null, ['class' => 'form-control','style'=>'height:100px','placeholder'=>'This package is special for couples .....', 'maxLength'=>'300', 'autocomplete' => 'off', 'id' => 'tour_package_type_description', 'required']) }}
                                        {!! $errors->first('tour_package_type_description', '<span class="badge badge-danger">:message</span>') !!}
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


