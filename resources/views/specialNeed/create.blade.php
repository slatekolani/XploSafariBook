@extends('layouts.main', ['title' => __("Add Special Needs"), 'header' => __('Add Special Needs')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['route'=>'specialNeed.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
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
                                        {{ Form::label('special_need_icon', __("Special need Icon"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('special_need_icon', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'special_need_icon', 'required']) }}
                                        {!! $errors->first('special_need_icon', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('special_need_name', __("Special need"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('special_need_name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'special_need_name', 'required']) }}
                                        {!! $errors->first('special_need_name', '<span class="badge badge-danger">:message</span>') !!}
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

