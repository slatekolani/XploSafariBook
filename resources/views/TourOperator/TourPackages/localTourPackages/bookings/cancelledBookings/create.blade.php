@extends('layouts.main', ['title' => 'Cancel Trip ', 'header' => __('Cancel Trip ')])

@include('includes.validate_assets')
@section('content')

{{ Form::open(['route'=>'localTripCancellation.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
@csrf
<section>
    <div class="row" style="margin: auto">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                     <div class="col-md-12">
                       
                        
                        <div class="alert alert-info mt-3">
                            <ul style="list-style:none">
                                <li>
                                    <i class="fas fa-briefcase mr-2"></i> If you are traveling as a group, cancellations must be made on behalf of all individuals included in your booking. Partial cancellations may require special handling and might not be applicable for certain itineraries.
                                </li>
                                <li>
                                    <i class="fas fa-user-friends mr-2"></i> As the lead traveler or group representative, ensure that you have communicated with all group members before submitting the cancellation request. The request will affect all group participants.
                                </li>
                                <li>
                                    <i class="fas fa-info-circle mr-2"></i> Review the cancellation policy applicable to your booking. Cancellation charges, refund timelines, and any non-refundable components will be highlighted before final submission.
                                </li>
                                <li>
                                    <i class="fas fa-file-alt mr-2"></i> For cancellations due to emergencies, such as illness or unforeseen circumstances, <span style="color: dodgerblue">{{$localTourBooking->localTourPackages->tourOperator->company_name}}</span> will ask for more proof while processing your request.
                                </li>
                                <li>
                                    <i class="fas fa-dollar-sign mr-2"></i> Understand that refunds will be processed as per the payment method used during booking, or depending on policy terms. Please review the terms & condition of <a href="{{ asset('public/companyTermsAndConditions/' . $localTourBooking->localTourPackages->tourOperator->terms_and_conditions) }}"
                                        target="_blank">{{$localTourBooking->localTourPackages->tourOperator->company_name}}</a>
                                </li>
                                <li>
                                    <i class="fas fa-clock mr-2"></i> Submit your cancellation request as soon as possible to maximize refund eligibility. Late cancellations may result in higher charges or forfeiture of the entire amount.
                                </li>
                               
                                <li>
                                    <i class="fas fa-envelope mr-2"></i> Once the cancellation is processed, a confirmation email will be sent to your registered email address. Keep this for your records.
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>       

        <div class="col-md-12 mt-4">
            <div class="card shadow-sm">
                <div class="col-md-12 mt-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Confirm Booking Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <dl class="row">
                                        <dt class="col-sm-4">Booking Reference:</dt>
                                        <dd class="col-sm-8">{{ $localTourBooking->reference_number }}</dd>
                                        
                                        <dt class="col-sm-4">Tour Package:</dt>
                                        <dd class="col-sm-8">{{ $localTourBooking->localTourPackages->touristicAttraction->attraction_name }}</dd>
                                        
                                        <dt class="col-sm-4">Travel Date:</dt>
                                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($localTourBooking->travel_date)->format('d M Y') }}</dd>
                                        <dt class="col-sm-4">Tour Price:</dt>
                                        <dd class="col-sm-8">
                                            Tshs {{number_format($localTourBooking->DiscountedTourPriceLabel)}}
                                        </dd>
                                        
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row">
                                        <dt class="col-sm-4">Number of Travelers:</dt>
                                        <dd class="col-sm-8">{{ $localTourBooking->TotalTouristsLabel }}</dd>
                                        
                                        <dt class="col-sm-4">Tour Operator:</dt>
                                        <dd class="col-sm-8">{{ $localTourBooking->localTourPackages->tourOperator->company_name }}</dd>
                                        
                                        <dt class="col-sm-4">Booking Status:</dt>
                                        <dd class="col-sm-8">
                                            @if ($localTourBooking->status == 1)
                                            <span class="badge badge-success">
                                                Confirmed for Safari
                                            </span>
                                            @else
                                            <span class="badge badge-danger">
                                                Not Confirmed for Safari
                                            </span>
                                            @endif
                                            
                                        </dd>
                                        
                                        <dt class="col-sm-4">Amount Paid:</dt>
                                        <dd class="col-sm-8">
                                            Tshs 0
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($localTourBooking->TotalLocalCancelledTripBookingsLabel == 0)
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('cancellation_type', __("Cancellation type"), ['class' => 'required_asterik font-weight-bold']) }}
                        {{ Form::select('cancellation_type', [
                            'full cancellation' => 'Full Cancellation',
                            'partial cancellation' => 'Partial Cancellation',
                        ], null, ['class' => 'form-control select2', 'placeholder' => 'Select cancellation type', 'required']) }}
                        {!! $errors->first('cancellation_type', '<span class="badge badge-danger">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label('cancellation_reason', __("Reason for Trip Cancellation"), ['class' => 'required_asterik font-weight-bold']) }}
                        {{ Form::select('cancellation_reason', [
                            '' => 'Select a reason for cancellation',
                            'medical emergency' => 'Medical Emergency/Illness',
                            'weather condition' => 'Adverse Weather Conditions',
                            'work commitments' => 'Work-related Commitments',
                            'family emergency' => 'Family Emergency',
                            'visa issue' => 'Visa/Documentation Issues',
                            'transport issue' => 'Transportation Issues',
                            'financial constraints' => 'Financial Constraints',
                            'schedule conflict' => 'Schedule Conflict',
                            'travel advisory concerns' => 'Travel Advisory/Safety Concerns',
                            'accommodation issue' => 'Accommodation Issues',
                            'personal reasons' => 'Personal Reasons',
                            'other' => 'Other (Please specify in description)'
                        ], null, ['class' => 'form-control select2', 'required']) }}
                        {!! $errors->first('cancellation_reason', '<span class="badge badge-danger">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label('cancellation_reason_description', __("Additional Details"), ['class' => 'required_asterik font-weight-bold']) }}
                        {{ Form::textarea('cancellation_reason_description', null, [
                            'class' => 'form-control',
                            'maxLength' => 150,
                            'rows' => 4,
                            'placeholder' => 'Please provide additional details about your cancellation reason',
                            'required'
                        ]) }}
                        {!! $errors->first('cancellation_reason_description', '<span class="badge badge-danger">:message</span>') !!}
                    </div>

                    <div class="terms-box p-3 bg-light rounded">
                        <div class="form-check">
                            {{ Form::checkbox('accept_cancellation_policy', '1', false, ['class' => 'form-check-input', 'id' => 'accept_cancellation_policy','required']) }}
                            {{ Form::label('accept_cancellation_policy', __('I agree to the following terms:'), ['class' => 'form-check-label fw-bold']) }}
                        </div>
                        <ul class="mt-3 text-muted">
                            
                            <li>{{$localTourBooking->localTourPackages->cancellation_policy}}</li>
                            <li>I confirm all information provided is accurate and complete</li>
                        </ul>
                    </div>
                    <input type="hidden" name="local_tour_booking_id" value="{{$localTourBooking->id}}">

        <div class="col-md-12 mt-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Back
                        </a>
                        {{ Form::button('<i class="fas fa-paper-plane mr-1"></i> ' . trans('Submit Cancellation Request'), ['class' => 'btn btn-primary', 'type' => 'submit']) }}
                    </div>
                </div>
            </div>
        </div>
                </div>
                @else
                <div class="card-body">
                    

                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle mr-2"></i> You have already submitted a cancellation request for this booking. Please wait for the previous request to be processed before submitting another.
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</section>
{{ Form::close() }}
@endsection

@push('after-scripts')
<style>
    .card {
        transition: all 0.3s ease;
        border: none;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
    
    .info-section {
        border-left: 4px solid #007bff;
    }
    
    .required_asterik:after {
        content: " *";
        color: red;
    }
    
    .btn {
        padding: 0.5rem 1.5rem;
        border-radius: 0.25rem;
        transition: all 0.2s;
    }
    
    .btn:hover {
        transform: translateY(-1px);
    }
    
    .alert {
        border-radius: 0.25rem;
    }
</style>

@endpush