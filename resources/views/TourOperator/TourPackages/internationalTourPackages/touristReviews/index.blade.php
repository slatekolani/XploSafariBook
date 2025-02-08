@extends('layouts.main', ['title' =>'Reviews', 'header' => __('Reviews')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')
    <div class="row">
        <div id="notify" style="display: none"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <span class="badge badge-info" style="font-size: 15px">Alert:</span>
                    <p>&blacktriangleright;At the end of the tour date, this link is automatically sent to the tourist
                        via their email. The link below is intended for manual use, allowing you to personally share it
                        with your customer. Please remember, each booking can only have one comment!</p>
                    <p>&blacktriangleright;Only administrators can activate and deactivate reviews, as well as delete
                        and restore reviews</p>
                    <p>&blacktriangleright; The review is submitted by an individual who booked a safari. Although there
                        are many participants, one representative is sufficient to convey the collective feedback </p>
                    <div class="d-flex align-items-center">
                            <span class="mr-2">
                                <a href="{{ route('touristReview.reviewTourOperator', $tourPackageBooking->uuid) }}"
                                   class="text-primary" style="font-size: 15px; text-decoration: none;">
                                    {{ route('touristReview.reviewTourOperator', $tourPackageBooking->uuid) }}
                                </a>
                            </span>

                        <button class="btn btn-sm btn-primary copy-link-btn"
                                data-clipboard-text="{{ route('touristReview.reviewTourOperator', $tourPackageBooking->uuid) }}">
                            Copy Link
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 10px">
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('touristReview.index',$tourPackageBooking->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Total Reviews') }} ~
                            <badge class="badge badge-primary"
                                   style="font-size: 14px">{{$tourPackageBooking->TotalTouristReviewsLabel}}</badge>
                        </h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('touristReview.approvedTouristReviewsIndex',$tourPackageBooking->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                    class="fas fa-clipboard"></i> {{ __('Approved Reviews') }} ~
                            <badge class="badge badge-success"
                                   style="font-size: 14px">{{$tourPackageBooking->TotalApprovedTouristReviewsLabel}}</badge>
                        </h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('touristReview.unApprovedTouristReviewIndex',$tourPackageBooking->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                    class="fas fa-clipboard"></i> {{ __('Un Approved Reviews') }} ~
                            <badge class="badge badge-danger"
                                   style="font-size: 14px"> {{$tourPackageBooking->TotalUnApprovedTouristReviewsLabel}}</badge>
                        </h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('touristReview.deletedTouristReviewIndex',$tourPackageBooking->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Deleted Reviews') }}
                            ~
                            <badge class="badge badge-danger"
                                   style="font-size: 14px">{{$tourPackageBooking->TotalDeletedTouristReviewsLabel}}</badge>
                        </h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>
    </div>
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:180%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.TourPackages.internationalTourPackages.touristReviews.get_tourist_reviews')
            </section>
        </div>

    </div>

@endsection
@push('after-scripts')
    <script>
        const clipboard = new ClipboardJS('.copy-link-btn');

        clipboard.on('success', function (e) {
            alert('Link copied to clipboard!');
        });

        clipboard.on('error', function (e) {
            alert('Failed to copy link. Please manually copy it.');
        });
    </script>
@endpush

