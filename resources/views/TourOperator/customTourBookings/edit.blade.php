@extends('layouts.main', ['title' => 'Edit Custom Safari', 'header' => __('Edit Custom Safari')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($customTourBooking,['enctype="multipart/form-data"','route' => ['customTourBookings.update', $customTourBooking->uuid], 'method'=>'put','autocomplete' => 'off',
      'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $customTourBooking->id, []) }}
    @csrf
    <section>
        <div class="row" style="margin: auto">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);margin-top: 3px">
                        <div class="col-md-12">
                            <p>You are now requesting a custom trip from <strong style="color: dodgerblue">{{$tourOperator->company_name}}</strong></p>
                            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_name', __("Full Name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('tourist_name',$customTourBooking->tourist_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_name', 'required']) }}
                                        {!! $errors->first('tourist_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_email_address', __("Email Address"), ['class' => 'required_asterik']) }}
                                        {{ Form::email('tourist_email_address',$customTourBooking->tourist_email_address, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_email_address', 'required']) }}
                                        {!! $errors->first('tourist_email_address', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_region', __("Region of Residence"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('tourist_region',$regions,$customTourBooking->tourist_region, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'tourist_region', 'required']) }}
                                        {!! $errors->first('tourist_region', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_phone_number', __("Phone Number"), ['class' => 'required_asterik']) }}
                                        {{ Form::tel('tourist_phone_number', $customTourBooking->tourist_phone_number, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_phone_number', 'required']) }}
                                        {!! $errors->first('tourist_phone_number', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_package_type', __("What kind of tour do you want? "), ['class' => 'required_asterik']) }}
                                        {{ Form::select('tour_package_type', $tourPackageTypes,$customTourBooking->tour_package_type, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'tour_package_type', 'required']) }}
                                        {!! $errors->first('tour_package_type', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_type', __("What quality of tour do you want? "), ['class' => 'required_asterik']) }}
                                        {{ Form::select('tour_type', $tourTypes,$customTourBooking->tour_type, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'tour_type', 'required']) }}
                                        {!! $errors->first('tour_type', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('transport_type', __("What transport do you want to use?"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('transport_type', $transports, $customTourBooking->transport_type,['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'transport_type', 'required']) }}
                                        {!! $errors->first('transport_type', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_visit_areas', __("Places you want to visit"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('tourist_visit_areas[]',$tourOperatorSafariPreferences, $customTourBookingTouristAttractionsId, ['class' => 'form-control select2','multiple', 'autocomplete' => 'off', 'id' => 'tourist_visit_areas', 'required']) }}
                                        {!! $errors->first('tourist_visit_areas', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('special_need_description', __("Do you have anyone whom need special attention? Describe.."), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('special_need_description', $customTourBooking->special_need_description, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder'=>'If none type none','maxLength'=>'200','style'=>'height:80px','id' => 'special_need_description', 'required']) }}
                                        {!! $errors->first('special_need_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('start_date', __("Start Date"), ['class' => 'required_asterik']) }}
                                        {{ Form::date('start_date',$customTourBooking->start_date, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'start_date', 'required']) }}
                                        {!! $errors->first('start_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('end_date', __("End Date"), ['class' => 'required_asterik']) }}
                                        {{ Form::date('end_date',$customTourBooking->end_date, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'end_date', 'required']) }}
                                        {!! $errors->first('end_date', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('due_payment_time', __("Due payment date"), ['class' => 'required_asterik']) }}
                                        {{ Form::date('due_payment_time', $customTourBooking->due_payment_time, ['class' => 'form-control','autocomplete' => 'off', 'id' => 'due_payment_time', 'required']) }}
                                        {!! $errors->first('due_payment_time', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_adult_foreigners', __("Number of Foreigners (Adults)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_adult_foreigners',$customTourBooking->total_adult_foreigners, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder'=>'if none type 0','id' => 'total_adult_foreigners', 'required']) }}
                                        {!! $errors->first('total_adult_foreigners', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_children_foreigners', __("Number of Foreigners (Children)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_children_foreigners', $customTourBooking->total_children_foreigners, ['class' => 'form-control', 'placeholder'=>'If none write 0','autocomplete' => 'off', 'id' => 'total_children_foreigners', 'required']) }}
                                        {!! $errors->first('total_children_foreigners', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_children_residents', __("Number of Residents (Children)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_children_residents', $customTourBooking->total_children_residents, ['class' => 'form-control', 'placeholder'=>'If none write 0','autocomplete' => 'off', 'id' => 'total_children_residents', 'required']) }}
                                        {!! $errors->first('total_children_residents', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_adult_residents', __("Number of Residents (Adult)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_adult_residents', $customTourBooking->total_adult_residents, ['class' => 'form-control', 'placeholder'=>'If none write 0','autocomplete' => 'off', 'id' => 'total_adult_residents', 'required']) }}
                                        {!! $errors->first('total_adult_residents', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Do you need a reservation?</label><br>
                                        <div class="form-check form-check-inline custom-checkbox">
                                            <input class="form-check-input" type="checkbox" id="reservation_yes" name="reservation_needed" value="1" {{ $customTourBooking->reservation_needed == 1 ? 'checked' : '' }} >
                                            <label class="form-check-label" for="reservation_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline custom-checkbox">
                                            <input class="form-check-input" type="checkbox" id="reservation_no" name="reservation_needed" value="0" {{ $customTourBooking->reservation_needed == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="reservation_no">No</label>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('message', __("Your Message"), ['class' => 'required_asterik']) }}<br>
                                        <p>To ensure the best response from {{$tourOperator->company_name}}, it is recommended to introduce yourself and provide an explanation of your interest in this tour </p>
                                        {{ Form::textarea('message',$customTourBooking->message, ['class' => 'form-control','style'=>'height:100px', 'maxLength'=>'200','autocomplete' => 'off', 'id' => 'message', 'required']) }}
                                        {!! $errors->first('message', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('discount', __("Discount offering (percent)"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('discount', $customTourBooking->discount, ['class' => 'form-control','autocomplete' => 'off', 'placeholder'=>'if no discount, type 0', 'id' => 'discount', 'required']) }}
                                        {!! $errors->first('discount', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Set tour price</h4>
                                    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Attraction</th>
                                                <th>Resident adult price</th>
                                                <th>Foreigner adult price</th>
                                                <th>Resident child price</th>
                                                <th>Foreigner child price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(empty($customTourBooking->CustomTourBookingTouristAttractionLabel))
                                                <tr>
                                                    <td colspan="5">No attractions selected</td>
                                                </tr>
                                            @else
                                                @foreach($customTourBooking->CustomTourBookingTouristAttractionLabel as $attraction)
                                                    <tr>
                                                        <td>
                                                            {{ $attraction['attraction_name'] }}
                                                            {{ Form::hidden('attraction_id[]', $attraction['id']) }}
                                                        </td>
                                                        @php
                                                            $attractionPrice = $customTourBookingTourPrices->where('attraction_id', $attraction['id'])->first();
                                                        @endphp
                                                        <td><input type="number" class="form-control" value="{{ $attractionPrice ? $attractionPrice->resident_adult_price : '' }}" name="resident_adult_price[]" required></td>
                                                        <td><input type="number" class="form-control" value="{{ $attractionPrice ? $attractionPrice->foreigner_adult_price : '' }}" name="foreigner_adult_price[]" required></td>
                                                        <td><input type="number" class="form-control" value="{{ $attractionPrice ? $attractionPrice->resident_child_price : '' }}" name="resident_child_price[]" required></td>
                                                        <td><input type="number" class="form-control" value="{{ $attractionPrice ? $attractionPrice->foreigner_child_price : '' }}" name="foreigner_child_price[]" required></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Allocate reservations</h4>
                                    <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Attraction</th>
                                                <th>Reservation</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(empty($customTourBooking->CustomTourBookingTouristAttractionLabel))
                                                <tr>
                                                    <td colspan="2">No attractions selected</td>
                                                </tr>
                                            @else
                                                @foreach($customTourBooking->CustomTourBookingTouristAttractionLabel as $attraction)
                                                    <tr>
                                                        <td>
                                                            {{ $attraction['attraction_name'] }}
                                                            {{ Form::hidden('touristic_attraction_id[]', $attraction['id']) }}
                                                        </td>
                                                        <td>
                                                            {{ Form::select('tour_operator_reservation_id[]', ['' => 'No Reservation'] + $reservations->toArray(), isset($attractionReservations[$loop->index]['tour_operator_reservation_id']) ? $attractionReservations[$loop->index]['tour_operator_reservation_id'] : null, ['class' => 'form-control select2', 'autocomplete' => 'off']) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <h4>Allocated reservations</h4>

                                    <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Attraction name</th>
                                                <th>Reservation name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($attractionReservations as $attractionReservation)
                                                <tr>
                                                    <td>{{$attractionReservation->touristicAttraction->attraction_name}}</td>
                                                    @if($attractionReservation->tour_operator_reservation_id==0)
                                                        <td>No reservation</td>
                                                    @else
                                                    <td>{{$attractionReservation->tourOperatorReservation->reservation_name}}</td>
                                                    @endif
                                                    <td><a href="{{route('customTourBookings.deleteAttractionReservation',$attractionReservation->uuid)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">No reservation was added for a specific safari allocated</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                        <div class="callout">
                                            <div class="callout-header">
                                                <h3>Wanna see the invoice?</h3>
                                            </div>
                                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                            <div class="callout-container">
                                                <a href="{{route('customTourBookings.invoicePreview',$customTourBooking->uuid)}}" class="btn btn-primary">
                                                    Preview Invoice
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>By clicking the 'Send request' button you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a></p>
                                    <input name="tour_operator_id" value="{{$tourOperator->id}}" hidden>
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

