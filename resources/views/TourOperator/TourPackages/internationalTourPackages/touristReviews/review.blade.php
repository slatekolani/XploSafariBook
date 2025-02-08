@extends('layouts.main', ['title' => 'Review Form', 'header' => __('Review Form')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['route'=>'touristReview.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
    @csrf
    <section>

        <div class="row" style="margin: auto">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            @auth
                                <p class="text-info" style="border: 2px solid red">&blacktriangleright; You are viewing
                                    as <u>{{$tourPackageBooking->tourOperator->company_name}}</u>. Kindly be informed
                                    that you are not authorized to fill out this form; only validation of its
                                    destination is permitted</p>
                            @endauth
                            <p>&blacktriangleright; You are now reviewing <span
                                        style="color: dodgerblue">{{$tourPackageBooking->tourOperator->company_name}}</span>
                                on the main safari to <span
                                        style="color: dodgerblue">{{\App\Models\TouristicAttractions\touristicAttractions::find((\App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages::find($tourPackageBooking->tour_package_id)->main_safari_name))->attraction_name}}</span>
                                you booked and travelled on <span
                                        style="color: dodgerblue">{{date(' D jS M Y', strtotime(\App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages::find($tourPackageBooking->tour_package_id)->safari_start_date))}}</span>
                                to <span
                                        style="color: dodgerblue">{{date(' D jS M Y', strtotime(\App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages::find($tourPackageBooking->tour_package_id)->safari_end_date))}}</span>
                                as <span style="color: dodgerblue">{{$tourPackageBooking->tourist_name}}</span>. If it wasnt you, we are sorry for the inconvenience.</p>
                            <p>&blacktriangleright;You are the representative of others who traveled with you. Please share on a collective experience basis
                            </p>
                            <p>&blacktriangleright; Please read our community guideline on reviewing <a
                                        href="#">here</a> before you make a review</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85);margin-top: 3px">
                        <div class="col-md-12">
                            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tourist_name', __("Tourist name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('tourist_name',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tourist_name', 'required']) }}
                                        {!! $errors->first('tourist_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('review_title', __("Review Title"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('review_title',null, ['class' => 'form-control','maxLength'=>'100', 'autocomplete' => 'off', 'id' => 'review_title', 'required']) }}
                                        {!! $errors->first('review_title', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('review_message', __("Review Message"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('review_message',null, ['class' => 'form-control','maxLength'=>'500', 'autocomplete' => 'off', 'id' => 'review_message', 'required']) }}
                                        {!! $errors->first('review_message', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    @guest
                                        <p>By clicking the 'Submit Review' button you agree to our <a href="#">Terms of
                                                Use</a> and <a href="#">Privacy Policy</a></p>
                                    @endguest
                                    <input name="tour_package_booking_id" value="{{$tourPackageBooking->id}}" hidden>
                                    <input name="tour_operator_id" value="{{$tourPackageBooking->tourOperator->id}}"
                                           hidden>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            @guest
                                                @if($tourPackageBooking->CheckedNumberOfReviewsPerBookingLabel===0)
                                                {{ Form::button(trans('Submit Review'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
                                                @else
                                                    <btn onclick="alert('This action is no longer available; a review has already been submitted.')" class="btn btn-primary btn-sm">Submit Review</btn>
                                                @endif
                                            @endguest
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br/>

    {{ Form::close() }}
@endsection
@push('after-scripts')

    <script>
        $(function () {
            $(".select2").select2();


        });

    </script>
@endpush

