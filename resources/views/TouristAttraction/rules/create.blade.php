@extends('layouts.main', ['title' => __("Create attraction rule"), 'header' => __('Create attraction rule')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['route' => 'touristicAttractionRule.store', 'autocomplete' => 'off', 'method' => 'post', 'class' => 'needs-validation', 'novalidate', 'files' => true, 'enctype' => 'multipart/form-data']) }}
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
                                        {{ Form::label('rule_title', __("Rule title"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('rule_title', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'rule_title', 'required']) }}
                                        {!! $errors->first('rule_title', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('rule_description', __("Attraction description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('rule_description', null, ['class' => 'form-control','style'=>'height:100px','maxLength'=>'300', 'autocomplete' => 'off', 'id' => 'rule_description', 'required']) }}
                                        {!! $errors->first('rule_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <input name="nation_id" value="{{$nation->id}}" hidden>
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

