@extends('layouts.main', ['title' => __("International Safari Package"), 'header' => __('International Safari Package')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['enctype="multipart/form-data"','route'=>'tourPackages.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
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
                                        {{ Form::label('main_safari_name', __("Main safari name"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('main_safari_name', $touristAttractions,null, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'main_safari_name', 'required']) }}
                                        {!! $errors->first('main_safari_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_package_description', __("Safari package description"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('safari_package_description',null, ['class' => 'form-control','placeholder'=>'7-Day Midrange Tanzania Safari Adventures (Big 5)', 'autocomplete' => 'off', 'id' => 'safari_package_description', 'required']) }}
                                        {!! $errors->first('safari_package_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_poster', __("Safari poster"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('safari_poster', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'safari_poster', 'required']) }}
                                        {!! $errors->first('safari_poster', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_adult_tanzanian', __("Trip price per person (Adult Tanzanian)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_adult_tanzanian', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'trip_price_adult_tanzanian', 'required']) }}
                                        {!! $errors->first('trip_price_adult_tanzanian', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_child_tanzanian', __("Trip price per person (Child Tanzanian)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_child_tanzanian', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'trip_price_child_tanzanian', 'required']) }}
                                        {!! $errors->first('trip_price_child_tanzanian', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_adult_foreigner', __("Trip price per person (Adult Foreigner)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_adult_foreigner', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'trip_price_adult_foreigner', 'required']) }}
                                        {!! $errors->first('trip_price_adult_foreigner', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_child_foreigner', __("Trip price per person (Child Foreigner)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_child_foreigner', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'trip_price_child_foreigner', 'required']) }}
                                        {!! $errors->first('trip_price_child_foreigner', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_start_date', __("Safari start date"), ['class' => 'required_asterik']) }}
                                        {{ Form::date('safari_start_date', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'safari_start_date', 'required']) }}
                                        {!! $errors->first('safari_start_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_end_date', __("Safari end date"), ['class' => 'required_asterik']) }}
                                        {{ Form::date('safari_end_date', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'safari_end_date', 'required']) }}
                                        {!! $errors->first('safari_end_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('special_need', __("Special need category"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('special_need[]',$specialNeed, null, ['class' => 'form-control select2', 'multiple', 'autocomplete' => 'off', 'id' => 'special_need', 'required']) }}
                                        {!! $errors->first('special_need', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_transport', __("Safari transports"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('safari_transport[]',$safariTransport, null, ['class' => 'form-control select2','multiple', 'autocomplete' => 'off', 'id' => 'safari_transport', 'required']) }}
                                        {!! $errors->first('safari_transport', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                            <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('safari_tour_type', __("Safari tour types"), ['class' => 'required_asterik']) }}
                                    {{ Form::select('safari_tour_type[]',$safariTourTypes, null, ['class' => 'form-control select2', 'multiple', 'autocomplete' => 'off', 'id' => 'safari_tour_type', 'required']) }}
                                    {!! $errors->first('safari_tour_type', '<span class="badge badge-danger">:message</span>') !!}
                                </div>
                            </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p>Add the tour features on your package</p>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table>
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Feature name</th>
                                                    <th>Feature description</th>
                                                </tr>
                                                </thead>
                                                <tbody id="features">
                                                <tr>
                                                    <td><input type="text" name="feature_name1" placeholder="Customised" class="form-control" required></td>
                                                    <td><input type="text" name="feature_description1" placeholder="Safari can be customised" class="form-control" required></td>
                                                    <td><a class="fas fa-pencil-alt" id="addFeature">+</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Add activities included on your package</p>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table>
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Activity name</th>
                                                    <th>Activity description</th>
                                                </tr>
                                                </thead>
                                                <tbody id="activity">
                                                <tr>
                                                    <td><input type="text" name="activity_name1" placeholder="Indoor games" class="form-control" required></td>
                                                    <td><input type="text" name="activity_description1" placeholder="Playing Expedition Games" class="form-control" required></td>
                                                    <td><a class="fas fa-pencil-alt" id="addActivity">+</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Add Trips associated on your package</p>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table>
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Day number</th>
                                                    <th>Safari trip name</th>
                                                    <th>Safari trip description</th>
                                                </tr>
                                                </thead>
                                                <tbody id="safariTrip">
                                                <tr>
                                                    <td><input type="number" name="day_number1" placeholder="1 or 1-2" class="form-control" required></td>
                                                    <td><input type="text" name="safari_trip_name1" placeholder="Arusha National Park" class="form-control" required></td>
                                                    <td><input type="text" name="safari_trip_description1" placeholder="National Park" class="form-control" required></td>
                                                    <td><a class="fas fa-pencil-alt" id="addSafariTrip">+</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Add Accommodations in respective to safari days and places included on your package</p>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table>
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Day number</th>
                                                    <th>Accommodation name</th>
                                                    <th>Accommodation description</th>
                                                    <th>Accommodation link</th>
                                                </tr>
                                                </thead>
                                                <tbody id="accommodation">
                                                <tr>
                                                    <td><input type="number" name="day_number1" placeholder="1 or 1-2" class="form-control" required></td>
                                                    <td><input type="text" name="accommodation_name1" placeholder="Expedition Hotels" class="form-control" required></td>
                                                    <td><input type="text" name="accommodation_description1" placeholder="Nice and comfort place" class="form-control" required></td>
                                                    <td><input type="url" name="accommodation_link1" placeholder="www.expeditionHotels.com" class="form-control" required></td>
                                                    <td><a class="fas fa-pencil-alt" id="addAccommodation">+</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input name="tour_operator_id" value="{{$tourOperator->id}}" hidden>
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
       $(document).ready(function(){
           var i=1;
           $('#addFeature').on('click',function(){
               i++;
               var html= '';
               html += '<tr>';
               html += '<td><input type="text" name="feature_name'+i+'" placeholder="Customised" class="form-control"></td>';
               html += '<td><input type="text" name="feature_description'+i+'" placeholder="Safari can be customised" class="form-control"></td>';
               html += '<td><a class="fas fa-pencil-alt" id="removeFeature">-</a></td>';
               html += '</tr>';
               $('#features').append(html);
           })
           $(document).on('click','#removeFeature',function (){
               $(this).closest('tr').remove();
           })
       })
    </script>
@endpush
@push('after-scripts')
    <script>
        $(document).ready(function (){
            var i;
            $('#addActivity').on('click',function (){
                i++;
                var html='';
                html += '<tr>';
                html += '<td><input type="text" name="activity_name'+i+'" placeholder="Indoor games" class="form-control" required></td></td>';
                html += '<td><input type="text" name="activity_description'+i+'" placeholder="Playing Expedition Games" class="form-control" required></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeActivity">-</a></td>';
                html += '</tr>';
                $('#activity').append(html);
            })
            $(document).on('click','#removeActivity',function (){
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function (){
            var i=1;
            $('#addSafariTrip').on('click',function (){
                i++;
                var html='';
                html += '<tr>';
                html += '<td><input type="number" name="day_number'+i+'" placeholder="1 or 1-2" class="form-control" required></td>';
                html += '<td><input type="text" name="safari_trip_name'+i+'" placeholder="Olduvai gorge" class="form-control" required></td>';
                html += '<td><input type="text" name="safari_trip_description'+i+'" placeholder="Historical site" class="form-control" required></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeSafariTrip">-</a></td>';
                html += '</tr>';
                $('#safariTrip').append(html);
            })
            $(document).on('click','#removeSafariTrip',function (){
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush
@push('after-scripts')
    <script>
        $(document).ready(function (){
            var i;
            $('#addAccommodation').on('click',function (){
                i++;
                var html='';
                html += '<tr>';
                html += '<td><input type="number" name="day_number'+i+'" placeholder="1 or 1-2" class="form-control" required></td>';
                html += '<td><input type="text" name="accommodation_name'+i+'" placeholder="Expedition Hotels" class="form-control" required></td>';
                html += '<td><input type="text" name="accommodation_description'+i+'" placeholder="Nice and comfort place" class="form-control" required></td>';
                html += '<td><input type="url" name="accommodation_link'+i+'" placeholder="www.expeditionhotels.com" class="form-control" required></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeAccommodation">-</a></td>';
                html += '</tr>';
                $('#accommodation').append(html);
            })
            $(document).on('click','#removeAccommodation',function (){
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush

