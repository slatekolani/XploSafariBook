@extends('layouts.main', ['title' => __("Edit Transport"), 'header' => __('Edit Transport')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($transport_name,['route' => ['transport.update', $transport_name->uuid], 'method'=>'put','autocomplete' => 'off',
        'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $transport_name->id, []) }}
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
                                        {{ Form::label('transport_name', __("Transport name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('transport_name', $transport_name->transport_icon, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'transport_name', 'required']) }}
                                        {!! $errors->first('transport_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('transport_name', __("Transport name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('transport_name', $transport_name->transport_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'transport_name', 'required']) }}
                                        {!! $errors->first('transport_name', '<span class="badge badge-danger">:message</span>') !!}
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

