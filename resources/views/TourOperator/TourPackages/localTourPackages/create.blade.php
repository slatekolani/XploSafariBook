@extends('layouts.main', ['title' => __('Local Safari Package'), 'header' => __('Local Safari Package')])

@include('includes.validate_assets')
@section('content')
    {{ Form::open(['enctype="multipart/form-data"', 'route' => 'localTourPackages.store', 'autocomplete' => 'off', 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
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
                                        {{ Form::select('safari_name', $touristicAttractions, null, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'safari_name', 'required']) }}
                                        {!! $errors->first('safari_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_package_type_name', __('Package type'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('tour_package_type_name', $tourPackageTypes, null, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'tour_package_type_name', 'required']) }}
                                        {!! $errors->first('tour_package_type_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('targeted_event', __('Targeted event'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('targeted_event', $events, null, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'targeted_event', 'required']) }}
                                        {!! $errors->first('targeted_event', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_description', __('Safari description'), ['class' => 'required_asterik']) }}
                                        {{ Form::text('safari_description', null, ['class' => 'form-control', 'placeholder' => 'A day trip to ...', 'autocomplete' => 'off', 'id' => 'safari_description', 'required']) }}
                                        {!! $errors->first('safari_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    
                                            <div class="form-group">
                                                {{ Form::label('trip_kind', __('Which is your trip?'), ['class' => 'required_asterik']) }}
                                                <div style="display: flex">
                                                    <div class="form-check" style="padding-right: 10px">
                                                        <input type="radio" class="form-check-input" name="trip_kind"
                                                            id="dayLongAdventure" value="dayAdventure">
                                                        <label for="dayAdventure" class="form-check-label">Day
                                                            Adventure</label>
                                                    </div>
                                                    <div class="form-check" style="padding-right: 10px">
                                                        <input type="radio" class="form-check-input" name="trip_kind"
                                                            id="weekendGateway" value="weekendGateway">
                                                        <label for="weekendGateway" class="form-check-label">Weekend
                                                            Gateway</label>
                                                    </div>
                                                    <div class="form-check" style="padding-right: 10px">
                                                        <input type="radio" class="form-check-input" name="trip_kind"
                                                            id="weekLongAdventure" value="weekLongAdventure">
                                                        <label for="weekLongAdventure" class="form-check-label">Week Long
                                                            Adventure</label>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('package_range', __('What is the duration from purchase to travel date for your package?'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('package_range', $package_range, null, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'package_range', 'required']) }}
                                        {!! $errors->first('package_range', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('free_of_charge_age', __('Free of charge age below?'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('free_of_charge_age', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'free_of_charge_age', 'required']) }}
                                        {!! $errors->first('free_of_charge_age', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_start_date', __('Safari start date'), ['class' => 'required_asterik']) }}
                                        {{ Form::date('safari_start_date', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'safari_start_date', 'required']) }}
                                        {!! $errors->first('safari_start_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_end_date', __('Safari end date'), ['class' => 'required_asterik']) }}
                                        {{ Form::date('safari_end_date', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'safari_end_date', 'required']) }}
                                        {!! $errors->first('safari_end_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('payment_deadline', __('Payment Deadline'), ['class' => 'required_asterik']) }}
                                        {{ Form::date('payment_deadline', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'payment_deadline', 'required']) }}
                                        {!! $errors->first('payment_deadline', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('travel_age_range', __('Travel Age Range'), ['class' => 'required_asterik']) }}
                                        {{ Form::text('travel_age_range', null, ['class' => 'form-control', 'placeholder'=>'From 8 to 15 years','autocomplete' => 'off', 'id' => 'travel_age_range', 'required']) }}
                                        {!! $errors->first('travel_age_range', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('safari_poster', __('Safari image'), ['class' => 'required_asterik']) }}
                                        {{ Form::file('safari_poster', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'safari_poster', 'required']) }}
                                        {!! $errors->first('safari_poster', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_adult_tanzanian', __('Trip price per person (Adult Tanzanian)'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_adult_tanzanian', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '30000', 'id' => 'trip_price_adult_tanzanian', 'required']) }}
                                        {!! $errors->first('trip_price_adult_tanzanian', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_child_tanzanian', __('Trip price per person (Child Tanzanian)'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_child_tanzanian', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '30000', 'id' => 'trip_price_child_tanzanian', 'required']) }}
                                        {!! $errors->first('trip_price_child_tanzanian', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_adult_foreigner', __('Trip price per person (Adult Foreigner)'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_adult_foreigner', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '30000', 'id' => 'trip_price_adult_foreigner', 'required']) }}
                                        {!! $errors->first('trip_price_adult_foreigner', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('trip_price_child_foreigner', __('Trip price per person (Child Foreigner)'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('trip_price_child_foreigner', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '30000', 'id' => 'trip_price_child_foreigner', 'required']) }}
                                        {!! $errors->first('trip_price_child_foreigner', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('maximum_travellers', __('Maximum travellers'), ['class' => 'required_asterik']) }}
                                        {{ Form::number('maximum_travellers', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '40', 'id' => 'maximum_travellers', 'required']) }}
                                        {!! $errors->first('maximum_travellers', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('phone_number', __('Phone number'), ['class' => 'required_asterik']) }}
                                        {{ Form::tel('phone_number', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '07....', 'id' => 'phone_number', 'required']) }}
                                        {!! $errors->first('phone_number', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('email_address', __('label.email'), ['class' => 'required_asterik']) }}
                                        {{ Form::email('email_address', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'mambo@gmail.com', 'id' => 'email_address', 'required']) }}
                                        {!! $errors->first('email_address', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('customer_satisfaction', __('Customer satisfaction category'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('customer_satisfaction[]', $customerSatisfactionCategory, null, ['class' => 'form-control select2', 'multiple', 'autocomplete' => 'off', 'id' => 'customer_satisfaction', 'required']) }}
                                        {!! $errors->first('customer_satisfaction', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>



                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('local_safari_special_need', __('Special need supported'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('local_safari_special_need[]', $specialNeeds, null, ['class' => 'form-control select2', 'multiple', 'autocomplete' => 'off', 'id' => 'local_safari_special_need', 'required']) }}
                                        {!! $errors->first('local_safari_special_need', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('local_safari_transport', __('Transports'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('local_safari_transport[]', $transports, null, ['class' => 'form-control select2', 'multiple', 'autocomplete' => 'off', 'id' => 'local_safari_transport', 'required']) }}
                                        {!! $errors->first('local_safari_transport', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('local_tour_type', __('What is the quality of your tour package?'), ['class' => 'required_asterik']) }}
                                        {{ Form::select('local_tour_type', $tourTypeOffered, null, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'local_tour_type', 'required']) }}
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
                                            <table>
                                                <thead>
                                                    <tr class="required_asterik">
                                                        <th>Collection station name</th>
                                                        <th>Pick up time (24 hour)</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="collectionStops">
                                                    <tr>
                                                        <td><input type="text" name="collection_stop_name1"
                                                                placeholder="Shoppers" class="form-control" required></td>
                                                        <td><input type="time" name="pick_up_time1" placeholder="500"
                                                                class="form-control" required></td>
                                                        <td><input type="number" name="collection_stop_price1"
                                                                placeholder="500" class="form-control" required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addCollectionStop">+</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p style="margin: 0 0 0 0">&checkmark;Activities included</p>
                                            <table>
                                                <thead>
                                                    <tr class="required_asterik">
                                                        <th>Activity name</th>
                                                        <th>Activity description</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="activities">
                                                    <tr>
                                                        <td><input type="text" name="activity_name1"
                                                                placeholder="Indoor games" class="form-control" required>
                                                        </td>
                                                        <td><input type="text" name="activity_description1"
                                                                placeholder="Playing Expedition Games"
                                                                class="form-control" required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addActivity">+</a></td>
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
                                    <div class="row">
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p style="margin: 0 0 0 0">&checkmark;Price Inclusive</p>
                                            <table>
                                                <thead>
                                                    <tr class="required_asterik">
                                                        <th>Item name</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="inclusiveItem">
                                                    <tr>
                                                        <td><input type="text" name="item1"
                                                                placeholder="Drinks and Food" class="form-control"
                                                                required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addInclusiveItem">+</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p style="margin: 0 0 0 0">&checkmark;Price Exclusive</p>
                                            <table>
                                                <thead>
                                                    <tr class="required_asterik">
                                                        <th>Item name</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="exclusiveItem">
                                                    <tr>
                                                        <td><input type="text" name="item1"
                                                                placeholder="Drinks and Food" class="form-control"
                                                                required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addExclusiveItem">+</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p style="margin: 0 0 0 0">&checkmark;Suggest requirements to your client</p>
                                            <table>
                                                <thead>
                                                    <tr class="required_asterik">
                                                        <th>Requirement name</th>
                                                        <th>Requirement description</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tourRequirements">
                                                    <tr>
                                                        <td><input type="text" name="requirement_name1"
                                                                placeholder="Heavy coat" class="form-control" required>
                                                        </td>
                                                        <td><input type="text" name="requirement_description1"
                                                                placeholder="It is very cold at this area"
                                                                class="form-control" required></td>
                                                        <td><a class="fas fa-pencil-alt" id="addRequirement">+</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                {{ Form::label('reservation_used', __('Reservations included in this tour (optional)')) }}
                                                {{ Form::select('reservation_used', $reservations, null, ['class' => 'form-control select2', 'multiple', 'autocomplete' => 'off', 'id' => 'reservation_used']) }}
                                                {!! $errors->first('reservation_used', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('transport_used_images', __('Images of transports to be used'), ['class' => 'required_asterik']) }}
                                                {{ Form::file('transport_used_images[]', ['class' => 'form-control', 'multiple' => true, 'autocomplete' => 'off', 'id' => 'transport_used_images', 'required']) }}
                                                {!! $errors->first('transport_used_images', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                {{ Form::label('discount_offered', __('Discount Offered (Percent Mode)'), ['class' => 'required_asterik']) }}
                                                {{ Form::number('discount_offered', null, ['class' => 'form-control','maxLength'=>'3', 'autocomplete' => 'off', 'id' => 'discount_offered', 'required']) }}
                                                {!! $errors->first('discount_offered', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                {{ Form::label('number_of_people_for_discount', __('Number of people reached for a discount'), ['class' => 'required_asterik']) }}
                                                {{ Form::number('number_of_people_for_discount', null, ['class' => 'form-control','maxLength'=>'6', 'autocomplete' => 'off', 'id' => 'number_of_people_for_discount', 'required']) }}
                                                {!! $errors->first('number_of_people_for_discount', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('number_of_views_expecting', __('Expected number of viewers?'), ['class' => 'required_asterik']) }}
                                                {{ Form::number('number_of_views_expecting', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'number_of_views_expecting', 'required']) }}
                                                {!! $errors->first('number_of_views_expecting', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('payment_start_percent', __('Starting Payment (Percent Mode)'), ['class' => 'required_asterik']) }}
                                                {{ Form::number('payment_start_percent', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'payment_start_percent', 'required']) }}
                                                {!! $errors->first('payment_start_percent', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('payment_start_percent_deadline', __('Payment Start Percent Deadline'), ['class' => 'required_asterik']) }}
                                                {{ Form::date('payment_start_percent_deadline', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'payment_start_percent_deadline', 'required']) }}
                                                {!! $errors->first('payment_start_percent_deadline', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('cancellation_percent', __('Trip Cancellation Percent'), ['class' => 'required_asterik']) }}
                                                {{ Form::number('cancellation_percent', null, ['class' => 'form-control', 'autocomplete' => 'off', 'maxLength'=>'3', 'id' => 'cancellation_percent', 'required']) }}
                                                {!! $errors->first('cancellation_percent', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('cancellation_due_date', __('Trip Cancellation due date'), ['class' => 'required_asterik']) }}
                                                {{ Form::date('cancellation_due_date', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'cancellation_due_date', 'required']) }}
                                                {!! $errors->first('cancellation_due_date', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-8 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('cancellation_policy', __('Cancellation Policy'), ['class' => 'required_asterik']) }}
                                                {{ Form::textarea('cancellation_policy', null, ['class' => 'form-control', 'autocomplete' => 'off','maxLength'=>'200','style'=>'height:100px', 'id' => 'cancellation_policy', 'required']) }}
                                                {!! $errors->first('cancellation_policy', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('emergency_handling', __('How will you handle your clients in case of an emergency?'), ['class' => 'required_asterik']) }}
                                                {{ Form::textarea('emergency_handling', null, ['class' => 'form-control', 'style' => 'height:100px', 'maxLength' => '300', 'autocomplete' => 'off', 'id' => 'emergency_handling', 'required']) }}
                                                {!! $errors->first('emergency_handling', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input name="tour_operator_id" value="{{ $tourOperator->id }}" hidden>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Add'), ['class' => 'btn btn-primary', 'type' => 'submit', 'style' => 'border-radius: 5px;']) }}
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
            var i = 1;
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
                $('#activities').append(html);
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
            var i = 1;
            $('#addInclusiveItem').on('click', function() {
                i++;
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="item' + i +
                    '" placeholder="Drinks and Food" class="form-control" required></td></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeInclusiveItem">-</a></td>';
                html += '</tr>';
                $('#inclusiveItem').append(html);
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
            var i = 1;
            $('#addExclusiveItem').on('click', function() {
                i++;
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="item' + i +
                    '" placeholder="Drinks and Food" class="form-control" required></td></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeExclusiveItem">-</a></td>';
                html += '</tr>';
                $('#exclusiveItem').append(html);
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
            var i = 1;
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
                $('#collectionStops').append(html);
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
            var i = 1;
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
                $('#tourRequirements').append(html);
            })
            $(document).on('click', '#removeRequirement', function() {
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush
