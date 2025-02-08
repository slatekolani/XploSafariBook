@extends('layouts.main', ['title' => __("Edit Event"), 'header' => __('Edit Event')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($event,['enctype="multipart/form-data"','route' => ['event.update', $event->uuid], 'method'=>'put','autocomplete' => 'off',
         'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $event->id, []) }}
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
                                    <a href="{{asset('public/eventImages/'.$event->event_image)}}">Previous Image</a>
                                    <div class="form-group">
                                        {{ Form::label('event_image', __("Event image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('event_image', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'event_image', 'required']) }}
                                        {!! $errors->first('event_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('event_name', __("Event name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('event_name', $event->event_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'event_name', 'required']) }}
                                        {!! $errors->first('event_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('event_description', __("Event description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('event_description', $event->event_description, ['class' => 'form-control','style'=>'height:100px','placeholder'=>'This event was due to .....', 'maxLength'=>'300', 'autocomplete' => 'off', 'id' => 'event_description', 'required']) }}
                                        {!! $errors->first('event_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('event_date', __("Event date"), ['class' => 'required_asterik']) }}
                                        {{ Form::date('event_date', $event->event_date, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'event_date']) }}
                                        {!! $errors->first('event_date', '<span class="badge badge-danger">:message</span>') !!}
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


