@extends('layouts.main', ['title' => __('Edit Safari - ' . $localTourPackage->touristicAttraction->attraction_name), 'header' => __('Edit Safari - ' . $localTourPackage->touristicAttraction->attraction_name)])

@include('includes.validate_assets')
@section('content')
    {{ Form::model($localTourPackage, [
        'enctype="multipart/form-data"',
        'route' => ['localTourPackages.update', $localTourPackage->uuid],
        'method' => 'put',
        'autocomplete' => 'off',
        'id' => 'update',
        'class' => 'form-horizontal  needs-validation',
        'novalidate',
    ]) }}
    {{ Form::hidden('user_id', $localTourPackage->id, []) }}

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
                                        {{ Form::label('safari_name', __('Safari name'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('safari_name', $touristicAttractions, $localTourPackage->touristicAttraction->safari_name, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'safari_name', 'required']) }}
                                        {!! $errors->first('safari_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_package_type_name', __('Package type'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('tour_package_type_name', $tourPackageTypes, $localTourPackage->tour_package_type_name, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'tour_package_type_name', 'required']) }}
                                        {!! $errors->first('tour_package_type_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('targeted_event', __('Targeted event'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('targeted_event', $events, $localTourPackage->targeted_event, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'targeted_event', 'required']) }}
                                        {!! $errors->first('targeted_event', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_description', __('Safari description'), ['class' => 'required_asterik']) }}
                                        {{ Form::text('safari_description', $localTourPackage->safari_description, ['class' => 'form-control', 'placeholder' => 'A day trip to ...', 'autocomplete' => 'off', 'id' => 'safari_description', 'required']) }}
                                        {!! $errors->first('safari_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-sm-8">

                                    <div class="form-group">
                                        {{ Form::label('trip_kind', __('Which is your trip?'), ['class' => 'required_asterik']) }}
                                        <div style="display: flex">
                                            <div class="form-check" style="padding-right: 10px">
                                                <input type="radio" class="form-check-input" name="trip_kind"
                                                    id="dayAdventure" value="dayAdventure"
                                                    {{ old('trip_kind', $localTourPackage->trip_kind ?? '') == 'dayAdventure' ? 'checked' : '' }}>
                                                <label for="dayAdventure" class="form-check-label">Day
                                                    Adventure</label>
                                            </div>
                                            <div class="form-check" style="padding-right: 10px">
                                                <input type="radio" class="form-check-input" name="trip_kind"
                                                    id="weekendGateway" value="weekendGateway"
                                                    {{ old('trip_kind', $localTourPackage->trip_kind ?? '') == 'weekendGateway' ? 'checked' : '' }}>
                                                <label for="weekendGateway" class="form-check-label">Weekend
                                                    Gateway</label>
                                            </div>
                                            <div class="form-check" style="padding-right: 10px">
                                                <input type="radio" class="form-check-input" name="trip_kind"
                                                    id="weekLongAdventure" value="weekLongAdventure"
                                                    {{ old('trip_kind', $localTourPackage->trip_kind ?? '') == 'weekLongAdventure' ? 'checked' : '' }}>
                                                <label for="weekLongAdventure" class="form-check-label">Week Long
                                                    Adventure</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('package_range', __('What is the duration from purchase to travel date for your package?'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('package_range', $package_range, $localTourPackage->package_range, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'package_range', 'required']) }}
                                        {!! $errors->first('package_range', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('free_of_charge_age', __('Free of charge age below?'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('free_of_charge_age', $localTourPackage->free_of_charge_age, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'free_of_charge_age', 'required']) }}
                                        {!! $errors->first('free_of_charge_age', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                               
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_start_date', __('Safari start date'), ['class' => 'required_asterik']) }}
                                        {{ Form::date('safari_start_date', $localTourPackage->safari_start_date, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'safari_start_date', 'required']) }}
                                        {!! $errors->first('safari_start_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_end_date', __('Safari end date'), ['class' => 'required_asterik']) }}
                                        {{ Form::date('safari_end_date', $localTourPackage->safari_end_date, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'safari_end_date', 'required']) }}
                                        {!! $errors->first('safari_end_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                               
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('payment_deadline', __('Payment Deadline'), ['class' => 'required_asterik']) }}
                                        {{ Form::date('payment_deadline', $localTourPackage->payment_deadline, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'payment_deadline', 'required']) }}
                                        {!! $errors->first('payment_deadline', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('travel_age_range', __('Travel Age Range'), ['class' => 'required_asterik']) }}
                                        {{ Form::text('travel_age_range', $localTourPackage->travel_age_range, ['class' => 'form-control', 'placeholder'=>'From 8 to 15 years','autocomplete' => 'off', 'id' => 'travel_age_range', 'required']) }}
                                        {!! $errors->first('travel_age_range', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_poster', __('Safari image')) }}
                                        <a
                                            href="{{ asset('public/localSafariBlogImages/' . $localTourPackage->safari_poster) }}">Previous
                                            image</a>
                                        {{ Form::file('safari_poster', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'safari_poster']) }}
                                        {!! $errors->first('safari_poster', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_adult_tanzanian', __('Trip price per person (Adult Tanzanian)'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_adult_tanzanian', $localTourPackage->trip_price_adult_tanzanian, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '30000', 'id' => 'trip_price_adult_tanzanian', 'required']) }}
                                        {!! $errors->first('trip_price_adult_tanzanian', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_child_tanzanian', __('Trip price per person (Child Tanzanian)'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_child_tanzanian', $localTourPackage->trip_price_child_tanzanian, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '30000', 'id' => 'trip_price_child_tanzanian', 'required']) }}
                                        {!! $errors->first('trip_price_child_tanzanian', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_adult_foreigner', __('Trip price per person (Adult Foreigner)'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_adult_foreigner', $localTourPackage->trip_price_adult_foreigner, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '30000', 'id' => 'trip_price_adult_foreigner', 'required']) }}
                                        {!! $errors->first('trip_price_adult_foreigner', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_child_foreigner', __('Trip price per person (Child Foreigner)'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_child_foreigner', $localTourPackage->trip_price_child_foreigner, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '30000', 'id' => 'trip_price_child_foreigner', 'required']) }}
                                        {!! $errors->first('trip_price_child_foreigner', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('maximum_travellers', __('Maximum travellers'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('maximum_travellers', $localTourPackage->maximum_travellers, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '40', 'id' => 'maximum_travellers', 'required']) }}
                                        {!! $errors->first('maximum_travellers', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('phone_number', __('Phone number'), ['class' => 'required_asterik']) }}
                                        {{ Form::tel('phone_number', $localTourPackage->phone_number, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '07....', 'id' => 'phone_number', 'required']) }}
                                        {!! $errors->first('phone_number', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('email_address', __('label.email'), ['class' => 'required_asterik']) }}
                                        {{ Form::email('email_address', $localTourPackage->email_address, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'mambo@gmail.com', 'id' => 'email_address', 'required']) }}
                                        {!! $errors->first('email_address', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('customer_satisfaction', __('Customer satisfaction category'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('customer_satisfaction[]', $customerSatisfactionCategory, $customerSatisfactionCategoryIds, ['class' => 'form-control select2', 'multiple', 'autocomplete' => 'off', 'id' => 'customer_satisfaction', 'required']) }}
                                        {!! $errors->first('customer_satisfaction', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>



                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('local_safari_special_need', __('Special need supported'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('local_safari_special_need[]', $specialNeeds, $specialNeedIds, ['class' => 'form-control select2', 'multiple', 'autocomplete' => 'off', 'id' => 'local_safari_special_need', 'required']) }}
                                        {!! $errors->first('local_safari_special_need', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('local_safari_transport', __('Transports'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('local_safari_transport[]', $transports, $transportIds, ['class' => 'form-control select2', 'multiple', 'autocomplete' => 'off', 'id' => 'local_safari_transport', 'required']) }}
                                        {!! $errors->first('local_safari_transport', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('local_tour_type', __('What is the quality of your tour package?'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('local_tour_type', $tourTypeOffered, $localTourPackage->local_tour_type, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'local_tour_type', 'required']) }}
                                        {!! $errors->first('local_tour_type', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p style="margin: 0 0 0 0">&checkmark;Collection stations and their additional
                                                prices </p>
                                            <table id="collectionStops">
                                                <thead>
                                                    <tr class="required_asterik">
                                                        <th>Collection station name</th>
                                                        <th>Pick up time (24 hour)</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($safariCollectionStations as $safariCollectionStation)
                                                        <tr id="collectionStops{{ $safariCollectionStation->id }}">
                                                            <td><input type="text"
                                                                    name="collection_stop_name{{ $safariCollectionStation->id }}"
                                                                    value="{{ $safariCollectionStation->collection_stop_name }}"
                                                                    placeholder="Shoppers" class="form-control" required>
                                                            </td>
                                                            <td><input type="time"
                                                                    name="pick_up_time{{ $safariCollectionStation->id }}"
                                                                    value="{{ $safariCollectionStation->pick_up_time }}"
                                                                    placeholder="500" class="form-control" required></td>
                                                            <td><input type="number"
                                                                    name="collection_stop_price{{ $safariCollectionStation->id }}"
                                                                    value="{{ $safariCollectionStation->collection_stop_price }}"
                                                                    placeholder="500" class="form-control" required></td>
                                                            <td><a href="{{ route('localTourPackages.deleteCollectionStation', $safariCollectionStation->uuid) }}"
                                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                                        </tr>
                                                    @empty
                                                        <tr id="collectionStops">
                                                            <td><input type="text" name="collection_stop_name1"
                                                                    placeholder="Shoppers" class="form-control" required>
                                                            </td>
                                                            <td><input type="time" name="pick_up_time1"
                                                                    placeholder="500" class="form-control" required></td>
                                                            <td><input type="number" name="collection_stop_price1"
                                                                    placeholder="500" class="form-control" required></td>
                                                            <td><a class="fas fa-pencil-alt" id="addCollectionStop">+</a>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                    <td><a class="btn btn-primary btn-sm" id="addCollectionStop">Add</a>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p style="margin: 0 0 0 0">&checkmark;Activities included</p>
                                            <table id="activities">
                                                <thead>
                                                    <tr class="required_asterik">
                                                        <th>Activity name</th>
                                                        <th>Activity description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($localTourPackageIncludedActivities as $localTourPackageIncludedActivity)
                                                        <tr id="activities{{ $localTourPackageIncludedActivity->id }}">
                                                            <td><input type="text"
                                                                    name="activity_name{{ $localTourPackageIncludedActivity->id }}"
                                                                    value="{{ $localTourPackageIncludedActivity->activity_name }}"
                                                                    placeholder="Indoor games" class="form-control"
                                                                    required></td>
                                                            <td><input type="text"
                                                                    name="activity_description{{ $localTourPackageIncludedActivity->id }}"
                                                                    value="{{ $localTourPackageIncludedActivity->activity_description }}"
                                                                    placeholder="Playing Expedition Games"
                                                                    class="form-control" required></td>
                                                            <td><a href="{{ route('localTourPackages.deleteIncludedActivity', $localTourPackageIncludedActivity->uuid) }}"
                                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                                        </tr>
                                                    @empty
                                                        <tr id="activities">
                                                            <td><input type="text" name="activity_name1"
                                                                    placeholder="Indoor games" class="form-control"
                                                                    required></td>
                                                            <td><input type="text" name="activity_description1"
                                                                    placeholder="Playing Expedition Games"
                                                                    class="form-control" required></td>
                                                            <td><a class="fas fa-pencil-alt" id="addActivity">+</a></td>
                                                        </tr>
                                                    @endforelse
                                                    <td><a class="btn btn-primary btn-sm" id="addActivity">Add</a></td>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p style="margin: 0 0 0 0">&checkmark;Price Inclusive</p>
                                            <table id="inclusiveItem">
                                                <thead>
                                                    <tr class="required_asterik">
                                                        <th>Item name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($localTourPackagePriceInclusives as $localTourPackagePriceInclusive)
                                                        <tr id="inclusiveItem{{ $localTourPackagePriceInclusive->id }}">
                                                            <td><input type="text"
                                                                    name="item{{ $localTourPackagePriceInclusive->id }}"
                                                                    value="{{ $localTourPackagePriceInclusive->item }}"
                                                                    placeholder="Drinks and Food" class="form-control"
                                                                    required></td>
                                                            <td><a href="{{ route('localTourPackages.deletePriceInclusiveItem', $localTourPackagePriceInclusive->uuid) }}"
                                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                                        </tr>
                                                    @empty
                                                        <tr id="inclusiveItem">
                                                            <td><input type="text" name="item1"
                                                                    placeholder="Drinks and Food" class="form-control"
                                                                    required></td>
                                                            <td><a class="fas fa-pencil-alt" id="addInclusiveItem">+</a>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                    <td><a class="btn btn-primary btn-sm" id="addInclusiveItem">Add</a>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p style="margin: 0 0 0 0">&checkmark;Price Exclusive</p>
                                            <table id="exclusiveItem">
                                                <thead>
                                                    <tr class="required_asterik">
                                                        <th>Item name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($localTourPackagePriceExclusives as $localTourPackagePriceExclusive)
                                                        <tr id="exclusiveItem{{ $localTourPackagePriceExclusive->id }}">
                                                            <td><input type="text"
                                                                    name="item{{ $localTourPackagePriceExclusive->id }}"
                                                                    value="{{ $localTourPackagePriceExclusive->item }}"
                                                                    placeholder="Drinks and Food" class="form-control"
                                                                    required></td>
                                                            <td><a href="{{ route('localTourPackages.deletePriceExclusiveItem', $localTourPackagePriceExclusive->uuid) }}"
                                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                                        </tr>
                                                    @empty
                                                        <tr id="exclusiveItem">
                                                            <td><input type="text" name="item1"
                                                                    placeholder="Drinks and Food" class="form-control"
                                                                    required></td>
                                                            <td><a class="fas fa-pencil-alt" id="addExclusiveItem">+</a>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                    <td><a class="btn btn-primary btn-sm" id="addExclusiveItem">Add</a>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p style="margin: 0 0 0 0">&checkmark;Suggest requirements to your client</p>
                                            <table id="tourRequirements">
                                                <thead>
                                                    <tr class="required_asterik">
                                                        <th>Requirement name</th>
                                                        <th>Requirement description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($localTourPackageRequirements as $localTourPackageRequirement)
                                                        <tr id="tourRequirements{{ $localTourPackageRequirement->id }}">
                                                            <td><input type="text"
                                                                    name="requirement_name{{ $localTourPackageRequirement->id }}"
                                                                    value="{{ $localTourPackageRequirement->requirement_name }}"
                                                                    placeholder="Heavy coat" class="form-control"
                                                                    required></td>
                                                            <td><input type="text"
                                                                    name="requirement_description{{ $localTourPackageRequirement->id }}"
                                                                    value="{{ $localTourPackageRequirement->requirement_description }}"
                                                                    placeholder="It is very cold at this area"
                                                                    class="form-control" required></td>
                                                            <td><a href="{{ route('localTourPackages.deleteTripRequirement', $localTourPackageRequirement->uuid) }}"
                                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                                        </tr>
                                                    @empty
                                                        <tr id="tourRequirements">
                                                            <td><input type="text" name="requirement_name1"
                                                                    placeholder="Heavy coat" class="form-control"
                                                                    required></td>
                                                            <td><input type="text" name="requirement_description1"
                                                                    placeholder="It is very cold at this area"
                                                                    class="form-control" required></td>
                                                            <td><a class="fas fa-pencil-alt" id="addRequirement">+</a>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                    <td><a class="btn btn-primary btn-sm" id="addRequirement">Add</a></td>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                {{ Form::label('reservation_used', __('Reservations included in this tour (optional)')) }}
                                                {{ Form::select('reservation_used[]', $reservations, $reservationIds, ['class' => 'form-control select2', 'multiple', 'autocomplete' => 'off', 'id' => 'reservation_used']) }}
                                                {!! $errors->first('reservation_used', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('transport_used_images', __('Images of transports to be used')) }}
                                                {{ Form::file('transport_used_images[]', ['class' => 'form-control', 'multiple' => true, 'autocomplete' => 'off', 'id' => 'transport_used_images']) }}
                                                {!! $errors->first('transport_used_images', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                {{ Form::label('discount_offered', __('Discount Offered (Percent Mode)'), ['class' => 'required_asterik']) }}
                                                {{ Form::number('discount_offered', $localTourPackage->discount_offered, ['class' => 'form-control','maxLength'=>'3', 'autocomplete' => 'off', 'id' => 'discount_offered', 'required']) }}
                                                {!! $errors->first('discount_offered', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                {{ Form::label('number_of_people_for_discount', __('Number of people reached for a discount'), ['class' => 'required_asterik']) }}
                                                {{ Form::number('number_of_people_for_discount', $localTourPackage->number_of_people_for_discount, ['class' => 'form-control','maxLength'=>'6', 'autocomplete' => 'off', 'id' => 'number_of_people_for_discount', 'required']) }}
                                                {!! $errors->first('number_of_people_for_discount', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('number_of_views_expecting', __('Expected number of viewers?'), ['class' => 'required_asterik']) }}
                                                {{ Form::number('number_of_views_expecting', $localTourPackage->number_of_views_expecting, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'number_of_views_expecting', 'required']) }}
                                                {!! $errors->first('number_of_views_expecting', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('payment_start_percent', __('Starting Payment (Percent Mode)'), ['class' => 'required_asterik']) }}
                                                {{ Form::number('payment_start_percent', $localTourPackage->payment_start_percent, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'payment_start_percent', 'required']) }}
                                                {!! $errors->first('payment_start_percent', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('payment_start_percent_deadline', __('Payment Start Percent Deadline'), ['class' => 'required_asterik']) }}
                                                {{ Form::date('payment_start_percent_deadline', $localTourPackage->payment_start_percent_deadline, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'payment_start_percent_deadline', 'required']) }}
                                                {!! $errors->first('payment_start_percent_deadline', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('cancellation_percent', __('Trip Cancellation Percent'), ['class' => 'required_asterik']) }}
                                                {{ Form::number('cancellation_percent', $localTourPackage->cancellation_percent, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'cancellation_percent', 'maxLength'=>'3','required']) }}
                                                {!! $errors->first('cancellation_percent', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('cancellation_due_date', __('Trip Cancellation due date'), ['class' => 'required_asterik']) }}
                                                {{ Form::date('cancellation_due_date', $localTourPackage->cancellation_due_date, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'cancellation_due_date', 'required']) }}
                                                {!! $errors->first('cancellation_due_date', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('cancellation_policy', __('Cancellation Policy'), ['class' => 'required_asterik']) }}
                                                {{ Form::textarea('cancellation_policy', $localTourPackage->cancellation_policy, ['class' => 'form-control', 'autocomplete' => 'off','maxLength'=>'200','style'=>'height:100px', 'id' => 'cancellation_policy', 'required']) }}
                                                {!! $errors->first('cancellation_policy', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('emergency_handling', __('How will you handle your clients in case of an emergency?'), ['class' => 'required_asterik']) }}
                                                {{ Form::textarea('emergency_handling', $localTourPackage->emergency_handling, ['class' => 'form-control', 'style' => 'height:100px', 'maxLength' => '300', 'autocomplete' => 'off', 'id' => 'emergency_handling', 'required']) }}
                                                {!! $errors->first('emergency_handling', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Trip Hierarchy (Optional)</h4>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Day</th>
                                                            <th>Date</th>
                                                            <th>Destination</th>
                                                            <th>Reservation</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tripHierachy">
                                                        @forelse ($localTourPackageTripHierachies as $hierarchy)
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="hierarchy_id[]" value="{{ $hierarchy->id }}">
                                                                <input type="number" name="day[]" class="form-control" value="{{ $hierarchy->day }}">
                                                            </td>
                                                            <td>
                                                                <input type="date" name="travel_date[]" class="form-control" value="{{ $hierarchy->travel_date }}">
                                                            </td>
                                                            <td>
                                                                <select name="destination[]" class="form-control select2 package-type-select">
                                                                    <option value="">Travel Destination?</option>
                                                                    @foreach ($touristicAttractions as $touristicAttraction)
                                                                        <option value="{{ $touristicAttraction }}" 
                                                                            {{ $hierarchy->destination == $touristicAttraction ? 'selected' : '' }}>
                                                                            {{ $touristicAttraction }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="reservation[]" class="form-control select2 package-type-select">
                                                                    <option value="">Reservation</option>
                                                                    @foreach ($reservations as $reservation)
                                                                        <option value="{{ $reservation }}" 
                                                                            {{ $hierarchy->reservation == $reservation ? 'selected' : '' }}>
                                                                            {{ $reservation }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                @if ($loop->first)
                                                                <button type="button" class="btn btn-primary btn-sm addTripHierachy">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                                @else
                                                                <button type="button" class="btn btn-danger btn-sm removeTripHierachy">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                                <a href="{{route('localTourPackages.deleteTripHierachy',$hierarchy->uuid)}}" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td>
                                                                <input type="number" name="day[]" class="form-control" placeholder="Enter Day number">
                                                            </td>
                                                            <td>
                                                                <input type="date" name="travel_date[]" class="form-control">
                                                            </td>
                                                            <td>
                                                                <select name="destination[]" class="form-control select2 package-type-select">
                                                                    <option value="">Travel Destination?</option>
                                                                    @foreach ($touristicAttractions as $touristicAttraction)
                                                                        <option value="{{ $touristicAttraction }}">{{ $touristicAttraction }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="reservation[]" class="form-control select2 package-type-select">
                                                                    <option value="">Reservation</option>
                                                                    @foreach ($reservations as $reservation)
                                                                        <option value="{{ $reservation }}">{{ $reservation }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary btn-sm addTripHierachy">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input name="tour_operator_id" value="{{ $localTourPackage->tourOperator->id }}" hidden>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Update'), ['class' => 'btn btn-primary', 'type' => 'submit', 'style' => 'border-radius: 5px;']) }}
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
    <br />

    {{ Form::close() }}
@endsection
@push('after-scripts')
    <script>
        $(function() {
            $(".select2").select2();


        });
    </script>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function() {
            var i = {{ $localTourPackageIncludedActivities->count() + 1 }};
            $('#addActivity').on('click', function() {
                i++;
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="activity_name' + i +
                    '" placeholder="Indoor games" class="form-control"></td>';
                html += '<td><input type="text" name="activity_description' + i +
                    '" placeholder="Playing Expedition Games" class="form-control"></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeActivity">-</a></td>';
                html += '</tr>';
                $('#activities tbody').append(html);
            })
            $(document).on('click', '#removeActivity', function() {
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function() {
            var i = {{ $localTourPackagePriceInclusives->count() + 1 }};
            $('#addInclusiveItem').on('click', function() {
                i++;
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="item' + i +
                    '" placeholder="Drinks and Food" class="form-control" required></td></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeInclusiveItem">-</a></td>';
                html += '</tr>';
                $('#inclusiveItem tbody').append(html);
            })
            $(document).on('click', '#removeInclusiveItem', function() {
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function() {
            var i = {{ $localTourPackagePriceExclusives->count() + 1 }};
            $('#addExclusiveItem').on('click', function() {
                i++;
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="item' + i +
                    '" placeholder="Drinks and Food" class="form-control" required></td></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeExclusiveItem">-</a></td>';
                html += '</tr>';
                $('#exclusiveItem tbody').append(html);
            })
            $(document).on('click', '#removeExclusiveItem', function() {
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush
@push('after-scripts')
    <script>
        $(document).ready(function() {
            var i = {{ $safariCollectionStations->count() + 1 }};
            $('#addCollectionStop').on('click', function() {
                i++;
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="collection_stop_name' + i +
                    '" placeholder="Shoppers" class="form-control" required></td></td>';
                html += '<td><input type="time" name="pick_up_time' + i +
                    '" class="form-control" required></td></td>';
                html += '<td><input type="number" name="collection_stop_price' + i +
                    '" placeholder="500" class="form-control" required></td></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeCollectionStop">-</a></td>';
                html += '</tr>';
                $('#collectionStops tbody').append(html);
            })
            $(document).on('click', '#removeCollectionStop', function() {
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush
@push('after-scripts')
    <script>
        $(document).ready(function() {
            var i = {{ $localTourPackageRequirements->count() + 1 }};
            $('#addRequirement').on('click', function() {
                i++;
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="requirement_name' + i +
                    '" placeholder="Heavy coat" class="form-control" required></td>';
                html += '<td><input type="text" name="requirement_description' + i +
                    '" placeholder="It is very cold at this area" class="form-control" required></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeRequirement">-</a></td>';
                html += '</tr>';
                $('#tourRequirements tbody').append(html);
            })
            $(document).on('click', '#removeRequirement', function() {
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush


@push('after-scripts')
    <script>
        $(document).ready(function () {
            function initializeSelect2(element) {
                $(element).select2({
                    width: '100%',
                    dropdownParent: $(element).closest('tr')
                });
            }

            // Initialize only select2 elements within Trip Hierarchy
            $('#tripHierachy .select2').each(function () {
                initializeSelect2(this);
            });

            $(document).on('click', '.addTripHierachy', function () {
                let newRow = `
                    <tr>
                        <td><input type="number" name="day[]" class="form-control" placeholder="Enter Day number"></td>
                        <td><input type="date" name="travel_date[]" class="form-control"></td>
                        <td>
                            <select name="destination[]" class="form-control select2 package-type-select">
                                <option value="">Travel Destination?</option>
                                @foreach ($touristicAttractions as $touristicAttraction)
                                    <option value="{{ $touristicAttraction }}">{{ $touristicAttraction }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="reservation[]" class="form-control select2 package-type-select">
                                <option value="">Reservation</option>
                                @foreach ($reservations as $reservation)
                                    <option value="{{ $reservation }}">{{ $reservation }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm removeTripHierachy">
                                <i class="fas fa-minus"></i>
                            </button>
                        </td>
                    </tr>
                `;

                $('#tripHierachy').append(newRow);
                initializeSelect2($('#tripHierachy tr:last-child .select2'));
            });

            $(document).on('click', '.removeTripHierachy', function () {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endpush

