@extends('layouts.main', ['title' => __("Tourist Review " . \App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings::find($localTouristReview->local_tour_booking_id)->tourist_name), 'header' => __('Tourist Review ' . \App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings::find($localTouristReview->local_tour_booking_id)->tourist_name)])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">

                            <tr>
                                <th>Review Posted date & time</th>
                                <td>{{date('jS M Y H:i a',strtotime($localTouristReview->created_at))}}</td>
                            </tr>
                            <tr>
                                <th>Review Message</th>
                                <td>{{$localTouristReview->review_company}}</td>
                            </tr>
                            <tr>
                                <th>Review Message</th>
                                <td>{{$localTouristReview->review_attraction}}</td>
                            </tr>
                            <tr>
                                <th>Review rating</th>
                                <td>{{$localTouristReview->rating}}</td>
                            </tr>
                            <tr>
                                <th>Review Status</th>
                                <td>
                                    @if($localTouristReview->status==0)
                                        <span class="badge badge-danger">Unapproved</span>
                                    @elseif($localTouristReview->status==1)
                                        <span class="badge badge-success">Approved + Public</span>
                                    @else
                                        <span class="badge badge-danger">Error</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


