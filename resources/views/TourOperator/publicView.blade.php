@extends('layouts.main', ['title' => __('Tour Operator Information'), 'header' => __('Tour operator Information')])
@include('includes.validate_assets')
@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85)">
                        <div class="row" style="border: 1px solid gainsboro;margin-top: 10px">
                            <div class="col-md-6">
                                <img src="{{ asset('public/CompaniesTeamImage/' . $tourOperator->company_team_image) }}"
                                    alt="Team Image"
                                    style="width: 100%; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6); margin-top: 50px;"
                                    loading="lazy">
                            </div>

                            <div class="col-md-6" style="margin-top: 20px">
                                <div style="display: flex">
                                    <img src="{{ asset('public/TourOperatorsLogos/' . $tourOperator->company_logo) }}"
                                        alt="Company Logo"
                                        style="height: 70px; width: auto;"
                                        loading="lazy">
                                    <h3 style="font-family: 'Lobster', cursive; font-size: 25px;color:dodgerblue">
                                        {{ $tourOperator->company_name }}</h3>
                                </div>
                                @if ($tourOperator->status == 1)
                                    <span class="badge badge-success badge-pill pull-right">Approved</span>
                                @else
                                    <span class="badge badge-danger badge-pill pull-right">Unapproved</span>
                                @endif
                                <p>"{{ $tourOperator->about_company }}"</p>
                                <p><b>Year established</b>: {{ date('jS M Y', strtotime($tourOperator->established_date)) }}
                                </p>
                                <p><b>Years of experience</b>: {{ $tourOperator->TourCompanyYearsOfExperienceLabel }} years
                                </p>
                                <p><b>Total employees</b>: {{ $tourOperator->total_employees }} employees</p>
                                <p><b>Safari Class</b>:
                                    @if ($tourOperator->safariClass == 'bothLocalAndInternationalTours')
                                        <span>Offers both<a href="#"> Local and International Safari's</a></span>
                                    @elseif ($tourOperator->safariClass == 'localTours')
                                        <span>Offers <a href="#">Local Safari's</a> Only</span>
                                    @elseif ($tourOperator->safariClass == 'internationalTours')
                                        <span>Offers <a href="#">International Safari's</a> Only</span>
                                    @endif
                                </p>
                                <p><b>Offering custom Safari's?</b>
                                    @if ($tourOperator->agreeCustomBooking == 'Yes')
                                        <span>Yes, <span style="color:dodgerblue">{{ $tourOperator->company_name }}</span>
                                            offers custom safari's</span>
                                    @elseif($tourOperator->agreeCustomBooking == 'No')
                                        <span>No, <span style="color:dodgerblue">{{ $tourOperator->company_name }}</span>
                                            does not offer custom safari's</span>
                                    @endif
                                </p>
                                <div style="display: flex">

                                    <p><b>Country</b>:
                                        <a href="{{ route('Tanzania.show', $nation->uuid) }}">
                                            <img src="{{ asset('public/nationFlags/' . $tourOperator->nation->nation_flag) }}"
                                                alt="Tanzania flag"
                                                style="height: 20px; width: 20px; border-radius:50%;object-fit: cover;"
                                                loading="lazy">
                                            {{ $tourOperator->nation->nation_name }} &rightsquigarrow;
                                        </a>
                                    </p>
                                </div>
                                <p><b>Regions of Operation</b>:
                                    @forelse($tourOperator->TourOperatorRegionsOfOperationLabel as $region)
                                        <a href="{{ route('tanzaniaRegion.publicView', $region['uuid']) }}"
                                            class="region-link" data-toggle="tooltip" data-placement="top"
                                            data-attraction-id="{{ $region['name'] }}" style="color: dodgerblue"
                                            title="{{ $region['description'] }}">{{ $region['name'] }}</a>,
                                    @empty
                                    @endforelse
                                </p>

                                <p><b>Insurances</b>:
                                    @forelse($tourOperator->TourOperatorTourInsuranceTypesLabel as $insurance)
                                        <a class="region_link" data-toggle="tooltip" data-placement="top"
                                            data-attraction-id="{{ $insurance['name'] }}" style="color: dodgerblue"
                                            title="{{ $insurance['description'] }}">{{ $insurance['name'] }}</a>,
                                    @empty
                                    @endforelse
                                </p>

                                <p>
                                    <b>Safari preferences</b>:
                                    @forelse($tourOperator->TourOperatorSafariPreferencesLabel as $safari)
                                        <a href="{{ route('touristicAttraction.show', $safari['uuid']) }}"
                                            class="safari_link" data-toggle="tooltip" data-placement="top"
                                            data-attraction-id="{{ $safari['name'] }}" style="color: dodgerblue"
                                            title="{{ $safari['description'] }}">{{ $safari['name'] }}</a>,
                                    @empty
                                    @endforelse
                                </p>
                                <p>
                                    <b>Time range for support</b>:
                                    {{ $tourOperator->support_time_range }}
                                </p>

                                <div class="d-flex justify-content-center">
                                    <a href="{{ $tourOperator->instagram_url }}" target="_blank" class="mx-2">
                                        <i class="fab fa-instagram fa-2x" style="color: #E4405F;"></i>
                                    </a>
                                    <a href="{{ $tourOperator->whatsapp_url }}" target="_blank" class="mx-2">
                                        <i class="fab fa-whatsapp fa-2x" style="color: #25D366;"></i>
                                    </a>
                                    <a href="mailto:{{ $tourOperator->email_address }}" target="_blank" class="mx-2">
                                        <i class="fas fa-envelope fa-2x" style="color: #007BFF;"></i>
                                    </a>
                                    <a href="{{ $tourOperator->gps_url }}" target="_blank" class="mx-2">
                                        <i class="fas fa-map-marker-alt fa-2x" style="color: #EA4335;"></i>
                                    </a>
                                    <a href="{{ $tourOperator->website_url }}" target="_blank" class="mx-2">
                                        <i class="fas fa-globe fa-2x" style="color: #007BFF;"></i>
                                    </a>
                                    <a href="tel:{{ $tourOperator->phone_number }}" class="mx-2">
                                        <i class="fas fa-phone fa-2x" style="color: #34B7F1;"></i>
                                    </a>
                                </div>


                                @if ($tourOperator->status == 1)
                                    <span class="badge badge-success badge-pill pull-right">Approved</span>
                                @else
                                    <span class="badge badge-danger badge-pill pull-right">Unapproved</span>
                                @endif
                                <br>

                                @if ($tourOperator->agreeCustomBooking == 'Yes')
                                <a href="{{ route('customTourBookings.create', $tourOperator->uuid) }}"
                                    class="btn btn-primary w-100">
                                    Request Custom Tour
                                </a>
                                @else                                       
                                <a onclick="alert('Whoops! It appears this tour company does not support custom tours');"
                                    class="btn btn-primary btn-sm" style="margin-left: 10px">Request custom tour
                                    &blacktriangleright;</a>
                                @endif
                               <br>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Local Safaris Posted by <span style="color: dodgerblue">{{ $tourOperator->company_name }}</span></h3>
                                <p>Travel to these destinations in the posted packages and enjoy the beauty of Tanzania.</p>                                
                                <div class="row">
                                    @forelse($localTourPackages as $localTourPackage)
                                        @if ($localTourPackage->tourOperator->status == 1)
                                            <div class="col-md-4" style="margin-top: 15px;">
                                                <div class="card h-100 border-primary card-with-gradient">
                                                    <a href="{{ route('localTourPackage.view', $localTourPackage->uuid) }}"
                                                        style="text-decoration: none; position: relative; display: block;">
                                                        <img class="card-img-top"
                                                            src="{{ asset('public/localSafariBlogImages/' . $localTourPackage->safari_poster) }}"
                                                            style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%);"
                                                            loading="lazy">
                                                        <div class="card-img-overlay">
                                                            <p class="card-text text-white font-weight-bold"
                                                                style="font-size: 1.5rem; position: absolute; top: 0; right: 0; padding: 1rem;">
                                                                @if ($localTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)
                                                                    <span class="badge badge-primary">Upcoming</span>
                                                                @else
                                                                    <span class="badge badge-danger">Expired</span>
                                                                @endif
                                                            </p>
                                                            <p class="card-text text-white font-weight-bold"
                                                                style="font-size: 1.5rem; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                                {{ $localTourPackage->touristicAttraction->attraction_name }}<br>
                                                                <span
                                                                    style="font-family: 'Montserrat', sans-serif; font-weight: normal; font-size: 1rem;">
                                                                    {{ $localTourPackage->safari_description }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </a>

                                                    <div class="card-body">
                                                        @if ($localTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)
                                                            <p>{!! $localTourPackage->CountDownDaysForLocalTourPackageTripLabel !!} ~ Book Now! A lifetime experience
                                                                awaits...</p>
                                                        @else
                                                            <span class="badge badge-danger">Expired</span>
                                                        @endif

                                                        <h5 class="card-title" style="font-size: 14px;">A
                                                            {{ $localTourPackage->tourPackageType->tour_package_type_name }}
                                                            special for
                                                            {{ $localTourPackage->tanzaniaAndWorldEvent->event_name }}...
                                                        </h5>

                                                        <div class="d-flex" style="margin-top: 8px;">
                                                            <h5 class="card-title font-weight-bold"
                                                                style="font-size: 14px; color: #ffd700;">
                                                                &starf; {{ $localTourPackage->tourType->tour_type_name }}
                                                            </h5>
                                                            <h5 class="card-title font-weight-bold ml-4"
                                                                style="font-size: 14px;">
                                                                <i class="fas fa-users" style="color: red;"></i>
                                                                <span style="font-size: 13px; color: red;">
                                                                    {{ number_format($localTourPackage->TotalSpacesRemainedLabel) }}
                                                                    /
                                                                    {{ number_format($localTourPackage->maximum_travellers) }}
                                                                    seats
                                                                </span>
                                                            </h5>
                                                        </div>

                                                        <p class="card-text" style="font-size: 14px; margin-bottom: 8px;">
                                                            <b>Local</b>: Tshs
                                                            {{ number_format($localTourPackage->trip_price_adult_tanzanian) }}
                                                            <span style="color: dodgerblue;">/Adult</span> ~ Tshs
                                                            {{ number_format($localTourPackage->trip_price_child_tanzanian) }}
                                                            <span style="color: dodgerblue;">/Child</span>
                                                        </p>

                                                        <p class="card-text" style="font-size: 14px;">
                                                            <b>Foreigner</b>: Tshs
                                                            {{ number_format($localTourPackage->trip_price_adult_foreigner) }}
                                                            <span style="color: dodgerblue;">/Adult</span> ~ Tshs
                                                            {{ number_format($localTourPackage->trip_price_child_foreigner) }}
                                                            <span style="color: dodgerblue;">/Child</span>
                                                        </p>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <a href="{{ route('localTourPackage.view', $localTourPackage->uuid) }}"
                                                                class="btn btn-primary">View Details</a>
                                                            <p class="mb-0">Safari offered by:
                                                                <a
                                                                    href="{{ route('tourOperator.publicView', $localTourPackage->tourOperator->uuid) }}">
                                                                    {{ $localTourPackage->tourOperator->company_name }}
                                                                    &rightsquigarrow;
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif(!$noLocalTourPackageAttractions)
                                            <div class="col-md-12">
                                                <p style="padding-left: 20px;">No local safaris are currently posted by <span
                                                    style="color: dodgerblue">{{ $tourOperator->company_name }}</span>
                                                    this attraction.</p>
                                            </div>
                                            @php
                                                $noLocalTourPackageAttractions = true;
                                            @endphp
                                        @endif
                                    @empty
                                        <div class="col-md-12">
                                            <p>No local safaris are currently posted by <span
                                                style="color: dodgerblue">{{ $tourOperator->company_name }}.</span>
                                            </p>
                                        </div>
                                    @endforelse
                                </div>
                                <div class="row pull-right" style="margin-top: 20px;margin-bottom: 20px">
                                    <div class="text-center">
                                        <a href="#" class="btn btn-primary btn-sm" style="margin-left: 10px">More?
                                            &blacktriangledown;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row" style="padding-top: 5px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <h3>Reservations Included in Posted Safaris</h3>
                            <p>Travel to the destinations in the posted packages and enjoy a stay in these reservations.</p>
                               

                            <div class="row">
                                <?php
                                $reservationCount = 0;
                            ?>
                                @forelse($reservationLocalTourPackages as $reservationLocalTourPackage)
                                    @forelse($reservationLocalTourPackage->localTourPackageReservations as $localTourPackageReservation)
                                        @if ($localTourPackageReservation->tourOperator->status == 1)
                                            @if ($reservationCount < 3)
                                                <div class="col-md-4" style="margin-top: 15px">
                                                    <a href="{{ route('localTourPackage.view', $reservationLocalTourPackage->uuid) }}"
                                                        style="text-decoration: none; position: relative; display: block;">
                                                        <div class="card h-100 border-primary card-with-gradient">
                                                            <div id="ReservationIndicators" class="carousel slide"
                                                                data-ride="carousel">
                                                                <ol class="carousel-indicators">
                                                                    @forelse(explode(',', $localTourPackageReservation->reservation_images) as $index => $image)
                                                                        <li data-target="#ReservationIndicators"
                                                                            data-slide-to="{{ $index }}"
                                                                            @if ($index === 0) class="active" @endif>
                                                                        </li>
                                                                    @empty
                                                                        <p>No image found!</p>
                                                                    @endforelse
                                                                </ol>
                                                                <div class="carousel-inner">
                                                                    @forelse(explode(',', $localTourPackageReservation->reservation_images) as $index => $image)
                                                                        <div
                                                                            class="carousel-item @if ($index === 0) active @endif">
                                                                            <img src="{{ asset('public/' . $image) }}"
                                                                                style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%);"
                                                                                loading="lazy">
                                                                        </div>
                                                                    @empty
                                                                        <p>No image found!</p>
                                                                    @endforelse
                                                                </div>
                                                            </div>

                                                            <div class="card-img-overlay">
                                                                <p class="card-text card-text-white"
                                                                    style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                                    {{ $localTourPackageReservation->reservation_name }}<br>
                                                                    <span
                                                                        style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">
                                                                        Travel with
                                                                        {{ $localTourPackageReservation->tourOperator->company_name }}
                                                                        to
                                                                        {{ $reservationLocalTourPackage->touristicAttraction->attraction_name }}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <?php
                                                $reservationCount++;
                                                ?>
                                            @else
                                            @break;
                                        @endif
                                    @endif
                                @empty
                                @endforelse
                            @empty
                                <div class="col-md-12">
                                    <p>Whoops! No Reservation included yet from the tour
                                        packages.</p>
                                </div>
                            @endforelse

                        </div>
<br>
                            <div class="col-md-12">
                                <h3>Activities a tour operator can assist you with</h3>
                                <p>Discover the experiences {{$tourOperator->company_name}} can provide.</p>                                
                    
                                <div class="group-travels-grid">
                                    @forelse($tourOperatorTouristicActivities as $tourOperatorTouristicActivity)
                                        <div class="group-travel-card">
                                            <div class="card group-travel-card-inner h-100 shadow-hover">
                                                <a href="{{route('touristicActivity.showActivity',$tourOperatorTouristicActivity->uuid)}}" class="group-travel-card-link">
                                                    <div class="card-image-wrapper">
                                                        <img 
                                                            src="{{ asset('public/touristicActivityImage/' . $tourOperatorTouristicActivity->activity_image) }}"
                                                            alt="{{ $tourOperatorTouristicActivity->activity_name }}"
                                                            class="card-img-top group-travel-image"
                                                            loading="lazy"
                                                        >
                                                        <div class="card-image-overlay">
                                                            <h5 class="group-travel-title">{{ $tourOperatorTouristicActivity->activity_name }}</h5>
                                                            <span style="color: white">{{strlen($tourOperatorTouristicActivity->activity_description) > 38 ? substr($tourOperatorTouristicActivity->activity_description,0,38) .'...' : $tourOperatorTouristicActivity->activity_description  }}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="no-group-travels-message">
                                            <p>Whoops! No touristic activity have been added yet. Our team is crafting something special!</p>
                                        </div>
                                    @endforelse
                                </div>
                    
                                <div class="see-more-section">
                                    <a href="#" class="btn btn-explore-group">
                                        Explore Touristic Activities
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        
                        <div class="row pull-right" style="margin-top: 20px;margin-bottom: 20px">
                            <div class="text-center">
                                <a href="#" class="btn btn-primary btn-sm" style="margin-left: 10px">More?
                                    &blacktriangledown;</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 30px">
                            <div class="col-md-12" style="margin-top: 20px">
                                <h3>Reviews - <span class="badge badge-primary">{{ $totalLocalTouristReviews }}</span></h3>
                                <p>See what others say about {{$tourOperator->company_name}} to help you make an informed decision.</p>   
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
                                
                                <!-- "See all" button container -->
                                <div class="row">
                                    <div class="col-12" style="display: flex; justify-content: flex-end; margin-top: 20px; margin-bottom: 20px;">
                                        <a href="{{route('localTouristReview.allLocalTouristReviews', $tourOperator->uuid)}}"
                                            class="btn btn-primary btn-sm">See all &blacktriangleright;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        

    </div>
</div>
</div>
@endsection

<style>
    .group-travels-section {
        background-color: #f0f4f8;
        padding: 3rem 0;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-weight: 700;
        color: #2c3e50;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }
    
    .section-subtitle {
        color: #7f8c8d;
        font-size: 1.1rem;
    }
    
    .group-travels-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .group-travel-card {
        perspective: 1000px;
    }
    
    .group-travel-card-inner {
        transition: all 0.3s ease-in-out;
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .group-travel-card-inner:hover {
        transform: translateY(-10px) rotateX(5deg);
        box-shadow: 0 20px 30px rgba(0,0,0,0.1);
    }
    
    .card-image-wrapper {
        position: relative;
        overflow: hidden;
    }
    
    .group-travel-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .group-travel-card-inner:hover .group-travel-image {
        transform: scale(1.1);
    }
    
    .card-image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.7));
        padding: 1rem;
    }
    
    .group-travel-title {
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
    }
    
    .no-group-travels-message {
        text-align: center;
        color: #6c757d;
        padding: 2rem;
        background-color: #e9ecef;
        border-radius: 12px;
    }
    
    .see-more-section {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .btn-explore-group {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background-color: #2ecc71;
        color: white;
        text-decoration: none;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-weight: 600;
        box-shadow: 0 10px 20px rgba(46, 204, 113, 0.2);
    }
    
    .btn-explore-group:hover {
        background-color: #27ae60;
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(46, 204, 113, 0.3);
    }
    
    .btn-explore-group svg {
        transition: transform 0.3s ease;
    }
    
    .btn-explore-group:hover svg {
        transform: translateX(5px);
    }
    
    @media (max-width: 768px) {
        .group-travels-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    @media (max-width: 480px) {
        .group-travels-grid {
            grid-template-columns: 1fr;
        }
    }
    </style>
