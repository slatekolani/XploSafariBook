@extends('layouts.main', ['title' => 'Edit FAQ-'.(\App\Models\TouristicAttractions\touristicAttractions::find($touristAttractionFaq->touristic_attraction_id)->attraction_name), 'header' => 'Edit FAQ-'.(\App\Models\TouristicAttractions\touristicAttractions::find($touristAttractionFaq->touristic_attraction_id)->attraction_name)])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($touristAttractionFaq,['route' => ['touristicAttraction.updateTouristAttractionFAQ', $touristAttractionFaq->uuid], 'method'=>'put','autocomplete' => 'off',
              'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('id', $touristAttractionFaq->id, []) }}
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
                                        {{ Form::label('question_title', __("Question title"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('question_title', $touristAttractionFaq->question_title, ['class' => 'form-control', 'autocomplete' => 'off','maxLength'=>'50', 'id' => 'question_title', 'required']) }}
                                        {!! $errors->first('question_title', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('question_description', __("Question description "), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('question_description', $touristAttractionFaq->question_description, ['class' => 'form-control','maxLength'=>'500', 'autocomplete' => 'off', 'id' => 'question_description', 'required']) }}
                                        {!! $errors->first('question_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <input class="form-control" name="touristic_attraction_id" value="{{$touristAttractionFaq->touristic_attraction_id}}" hidden>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Update Answer'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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

