@extends('layouts.main', ['title' => __('All Reviews'), 'header' => __('All Reviews')])
@include('includes.validate_assets')
@section('content')
<div class="row" style="padding-top: 5px">
    <!-- Sidebar -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div style="display: flex">
                    <img src="{{ asset('public/TourOperatorsLogos/' . $tourOperator->company_logo) }}"
                        alt="Company Logo"
                        style="height: 70px; width: 70px; border-radius:50%;object-fit: cover;"
                        loading="lazy">
                    <h3 style="font-family: 'Lobster', cursive; font-size: 25px;color:dodgerblue">
                        {{ $tourOperator->company_name }}</h3>
                </div>
                <div style="text-align: center">
                    <p>{{ $totalLocalTouristReviews }} reviews</p>
                    <p>{{$tourOperator->about_company}}</p>
                </div>

                <a href="{{ route('tourOperator.publicView', $tourOperator->uuid) }}" class="d-flex justify-content-center btn btn-primary btn-sm mt-2">
                    View Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3>Reviews - <span class="badge badge-primary">{{ $totalLocalTouristReviews }}</span></h3>

                <div class="row">
                    @forelse($localTouristReviews as $localTouristReview)
                        <div class="col-md-6" style="margin-bottom: 30px;">
                            <div class="review-item">

                                <div style="border: 2px solid dodgerblue; padding: 15px; border-radius: 8px;">
                                    <p style="font-weight: bold; margin-bottom: 5px;">
                                        "User Travelled to <a href="{{route('touristicAttraction.show',$localTouristReview->localTourPackage->touristicAttraction->uuid)}}">{{ $localTouristReview->localTourPackage->touristicAttraction->attraction_name }}</a>"
                                    </p>
                                    <p style="margin-bottom: 15px;text-decoration:underline">{{ $localTouristReview->title_review_company }}</p>
                                    <p style="margin-bottom: 15px;"> ~ {{ $localTouristReview->review_company }}</p>
                                    <!-- Rating Display -->
                                    <div class="rating-display" style="display: flex; gap: 5px;">
                                        @php
                                            $rating = $localTouristReview->rating;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <div style="
                                                width: 15px; 
                                                height: 15px; 
                                                background-color: {{ $i <= $rating ? '#1e90ff' : '#e4e5e9' }}; 
                                                border: 1px solid #1e90ff; 
                                                border-radius: 3px;">
                                            </div>
                                        @endfor
                                    </div>
                                    <br>
                                    <p><i class="fas fa-user"></i> Reviewed By: {{$localTouristReview->localTourPackageBooking->tourist_name}}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center mt-3">
                            <img width="40" height="40" src="https://img.icons8.com/material/40/user--v1.png" alt="user--v1" />
                            <h4 style="font-weight: bold; margin-top: 10px;">Xplo Safari Book Admin</h4>
                            <div style="border: 2px solid dodgerblue; padding: 15px; border-radius: 8px; margin-top: 15px;">
                                <p>This tour operator has not yet received any reviews. However, we are confident in the quality of 
                                their services. You can always choose their company for your trip. Once you are finished, a link 
                                will be sent to you automatically or manually. Please support this tour operator by being the 
                                first to leave a review. We appreciate both positive and negative feedback; just share your 
                                honest opinion.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="pagination text-end mt-3">
                    {{ $localTouristReviews->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
