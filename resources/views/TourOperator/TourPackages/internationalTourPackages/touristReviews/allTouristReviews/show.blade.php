@extends('layouts.main', ['title' => __("All Tourist Reviews"), 'header' => __('All Tourist Reviews')])
@include('includes.validate_assets')
@section('content')

    <div class="col-md-12">
        <div class="row" style="padding-top: 5px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p style="font-size: 18px">Reviews ~ <span
                                    class="badge badge-primary">{{$totalTouristReviews}}</span></p>
                        @if(!empty($touristReviews) && $touristReviews->count())
                            @foreach($touristReviews as $touristReview)
                                <div style="padding-top: 10px">
                                    <div style="display: flex">
                                        <img src="{{url('/public/HomeImages/avatar.png')}}"
                                             style="width:40px;height: 40px;">
                                        <p style="padding-left: 20px;padding-top:5px;font-size: 15px">
                                            <strong>{{\App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookings::find($touristReview->tour_package_booking_id)->tourist_name}}</strong>
                                        </p>
                                    </div>
                                    <p>Reviewed by: {{$touristReview->tourist_name}} (Safari companion
                                        of {{\App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookings::find($touristReview->tour_package_booking_id)->tourist_name}}
                                        )</p>
                                    <div class="container" style="border: 1px solid dodgerblue">
                                        <p style="font-size: 20px">"{{$touristReview->review_title}}"</p>
                                        <p>{{$touristReview->review_message}}</p>
                                        <p> Booked Trip: <strong
                                                    style="color: dodgerblue"> {{\App\Models\TouristicAttractions\touristicAttractions::find(\App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookings::find($touristReview->tour_package_booking_id)->tour_package_id)->attraction_name}}
                                                Package</strong></p>
                                        <p> Reviewed: <strong
                                                    style="color: dodgerblue"> {{date('jS M Y',strtotime($touristReview->created_at))}}</strong>
                                        </p>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span>No Comments Available</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


