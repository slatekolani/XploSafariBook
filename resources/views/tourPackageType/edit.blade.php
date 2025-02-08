@extends('layouts.main', ['title' => __("Edit tour package type"), 'header' => __('Edit tour package type')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($tourPackageType,['enctype="multipart/form-data"','route' => ['tourPackageType.update', $tourPackageType->uuid], 'method'=>'put','autocomplete' => 'off',
         'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $tourPackageType->id, []) }}
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
                                    <a href="{{asset('public/packageTypeImage/'.$tourPackageType->tour_package_type_image)}}" target="_blank">Previous Image</a>
                                    <div class="form-group">
                                        {{ Form::label('tour_package_type_image', __("Tour package type image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('tour_package_type_image', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tour_package_type_image']) }}
                                        {!! $errors->first('tour_package_type_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_package_type_name', __("Tour package type name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('tour_package_type_name', $tourPackageType->tour_package_type_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tour_package_type_name', 'placeholder'=>'Couples package', 'required']) }}
                                        {!! $errors->first('tour_package_type_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_package_type_description', __("Tour package type description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('tour_package_type_description', $tourPackageType->tour_package_type_description, ['class' => 'form-control','style'=>'height:100px','placeholder'=>'This package is special for couples .....', 'maxLength'=>'300', 'autocomplete' => 'off', 'id' => 'tour_package_type_description', 'required']) }}
                                        {!! $errors->first('tour_package_type_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Update'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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


