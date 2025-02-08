@extends('layouts.main', ['title' => __("Edit Tanzania region"), 'header' => __('Edit Tanzania region')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($tanzaniaRegion,['enctype="multipart/form-data"','route' => ['tanzaniaRegion.update', $tanzaniaRegion->uuid], 'method'=>'put','autocomplete' => 'off',
          'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $tanzaniaRegion->id, []) }}

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
                                        {{ Form::label('region_name', __("Region name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('region_name', $tanzaniaRegion->region_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'region_name', 'required']) }}
                                        {!! $errors->first('region_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('region_icon_image', __("Region icon image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('region_icon_image[]', ['class' => 'form-control','multiple'=>true, 'autocomplete' => 'off', 'id' => 'region_icon_image']) }}
                                        {!! $errors->first('region_icon_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('region_description', __("Region description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('region_description', $tanzaniaRegion->region_description, ['class' => 'form-control', 'autocomplete' => 'off','style'=>'height:80px','maxLength'=>'400','id' => 'region_description', 'required']) }}
                                        {!! $errors->first('region_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('economic_activity', __("Economic activity dominant"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('economic_activity',$regionMainEconomicActivities, $tanzaniaRegion->economic_activity, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'economic_activity', 'required']) }}
                                        {!! $errors->first('economic_activity', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('region_size', __("Region size"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('region_size', $tanzaniaRegion->region_size, ['class' => 'form-control', 'autocomplete' => 'off','style'=>'height:80px', 'maxLength'=>'400','id' => 'region_size', 'required']) }}
                                        {!! $errors->first('region_size', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('region_history', __("Region history"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('region_history', $tanzaniaRegion->region_history, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'region_history','style'=>'height:80px','maxLength'=>'400', 'required']) }}
                                        {!! $errors->first('region_history', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('population', __("Population"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('population', $tanzaniaRegion->population, ['class' => 'form-control','maxLength'=>'400','style'=>'height:80px','autocomplete' => 'off', 'id' => 'population', 'required']) }}
                                        {!! $errors->first('population', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('climatic_condition', __("Climate condition"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('climatic_condition', $tanzaniaRegion->climatic_condition, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'climatic_condition', 'style'=>'height:80px','required']) }}
                                        {!! $errors->first('climatic_condition', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('region_map', __("Embed region map"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('region_map', $tanzaniaRegion->region_map, ['class' => 'form-control', 'autocomplete' => 'off','id' => 'region_map', 'required']) }}
                                        {!! $errors->first('region_map', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('other_economic_activities', __("Economic activities"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('other_economic_activities[]',$regionMainEconomicActivities,$regionOtherEconomicActivitiesId, ['class' => 'form-control select2', 'multiple','autocomplete' => 'off','id' => 'other_economic_activities', 'required']) }}
                                        {!! $errors->first('other_economic_activities', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-8 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('transport_nature', __("Transport Nature of the region"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('transport_nature', $tanzaniaRegion->transport_nature, ['class' => 'form-control', 'autocomplete' => 'off','id' => 'transport_nature','maxLength'=>'400', 'style'=>'height:80px','required']) }}
                                        {!! $errors->first('transport_nature', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Necessary precautions</h4>
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
                                                @forelse($regionPrecautions as $regionPrecaution)
                                                <tr id="precautions{{$regionPrecaution->id}}">
                                                    <td><input type="text" class="form-control" value="{{$regionPrecaution->precaution_title}}" placeholder="Robbery" name="precaution_title{{$regionPrecaution->id}}" maxlength="50" required></td>
                                                    <td><input type="text" class="form-control" value="{{$regionPrecaution->precaution_description}}" placeholder="Be careful....." maxlength="500" name="precaution_description{{$regionPrecaution->id}}" required></td>
                                                    <td><a href="{{route('tanzaniaRegion.deleteRegionPrecaution',$regionPrecaution->uuid)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                </tr>
                                                @empty
                                                    <tr id="precautions">
                                                        <td><input type="text" class="form-control" placeholder="Robbery" name="precaution_title1" maxlength="50" required></td>
                                                        <td><input type="text" class="form-control" placeholder="Be careful....." maxlength="500" name="precaution_description1" required></td>
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
                            <input type="text" name="nation_id" value="{{$tanzaniaRegion->nation_id}}" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Submit'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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
            var i={{$regionPrecautions->count() + 1}};
            $('#addPrecaution').on('click',function (){
                i++;
                var html='';
                html +='<tr>';
                html += '<td><input type="text" class="form-control" placeholder="precaution title" name="precaution_title'+i+'" required></td>';
                html += '<td><input type="text" class="form-control" placeholder="Precaution description" maxlength="500" name="precaution_description'+i+'" required></td>';
                html += '<td><a class="fas fa-pencil-alt danger" id="removePrecaution">-</a></td>';
                html += '</tr>';
                $('#precautions tbody').append(html);
            })
            $(document).on('click','#removePrecaution',function (){
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush


