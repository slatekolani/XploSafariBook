@extends('layouts.main', ['title' => __("Edit Faq"), 'header' => __('Edit Faq ')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($tanzaniaFAQ,['route' => ['tanzaniaFAQ.update', $tanzaniaFAQ->uuid], 'method'=>'put','autocomplete' => 'off',
    'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $tanzaniaFAQ->id, []) }}
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
                                        {{ Form::text('question_title', $tanzaniaFAQ->question_title, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'question_title', 'required']) }}
                                        {!! $errors->first('question_title', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('question_answer', __("Question answer"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('question_answer', $tanzaniaFAQ->question_answer, ['class' => 'form-control','maxLength'=>'300','style'=>'height:100px', 'autocomplete' => 'off', 'id' => 'question_answer', 'required']) }}
                                        {!! $errors->first('question_answer', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <input type="text" name="nation_id" value="{{$tanzaniaFAQ->nation_id}}" hidden>
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

