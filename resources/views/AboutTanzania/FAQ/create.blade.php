@extends('layouts.main', ['title' => __("Faq - " . $nation->nation_name), 'header' => __('Faq - ' . $nation->nation_name)])

@include('includes.validate_assets')
@section('content')
    {{ Form::open(['route'=>'tanzaniaFAQ.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
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
                                        {{ Form::text('question_title', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'question_title', 'required']) }}
                                        {!! $errors->first('question_title', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('question_answer', __("Question answer"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('question_answer', null, ['class' => 'form-control','maxLength'=>'300','style'=>'height:100px', 'autocomplete' => 'off', 'id' => 'question_answer', 'required']) }}
                                        {!! $errors->first('question_answer', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <input type="text" name="nation_id" value="{{$nation->id}}" hidden>
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

