@extends('layouts.main', ['title' => __("Edit attraction category"), 'header' => __('Edit attraction category')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($touristicAttractionCategory,['route' => ['touristicAttractionCategory.update', $touristicAttractionCategory->uuid], 'method'=>'put','autocomplete' => 'off',
     'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate','files' => true, 'enctype' => 'multipart/form-data']) }}
    {{ Form::hidden('user_id', $touristicAttractionCategory->id, []) }}
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
                                        <a href="{{ asset('public/TouristicAttractionCategoryIconicImages/'.$touristicAttractionCategory->attraction_category_iconic_image) }}" target="_blank">
                                            <img src="{{ asset('public/TouristicAttractionCategoryIconicImages/'.$touristicAttractionCategory->attraction_category_iconic_image) }}" alt="iconic image" style="width: 100px; height: 100px;"></a>
                                        {{ Form::label('attraction_category_iconic_image', __("Attraction category Iconic Image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('attraction_category_iconic_image', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'attraction_category_iconic_image', 'required']) }}
                                        {!! $errors->first('attraction_category_iconic_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('attraction_category', __("Attraction category"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('attraction_category', $touristicAttractionCategory->attraction_category, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'attraction_category', 'required']) }}
                                        {!! $errors->first('attraction_category', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('attraction_category_description', __("Attraction category description"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('attraction_category_description', $touristicAttractionCategory->attraction_category_description, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'attraction_category_description', 'required']) }}
                                        {!! $errors->first('attraction_category_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('attraction_category_basic_information', __("Attraction Category basic information"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('attraction_category_basic_information', $touristicAttractionCategory->attraction_category_basic_information, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'attraction_category_basic_information', 'style'=>'height:80px', 'required']) }}
                                        {!! $errors->first('attraction_category_basic_information', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('attraction_category_touristic_activities', __("Attraction Category Touristic Activities"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('attraction_category_touristic_activities[]', $touristicActivities, $categoryTouristicActivities, ['class' => 'form-control select2','multiple', 'autocomplete' => 'off', 'id' => 'attraction_category_touristic_activities', 'style'=>'height:80px', 'required']) }}
                                        {!! $errors->first('attraction_category_touristic_activities', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
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

