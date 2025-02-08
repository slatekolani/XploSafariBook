@extends('layouts.main', ['title' => __('Local Trip Cancellation Request '), 'header' => __('Local Trip Cancellation Request')])
@include('includes.validate_assets')
@section('content')
@if (Auth::user()->hasRole(1) && Auth::user()->hasRole(2))
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    @if(isset($localTripCancellationRequest))
                    <table class="table table-hover table-responsive-md">
                        <tr>
                            <th>Cancellation Date & Time</th>
                            <td>{{ $localTripCancellationRequest->created_at->format('jS M Y h:i a') }}</td>
                        </tr>
                        <tr>
                            <th>Cancellation Type</th>
                            <td>{{ $localTripCancellationRequest->cancellation_type }}</td>
                        </tr>
                        <tr>
                            <th>Cancellation Reason</th>
                            <td>{{ $localTripCancellationRequest->cancellation_reason }}</td>
                        </tr>
                        <tr>
                            <th>Cancellation Description</th>
                            <td>{{ $localTripCancellationRequest->cancellation_reason_description }}</td>
                        </tr>
                        <tr>
                            <th>Cancellation Policy Agreement</th>
                            <td>
                                @if($localTripCancellationRequest->accept_cancellation_policy == 0)
                                <span class="badge badge-danger">Did not accept</span>
                                @else
                                <span class="badge badge-success">Accepted</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    @else
                    <p>No cancellation request data available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-info text-white text-center fw-bold">
                <h4>Cancellation Request Details</h4>
            </div>
            <div class="card-body">
                @if(isset($localTripCancellationRequest))
                <h3 class="fw-bold text-primary">Hello {{$localTourBooking->tourist_name}},</h3>
                <p class="mt-3">
                    Here are the details of your cancellation request for the safari to 
                    <a href="{{route('touristicAttraction.show', $localTourBooking->localTourPackages->touristicAttraction->uuid)}}" class="text-decoration-underline">
                        {{$localTourBooking->localTourPackages->touristicAttraction->attraction_name}}
                    </a>.
                </p>
                <p>
                    For more information about this trip, please click 
                    <a href="{{route('localTourBooking.view', $localTourBooking->uuid)}}" class="text-decoration-underline">here</a>.
                </p>

                <table class="table table-striped table-bordered table-hover mt-4">
                    <tbody>
                        <tr>
                            <th class="text-start" style="width: 40%;">Cancellation Date & Time</th>
                            <td class="text-start">{{ $localTripCancellationRequest->created_at->format('jS M Y h:i a') }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Cancellation Type</th>
                            <td class="text-start">{{ $localTripCancellationRequest->cancellation_type }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Cancellation Reason</th>
                            <td class="text-start">{{ $localTripCancellationRequest->cancellation_reason }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Cancellation Description</th>
                            <td class="text-start">{{ $localTripCancellationRequest->cancellation_reason_description }}</td>
                        </tr>
                        
                        <tr>
                            <th class="text-start">Cancellation Policy Agreement</th>
                            <td class="text-start">
                                @if($localTripCancellationRequest->accept_cancellation_policy == 0)
                                <span class="badge bg-danger">Did not accept</span>
                                @else
                                <span class="badge bg-success">Accepted</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-start">Cancellation Status</th>
                            <td class="text-start">
                                @if($localTripCancellationRequest->cancellation_status == 0)
                                <span class="badge bg-warning">Not approved</span>
                                @else
                                <span class="badge bg-danger">Cancellation Approved</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-start">Send Abort Cancellation Memo</th>
                            <td class="text-start">
                                <a href="#" class="btn btn-primary">Send Memo</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @else
                <div class="alert alert-warning text-center">
                    No cancellation request data available.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endif

@endsection
