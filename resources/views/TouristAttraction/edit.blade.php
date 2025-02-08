@extends('layouts.main', ['title' => __("Edit tourist attraction"), 'header' => __('Edit tourist attraction')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($touristicAttraction,['route' => ['touristicAttraction.update', $touristicAttraction->uuid], 'method'=>'put','autocomplete' => 'off',
 'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate','files' => true, 'enctype' => 'multipart/form-data']) }}
    {{ Form::hidden('user_id', $touristicAttraction->id, []) }}
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
                                        {{ Form::label('attraction_name', __("Attraction name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('attraction_name', $touristicAttraction->attraction_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'attraction_name', 'required']) }}
                                        {!! $errors->first('attraction_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('attraction_description', __("Attraction description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('attraction_description', $touristicAttraction->attraction_description, ['class' => 'form-control', 'autocomplete' => 'off', 'maxLength'=>'400','style'=>'height:80px','id' => 'attraction_description', 'required']) }}
                                        {!! $errors->first('attraction_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('attraction_category', __("Attraction category"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('attraction_category',$attractionCategory, $touristicAttraction->attraction_category, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'attraction_category', 'required']) }}
                                        {!! $errors->first('attraction_category', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label('establishment_year', __("Year of establishment"), ['class' => 'required_asterik']) }}
                                            {{ Form::select('establishment_year', $years, $touristicAttraction->establishment_year, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'establishment_year', 'required']) }}
                                            {!! $errors->first('establishment_year', '<span class="badge badge-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label('attraction_region', __("Attraction region"), ['class' => 'required_asterik']) }}
                                            {{ Form::select('attraction_region', $regions,$touristicAttraction->attraction_region, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'attraction_region', 'required']) }}
                                            {!! $errors->first('attraction_region', '<span class="badge badge-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label('seasonal_variation', __("Seasonal variation"), ['class' => 'required_asterik']) }}
                                            {{ Form::textarea('seasonal_variation',$touristicAttraction->seasonal_variation, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'seasonal_variation', 'placeholder'=>'How does the park change throughout the year? Are there specific times for blooming flowers, migration, or wildlife spotting?','style'=>'height:100px','required']) }}
                                            {!! $errors->first('seasonal_variation', '<span class="badge badge-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label('flora_fauna', __("Flora & Fauna"), ['class' => 'required_asterik']) }}
                                            {{ Form::textarea('flora_fauna',$touristicAttraction->flora_fauna, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'flora_fauna', 'placeholder'=>'What are the key plant and animal species in the park? Are there endangered species or unique ecosystems?','style'=>'height:100px','required']) }}
                                            {!! $errors->first('flora_fauna', '<span class="badge badge-danger">:message</span>') !!}
                                        </div>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('governing_body', __("Governing body"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('governing_body', $touristicAttraction->governing_body, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'governing_body', 'required']) }}
                                        {!! $errors->first('governing_body', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('website_link', __("Governing body website link"), ['class' => 'required_asterik']) }}
                                        {{ Form::url('website_link', $touristicAttraction->website_link, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'website_link', 'required']) }}
                                        {!! $errors->first('website_link', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                               
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('attraction_image', __("Attraction Image"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('attraction_image[]', ['class' => 'form-control','multiple'=>true, 'autocomplete' => 'off', 'id' => 'attraction_image']) }}
                                        {!! $errors->first('attraction_image', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('basic_information', __("Basic information of the attraction"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('basic_information',$touristicAttraction->basic_information, ['class' => 'form-control','maxLength'=>'1000', 'autocomplete' => 'off', 'id' => 'basic_information', 'required']) }}
                                        {!! $errors->first('basic_information', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('attraction_map', __("Attraction map"), ['class' => 'required_asterik']) }}
                                        <a href="{{asset('public/attractionMaps/'.$touristicAttraction->attraction_map)}}">Previous Map</a>
                                        {{ Form::file('attraction_map',null,$touristicAttraction->attraction_map, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'attraction_map']) }}
                                        {!! $errors->first('attraction_map', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('attraction_visit_month', __("Best months of visit"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('attraction_visit_month', $touristicAttraction->attraction_visit_month, ['class' => 'form-control','autocomplete' => 'off', 'id' => 'attraction_visit_month', 'required']) }}
                                        {!! $errors->first('attraction_visit_month', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('entry_fee_adult_foreigner', __("Entry fee adult foreigner"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('entry_fee_adult_foreigner', $touristicAttraction->entry_fee_adult_foreigner, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'entry_fee_adult_foreigner', 'required']) }}
                                        {!! $errors->first('entry_fee_adult_foreigner', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('entry_fee_child_foreigner', __("Entry fee child foreigner"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('entry_fee_child_foreigner', $touristicAttraction->entry_fee_child_foreigner, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'entry_fee_child_foreigner', 'required']) }}
                                        {!! $errors->first('entry_fee_child_foreigner', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('entry_fee_child_local', __("Entry fee child local"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('entry_fee_child_local', $touristicAttraction->entry_fee_child_local, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'entry_fee_child_local', 'required']) }}
                                        {!! $errors->first('entry_fee_child_local', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('entry_fee_adult_local', __("Entry fee adult local"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('entry_fee_adult_local', $touristicAttraction->entry_fee_adult_local, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'entry_fee_adult_local', 'required']) }}
                                        {!! $errors->first('entry_fee_adult_local', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('activities_in_attraction', __("Activities to conduct in this attraction"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('activities_in_attraction[]',$touristicActivities,$touristicAttractionActivities, ['class' => 'form-control select2','multiple', 'autocomplete' => 'off', 'id' => 'activities_in_attraction', 'required']) }}
                                        {!! $errors->first('activities_in_attraction', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Advice to visitors</h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table id="advices">
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Advice number</th>
                                                    <th>Advice title</th>
                                                    <th>Advice description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($attractionVisitAdvices as $attractionVisitAdvice)
                                                <tr id="advices{{$attractionVisitAdvice->id}}">
                                                    <td><input type="number" class="form-control" placeholder="1" name="advice_number{{$attractionVisitAdvice->id}}" value="{{$attractionVisitAdvice->advice_number}}" required></td>
                                                    <td><input type="text" class="form-control" placeholder="Book in advance" name="advice_title{{$attractionVisitAdvice->id}}" value="{{$attractionVisitAdvice->advice_title}}" maxlength="50" required></td>
                                                    <td><input type="text" class="form-control" placeholder="Mikumi can get busy ...." maxlength="500" name="advice_description{{$attractionVisitAdvice->id}}" value="{{$attractionVisitAdvice->advice_description}}" required></td>
                                                    <td><a href="{{route('touristicAttraction.deleteVisitAdvice',$attractionVisitAdvice->uuid)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                </tr>
                                                @empty
                                                    <tr id="advices">
                                                        <td><input type="number" class="form-control" placeholder="1" name="advice_number1" required></td>
                                                        <td><input type="text" class="form-control" placeholder="Book in advance" name="advice_title1" maxlength="50" required></td>
                                                        <td><input type="text" class="form-control" placeholder="Mikumi can get busy ...." maxlength="500" name="advice_description1" required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addAdvice">+</a></td>
                                                    </tr>
                                                @endforelse
                                                <td><a class="btn btn-primary btn-sm" id="addAdvice">Add</a></td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Reasons to Visit the Attraction</h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table id="reasons">
                                                <thead>
                                                <tr class="required_asterik">
                                                    <th>Reason number</th>
                                                    <th>Reason title</th>
                                                    <th>Reason description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($attractionVisitReasons as $attractionVisitReason)
                                                <tr id="reasons{{$attractionVisitReason->id}}">
                                                    <td><input type="number" class="form-control" placeholder="1" name="reason_number{{$attractionVisitReason->id}}" value="{{$attractionVisitReason->reason_number}}" required></td>
                                                    <td><input type="text" class="form-control" placeholder="Diverse Scenery" name="reason_title{{$attractionVisitReason->id}}" value="{{$attractionVisitReason->reason_title}}" required></td>
                                                    <td><input type="text" class="form-control" placeholder="The Scenery ...." maxlength="500" name="reason_description{{$attractionVisitReason->id}}" value="{{$attractionVisitReason->reason_description}}" required></td>
                                                    <td><a href="{{route('touristicAttraction.deleteVisitReason',$attractionVisitReason->uuid)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                </tr>
                                                @empty
                                                    <tr id="reasons">
                                                        <td><input type="number" class="form-control" placeholder="1" name="reason_number1" required> </td>
                                                        <td><input type="text" class="form-control" placeholder="Diverse Scenery" name="reason_title1" required> </td>
                                                        <td><input type="text" class="form-control" placeholder="The Scenery ...." maxlength="500" name="reason_description1" required> </td>
                                                        <td><a class="fas fa-pencil-alt" id="addReason">+</a></td>
                                                    </tr>
                                                @endforelse
                                                <td><a class="btn btn-primary btn-sm" id="addReason">Add</a></td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('personal_experience', __("Personal Experience"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('personal_experience', $touristicAttraction->personal_experience, ['class' => 'form-control','autocomplete' => 'off','style'=>'height:100px','placeholder'=>'•	Share your own story or experience visiting the park', 'id' => 'personal_experience', 'required']) }}
                                        {!! $errors->first('personal_experience', '<span class="badge badge-danger">:message</span>') !!}
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
            var i={{$attractionVisitAdvices->count() + 1}};
            $('#addAdvice').on('click',function (){
                i++;
                var html='';
                html +='<tr>';
                html += '<td><input type="number" class="form-control" placeholder="1" name="advice_number'+i+'" required></td>';
                html += '<td><input type="text" class="form-control" placeholder="Advice title" name="advice_title'+i+'" required></td>';
                html += '<td><input type="text" class="form-control" placeholder="Advice description" maxlength="500" name="advice_description'+i+'" required></td>';
                html += '<td><a class="fas fa-pencil-alt danger" id="removeAdvice">-</a></td>';
                html += '</tr>';
                $('#advices tbody').append(html);
            })
            $(document).on('click','#removeAdvice',function (){
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function () {
            var i = {{$attractionVisitReasons->count() + 1}};
            $('#addReason').on('click', function () {
                i++;
                var html;
                html += '<tr>';
                html += '<td><input type="number" class="form-control" placeholder="1" name="reason_number' + i + '" required></td>';
                html += '<td><input type="text" class="form-control" placeholder="Diverse Scenery" name="reason_title' + i + '" required></td>';
                html += '<td><input type="text" class="form-control" placeholder="The Scenery ..." maxlength="500" name="reason_description' + i + '" required></td>';
                html += '<td><a class="fas fa-pencil-alt danger" id="removeReason">-</a></td>';
                html += '</tr>';
                $('#reasons tbody').append(html);
            })
            $(document).on('click', '#removeReason', function () {
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush



