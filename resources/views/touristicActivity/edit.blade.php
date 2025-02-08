@extends('layouts.main', ['title' => __("Edit touristic activity"), 'header' => __('Edit touristic activity')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($touristicActivity,['enctype="multipart/form-data"','route' => ['touristicActivity.update', $touristicActivity->uuid], 'method'=>'put','autocomplete' => 'off',
         'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $touristicActivity->id, []) }}
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
                                    <a href="{{asset('public/touristicActivityImage/'.$touristicActivity->activity_image)}}" target="_blank">Previous Image</a>
                                    <div class="form-group">
                                        {{ Form::label('activity_image', __("Touristic Activity Image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('activity_image', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'activity_image']) }}
                                        {!! $errors->first('activity_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('activity_name', __("Touristic Activity Name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('activity_name', $touristicActivity->activity_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'activity_name', 'placeholder'=>'Couples package', 'required']) }}
                                        {!! $errors->first('activity_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('activity_description', __("Touristic activity Description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('activity_description', $touristicActivity->activity_description, ['class' => 'form-control','style'=>'height:100px','placeholder'=>'Go for bird watching...', 'maxLength'=>'300', 'autocomplete' => 'off', 'id' => 'activity_description', 'required']) }}
                                        {!! $errors->first('activity_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('best_activity_period', __("Best Activity Period"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('best_activity_period', $touristicActivity->best_activity_period, ['class' => 'form-control','placeholder'=>'Starting from September .....', 'maxLength'=>'300', 'autocomplete' => 'off', 'id' => 'best_activity_period', 'required']) }}
                                        {!! $errors->first('best_activity_period', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('basic_information', __("Basic Information"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('basic_information', $touristicActivity->basic_information, ['class' => 'form-control','style'=>'height:100px','placeholder'=>'This activity will get you involved in 2001 bird species .....', 'maxLength'=>'500', 'autocomplete' => 'off', 'id' => 'basic_information', 'required']) }}
                                        {!! $errors->first('basic_information', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table id="activityTip">
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Tip title</th>
                                                    <th>Tip description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($touristicActivityConductTips as $touristicActivityConductTip)
                                                    <tr id="activityTip{{$touristicActivityConductTip->id}}">
                                                    <td><input type="text" class="form-control" name="tip_name{{$touristicActivityConductTip->id}}" value="{{$touristicActivityConductTip->tip_name}}" required></td>
                                                    <td><input type="text" class="form-control" maxlength="500" name="tip_description{{$touristicActivityConductTip->id}}" value="{{$touristicActivityConductTip->tip_description}}" required></td>
                                                    <td><a href="{{route('touristicActivity.deleteTouristicActivityConductTip',$touristicActivityConductTip->uuid)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                    </tr>
                                                @empty
                                                    <tr id="activityTip">
                                                        <td><input type="text" class="form-control" name="tip_name1" maxlength="50" required></td>
                                                        <td><input type="text" class="form-control" maxlength="500" name="tip_description1" required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addActivityTip">+</a></td>
                                                    </tr>
                                                @endforelse
                                                <td><a class="btn btn-primary btn-sm" id="addActivityTip">Add</a></td>
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


