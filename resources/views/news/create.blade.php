@extends('layouts.main', ['title' => __("Create News"), 'header' => __('Create News')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['enctype="multipart/form-data"','route'=>'news.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
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
                                        {{ Form::label('news_title', __("News title"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('news_title', null, ['class' => 'form-control', 'autocomplete' => 'off','maxLength'=>'30', 'id' => 'news_title', 'required']) }}
                                        {!! $errors->first('news_title', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('news_description', __("News description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('news_description', null, ['class' => 'form-control','maxLength'=>'1000', 'autocomplete' => 'off', 'id' => 'news_description', 'required']) }}
                                        {!! $errors->first('news_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('news_image', __("News image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('news_image', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'news_image', 'required']) }}
                                        {!! $errors->first('news_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Post'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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

