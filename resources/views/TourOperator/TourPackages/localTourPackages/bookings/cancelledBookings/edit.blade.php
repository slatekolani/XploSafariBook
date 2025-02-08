@extends('layouts.main', ['title' => 'Edit Cancelled Trip ', 'header' => __('Edit Cancelled Trip ')])

@include('includes.validate_assets')
@section('content')

{{ Form::model($localTripCancellationRequest,['enctype="multipart/form-data"','route' => ['localTripCancellation.update', $localTripCancellationRequest->uuid], 'method'=>'put','autocomplete' => 'off',
'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
    {{ Form::hidden('user_id', $localTripCancellationRequest->id, []) }}
@csrf
<section>
    <div class="row" style="margin: auto">    
        <div class="col-md-12 mt-4">
            <div class="card shadow-sm">
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
                    <input type="hidden" name="local_tour_booking_id" value="{{$localTripCancellationRequest->local_tour_booking_id}}">

        <div class="col-md-12 mt-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Back
                        </a>
                        {{ Form::button('<i class="fas fa-paper-plane mr-1"></i> ' . trans('Update Cancellation Request'), ['class' => 'btn btn-primary', 'type' => 'submit']) }}
                    </div>
                </div>
            </div>
        </div>
                </div>                
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