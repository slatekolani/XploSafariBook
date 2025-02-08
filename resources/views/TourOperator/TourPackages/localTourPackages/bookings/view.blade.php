@extends('layouts.main', ['title' => __('Local tour booking for ' . $localTourBooking->tourist_name), 'header' => __('Local tour booking')])
@include('includes.validate_assets')
@section('content')


    <div class="row">
        <div class="col-md-12">
            @if (Auth::user()->hasRole(1) && Auth::user()->hasRole(2))
                <a href="{{ route('localTourBooking.edit', $localTourBooking->uuid) }}" class="btn btn-primary btn-sm"
                    style="margin-bottom:10px">Edit Information</a>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-responsive-md">
                                <tr>
                                    <th>Tourist name</th>
                                    <td>{{ $localTourBooking->tourist_name }}</td>
                                </tr>
                                <tr>
                                    <th>Phone number</th>
                                    <td>{{ $localTourBooking->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Email address</th>
                                    <td>{{ $localTourBooking->email_address }}</td>
                                </tr>
                                <tr>
                                    <th>Total children foreigners</th>
                                    <td>{{ number_format($localTourBooking->total_number_foreigner_child) }}</td>
                                </tr>
                                <tr>
                                    <th>Total adults foreigners</th>
                                    <td>{{ number_format($localTourBooking->total_number_foreigner_adult) }}</td>
                                </tr>
                                <tr>
                                    <th>Total children residents</th>
                                    <td>{{ number_format($localTourBooking->total_number_local_child) }}</td>
                                </tr>
                                <tr>
                                    <th>Total adults residents</th>
                                    <td>{{ number_format($localTourBooking->total_number_local_adult) }}</td>
                                </tr>
                                <tr>
                                    <th>Pick up station</th>
                                    <td>{{ $localTourBooking->collectionStop->collection_stop_name }}</td>
                                    <td>{{ number_format($localTourBooking->collectionStop->collection_stop_price) }}</td>
                                </tr>
                                <tr>
                                    <th>Special need</th>
                                    @if ($localTourBooking->special_attention == 0)
                                        <td>No special need included in this safari</td>
                                    @else
                                        <td>{{ $localTourBooking->specialNeed->special_need_name }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Reservation selected</th>
                                    <td>
                                        @if ($localTourBooking->reservation_id == 0)
                                            <span>No reservation was selected</span>
                                        @else
                                            <span>{{ $localTourBooking->tourOperatorReservation->reservation_name }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td>{{ $localTourBooking->message }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    @if ($localTourBooking->status == 1)
                                        <td><span class="badge badge-success badge-pill">Approved</span></td>
                                    @else
                                        <td><span class="badge badge-danger badge-pill">Unapproved</span></td>
                                    @endif
                                </tr>


                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-primary text-white text-center fw-bold">
                                <h4>Local Tour Booking Details</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th class="text-start" style="width: 40%;">Tourist Name</th>
                                            <td class="text-start">{{ $localTourBooking->tourist_name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Phone Number</th>
                                            <td class="text-start">{{ $localTourBooking->phone_number }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Email Address</th>
                                            <td class="text-start">{{ $localTourBooking->email_address }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Total Children (Foreigners)</th>
                                            <td class="text-start">
                                                {{ number_format($localTourBooking->total_number_foreigner_child) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Total Adults (Foreigners)</th>
                                            <td class="text-start">
                                                {{ number_format($localTourBooking->total_number_foreigner_adult) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Total Children (Residents)</th>
                                            <td class="text-start">
                                                {{ number_format($localTourBooking->total_number_local_child) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Total Adults (Residents)</th>
                                            <td class="text-start">
                                                {{ number_format($localTourBooking->total_number_local_adult) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Pick-Up Station</th>
                                            <td class="text-start">
                                                {{ $localTourBooking->collectionStop->collection_stop_name }}
                                                <span
                                                    class="text-muted">({{ number_format($localTourBooking->collectionStop->collection_stop_price) }})</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Special Need</th>
                                            <td class="text-start">
                                                @if ($localTourBooking->special_attention == 0)
                                                    No special need included in this safari
                                                @else
                                                    {{ $localTourBooking->specialNeed->special_need_name }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Reservation Selected</th>
                                            <td class="text-start">
                                                @if ($localTourBooking->reservation_id == 0)
                                                    <span class="text-danger">No reservation was selected</span>
                                                @else
                                                    <span
                                                        class="text-success">{{ $localTourBooking->tourOperatorReservation->reservation_name }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Message</th>
                                            <td class="text-start">{{ $localTourBooking->message }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Status</th>
                                            <td class="text-start">
                                                @if ($localTourBooking->status == 1)
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-danger">Unapproved</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
