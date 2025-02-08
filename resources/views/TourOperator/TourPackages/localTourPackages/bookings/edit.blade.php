@extends('layouts.main', ['title' => __('Edit Booking'), 'header' => __('Edit Booking')])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($localTourPackageBooking, [
        'route' => ['localTourBooking.update', $localTourPackageBooking->uuid],
        'method' => 'put',
        'autocomplete' => 'off',
        'id' => 'update',
        'class' => 'form-horizontal  needs-validation',
        'novalidate',
    ]) }}
    {{ Form::hidden('user_id', $localTourPackageBooking->id, []) }}

    @csrf
    <section>
        <div class="row" style="margin: auto">
            <div class="col-md-12">

                <div class="card shadow-lg rounded-lg">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0"><i class="fas fa-bookmark me-2"></i>Tour Booking Request</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <p class="text-muted mb-4">{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>

                            <!-- Personal Information Section -->
                            <div class="section-container mb-4">
                                <h5 class="section-title border-bottom pb-2 mb-3">
                                    <i class="fas fa-user me-2 text-primary"></i>Personal Information
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('tourist_name', __('Full name'), ['class' => 'form-label required_asterik']) }}
                                            {{ Form::text('tourist_name', $localTourPackageBooking->tourist_name, ['class' => 'form-control form-control-lg rounded', 'placeholder' => 'Enter your full name', 'required']) }}
                                            {!! $errors->first('tourist_name', '<span class="badge bg-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('phone_number', __('Phone number'), ['class' => 'form-label required_asterik']) }}
                                            {{ Form::tel('phone_number', $localTourPackageBooking->phone_number, ['class' => 'form-control form-control-lg rounded', 'placeholder' => '+XXX XXXXXXXXX', 'required']) }}
                                            {!! $errors->first('phone_number', '<span class="badge bg-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('email_address', __('Email address'), ['class' => 'form-label required_asterik']) }}
                                            {{ Form::email('email_address', $localTourPackageBooking->email_address, ['class' => 'form-control form-control-lg rounded', 'placeholder' => 'your@email.com', 'required']) }}
                                            {!! $errors->first('email_address', '<span class="badge bg-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Travelers Information Section -->
                            <div class="section-container mb-4">
                                <h5 class="section-title border-bottom pb-2 mb-3">
                                    <i class="fas fa-users me-2 text-primary"></i>Travelers Information
                                </h5>
                                <div class="row g-3">
                                    <!-- Fields for Travelers Information -->
                                    <div class="col-md-6">
                                        {{ Form::label('total_number_foreigner_adult', __('Total non-resident adults'), ['class' => 'form-label required_asterik']) }}
                                        {{ Form::number('total_number_foreigner_adult', $localTourPackageBooking->total_number_foreigner_adult, ['class' => 'form-control rounded', 'placeholder' => 'If none, enter 0', 'required', 'min' => '0', 'id' => 'total_foreign_adults']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::label('total_number_foreigner_child', __('Total non-resident children'), ['class' => 'form-label required_asterik']) }}
                                        {{ Form::number('total_number_foreigner_child', $localTourPackageBooking->total_number_foreigner_child, ['class' => 'form-control rounded', 'placeholder' => 'If none, enter 0', 'required', 'min' => '0', 'id' => 'total_foreign_children']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::label('total_number_local_adult', __('Total resident adults'), ['class' => 'form-label required_asterik']) }}
                                        {{ Form::number('total_number_local_adult', $localTourPackageBooking->total_number_local_adult, ['class' => 'form-control rounded', 'placeholder' => 'If none, enter 0', 'required', 'min' => '0', 'id' => 'total_local_adults']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::label('total_number_local_child', __('Total resident children'), ['class' => 'form-label required_asterik']) }}
                                        {{ Form::number('total_number_local_child', $localTourPackageBooking->total_number_local_child, ['class' => 'form-control rounded', 'placeholder' => 'If none, enter 0', 'required', 'min' => '0', 'id' => 'total_local_children']) }}
                                    </div>
                                </div>
                            </div>

                            <!-- Free of Charge Children Section -->
                            <div class="section-container mb-4">
                                <h5 class="section-title border-bottom pb-2 mb-3">
                                    <i class="fas fa-child me-2 text-primary"></i>Children Below
                                    {{ $localTourPackageBooking->localTourPackages->free_of_charge_age }} Years
                                </h5>
                                <div class="form-group">
                                    <div class="alert alert-info mb-3">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Please indicate the total number of children below
                                        {{ $localTourPackageBooking->localTourPackages->free_of_charge_age }} years old
                                    </div>
                                    {{ Form::label('total_free_of_charge_children', __('Total children'), ['class' => 'form-label required_asterik']) }}
                                    {{ Form::number('total_free_of_charge_children', $localTourPackageBooking->total_free_of_charge_children, ['class' => 'form-control rounded', 'placeholder' => 'If none, enter 0', 'required', 'min' => '0']) }}
                                    {!! $errors->first('total_free_of_charge_children', '<span class="badge bg-danger">:message</span>') !!}
                                </div>
                            </div>

                            <!-- Pickup Location Section -->
                            <div class="section-container mb-4">
                                <h5 class="section-title border-bottom pb-2 mb-3">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>Pickup Location
                                </h5>
                                <div class="form-group">
                                    {{ Form::label('collection_station', __('Where would you like to be picked up?'), ['class' => 'form-label required_asterik']) }}
                                    @if (count($localTourCollectionStations) > 0)
                                        {{ Form::select('collection_station', $localTourCollectionStations->pluck('collection_stop_name', 'id'), null, [
                                            'class' => 'form-select select2 rounded',
                                            'required',
                                            'style' => 'width: 100%',
                                        ]) }}
                                    @else
                                        <span class="badge bg-danger">No pickup locations available</span>
                                    @endif
                                    {!! $errors->first('collection_station', '<span class="badge bg-danger">:message</span>') !!}
                                </div>
                            </div>

                            @if (count($localTourPackageReservations) > 0)
                                <div class="section-container mb-4">
                                    <h5 class="section-title border-bottom pb-2 mb-3">
                                        <i class="fas fa-hotel me-2 text-primary"></i>Optional Reservations
                                    </h5>
                                    <div class="alert alert-info mb-3">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Select from our recommended accommodations for your safari experience
                                    </div>

                                    <!-- Hidden input to set a default null value -->
                                    <input type="hidden" name="reservation_id" value="">

                                    @foreach ($localTourPackageReservations as $key => $localTourPackageReservation)
                                        <div
                                            class="reservation-card mb-3 p-3 border {{ $key === 0 ? 'border-primary' : '' }} rounded">
                                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <h5 class="mb-3">{{ $localTourPackageReservation->reservation_name }}
                                                </h5>
                                                <div class="d-flex flex-column">
                                                    <div>Price/day/Resident Adult: <span style="color: dodgerblue">TShs
                                                            {{ number_format($localTourPackageReservation->resident_adult_price_reservation) }}</span>
                                                    </div>
                                                    <div>Price/day/Resident Child: <span style="color: dodgerblue">TShs
                                                            {{ number_format($localTourPackageReservation->resident_child_price_reservation) }}</span>
                                                    </div>
                                                    <div>Price/day/Foreigner Child: <span style="color: dodgerblue">TShs
                                                            {{ number_format($localTourPackageReservation->foreigner_child_price_reservation) }}</span>
                                                    </div>
                                                    <div>Price/day/Foreigner Adult: <span style="color: dodgerblue">TShs
                                                            {{ number_format($localTourPackageReservation->foreigner_adult_price_reservation) }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="reservation-images mb-3">
                                                <div class="row g-2">
                                                    @foreach (explode(',', $localTourPackageReservation->reservation_images) as $image)
                                                        <div class="col-md-3">
                                                            <a href="{{ '/public/' . $image }}"
                                                                data-fancybox="gallery-{{ $key }}"
                                                                class="d-block">
                                                                <img src="{{ '/public/' . $image }}" alt="Reservation"
                                                                    class="img-fluid rounded">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="d-flex flex-column">
                                                <a href="{{ $localTourPackageReservation->reservation_url }}"
                                                    target="_blank" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-external-link-alt me-1"></i>Preview Website
                                                </a>
                                                

                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input reservation-radio"
                                                        name="reservation_id"
                                                        id="reservation-{{ $localTourPackageReservation->id }}"
                                                        value="{{ $localTourPackageReservation->id }}"
                                                        {{ old('reservation_id', $localTourPackageBooking->reservation_id ?? '') == $localTourPackageReservation->id ? 'checked' : '' }}>
                                                    <label for="reservation-{{ $localTourPackageReservation->id }}"
                                                        class="form-check-label">Use this reservation</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <h5 class="section-title border-bottom pb-2 mb-3">
                                    <i class="fas fa-hotel me-2 text-primary"></i>Optional Reservations
                                </h5>
                                <div class="alert alert-info mb-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Select from our recommended accommodations for your safari experience
                                </div>
                                <!-- Display alert if no reservations are available -->
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    This safari does not offer any accomodation options.
                                </div>
                            @endif
                            <!-- Special Needs Section -->
                            <div class="section-container mb-4">
                                <h5 class="section-title border-bottom pb-2 mb-3">
                                    <i class="fas fa-heart me-2 text-primary"></i>Special Requirements
                                </h5>
                                <div class="form-group mb-3">
                                    {{ Form::label('special_attention', __('Any special attention needed?'), ['class' => 'form-label']) }}
                                    {{ Form::select('special_attention', $localTourPackageSupportedSpecialNeeds, null, [
                                        'class' => 'form-select select2 rounded',
                                        'style' => 'width: 100%',
                                        'placeholder' => 'Select if any special requirements needed',
                                    ]) }}
                                    {!! $errors->first('special_attention', '<span class="badge bg-danger">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('message', __('Additional message'), ['class' => 'form-label required_asterik']) }}
                                    {{ Form::textarea('message', $localTourPackageBooking->message, ['class' => 'form-control rounded', 'rows' => 3, 'maxLength' => '100', 'placeholder' => 'Any additional information or requests?', 'required']) }}
                                    {!! $errors->first('message', '<span class="badge bg-danger">:message</span>') !!}
                                    <small class="text-muted">Maximum 100 characters</small>
                                </div>
                            </div>

                            <!-- Terms and Conditions Section -->
                            <div class="section-container mb-4">
                                <h5 class="section-title border-bottom pb-2 mb-3">
                                    <i class="fas fa-file-contract me-2 text-primary"></i>Terms and Conditions
                                </h5>

                                <div class="terms-box p-3 bg-light rounded">
                                    <div class="form-check">
                                        {{ Form::checkbox('payment_agreement', '1', old('payment_agreement') == '1' || $localTourPackageBooking->payment_agreement ?? false, ['class' => 'form-check-input', 'id' => 'payment_agreement']) }}
                                        {{ Form::label('payment_agreement', __('I confirm that the amount and conditions outlined below are affordable, and I am able to meet them.:'), ['class' => 'form-check-label fw-bold']) }}
                                    </div>
                                    <ul class="mt-3 text-muted">
                                        <li style="color: dodgerblue;font-weight:bold"><i><u>Update the values in a tourist request — particularly the numbers — to see the difference!</u></i></li>
                                        <li>Discount of <span style="color: dodgerblue">{{$localTourPackageBooking->localTourPackages->discount_offered}}%</span> are offered when the total number of travelers you have booked for reaches <span style="color: dodgerblue">{{$localTourPackageBooking->localTourPackages->number_of_people_for_discount}} people</span> or more.</li>
                                        <li>Your tour will cost <span style="color:dodgerblue"
                                                id="total_before_discount">...</span> before the discount is applied, and
                                            <span style="color: dodgerblue" id="total_after_discount">...</span> after
                                            the discount is applied, to be paid within the <a
                                                href="{{ route('localTourPackage.spotLocalTourPackagePlans', $localTourPackageBooking->localTourPackages->package_range) }}">{{ $localTourPackagePackageRangeName }}</a>
                                            timeframe.
                                        </li>
                                        <li> The starting amount required to proceed with the installment
                                            payments is <span style="color: dodgerblue" id="initial_payment">...</span>,
                                            which is <i
                                                style="color: dodgerblue">{{ $localTourPackageBooking->localTourPackages->payment_start_percent }}%</i>
                                            of the discounted amount to be paid before <span style="color: dodgerblue">{{date('jS M Y',strtotime($localTourPackageBooking->localTourPackages->payment_start_percent_deadline))}}</span>. This is a non-refundable deposit.
                                        </li>

                                        <li>The deadline for payment for this trip is <i
                                                style="color:dodgerblue">{{ date('jS M Y', strtotime($localTourPackageBooking->localTourPackages->payment_deadline)) }}</i>.
                                            Your tour agent will provide additional details regarding payment.</li>
                                            <li>Cancellation fees may apply according to the cancellation policy if you decide to cancel your trip. This will cost you <span style="color: dodgerblue" id="cancellation_fee">...</span>, amounting to <i style="color:dodgerblue">{{ $localTourPackageBooking->localTourPackages->cancellation_percent }}%</i> of the total cost. After the cancellation deadline of <i style="color:dodgerblue">{{ date('jS M Y', strtotime($localTourPackageBooking->localTourPackages->cancellation_due_date)) }}</i>, no refund will be issued for cancellations. However, early cancellations after booking may result in lower cancellation fees than the standard ones. The final decision is at the discretion of <a href="{{ route('tourOperator.publicView', $localTourPackageBooking->localTourPackages->tourOperator->uuid) }}">{{$localTourPackageBooking->localTourPackages->tourOperator->company_name}}</a>, based on their requirements.</li>
                                        <li>An email will be sent to you shortly after <a
                                                href="{{ route('tourOperator.publicView', $localTourPackageBooking->localTourPackages->tourOperator->uuid) }}">{{ $localTourPackageBooking->localTourPackages->tourOperator->company_name }}</a>
                                            confirms your travel. The email will contain all the necessary details to
                                            help you get started.</li>
                                    </ul>
                                </div>
                                <div class="section-container mb-4">
                                    <h5 class="section-title border-bottom pb-2 mb-3">
                                        <i class="fas fa-dollar-sign""></i> Payment Mode
                                    </h5>
                                    <div class="form-group">
                                        <div class="alert alert-info mb-3">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Please specify how you plan to pay for your safari.
                                            <ul>
                                                <li>Full Payment: Pay the entire amount at once.</li>
                                                <li>Partial Payment: Pay in smaller amounts over time until the full balance
                                                    is cleared. </li>
                                            </ul>

                                        </div>
                                        <div style="display: flex">
                                            <div class="form-check" style="padding-right: 10px">
                                                <input type="radio" class="form-check-input" name="payment_mode"
                                                    id="fullPayment" value="fullPayment"
                                                    {{ old('payment_mode', $localTourPackageBooking->payment_mode ?? '') == 'fullPayment' ? 'checked' : '' }}>
                                                
                                                <label for="fullPayment" class="form-check-label">Full payment</label>
                                            </div>
                                            <div class="form-check" style="padding-right: 10px">
                                                <input type="radio" class="form-check-input" name="payment_mode"
                                                    id="partialPayment" value="partialPayment"
                                                    {{ old('payment_mode', $localTourPackageBooking->payment_mode ?? '') == 'partialPayment' ? 'checked' : '' }}>
                                                <label for="partialPayment" class="form-check-label">Partial
                                                    Payment</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="terms-box p-3 bg-light rounded">
                                    <div class="form-check">
                                        {{ Form::checkbox('accept_terms', '1', old('accept_terms') == '1' || $localTourPackageBooking->accept_terms ?? false, ['class' => 'form-check-input', 'id' => 'accept_terms']) }}
                                        {{ Form::label('accept_terms', __('I agree to the following terms:'), ['class' => 'form-check-label fw-bold']) }}
                                    </div>

                                    <ul class="mt-3 text-muted">
                                        <li>I have read and accept the <a
                                                href="{{ route('tourOperator.publicView', $localTourPackageBooking->localTourpackages->tourOperator->uuid) }}">{{ $localTourPackageBooking->localTourPackages->tourOperator->company_name }}</a>'s
                                            <a href="{{ asset('public/companyTermsAndConditions/' . $localTourPackageBooking->localTourPackages->tourOperator->terms_and_conditions) }}"
                                                target="_blank">Terms and Conditions</a>
                                        </li>
                                        <li>I have read <i>XploSafariBook</i> <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></li>
                                        <li>I confirm all information provided is accurate and complete</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input name="local_tour_package_id"
                                value="{{ $localTourPackageBooking->localTourPackages->id }}" hidden>
                            <input name="tour_operator_id"
                                value="{{ $localTourPackageBooking->localTourPackages->tourOperator->id }}" hidden>
                        </div>
                        <br>
                        @if ($localTourPackageBooking->localTourPackages->TotalSpacesRemainedLabel <= 0)
                            <div class="alert alert-info" role="alert">
                                No space is available in this tour. Please find another ones. Click <a
                                    href="">here</a> to find similar safari's to this
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Update'), ['class' => 'btn btn-primary btn-sm', 'type' => 'submit', 'style' => 'border-radius: 5px;']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

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
        @if ($localTourPackageReservations->isNotEmpty())
            function updateReservationId() {
                var checkbox = document.getElementById('reservation_id_checkbox');
                var hiddenInput = document.getElementById('reservation_id_hidden');

                if (checkbox.checked) {
                    hiddenInput.value = "{{ $localTourPackageReservations->first()->id }}";
                } else {
                    hiddenInput.value = "0";
                }
            }

            document.getElementById('reservation_id_checkbox').addEventListener('change', updateReservationId);
        @endif
    </script>
@endpush

@push('after-scripts')
    <script>
        document.querySelectorAll('.reservation-radio').forEach(function(radio) {
            radio.addEventListener('click', function() {
                // If the radio button is already checked, uncheck it
                if (this.checked && this.dataset.checked === "true") {
                    this.checked = false;
                    this.dataset.checked = "false";
                } else {
                    // Set the data attribute on all radios to "false" and set the clicked radio to "true"
                    document.querySelectorAll('.reservation-radio').forEach(r => r.dataset.checked =
                        "false");
                    this.dataset.checked = "true";
                }
            });
        });
    </script>
@endpush
@push('after-scripts')
<script>
document.addEventListener('input', calculateTotalCost);

function calculateTotalCost() {
 // Parse input values as integers to avoid string issues
 const foreignAdults = parseInt(document.getElementById('total_foreign_adults').value) || 0;
 const foreignChildren = parseInt(document.getElementById('total_foreign_children').value) || 0;
 const localAdults = parseInt(document.getElementById('total_local_adults').value) || 0;
 const localChildren = parseInt(document.getElementById('total_local_children').value) || 0;

 const totalTravellers = foreignAdults + foreignChildren + localAdults + localChildren;

 // Prices
 const pricePerForeignAdult = parseFloat({{ $localTourPackageBooking->localTourPackages->trip_price_adult_foreigner }});
 const pricePerForeignChild = parseFloat({{ $localTourPackageBooking->localTourPackages->trip_price_child_foreigner }});
 const pricePerLocalAdult = parseFloat({{ $localTourPackageBooking->localTourPackages->trip_price_adult_tanzanian }});
 const pricePerLocalChild = parseFloat({{ $localTourPackageBooking->localTourPackages->trip_price_child_tanzanian }});
 const discount = parseFloat({{ $localTourPackageBooking->localTourPackages->discount_offered }});
 const startPercent = parseFloat({{ $localTourPackageBooking->localTourPackages->payment_start_percent }});
 const cancellationPercent = parseFloat({{ $localTourPackageBooking->localTourPackages->cancellation_percent }});
 const minTravellersForDiscount = parseInt({{ $localTourPackageBooking->localTourPackages->number_of_people_for_discount }});

 // Initialize reservation prices to zero
 let reservationAdultResidentPrice = 0;
 let reservationChildResidentPrice = 0;
 let reservationAdultForeignerPrice = 0;
 let reservationChildForeignerPrice = 0;

 // Check selected reservation
 const selectedReservation = document.querySelector('input[name="reservation_id"]:checked');
 if (selectedReservation) {
     const reservationId = selectedReservation.value;

     @foreach ($localTourPackageReservations as $reservation)
         if (reservationId == "{{ $reservation->id }}") {
             reservationAdultResidentPrice = parseFloat({{ $reservation->resident_adult_price_reservation }});
             reservationChildResidentPrice = parseFloat({{ $reservation->resident_child_price_reservation }});
             reservationAdultForeignerPrice = parseFloat({{ $reservation->foreigner_adult_price_reservation }});
             reservationChildForeignerPrice = parseFloat({{ $reservation->foreigner_child_price_reservation }});
         }
     @endforeach
 }

 let totalBeforeDiscount =
     (foreignAdults * pricePerForeignAdult) +
     (foreignChildren * pricePerForeignChild) +
     (localAdults * pricePerLocalAdult) +
     (localChildren * pricePerLocalChild);

 // Add reservation costs based on traveler type
 if (selectedReservation) {
     totalBeforeDiscount += (foreignAdults * reservationAdultForeignerPrice) +
         (foreignChildren * reservationChildForeignerPrice) +
         (localAdults * reservationAdultResidentPrice) +
         (localChildren * reservationChildResidentPrice);
 }

 // Add selected collection station cost
 const collectionStationSelect = document.getElementById('collection_station');
 const selectedCollectionStationId = collectionStationSelect.value;

 let collectionStationCost = 0;
 @foreach ($localTourCollectionStations as $station)
     if (selectedCollectionStationId == "{{ $station->id }}") {
         collectionStationCost = parseFloat({{ $station->collection_stop_price }});
     }
 @endforeach

 totalBeforeDiscount += collectionStationCost * totalTravellers;

 let discountAmount = 0;
 if (totalTravellers >= minTravellersForDiscount) {
     discountAmount = totalBeforeDiscount * (discount / 100);
 }

 const totalAfterDiscount = totalBeforeDiscount - discountAmount;
 const initialPayment = totalAfterDiscount * (startPercent / 100);
 
 // Difference btn initial payment and the actual payment.
  const cancellationAfterDiscount=totalAfterDiscount-initialPayment;
  const cancellationBeforeDiscount=totalBeforeDiscount-initialPayment;
 // Take the difference then get the cancellation percent to gt the amount to get cancelled to the personnel
 // Calculate cancellation fee based on whether discount was applied
 const cancellationFee = discountAmount > 0
     ? cancellationAfterDiscount * (cancellationPercent / 100)
     : cancellationBeforeDiscount * (cancellationPercent / 100);

 // Function to format numbers as TZS currency
 function formatToTZS(amount) {

     return 'TZS ' + Number(amount).toLocaleString('en-KE', {
         minimumFractionDigits: 2,
         maximumFractionDigits: 2
     });
 }

 // Update the content with formatted values
 document.getElementById('total_before_discount').textContent = formatToTZS(totalBeforeDiscount);
 document.getElementById('total_after_discount').textContent = formatToTZS(totalAfterDiscount);
 document.getElementById('initial_payment').textContent = formatToTZS(initialPayment);
 document.getElementById('cancellation_fee').textContent = formatToTZS(cancellationFee);
}

// Recalculate when reservation or collection station changes
document.querySelectorAll('.reservation-radio').forEach(radio => {
 radio.addEventListener('change', calculateTotalCost);
});
document.getElementById('collection_station').addEventListener('change', calculateTotalCost);

 </script>
    
@endpush