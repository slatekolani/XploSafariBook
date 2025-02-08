@extends('layouts.main', ['title' => __("Editing Culture - " .$regionCulture->culture_name ), 'header' => __('Editing Culture - ' .$regionCulture->culture_name)])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($regionCulture,['enctype="multipart/form-data"','route' => ['regionCulture.update', $regionCulture->uuid], 'method'=>'put','autocomplete' => 'off',
          'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $regionCulture->id, []) }}
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
                                        {{ Form::label('culture_name', __("Culture name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('culture_name', $regionCulture->culture_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'culture_name', 'required']) }}
                                        {!! $errors->first('culture_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('basic_information', __("Basic information"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('basic_information',$regionCulture->basic_information, ['class' => 'form-control', 'autocomplete' => 'off','style'=>'height:80px','maxLength'=>'500','id' => 'basic_information', 'required']) }}
                                        {!! $errors->first('basic_information', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('culture_image', __("Culture image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('culture_image[]', ['class' => 'form-control','multiple'=>true, 'autocomplete' => 'off','maxLength'=>'100','id' => 'culture_image']) }}
                                        {!! $errors->first('culture_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('traditional_language', __("Traditional language"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('traditional_language', $regionCulture->traditional_language, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'traditional_language', 'style'=>'height:80px','maxLength'=>'500', 'required']) }}
                                        {!! $errors->first('traditional_language', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('traditional_dance', __("Traditional dance"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('traditional_dance', $regionCulture->traditional_dance, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'traditional_dance', 'required']) }}
                                        {!! $errors->first('traditional_dance', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('traditional_dance_description', __("Traditional dance description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('traditional_dance_description', $regionCulture->traditional_dance_description, ['class' => 'form-control','style'=>'height:80px','maxLength'=>'500', 'autocomplete' => 'off', 'id' => 'traditional_dance_description', 'required']) }}
                                        {!! $errors->first('traditional_dance_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('traditional_food', __("Traditional food"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('traditional_food', $regionCulture->traditional_food, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'traditional_food', 'required']) }}
                                        {!! $errors->first('traditional_food', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('traditional_food_description', __("Traditional food description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('traditional_food_description', $regionCulture->traditional_food_description, ['class' => 'form-control', 'autocomplete' => 'off','style'=>'height:80px','maxLength'=>'500', 'id' => 'traditional_food_description', 'required']) }}
                                        {!! $errors->first('traditional_food_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('culture_history', __("Culture history"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('culture_history', $regionCulture->culture_history, ['class' => 'form-control', 'autocomplete' => 'off','id' => 'culture_history', 'style'=>'height:80px','maxLength'=>'500','required']) }}
                                        {!! $errors->first('culture_history', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('cultural_video', __("Cultural video")) }}
                                        {{ Form::text('cultural_video', $regionCulture->cultural_video, ['class' => 'form-control', 'autocomplete' => 'off','id' => 'cultural_video']) }}
                                        {!! $errors->first('cultural_video', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('conclusion', __("Conclusion"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('conclusion', $regionCulture->conclusion, ['class' => 'form-control', 'autocomplete' => 'off','maxLength'=>'500','style'=>'height:80px','id' => 'conclusion','required']) }}
                                        {!! $errors->first('conclusion', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table id="cultureCharacteristic">
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Characteristic title</th>
                                                    <th>Characteristic description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($regionCultureCharacteristics as $regionCultureCharacteristic)
                                                    <tr id="cultureCharacteristic{{$regionCultureCharacteristic->id}}">
                                                    <td><input type="text" class="form-control" name="characteristic_title{{$regionCultureCharacteristic->id}}" value="{{$regionCultureCharacteristic->characteristic_title}}" maxlength="500" required></td>
                                                    <td><input type="text" class="form-control" maxlength="500" name="characteristic_description{{$regionCultureCharacteristic->id}}" value="{{$regionCultureCharacteristic->characteristic_description}}" required></td>
                                                    <td><a href="{{route('regionCulture.deleteCharacteristic',$regionCultureCharacteristic->uuid)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                    </tr>
                                                @empty
                                                    <tr id="cultureCharacteristic">
                                                        <td><input type="text" class="form-control" name="characteristic_title1" maxlength="50" required></td>
                                                        <td><input type="text" class="form-control" maxlength="500" name="characteristic_description1" required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addCultureCharacteristic">+</a></td>
                                                    </tr>
                                                @endforelse
                                                <td><a class="btn btn-primary btn-sm" id="addCultureCharacteristic">Add</a></td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Activities to do to appeciate the culture </h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table id="appreciationActivity">
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Activity to do description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($cultureAppreciationActivities as $cultureAppreciationActivity)
                                                    <tr id="appreciationActivity{{$cultureAppreciationActivity->id}}">
                                                    <td><input type="text" class="form-control" name="appreciation_activity_detail{{$cultureAppreciationActivity->id}}" value="{{$cultureAppreciationActivity->appreciation_activity_detail}}" maxlength="500" required></td>
                                                    <td><a href="{{route('regionCulture.deleteAppreciationActivities',$cultureAppreciationActivity->uuid)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                    </tr>
                                                @empty
                                                    <tr id="appreciationActivity">
                                                        <td><input type="text" class="form-control" name="appreciation_activity_detail1" maxlength="500" required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addAppreciationActivity">+</a></td>
                                                    </tr>
                                                @endforelse
                                                <td><a class="btn btn-primary btn-sm" id="addAppreciationActivity">Add</a></td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        


                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Challenges the culture Faces</h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table id="challengeDetail">
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Challenge Detail</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($cultureChallenges as $cultureChallenge)
                                                    <tr id="challengeDetail{{$cultureChallenge->id}}">
                                                    <td><input type="text" class="form-control" name="culture_challenges_detailed{{$cultureChallenge->id}}" value="{{$cultureChallenge->culture_challenges_detailed}}" maxlength="500" required></td>
                                                    <td><a href="{{route('regionCulture.deleteCultureChallenge',$cultureChallenge->uuid)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                    </tr>
                                                @empty
                                                    <tr id="challengeDetail">
                                                        <td><input type="text" class="form-control" name="culture_challenges_detailed1" maxlength="500" required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addChallengeDetail">+</a></td>
                                                    </tr>
                                                @endforelse
                                                <td><a class="btn btn-primary btn-sm" id="addChallengeDetail">Add</a></td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <input type="text" name="tanzania_region_id" value="{{$regionCulture->tanzania_region_id}}" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('update'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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
            var i={{$cultureChallenges->count() + 1}};
            $('#addCultureCharacteristic').on('click',function (){
                i++;
                var html='';
                html += '<tr>';
                html += '<td><input type="text" class="form-control" name="characteristic_title'+i+'" maxlength="50" required></td>';
                html += '<td><input type="text" class="form-control" maxlength="500" name="characteristic_description'+i+'" required></td>';
                html += '<td><a class="fas fa-pencil-alt danger" id="removeCultureCharacteristic">-</a></td>';
                html += '</tr>';
                $('#cultureCharacteristic tbody').append(html);
            })
            $(document).on('click','#removeCultureCharacteristic',function (){
                $(this).closest('tr').remove();
            })
        })
    </script>

    <script>
        $(document).ready(function (){
            var i={{$cultureAppreciationActivities->count() + 1}};
            $('#addAppreciationActivity').on('click',function (){
                i++;
                var html='';
                html += '<tr>';
                html += '<td><input type="text" class="form-control" name="appreciation_activity_detail'+i+'" maxlength="500" required></td>';
                html += '<td><a class="fas fa-pencil-alt danger" id="removeAppreciationActivity">-</a></td>';
                html += '</tr>';
                $('#appreciationActivity tbody').append(html);
            })
            $(document).on('click','#removeAppreciationActivity',function (){
                $(this).closest('tr').remove();
            })
        })
    </script>
    
    <script>
        $(document).ready(function (){
            var i={{$cultureChallenges->count() + 1}};
            $('#addChallengeDetail').on('click',function (){
                i++;
                var html='';
                html += '<tr>';
                html += '<td><input type="text" class="form-control" name="culture_challenges_detailed'+i+'" maxlength="500" required></td>';
                html += '<td><a class="fas fa-pencil-alt danger" id="removeChallengeDetail">-</a></td>';
                html += '</tr>';
                $('#challengeDetail tbody').append(html);
            })
            $(document).on('click','#removeChallengeDetail',function (){
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush



