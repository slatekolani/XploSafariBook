@extends('layouts.main', ['title' => __("Create Honey points - " . $touristicAttraction->attraction_name), 'header' => __('Create Honey points - ' . $touristicAttraction->attraction_name)])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['route' => 'touristicAttractionHoneyPoint.store', 'autocomplete' => 'off', 'method' => 'post', 'class' => 'needs-validation', 'novalidate', 'enctype' => 'multipart/form-data']) }}
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
                                        {{ Form::label('honey_point_name', __("Honey point name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('honey_point_name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'honey_point_name', 'required']) }}
                                        {!! $errors->first('honey_point_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('honey_point_description', __("Honey point description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('honey_point_description', null, ['class' => 'form-control','style'=>'height:100px', 'autocomplete' => 'off', 'id' => 'honey_point_description', 'required']) }}
                                        {!! $errors->first('honey_point_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('honey_point_image', __("Honey point image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('honey_point_image', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'honey_point_image', 'required']) }}
                                        {!! $errors->first('honey_point_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="touristic_attraction_id" value="{{$touristicAttraction->id}}" hidden>
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

