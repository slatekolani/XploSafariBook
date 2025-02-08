@extends('layouts.main', ['title' => __("Create Activity"), 'header' => __('Create Activity')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['enctype="multipart/form-data"','route'=>'touristicActivity.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
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
                                        {{ Form::label('activity_image', __("Activity image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('activity_image', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'activity_image', 'required']) }}
                                        {!! $errors->first('activity_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('activity_name', __("Touristic Activity name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('activity_name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'activity_name', 'required']) }}
                                        {!! $errors->first('activity_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('activity_description', __("Touristic Activity description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('activity_description', null, ['class' => 'form-control','style'=>'height:100px','placeholder'=>'This activity involves .....', 'maxLength'=>'300', 'autocomplete' => 'off', 'id' => 'activity_description', 'required']) }}
                                        {!! $errors->first('activity_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('best_activity_period', __("Best Activity Period"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('best_activity_period', null, ['class' => 'form-control','placeholder'=>'Starting from September .....', 'maxLength'=>'300', 'autocomplete' => 'off', 'id' => 'best_activity_period', 'required']) }}
                                        {!! $errors->first('best_activity_period', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('basic_information', __("Basic Information"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('basic_information', null, ['class' => 'form-control','style'=>'height:100px','placeholder'=>'This activity will get you involved in 2001 bird species .....', 'maxLength'=>'500', 'autocomplete' => 'off', 'id' => 'basic_information', 'required']) }}
                                        {!! $errors->first('basic_information', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Activity Tips</h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table>
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Tip Title</th>
                                                    <th>Tip Description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id="activityTip">
                                                    <td><input type="text" class="form-control" name="tip_name1" required></td>
                                                    <td><input type="text" class="form-control" maxlength="500" name="tip_description1" required></td>
                                                    <td><a class="fas fa-pencil-alt" id="addActivityTip">+</a></td>
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

<script>
    $(document).ready(function (){
        var i=1;
        $('#addActivityTip').on('click',function (){
           i++;
           var html='';
           html += '<tr>';
           html += '<td><input type="text" class="form-control" name="tip_name'+i+'" maxlength="50" required></td>';
           html += '<td><input type="text" class="form-control" maxlength="500" name="tip_description'+i+'" required></td>';
           html += '<td><a class="fas fa-pencil-alt danger" id="removeActivityTip">-</a></td>';
           html += '</tr>';
           $('#activityTip').append(html);
        })
        $(document).on('click','#removeActivityTip',function (){
            $(this).closest('tr').remove();
        })
    })
</script>

@endpush


