@extends('layouts.main', ['title' => __("Edit Nation"), 'header' => __('Edit Nation')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($nation,['enctype="multipart/form-data"','route' => ['nation.update', $nation->uuid], 'method'=>'put','autocomplete' => 'off',
    'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $nation->id, []) }}
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
                                        {{ Form::text('nation_name', $nation->nation_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nation_name', 'required']) }}
                                        {!! $errors->first('nation_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('nation_flag', __("Nation flag"), ['class' => 'required_asterik']) }}
                                        <a href="{{ url('public/nationFlags/' . $nation->nation_flag) }}" style="max-width: 100%; height: auto;">Previous image</a>
                                        {{ Form::file('nation_flag', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nation_flag']) }}
                                        {!! $errors->first('nation_flag', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>

                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_map', __("Tourist map"), ['class' => 'required_asterik']) }}
                                        <a href="{{url('public/touristMap/'.$nation->tourist_map)}}">Previous Map</a>
                                        {{ Form::file('tourist_map', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_map']) }}
                                        {!! $errors->first('tourist_map', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('nation_description', __("Nation description"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('nation_description', $nation->nation_description, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nation_description', 'required']) }}
                                        {!! $errors->first('nation_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('population', __("Population"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('population', $nation->population, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'population', 'required']) }}
                                        {!! $errors->first('population', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('google_map', __("Google map"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('google_map', $nation->google_map, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'google_map', 'required']) }}
                                        {!! $errors->first('google_map', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('nation_history', __("Nation history"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('nation_history', $nation->nation_history, ['class' => 'form-control','maxLength'=>'500','style'=>'height:100px', 'autocomplete' => 'off', 'id' => 'nation_history', 'required']) }}
                                        {!! $errors->first('nation_history', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Economic activities in Tanzania</h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table id="economicActivities">
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Economic activity title</th>
                                                    <th>Economic activity description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($nationEconomicActivities as $nationEconomicActivity)
                                                    <tr id="economicActivities{{$nationEconomicActivity->id}}">
                                                        <td><input type="text" class="form-control" name="economic_activity_title{{$nationEconomicActivity->id}}" value="{{$nationEconomicActivity->economic_activity_title}}" maxlength="50" required></td>
                                                        <td><input type="text" class="form-control" maxlength="200" name="economic_activity_description{{$nationEconomicActivity->id}}" value="{{$nationEconomicActivity->economic_activity_description}}" required></td>
                                                        <td><a href="{{route('nation.deleteEconomicActivity',$nationEconomicActivity->uuid)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                    </tr>
                                                @empty
                                                    <tr id="economicActivities">
                                                        <td><input type="text" class="form-control" name="economic_activity_title1" maxlength="50" required></td>
                                                        <td><input type="text" class="form-control" maxlength="200" name="economic_activity_description1" required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addEconomicActivity">+</a></td>
                                                    </tr>
                                                @endforelse
                                                <td><a class="btn btn-primary btn-sm" id="addEconomicActivity">Add</a></td>
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
                                            <table id="precautions">
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Precaution title</th>
                                                    <th>Precaution description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($nationPrecautions as $nationPrecaution)
                                                    <tr id="precautions{{$nationPrecaution->id}}">
                                                    <td><input type="text" class="form-control" name="precaution_title{{$nationPrecaution->id}}" value="{{$nationPrecaution->precaution_title}}" maxlength="50" required></td>
                                                    <td><input type="text" class="form-control" maxlength="200" name="precaution_description{{$nationPrecaution->id}}" value="{{$nationPrecaution->precaution_description}}" required></td>
                                                    <td><a href="{{route('nation.deleteNationPrecaution',$nationPrecaution->uuid)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                </tr>
                                                @empty
                                                    <tr id="precautions">
                                                        <td><input type="text" class="form-control" name="precaution_title1" maxlength="50" required></td>
                                                        <td><input type="text" class="form-control" maxlength="200" name="precaution_description1" required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addPrecaution">+</a></td>
                                                    </tr>
                                                @endforelse
                                                <td><a class="btn btn-primary btn-sm" id="addPrecaution">Add</a></td>
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
@endpush
@push('after-scripts')
    <script>
        $(document).ready(function (){
            var i = {{$nationEconomicActivities->count() + 1}};
            $('#addEconomicActivity').on('click', function(){
                i++;
                var html
                html +='<tr>';
                html += '<td><input type="text" class="form-control" name="economic_activity_title'+i+'" maxlength="50" required></td>';
                html += '<td><input type="text" class="form-control" name="economic_activity_description'+i+'" maxlength="200" required></td>';
                html += '<td><a class="fas fa-pencil-alt removeEconomicActivity">-</a></td>';
                html += '</tr>';
                $('#economicActivities tbody').append(html);
            });

            $(document).on('click', '.removeEconomicActivity', function(){
                $(this).closest('tr').remove();
            });
        });
    </script>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function(){
            var i= {{$nationPrecautions->count() + 1}};
            $('#addPrecaution').on('click',function (){
                i++;
                var html;
                html += '<tr>';
                html += '<td><input type="text" class="form-control" name="precaution_title'+i+'" maxlength="50" required></td>';
                html += '<td><input type="text" class="form-control" maxlength="200" name="precaution_description'+i+'" required></td>';
                html += '<td><a class="fas fa-pencil-alt removePrecaution">-</a></td>';
                html += '</tr>';
                $('#precautions tbody').append(html);
            })
            $(document).on('click','.removePrecaution',function(){
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush


