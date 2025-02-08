@extends('layouts.main', ['title' => __("Trip detail"), 'header' => __('Trip detail')])
@include('includes.validate_assets')
@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85)">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{asset('public/blogImages/'.$tourPackage->safari_poster)}}"
                                   target="_blank"><img
                                        src="{{asset('public/blogImages/'.$tourPackage->safari_poster)}}"
                                        style="width:100%;height:auto;filter: contrast(120%)"></a>
                                <div class="bottom-left">
                                    <p style="color: whitesmoke;font-size: 15px">{{$tourPackage->safari_package_description}}</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div style="text-align: center">
                                    <a href="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}"
                                       target="_blank"><img
                                            src="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}"
                                            style="width:70px;height:70px;border-radius: 50%;margin-top:-30px"></a>
                                    <p style="font-size: 14px">Experience the extraordinary with our enchanting tour
                                        package. Prepare to be captivated by the awe-inspiring beauty of <b
                                            style="color: dodgerblue">{{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_name}}</b>
                                        and other listed trips below. Immerse yourself in its breathtaking landscapes,
                                        indulge in thrilling adventures, and create cherished memories. <b
                                            style="color: dodgerblue">{{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_name}}</b>
                                        beckons you to discover its hidden treasures and cultural marvels. Unforgettable
                                        moments await, embrace the magic and let your dreams unfold</p>
                                    <a href="{{route('tourPackageBookings.create',$tourPackage->uuid)}}"
                                       class="btn btn-primary btn-sm" style="margin: 5px 5px 5px 5px">Request space
                                        to {{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_name}}
                                        Safari Package&blacktriangleright;</a>
                                    <a href="{{route('tourOperator.publicView',$tourPackage->tourOperator->uuid)}}"
                                       class="btn btn-primary btn-sm" style="margin: 5px 5px 5px 5px">See more offered by
                                        {{$tourPackage->tourOperator->company_name}}&blacktriangleright;</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8" style="padding-top: 20px">
                                <div style="border: 2px solid gainsboro">
                                    <p class="card-title" style="margin: 10px 10px 10px 10px;font-size: 17px"> Trip hierarchy</p>
                                    <div>
                                        @if(!empty($tourPackageTrips) && $tourPackageTrips->count())
                                            @foreach($tourPackageTrips as $tourPackageTrip)
                                                <div>
                                                    <p style="font-size: 14px" class="card-text"><strong
                                                            style="color: dodgerblue">Day {{$tourPackageTrip->day_number}}</strong>
                                                        - {{$tourPackageTrip->safari_trip_name}}</p>
                                                </div>
                                                <p style="font-size: 14px"
                                                   class="card-text">{{$tourPackageTrip->safari_trip_description}}</p>

                                            @endforeach
                                        @else
                                            <span class="text-danger">No trip hierarchy included!</span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="card-title" style="margin: 10px 10px 10px 10px;font-size: 17px"> Tour types</p>
                                        <p style="font-size: 14px"
                                           class="card-text">{{$tourPackage->TourPackagesTourTypesLabel}}</p>
                                    </div>
                                    <div>
                                        <p class="card-title" style="margin: 10px 10px 10px 10px;font-size: 17px"> Transports</p>
                                        <p style="font-size: 14px"
                                           class="card-text">{{$tourPackage->TourPackageTransportLabel}}</p>
                                    </div>
                                    <div>
                                        <p class="card-title" style="margin: 10px 10px 10px 10px;font-size: 17px"> Special needs
                                            supported</p>
                                        <p style="font-size: 14px"
                                           class="card-text">{{$tourPackage->TourPackageSpecialNeedCategoryLabel}}</p>
                                    </div>
                                    <div>
                                        <p class="card-title" style="margin: 10px 10px 10px 10px;font-size: 17px">Package
                                            features</p>
                                        @if(!empty($tourPackageFeatures) && $tourPackageFeatures->count())
                                            @foreach($tourPackageFeatures as $tourPackageFeature)
                                                <div>
                                                    <p style="font-size: 16px" class="card-text"><strong
                                                            style="color: dodgerblue"> {{$tourPackageFeature->feature_name}} </strong>
                                                    </p>
                                                </div>
                                                <p style="font-size: 14px"
                                                   class="card-text"> {{$tourPackageFeature->feature_description}}</p>

                                            @endforeach
                                        @else
                                            <span>No features available!</span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="card-title" style="margin: 10px 10px 10px 10px;font-size: 17px">
                                            Activities</p>
                                        @if(!empty($tourPackageActivities) && $tourPackageActivities->count())
                                            @foreach($tourPackageActivities as $tourPackageActivity)
                                                <div>
                                                    <p style="font-size: 16px" class="card-text"><strong
                                                            style="color: dodgerblue"> {{$tourPackageActivity->activity_name}}</strong>
                                                    </p>
                                                </div>
                                                <p style="font-size: 14px"
                                                   class="card-text">{{$tourPackageActivity->activity_description}}</p>

                                            @endforeach
                                        @else
                                            <span>No activities listed! </span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="card-title" style="margin: 10px 10px 10px 10px;font-size: 17px">
                                            Accommodations</p>
                                        @if(!empty($tourPackageAccommodations) && $tourPackageAccommodations->count())
                                            @foreach($tourPackageAccommodations as $tourPackageAccommodation)
                                                <div>
                                                    <p style="font-size: 14px" class="card-text"><strong
                                                            style="color: dodgerblue">
                                                            Day {{$tourPackageAccommodation->day_number}}</strong> - <a
                                                            href="{{$tourPackageAccommodation->accommodation_link}}"
                                                            target="_blank"
                                                            style="text-decoration: underline;color: darkred">{{$tourPackageAccommodation->accommodation_name}}</a>
                                                    </p>
                                                </div>
                                                <p style="font-size: 14px"
                                                   class="card-text">{{$tourPackageAccommodation->accommodation_description}}</p>
                                            @endforeach
                                        @else
                                            <span>No accommodations listed!</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 20px">
                                <div style="text-align: center;border: 2px solid gainsboro;margin-bottom: 5px">
                                    <a href="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}"><img
                                            src="{{asset('public/TourOperatorsLogos/'.$tourPackage->tourOperator->company_logo)}}"
                                            style="width:70px;height:70px;border-radius: 50%"></a>
                                    <h4 style="padding-left: 20px;color: dodgerblue">{{$tourPackage->tourOperator->company_name}}</h4>
                                    <p>Offices In
                                        - {{\App\Models\Nations\nations::find($tourPackage->tourOperator->company_nation)->nation_name}}
                                        <img
                                            src="{{asset('public/nationFlags/'.\App\Models\Nations\nations::find($tourPackage->tourOperator->company_nation)->nation_flag)}}"
                                            style="width:20px;height:20px"></p>
                                    @if($tourPackage->tourOperator->status=1)
                                        <p>Status - <b style="color:dodgerblue"> Verified</b></p>
                                    @else
                                        <i class="">Unverified</i>
                                    @endif
                                    <a href="{{route('tourOperator.publicView',$tourPackage->tourOperator->uuid)}}"
                                       class="btn btn-primary btn-sm"
                                       style="position:relative;text-align: center;bottom: 10px">Learn More
                                        &blacktriangleright;</a>
                                </div>

                                <div style="text-align: center;border: 2px solid gainsboro;margin-bottom: 5px">
                                    <div style="display: flex;padding-left: 30%">
                                    <p style="font-size: 14px">Reviews</p>
                                    <p>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </p>
                                    </div>

                                    <a href="#"
                                       class="btn btn-primary btn-sm"
                                       style="position:relative;text-align: center;bottom: 10px">See all reviews
                                        &blacktriangleright;</a>
                                </div>
                                <div style="text-align: center;border: 2px solid gainsboro;margin-bottom: 5px">
                                    <p style="font-size: 14px">Adult Foreigner: <b
                                            style="color: dodgerblue">$ {{number_format($tourPackage->trip_price_adult_foreigner)}}
                                            pp </b></p>
                                    <p style="font-size: 14px">Child Foreigner: <b
                                            style="color: dodgerblue">Tzs {{number_format($tourPackage->trip_price_child_foreigner)}}
                                            pp </b></p>
                                    <p style="font-size: 14px"> Start date ~ <b
                                            style="color: dodgerblue">{{date('jS M Y',strtotime($tourPackage->safari_start_date))}}</b>
                                    </p>
                                    <p style="font-size: 14px;"> End date~ <b
                                            style="color:dodgerblue">{{date('jS M Y',strtotime($tourPackage->safari_end_date))}}</b>
                                    </p>

                                    <a href="{{route('tourPackageBookings.create',$tourPackage->uuid)}}"
                                       class="btn btn-primary btn-sm"
                                       style="position:relative;text-align: center;bottom: 10px">Request Space
                                        &blacktriangleright;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row" style="margin-top: 5px">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="background-color: rgba(255,255,255,0.85);color:black">
                                <p style="font-size: 20px">Interested in This Tour?</p>
                                <a href="{{route('tourPackageBookings.create',$tourPackage->uuid)}}"
                                   class="btn btn-primary btn-sm">Request space &blacktriangleright;</a>
                                <p style="padding-top:8px"> &blacktriangleright; Requests are sent directly to the tour
                                    operator</p>
                                <p> &blacktriangleright; If preferred, you can <a
                                        href="{{route('tourOperator.publicView',$tourPackage->tourOperator->uuid)}}"
                                        title="{{$tourPackage->tourOperator->company_name}},{{$tourPackage->tourOperator->phone_number}}, {{$tourPackage->tourOperator->email_address}}">contact</a>
                                    the tour operator directly</p>
                                <br>
                                <p style="font-size:14px"><b>Disclaimer</b></p>
                                <p>&blacktriangleright; This tour is offered by <a
                                        href="{{route('tourOperator.publicView',$tourPackage->tourOperator->uuid)}}">{{$tourPackage->tourOperator->company_name}} </a>,
                                    not Expedition & Exploration Innovations.</p>
                                <p>&blacktriangleright; This tour is subject to the <a
                                        href="{{asset('public/companyTermsAndConditions/'.$tourPackage->tourOperator->terms_and_conditions)}}"
                                        target="_blank">terms & conditions</a>
                                    of {{$tourPackage->tourOperator->company_name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection


