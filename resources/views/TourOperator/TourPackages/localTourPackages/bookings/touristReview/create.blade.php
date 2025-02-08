@extends('layouts.main', ['title' => 'Review form special for ' . $localTourBooking->tourist_name, 'header' => __('Review form special for ' . $localTourBooking->tourist_name)])

@include('includes.validate_assets')
@section('content')

{{ Form::open(['route'=>'localTouristReview.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
@csrf
<section>
    <div class="row" style="margin: auto">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        @if(Auth::user()->role == 2)
                            <p class="text-info" style="border: 2px solid red">&blacktriangleright; You are viewing
                                as <u>{{$localTourBooking->tourOperator->company_name}}</u>. Kindly be informed
                                that you are not authorized to fill out this form; only validation of its
                                destination is permitted</p>
                        @endif
                        <p>&blacktriangleright; You are now reviewing <span
                                style="color: dodgerblue">{{$localTourBooking->tourOperator->company_name}}</span>
                            on the main safari to <span
                                style="color: dodgerblue">{{\App\Models\TouristicAttractions\touristicAttractions::find((\App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages::find($localTourBooking->local_tour_package_id)->safari_name))->attraction_name}}</span>
                            you booked and travelled on <span
                                style="color: dodgerblue">{{date(' D jS M Y', strtotime(\App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages::find($localTourBooking->local_tour_package_id)->safari_start_date))}}</span>
                            to <span
                                style="color: dodgerblue">{{date(' D jS M Y', strtotime(\App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages::find($localTourBooking->local_tour_package_id)->safari_end_date))}}</span>
                            as <span style="color: dodgerblue">{{$localTourBooking->tourist_name}}</span>. If it wasnt you, we are sorry for the inconvenience.</p>
                        <p>&blacktriangleright;You are the representative of others who traveled with you. Please share on a collective experience basis
                        </p>
                        <p>&blacktriangleright; Please read our community guideline on reviewing <a
                                href="#">here</a> before you make a review</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Star Rating Section -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="background-color: rgba(255,255,255,0.85); margin-top: 3px">
                    <div class="col-md-12">
                        <p class="text-info"><strong>Rate the Overall Experience</strong></p>
                        <div class="star-rating">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required />
                                <label for="star{{ $i }}" title="{{ $i }} stars">&#9733;</label>
                            @endfor
                            {!! $errors->first('rating', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Existing Review Fields -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="background-color: rgba(255,255,255,0.85); margin-top: 3px">
                    <!-- Existing review_company and review_attraction fields -->
                    <div class="form-group">
                        {{ Form::label('title_review_company', __("Title for company review"), ['class' => 'required_asterik']) }}
                        {{ Form::text('title_review_company', null, ['class' => 'form-control', 'autocomplete' => 'off','maxLength'=>'100', 'id' => 'title_review_company', 'required']) }}
                        {!! $errors->first('title_review_company', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('review_company', __("Review Company Service (max 500 characters)"), ['class' => 'required_asterik']) }}
                        {{ Form::textarea('review_company', null, ['class' => 'form-control', 'maxlength' => '500', 'style' => 'height:150px', 'autocomplete' => 'off', 'id' => 'review_company', 'required']) }}
                        {!! $errors->first('review_company', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('title_review_attraction', __("Title for attraction review"), ['class' => 'required_asterik']) }}
                        {{ Form::text('title_review_attraction', null, ['class' => 'form-control', 'autocomplete' => 'off', 'maxLength'=>'100','id' => 'title_review_attraction', 'required']) }}
                        {!! $errors->first('title_review_attraction', '<span class="badge badge-danger">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label('review_attraction', __("Review Attraction (max 500 characters)"), ['class' => 'required_asterik']) }}
                        {{ Form::textarea('review_attraction', null, ['class' => 'form-control', 'maxlength' => '500', 'style' => 'height:150px', 'autocomplete' => 'off', 'id' => 'review_attraction', 'required']) }}
                        {!! $errors->first('review_attraction', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                    
                   
                </div>
            </div>
        </div>
        <input class="hidden" name="tour_operator_id" value="{{$localTourBooking->tourOperator->id}}">
        <input class="hidden" name="local_tour_package_id" value="{{$localTourBooking->localTourPackages->id}}">
        <input class="hidden" name="local_tour_booking_id" value="{{$localTourBooking->id}}">

        <!-- Submit Section -->
        <div class="col-md-12">
            @if(Auth::user()->role == 3 && $localTourBooking->TotalLocalTouristReviewsLabel <= 0)

            <div class="card">
                <div class="card-body">
                    <div class="element-form">
                        <div class="form-group pull-left">
                            {{ Form::button(trans('Submit Review'), ['class' => 'btn btn-primary', 'type' => 'submit', 'style' => 'border-radius: 5px;']) }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
{{ Form::close() }}
@endsection

@push('after-scripts')
<!-- Additional CSS for Star Rating -->
<style>
    .star-rating {
        direction: rtl;
        display: inline-flex;
        font-size: 1.5rem;
    }
    .star-rating input[type="radio"] {
        display: none;
    }
    .star-rating label {
        color: #ccc;
        cursor: pointer;
        padding: 0 5px;
    }
    .star-rating input[type="radio"]:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
</style>

<!-- jQuery to enable select2 and star rating interaction -->
<script>
    $(function () {
        $(".select2").select2();

        // Optionally, you could add JavaScript to highlight selected stars
        $('.star-rating input[type="radio"]').change(function() {
            let rating = $(this).val();
            console.log("Selected Rating: ", rating);
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('form').addEventListener('submit', function(event) {
        if (!document.querySelector('input[name="rating"]:checked')) {
            event.preventDefault();
            alert("Please select a star rating.");
        }
    });
});
</script>
@endpush
