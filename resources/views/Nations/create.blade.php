@extends('layouts.main', ['title' => __("Create Nation"), 'header' => __('Create Nation')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['enctype="multipart/form-data"','route'=>'nation.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
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
                                        {{ Form::label('nation_name', __("Nation name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('nation_name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nation_name', 'required']) }}
                                        {!! $errors->first('nation_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('nation_flag', __("Nation flag"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('nation_flag', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nation_flag', 'required']) }}
                                        {!! $errors->first('nation_flag', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_map', __("Tourist map"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('tourist_map', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_map', 'required']) }}
                                        {!! $errors->first('tourist_map', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('nation_description', __("Nation description"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('nation_description', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nation_description', 'required']) }}
                                        {!! $errors->first('nation_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('population', __("Population"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('population', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'population', 'required']) }}
                                        {!! $errors->first('population', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('google_map', __("Google map"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('google_map', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'google_map', 'required']) }}
                                        {!! $errors->first('google_map', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('nation_history', __("Nation history"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('nation_history', null, ['class' => 'form-control','maxLength'=>'500','style'=>'height:100px', 'autocomplete' => 'off', 'id' => 'nation_history', 'required']) }}
                                        {!! $errors->first('nation_history', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Economic activities in Tanzania</h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table>
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Economic activity title</th>
                                                    <th>Economic activity description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id="economicActivities">
                                                    <td><input type="text" class="form-control" name="economic_activity_title1" maxlength="50" required></td>
                                                    <td><input type="text" class="form-control" maxlength="200" name="economic_activity_description1" required></td>
                                                    <td><a class="fas fa-pencil-alt" id="addEconomicActivity">+</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Precautions while in Tanzania</h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table>
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Precaution title</th>
                                                    <th>Precaution description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id="precautions">
                                                    <td><input type="text" class="form-control" name="precaution_title1" maxlength="50" required></td>
                                                    <td><input type="text" class="form-control" maxlength="200" name="precaution_description1" required></td>
                                                    <td><a class="fas fa-pencil-alt" id="addPrecaution">+</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
@push('after-scripts')
    <script>
        $(document).ready(function (){
            var i=1;
            $('#addEconomicActivity').on('click',function(){
                i++;
                var html;
                html += '<tr>';
                html += '<td><input type="text" class="form-control" name="economic_activity_title'+i+'" maxlength="50" required></td>';
                html += '<td><input type="text" class="form-control" maxlength="500" name="economic_activity_description'+i+'" maxlength="200" required></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeEconomicActivity">-</a></td>';
                html += '</tr>';
                $('#economicActivities').append(html);
            })
            $(document).on('click','#removeEconomicActivity',function (){
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush
@push('after-scripts')
    <script>
        $(document).ready(function(){
            var i=1;
            $('#addPrecaution').on('click',function (){
                i++;
                var html;
                html += '<tr>';
                html += '<td><input type="text" class="form-control" name="precaution_title'+i+'" maxlength="50" required></td>';
                html += '<td><input type="text" class="form-control" maxlength="200" name="precaution_description'+i+'" required></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removePrecaution">-</a></td>';
                html += '</tr>';
                $('#precautions').append(html);
            })
            $(document).on('click','#removePrecaution',function(){
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush
