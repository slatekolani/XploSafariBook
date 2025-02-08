@extends('layouts.main', ['title' => __("Edit visit advice to - " . $tanzaniaVisitAdvice->nation->nation_name), 'header' => __('Edit visit advice to - ' . $tanzaniaVisitAdvice->nation->nation_name)])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($tanzaniaVisitAdvice,['route' => ['tanzaniaVisitAdvice.update', $tanzaniaVisitAdvice->uuid], 'method'=>'put','autocomplete' => 'off',
     'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $tanzaniaVisitAdvice->id, []) }}
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
                                        {{ Form::label('advice_title', __("Advice title"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('advice_title', $tanzaniaVisitAdvice->advice_title, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'advice_title', 'required']) }}
                                        {!! $errors->first('advice_title', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('advice_description', __("Advice description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('advice_description', $tanzaniaVisitAdvice->advice_description, ['class' => 'form-control','maxLength'=>'300','style'=>'height:100px', 'autocomplete' => 'off', 'id' => 'advice_description', 'required']) }}
                                        {!! $errors->first('advice_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('directory_url', __("Directory url"), ['class' => 'required_asterik']) }}
                                        {{ Form::url('directory_url', $tanzaniaVisitAdvice->directory_url, ['class' => 'form-control','autocomplete' => 'off', 'id' => 'directory_url', 'required']) }}
                                        {!! $errors->first('directory_url', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <input type="text" name="nation_id" value="{{$tanzaniaVisitAdvice->nation_id}}" hidden>
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

