@extends('layouts.main', ['title' => __("Edit satisfaction category"), 'header' => __('Edit satisfaction category')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($satisfactionCategory,['enctype="multipart/form-data"','route' => ['customerSatisfactionCategory.update', $satisfactionCategory->uuid], 'method'=>'put','autocomplete' => 'off',
     'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $satisfactionCategory->id, []) }}
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
                                        {{ Form::label('customer_satisfaction_name', __("Customer satisfaction name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('customer_satisfaction_name', $satisfactionCategory->customer_satisfaction_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'customer_satisfaction_name', 'required']) }}
                                        {!! $errors->first('customer_satisfaction_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('customer_satisfaction_description', __("Customer satisfaction description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('customer_satisfaction_description', $satisfactionCategory->customer_satisfaction_description, ['class' => 'form-control', 'style'=>'height:100px','autocomplete' => 'off', 'maxLength'=>'300','id' => 'customer_satisfaction_description', 'required']) }}
                                        {!! $errors->first('customer_satisfaction_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
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
