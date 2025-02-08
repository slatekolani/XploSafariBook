@extends('layouts.main', ['title' => __("Tanzania"), 'header' => __('Tanzania')])
@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}

    <style>
         .heading {
        display: none;
    }

    .nav-container {
        position: relative;
        margin-bottom: 2rem;
        background: dodgerblue;
        z-index: 100;
    }

    .nav-container.sticky {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        padding: 0.5rem 2rem;
        background: dodgerblue;
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .nav-pills {
        border: none;
        display: flex;
        gap: 0.5rem;
        padding: 0.5rem;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .nav-pills::-webkit-scrollbar {
        display: none;
    }

    .nav-pills .nav-item {
        margin: 0;
    }

    .nav-pills .nav-link {
        border: none;
        color: #64748b;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
        border-radius: 8px;
        white-space: nowrap;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link:hover {
        color: white;
        background: rgba(30, 144, 255, 0.1);
    }

    .nav-pills .nav-link.active {
        color: white;
        background: dodgerblue;
    }

    .scroll-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        background: white;
        border: none;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .scroll-button:hover {
        background: #f8f9fa;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .scroll-button.left { left: 0.5rem; }
    .scroll-button.right { right: 0.5rem; }

    .tab-content {
        padding: 1rem;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @media (max-width: 768px) {
        .nav-container.sticky {
            padding: 0.5rem 1rem;
        }
        
        .nav-pills .nav-link {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
    </style>
@endpush

@section('content')

        <div class="card" style="margin-top: 30px">
            <div class="card-body">
                <h3 style="text-align: center;color:dodgerblue;font-size:30px">
                     {{$nation->nation_name}}
                </h3>
                <p style="text-align: center">{{$nation->nation_description}}</p>
                <div class="nav-container" id="stickyNav">
                    <button class="scroll-button left" onclick="scrollTabs('left')">&lt;</button>
                    <button class="scroll-button right" onclick="scrollTabs('right')">&gt;</button>
                    <ul class="nav nav-pills flex-nowrap" style="width: auto" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="pills-regions-tab" data-toggle="pill" href="#pills-regions" role="tab" aria-controls="pills-regions" aria-selected="false"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Regions</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-touristAttraction-tab" data-toggle="pill" href="#pills-touristAttraction" role="tab" aria-controls="pills-touristAttraction" aria-selected="false"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Attractions</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Cultures</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-economicActivity-tab" data-toggle="pill" href="#pills-economicActivity" role="tab" aria-controls="pills-economicActivity" aria-selected="false"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Economic activities</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-necessaryPrecautions-tab" data-toggle="pill" href="#pills-necessaryPrecautions" role="tab" aria-controls="pills-necessaryPrecautions" aria-selected="false"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Precautions</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-insuranceTypes-tab" data-toggle="pill" href="#pills-insuranceTypes" role="tab" aria-controls="pills-insuranceTypes" aria-selected="false"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Insurances</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-customerExperience-tab" data-toggle="pill" href="#pills-customerExperience" role="tab" aria-controls="pills-customerExperience" aria-selected="false"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Customer experience</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-tourAdvice-tab" data-toggle="pill" href="#pills-tourAdvice" role="tab" aria-controls="pills-tourAdvice" aria-selected="false"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Tour advice</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-touristMap-tab" data-toggle="pill" href="#pills-touristMap" role="tab" aria-controls="pills-touristMap" aria-selected="true"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Tourist map</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-FAQ-tab" data-toggle="pill" href="#pills-FAQ" role="tab" aria-controls="pills-FAQ" aria-selected="true"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">FAQ's</button></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-tourReservations-tab" data-toggle="pill" href="#pills-tourReservations" role="tab" aria-controls="pills-tourReservations" aria-selected="true"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Tour reservations</button></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-touristicGames-tab" data-toggle="pill" href="#pills-touristicGames" role="tab" aria-controls="pills-touristicGames" aria-selected="true"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Touristic games</button></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-events-tab" data-toggle="pill" href="#pills-events" role="tab" aria-controls="pills-events" aria-selected="true"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Tanzania events</button></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-tourTypes-tab" data-toggle="pill" href="#pills-tourTypes" role="tab" aria-controls="pills-tourTypes" aria-selected="true"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Tour types</button></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-tourPackageTypes-tab" data-toggle="pill" href="#pills-tourPackageTypes" role="tab" aria-controls="pills-tourPackageTypes" aria-selected="true"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Tour package types</button></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery" role="tab" aria-controls="pills-gallery" aria-selected="true"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;color:white">Gallery</button></a>
                    </li>

                </ul>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <!--                   Regions section-->
                    <div class="tab-pane fade show active" id="pills-regions" role="tabpanel" aria-labelledby="pills-regions-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-allRegions-tab" data-toggle="tab" href="#nav-allRegions" role="tab" aria-controls="nav-allRegions" aria-selected="true">Regions</a>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            @include('AboutTanzania.tanzaniaRegions.allRegions.allRegions')
                        </div>
                    </div>
<!--                   End region section -->
<!--                   Attraction section-->
                    <div class="tab-pane fade" id="pills-touristAttraction" role="tabpanel" aria-labelledby="pills-touristAttraction-tab">
                        <div class="nav-container">
                            <ul class="nav nav-tabs flex-nowrap" id="nav-tab" role="tablist">
                                    @forelse($touristicAttractionCategories as $touristicAttractionCategory)
                                    <li class="nav-item">
                                        <a href="{{route('localTourPackage.localSafariAttractionCategory',$touristicAttractionCategory->uuid)}}"><button class="btn btn-outline-primary" style="border-radius: 20px; border-color: gainsboro;">{{$touristicAttractionCategory->attraction_category}}</button></a>
                                    </li>
                                    @empty
                                    @endforelse
                            </ul>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        @forelse($touristicAttractions as $touristicAttraction)
                                            <div class="col-md-4" style="margin-top: 15px">
                                                <a href="{{ route('touristicAttraction.show', $touristicAttraction->uuid) }}" style="text-decoration: none; position: relative; display: block;">
                                                    <div class="card h-100 border-primary card-with-gradient">
                                                        <div id="AttractionsIndicators" class="carousel slide" data-ride="carousel">
                                                            <ol class="carousel-indicators">
                                                                @forelse(explode(',', $touristicAttraction->attraction_image) as $index => $image)
                                                                    <li data-target="#AttractionsIndicators" data-slide-to="{{ $index }}" @if($index === 0) class="active" @endif></li>
                                                                @empty
                                                                    <p>No image found!</p>
                                                                @endforelse
                                                            </ol>
                                                            <div class="carousel-inner">
                                                                @forelse(explode(',', $touristicAttraction->attraction_image) as $index => $image)
                                                                    <div class="carousel-item @if($index === 0) active @endif">
                                                                        <img src="{{ asset('public/'.$image) }}" style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%);" loading="lazy">
                                                                    </div>
                                                                @empty
                                                                    <p>No image found!</p>
                                                                @endforelse
                                                            </div>
                                                        </div>

                                                        <div class="card-img-overlay">
                                                            <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                                {{$touristicAttraction->attraction_name}}<br>
                                                                <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$touristicAttraction->attraction_description}}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @empty
                                            <p>Whoops! No Tanzanian attraction has been published yet. Our personnel are working on it</P>
                                        @endforelse
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-right mt-3">
                                                <a href="{{ route('Tanzania.show',$nation->uuid) }}" class="btn btn-primary btn-sm">
                                                    Discover More of Tanzania <span class="ml-1">&#9654;</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
<!--                   End attractions -->

{{--                    Culture section--}}
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-cultures-tab" data-toggle="tab" href="#nav-cultures" role="tab" aria-controls="nav-cultures" aria-selected="true">Tanzania culture</a>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            @include('AboutTanzania.tanzaniaRegions.cultures.allCultures')
                        </div>
                    </div>
{{--                    End culture section--}}


{{--                    Economic activity section--}}
                    <div class="tab-pane fade show" id="pills-economicActivity" role="tabpanel" aria-labelledby="pills-economicActivity-tab">
                        @forelse($nationEconomicActivities as $nationEconomicActivity)
                            <div class="panel panel-default" style="border: 2px solid #ddd; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="panel-heading" style="background-color: #f8f9fa; padding: 10px; border-bottom: 1px solid #ddd; border-radius: 8px 8px 0 0;">
                                    <div class="panel-title">
                                        <h5 style="font-weight: bold; color: #007bff;">&star;{{$nationEconomicActivity->economic_activity_title}}</h5>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 15px;">
                                    <p style="font-size: 16px; line-height: 1.5; color: #555;">{{$nationEconomicActivity->economic_activity_description}}</p>
                                </div>
                            </div>
                        @empty
                            <p>Whoops! No economic activity has been published yet. Please wait while our personnel work on it</p>
                        @endforelse
                    </div>
{{--                    End Economic activity section--}}

                    {{--                    Necessary precautions section--}}
                    <div class="tab-pane fade show" id="pills-necessaryPrecautions" role="tabpanel" aria-labelledby="pills-necessaryPrecautions-tab">
                        @forelse($nationNecessaryPrecautions as $nationNecessaryPrecaution)
                            <div class="panel panel-default" style="border: 2px solid #ddd; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="panel-heading" style="background-color: #f8f9fa; padding: 10px; border-bottom: 1px solid #ddd; border-radius: 8px 8px 0 0;">
                                    <div class="panel-title">
                                        <h5 style="font-weight: bold; color: #007bff;">&star;{{$nationNecessaryPrecaution->precaution_title}}</h5>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 15px;">
                                    <p style="font-size: 16px; line-height: 1.5; color: #555;">{{$nationNecessaryPrecaution->precaution_description}}</p>
                                </div>
                            </div>

                        @empty
                            <p>Whoops! No necessary precaution has been published yet. Please wait while our personnel work on it</p>
                        @endforelse
                    </div>
{{--                    End Necessary precautions section--}}
{{--                    Insurance types section--}}
                    <div class="tab-pane fade show" id="pills-insuranceTypes" role="tabpanel" aria-labelledby="pills-insuranceTypes-tab">
                        @forelse($insuranceTypes as $insuranceType)
                            <div class="panel panel-default" style="border: 2px solid #ddd; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="panel-heading" style="background-color: #f8f9fa; padding: 10px; border-bottom: 1px solid #ddd; border-radius: 8px 8px 0 0;">
                                    <div class="panel-title">
                                        <h5 style="font-weight: bold; color: #007bff;">&star;{{$insuranceType->tour_insurance_name}}</h5>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 15px;">
                                    <p style="font-size: 16px; line-height: 1.5; color: #555;">{{$insuranceType->tour_insurance_description}}</p>
                                    <a href="{{route('tourInsuranceType.spotTourOperator',$insuranceType->uuid)}}" class="btn btn-primary btn-sm" style="font-weight: bold;">
                                        Explore Tour Operators &blacktriangleright;
                                    </a>
                                </div>
                            </div>


                        @empty
                            <p>Whoops! No insurance has been published yet. Please wait while our personnel work on it</p>
                        @endforelse
                    </div>
{{--                    End insurance types section--}}

{{--                    customer satisfaction categories section--}}
                    <div class="tab-pane fade show" id="pills-customerExperience" role="tabpanel" aria-labelledby="pills-customerExperience-tab">
                        @forelse($customerSatisfactionCategories as $customerSatisfactionCategory)
                            <div class="panel panel-default" style="border: 2px solid #ddd; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="panel-heading" style="background-color: #f8f9fa; padding: 10px; border-bottom: 1px solid #ddd; border-radius: 8px 8px 0 0;">
                                    <div class="panel-title">
                                        <h5 style="font-weight: bold; color: #007bff;">&star;{{$customerSatisfactionCategory->customer_satisfaction_name}}</h5>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 15px;">
                                    <p style="font-size: 16px; line-height: 1.5; color: #555;">{{$customerSatisfactionCategory->customer_satisfaction_description}}</p>
                                    <a href="{{route('customerSatisfactionCategory.spotLocalSafaris',$customerSatisfactionCategory->uuid)}}" class="btn btn-primary btn-sm" style="font-weight: bold;">
                                        Explore Local Safaris &blacktriangleright;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p>Whoops! No customer experience has been published yet. Please wait while our personnel work on it</p>
                        @endforelse
                    </div>
{{--                    End customer satisfaction categories section--}}

                    {{--                    Tour advice section--}}
                    <div class="tab-pane fade show" id="pills-tourAdvice" role="tabpanel" aria-labelledby="pills-tourAdvice-tab">
                        @forelse($tourVisitAdvices as $tourVisitAdvice)
                            <div class="panel panel-default" style="border: 2px solid #ddd; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="panel-heading" style="background-color: #f8f9fa; padding: 10px; border-bottom: 1px solid #ddd; border-radius: 8px 8px 0 0;">
                                    <div class="panel-title">
                                        <h5 style="font-weight: bold; color: #007bff;">&star;{{$tourVisitAdvice->advice_title}}</h5>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 15px;">
                                    <p style="font-size: 16px; line-height: 1.5; color: #555;">{{$tourVisitAdvice->advice_description}}</p>
                                    <a href="{{$tourVisitAdvice->directory_url}}" class="btn btn-primary btn-sm" style="font-weight: bold;">
                                        Follow advice &blacktriangleright;
                                    </a>
                                </div>
                            </div>

                        @empty
                            <p>Whoops! No advice has been published yet. Please wait while our personnel work on it</p>
                        @endforelse
                    </div>
{{--                    End Tour advice section--}}

                    {{--                    Tourist map section--}}
                    <div class="tab-pane fade show" id="pills-touristMap" role="tabpanel" aria-labelledby="pills-touristMap-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{url('public/touristMap/1704382454.jpg')}}" style="width: 100%;height:100%">
                            </div>
                        </div>
                    </div>
                    {{--                    End tourist map section--}}

                   

                    {{--                    FAQ  section--}}
                    <div class="tab-pane fade show" id="pills-FAQ" role="tabpanel" aria-labelledby="pills-FAQ-tab">

                            <div class="card">
                                <div class="card-body" style="background-color: rgba(255,255,255,0.85)">
                                    <a href="#" class="pull-right btn btn-primary-scale-2 btn-sm">Ask Question &blacktriangleright;</a>
                                    <br>
                                    <div class="col-md-12" style="margin-top: 10px">
                                        <div class="panel-group" id="accordion">
                                            @forelse ($aboutTanzaniaFaqs as $index => $aboutTanzaniaFaq)
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseDescription{{$index}}" style="font-size: 14px">{{$aboutTanzaniaFaq->question_title}} &blacktriangledown;</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseDescription{{$index}}" class="panel-collapse collapse in">
                                                        <div class="panel-body">{{$aboutTanzaniaFaq->question_answer}}</div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>No Frequently Asked Questions Available. Begin your curiosity by emailing us your question. We value your privacy and assure you that we won't share the contact information with anyone or any third-party software</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    {{--                    End FAQ section--}}

{{--                    Tour Reservation section--}}
                    @php
                    $noLocalPackageReservationMessage=false;
                    @endphp
                    <div class="tab-pane fade" id="pills-tourReservations" role="tabpanel" aria-labelledby="pills-tourReservations-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 style="font-size:20px">Reservations included in Local Safaris </h3>
                                <div class="row">
                                    @forelse($reservationLocalTourPackages as $reservationLocalTourPackage)
                                        @forelse($reservationLocalTourPackage->localTourPackageReservations as $localTourPackageReservation)
                                            @if($localTourPackageReservation->tourOperator->status==1)
                                                <div class="col-md-4" style="margin-top: 15px">
                                                    <a href="{{route('localTourPackage.view',$reservationLocalTourPackage->uuid)}}" style="text-decoration: none; position: relative; display: block;">
                                                        <div class="card h-100 border-primary card-with-gradient">
                                                            <div id="ReservationIndicators" class="carousel slide" data-ride="carousel">
                                                                <ol class="carousel-indicators">
                                                                    @forelse(explode(',', $localTourPackageReservation->reservation_images) as $index => $image)
                                                                        <li data-target="#ReservationIndicators" data-slide-to="{{ $index }}" @if($index === 0) class="active" @endif></li>
                                                                    @empty
                                                                        <p>No image found!</p>
                                                                    @endforelse
                                                                </ol>
                                                                <div class="carousel-inner">
                                                                    @forelse(explode(',', $localTourPackageReservation->reservation_images) as $index => $image)
                                                                        <div class="carousel-item @if($index === 0) active @endif">
                                                                            <img src="{{ asset('public/'.$image) }}" style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%);" loading="lazy">
                                                                        </div>
                                                                    @empty
                                                                        <p>No image found!</p>
                                                                    @endforelse
                                                                </div>
                                                            </div>

                                                            <div class="card-img-overlay">
                                                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                                    {{$localTourPackageReservation->reservation_name}}<br>
                                                                    <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">
                                                            Travel with {{ $localTourPackageReservation->tourOperator->company_name }}
                                                            to {{ $reservationLocalTourPackage->touristicAttraction->attraction_name }}
                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse
                                    @empty
                                        <div class="col-md-12">
                                            <p style="padding-left: 20px">Whoops! No Reservation included yet from the tour packages.</p>
                                        </div>
                                    @endforelse
                                </div>
                                @if(!empty($reservationLocalTourPackages) && $reservationLocalTourPackages->count())
                                    @if($reservationLocalTourPackage->tourOperator->status==1)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right mt-3">
                                                    <a href="{{ route('tourOperatorReservation.allReservations') }}" class="btn btn-primary btn-sm">
                                                        See More <span class="ml-1">&#9654;</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                        {{--End Reservation section--}}

                    {{--Touristic game section--}}
                    <div class="tab-pane fade" id="pills-touristicGames" role="tabpanel" aria-labelledby="pills-touristicGames-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    @forelse($touristicGames as $touristicGame)
                                        <div class="col-md-4" style="margin-top: 15px">
                                            <a href="{{route('touristicGame.publicView',$touristicGame->uuid)}}" style="text-decoration: none; position: relative; display: block;">
                                                <div class="card h-100 border-primary card-with-gradient">
                                                    <div id="GameIndicator" class="carousel slide" data-ride="carousel">
                                                        <ol class="carousel-indicators">
                                                            @forelse(explode(',', $touristicGame->game_images) as $index => $image)
                                                                <li data-target="#GameIndicator" data-slide-to="{{ $index }}" @if($index === 0) class="active" @endif></li>
                                                            @empty
                                                                <p>No image found!</p>
                                                            @endforelse
                                                        </ol>
                                                        <div class="carousel-inner">
                                                            @forelse(explode(',', $touristicGame->game_images) as $index => $image)
                                                                <div class="carousel-item @if($index === 0) active @endif">
                                                                    <img src="{{ asset('public/'.$image) }}" style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%);" loading="lazy">
                                                                </div>
                                                            @empty
                                                                <p>No image found!</p>
                                                            @endforelse
                                                        </div>
                                                    </div>

                                                    <div class="card-img-overlay">
                                                        <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                            {{$touristicGame->game_name}}<br>
                                                            <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$touristicGame->game_category}}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <p>Whoops! No Game has been published yet. Our personnel are working on it</P>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                    {{--End touristic game section--}}

                    {{--Tanzania and world events--}}
                    <div class="tab-pane fade show" id="pills-events" role="tabpanel" aria-labelledby="pills-events-tab">
                        @forelse($tanzaniaEvents as $tanzaniaEvent)
                            <div class="panel panel-default" style="border: 2px solid #ddd; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="panel-heading" style="background-color: #f8f9fa; padding: 10px; border-bottom: 1px solid #ddd; border-radius: 8px 8px 0 0;">
                                    <div class="panel-title">
                                        <h5 style="font-weight: bold; color: #007bff;">&star;{{$tanzaniaEvent->event_name}}</h5>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 15px;">
                                    <p style="font-size: 16px; line-height: 1.5; color: #555;">{{$tanzaniaEvent->event_description}}</p>
                                    @if ($tanzaniaEvent->event_date===NULL)
                                    <p style="font-size: 14px; color: #777;">Any day of the month</p>
                                       @else
                                    <p style="font-size: 14px; color: #777;">{{date('jS M Y',strtotime($tanzaniaEvent->event_date))}}</p>
                                    @endif
                                    <a href="{{route('event.spotLocalSafaris',$tanzaniaEvent->uuid)}}" class="btn btn-primary btn-sm" style="font-weight: bold;">
                                        Explore Local Safaris &blacktriangleright;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p style="font-size: 18px; color: #dc3545;">Whoops! No Event has been added yet. Please wait while our personnel work on it</p>
                        @endforelse
                    </div>

                    {{--End Tanzania and world events--}}

                    {{--Tour types section--}}
                    <div class="tab-pane fade show" id="pills-tourTypes" role="tabpanel" aria-labelledby="pills-tourTypes-tab">
                        @forelse($tourTypes as $tourType)
                            <div class="panel panel-default" style="border: 2px solid #ddd; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="panel-heading" style="background-color: #f8f9fa; padding: 10px; border-bottom: 1px solid #ddd; border-radius: 8px 8px 0 0;">
                                    <div class="panel-title">
                                        <h5 style="font-weight: bold; color: #007bff;">&star;{{$tourType->tour_type_name}}</h5>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 15px;">
                                    <a href="{{route('tourType.spotLocalSafaris',$tourType->uuid)}}" class="btn btn-primary btn-sm" style="font-weight: bold;">
                                        Explore Local Safaris &blacktriangleright;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p style="font-size: 18px; color: #dc3545;">Whoops! No Event has been added yet. Please wait while our personnel work on it</p>
                        @endforelse
                    </div>

                    {{--End Tour types section--}}

                    {{--Tour package types section--}}
                    <div class="tab-pane fade show" id="pills-tourPackageTypes" role="tabpanel" aria-labelledby="pills-tourPackageTypes-tab">
                        @forelse($tourPackageTypes as $tourPackageType)
                            <div class="panel panel-default" style="border: 2px solid #ddd; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="panel-heading" style="background-color: #f8f9fa; padding: 10px; border-bottom: 1px solid #ddd; border-radius: 8px 8px 0 0;">
                                    <div class="panel-title">
                                        <h5 style="font-weight: bold; color: #007bff;">&star;{{$tourPackageType->tour_package_type_name}}</h5>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 15px;">
                                    <p style="font-size: 16px; line-height: 1.5; color: #555;">{{$tourPackageType->tour_package_type_description}}</p>
                                    <a href="{{route('tourPackageType.spotLocalSafaris',$tourPackageType->uuid)}}" class="btn btn-primary btn-sm" style="font-weight: bold;">
                                        Explore Local Safaris &blacktriangleright;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p style="font-size: 18px; color: #dc3545;">Whoops! No Event has been added yet. Please wait while our personnel work on it</p>
                        @endforelse
                    </div>

                    {{--End Tour package types section--}}

                    {{--                    Gallery section--}}
                    <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-gallery-tab" data-toggle="tab" href="#nav-gallery" role="tab" aria-controls="nav-gallery" aria-selected="true">Tanzania Gallery</a>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            @include('AboutTanzania.gallery')
                        </div>
                    </div>
                    {{--                    End Gallery section--}}
                </div>
            </div>
        </div>
@endsection
@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const nav = document.getElementById('stickyNav');
    const navPills = document.querySelector('.nav-pills');
    const scrollButtons = document.querySelectorAll('.scroll-button');
    
    // Sticky navigation
    let navTop = nav.offsetTop;
    let navHeight = nav.offsetHeight;
    
    function updateNavPosition() {
        navTop = nav.offsetTop;
        navHeight = nav.offsetHeight;
    }
    
    function handleScroll() {
        if (window.pageYOffset >= navTop) {
            nav.classList.add('sticky');
            document.body.style.paddingTop = navHeight + 'px';
        } else {
            nav.classList.remove('sticky');
            document.body.style.paddingTop = '0';
        }
        updateScrollButtons();
    }
    
    // Scroll buttons visibility
    function updateScrollButtons() {
        const isScrollable = navPills.scrollWidth > navPills.clientWidth;
        scrollButtons.forEach(button => {
            button.style.display = isScrollable ? 'flex' : 'none';
        });
        
        if (isScrollable) {
            const isAtStart = navPills.scrollLeft <= 0;
            const isAtEnd = navPills.scrollLeft >= (navPills.scrollWidth - navPills.clientWidth);
            
            document.querySelector('.scroll-button.left').style.display = isAtStart ? 'none' : 'flex';
            document.querySelector('.scroll-button.right').style.display = isAtEnd ? 'none' : 'flex';
        }
    }
    
    // Tab scrolling
    window.scrollTabs = function(direction) {
        const scrollAmount = navPills.clientWidth / 2;
        navPills.scrollBy({
            left: direction === 'left' ? -scrollAmount : scrollAmount,
            behavior: 'smooth'
        });
    };
    
    // Initialize
    updateNavPosition();
    updateScrollButtons();
    
    // Event listeners
    window.addEventListener('scroll', handleScroll);
    window.addEventListener('resize', () => {
        updateNavPosition();
        updateScrollButtons();
    });
    navPills.addEventListener('scroll', updateScrollButtons);
    
    // Handle tab clicks with smooth scroll
    const tabLinks = document.querySelectorAll('.nav-link');
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs
            tabLinks.forEach(tab => {
                tab.classList.remove('active');
                const target = document.querySelector(tab.getAttribute('href'));
                if (target) {
                    target.classList.remove('show', 'active');
                }
            });
            
            // Add active class to clicked tab
            this.classList.add('active');
            const targetPane = document.querySelector(this.getAttribute('href'));
            if (targetPane) {
                targetPane.classList.add('show', 'active');
            }
            
            // Smooth scroll to content
            const scrollOffset = nav.classList.contains('sticky') ? navHeight : navHeight * 2;
            const targetPosition = targetPane.getBoundingClientRect().top + window.pageYOffset - scrollOffset;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });
    });
});
</script>
@endpush


