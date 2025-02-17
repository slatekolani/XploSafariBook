<div class="tab-pane fade" id="nav-Reservation" role="tabpanel" aria-labelledby="nav-Reservation-tab">
    <div class="container py-5">
        @forelse($localTourPackageReservations as $localTourPackageReservation)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <!-- Image Gallery Section -->
                        <div class="col-md-6">
                            <div class="gallery-container">
                                <div class="row g-2">
                                    @forelse(explode(',', $localTourPackageReservation->reservation_images) as $image)
                                        <div class="col-6">
                                            <a data-fancybox="gallery-{{ $loop->parent->index }}"
                                               data-caption="{{ $localTourPackageReservation->reservation_capacity }}"
                                               href="{{ asset('public/' . $image) }}"
                                               class="gallery-link">
                                                <img src="{{ asset('public/' . $image) }}"
                                                     class="img-fluid rounded"
                                                     style="width: 100%; height: 200px; object-fit: cover;"
                                                     loading="lazy"
                                                     alt="Reservation Image">
                                            </a>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info">No images available</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Details Section -->
                        <div class="col-md-6">
                            <h2 class="text-primary mb-3">{{ $localTourPackageReservation->reservation_name }}</h2>
                            
                            <div class="mb-4">
                                <p class="mb-2">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    Region: 
                                    <a href="{{ route('tanzaniaRegion.publicView', $localTourPackageReservation->tanzaniaRegion->uuid) }}"
                                       class="text-decoration-none">
                                        {{ $localTourPackageReservation->tanzaniaRegion->region_name }}
                                    </a>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    Capacity: {{ $localTourPackageReservation->reservation_capacity }}
                                </p>
                            </div>

                            <!-- Pricing Card -->
                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Pricing Information</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-2"><strong>Resident Prices:</strong></p>
                                            <p class="small">Child: TZS {{ number_format($localTourPackageReservation->resident_child_price_reservation) }}</p>
                                            <p class="small">Adult: TZS {{ number_format($localTourPackageReservation->resident_adult_price_reservation) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2"><strong>Non-Resident Prices:</strong></p>
                                            <p class="small">Child: TZS {{ number_format($localTourPackageReservation->foreigner_child_price_reservation) }}</p>
                                            <p class="small">Adult: TZS {{ number_format($localTourPackageReservation->foreigner_adult_price_reservation) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Facilities Section -->
                            <div class="facilities-section mb-4">
                                <h5 class="text-primary mb-3">Facilities</h5>
                                <div class="row g-2">
                                    @forelse($localTourPackageReservation->tourOperatorReservationFacility as $facility)
                                        <div class="col-md-6">
                                            <div class="card h-100 border-light">
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        <i class="fas fa-hotel text-primary me-2"></i>
                                                        {{ $facility->facility_name }}
                                                    </h6>
                                                    <p class="card-text small">{{ $facility->facility_description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info">No facilities available</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Games Section -->
                            <div class="games-section mb-4">
                                <h5 class="text-primary mb-3">Available Games</h5>
                                <div class="row g-2">
                                    @forelse($reservationTouristicGames as $touristicGame)
                                        <div class="col-md-6">
                                            <a href="{{ route('touristicGame.publicView', $touristicGame->uuid) }}"
                                               class="text-decoration-none">
                                                <div class="card h-100 game-card">
                                                    <img src="{{ asset('public/' . explode(',', $touristicGame->game_images)[0]) }}"
                                                         class="card-img-top"
                                                         style="height: 150px; object-fit: cover;"
                                                         alt="{{ $touristicGame->game_name }}">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ $touristicGame->game_name }}</h6>
                                                        <p class="card-text small">{{ $touristicGame->game_category }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info">No games available at the moment</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="text-center">
                                <a href="{{ $localTourPackageReservation->reservation_url }}"
                                   class="btn btn-primary px-4"
                                   target="_blank">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    Visit Website
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                <h4 class="alert-heading">No Reservations Available</h4>
                <p>There are currently no optional reservations added to this package.</p>
            </div>
        @endforelse
    </div>
    <div class="trip-timeline">
        @if($localTourPackageTripHierachies)
        <h3>Trip Hierarchy & Reservations</h3>
            <div class="container py-5">
                @forelse ($localTourPackageTripHierachies as $hierarchy)
                    <div class="timeline-card mb-5">
                        <div class="row">
                            <!-- Left side with day circle -->
                            <div class="col-md-2 text-center mb-4 mb-md-0">
                                <div class="day-circle mx-auto">
                                    <span class="day-number">Day {{ $hierarchy->day }}</span>
                                </div>
                            </div>
    
                            <!-- Right side with content -->
                            <div class="col-md-10">
                                <div class="timeline-content bg-white rounded-lg shadow-sm p-4">
                                    <!-- Destination Header -->
                                    <div class="destination-section mb-4">
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <div class="icon-wrapper">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <h3 class="destination-title">
                                                <a href="{{route('touristicAttraction.show',$hierarchy->localTourPackage->touristicAttraction->uuid)}}" 
                                                   class="text-decoration-none">
                                                    {{ $hierarchy->destination }}
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="attraction-info">
                                            {{$hierarchy->localTourPackage->touristicAttraction->basic_information}}
                                        </p>
                                    </div>
    
                                    <!-- Date Information -->
                                    <div class="date-section mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-wrapper">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <span class="travel-date">
                                                {{ \Carbon\Carbon::parse($hierarchy->travel_date)->format('l, F j, Y') }}
                                            </span>
                                        </div>
                                    </div>
    
                                    <!-- Attraction Gallery -->
                                    <div class="gallery-section mb-4">
                                        <h4 class="gallery-title mb-3">Attraction Photos</h4>
                                        <div class="image-gallery">
                                            @php
                                                $images = explode(',', $hierarchy->localTourPackage->touristicAttraction->attraction_image);
                                            @endphp
                                            @if(count($images) > 0)
                                                <div class="row g-3">
                                                    @foreach($images as $index => $image)
                                                        <div class="col-6 col-md-4">
                                                            <a href="{{ asset('public/'.$image) }}" 
                                                               data-fancybox="attraction-gallery-{{$hierarchy->day}}" 
                                                               class="gallery-item">
                                                                <div class="image-wrapper">
                                                                    <img src="{{ asset('public/'.$image) }}" 
                                                                         alt="{{ $hierarchy->destination }}">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="alert alert-info">No images available</div>
                                            @endif
                                        </div>
                                    </div>
    
                                    <!-- Reservation Section -->
                                    @php
                                        $reservation = $hierarchy->localTourPackage->tourOperator->tourOperatorReservation
                                            ->firstWhere('reservation_name', $hierarchy->reservation);
                                    @endphp
                                    @if($reservation)
                                        <div class="reservation-section">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <div class="icon-wrapper">
                                                    <i class="fas fa-home"></i>
                                                </div>
                                                <h4 class="reservation-title">
                                                    <a href="{{$reservation->reservation_url}}" 
                                                       target="_blank"
                                                       class="text-decoration-none">
                                                        {{ $reservation->reservation_name }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <p class="reservation-capacity mb-4">{{$reservation->reservation_capacity}}</p>
    
                                            <!-- Reservation Gallery -->
                                            <div class="image-gallery">
                                                @php
                                                    $reservationImages = explode(',', $reservation->reservation_images);
                                                @endphp
                                                @if(count($reservationImages) > 0)
                                                    <div class="row g-3">
                                                        @foreach($reservationImages as $image)
                                                            <div class="col-6 col-md-4">
                                                                <a href="{{ asset('public/'.$image) }}" 
                                                                   data-fancybox="reservation-gallery-{{$hierarchy->day}}" 
                                                                   class="gallery-item">
                                                                    <div class="image-wrapper">
                                                                        <img src="{{ asset('public/'.$image) }}" 
                                                                             alt="{{ $reservation->reservation_name }}">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="alert alert-info">No images available</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
    
                        @if (!$loop->last)
                            <div class="timeline-connector"></div>
                        @endif
                    </div>
                @empty
                    <div class="empty-state">
                        <p>No trip hierarchies were added!</p>
                    </div>
                @endforelse
            </div>
        @else
            <div class="empty-state">
                <p>No trip hierarchies were added for you to see the reservation in them!</p>
            </div>
        @endif
    </div>
    
    <style>
    .trip-timeline {
        position: relative;
        padding: 2rem 0;
    }
    
    .timeline-card {
        position: relative;
    }
    
    .day-circle {
        width: 120px;
        height: 120px;
        background: linear-gradient(145deg, #3490dc, #2779bd);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(52, 144, 220, 0.2);
    }
    
    .day-number {
        color: white;
        font-size: 1.5rem;
        font-family: 'Playfair Display', serif;
        font-weight: bold;
    }
    
    .timeline-content {
        border-left: 4px solid #3490dc;
    }
    
    .icon-wrapper {
        width: 40px;
        height: 40px;
        background-color: rgba(52, 144, 220, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .icon-wrapper i {
        color: #3490dc;
        font-size: 1.2rem;
    }
    
    .destination-title {
        font-size: 1.5rem;
        margin: 0;
    }
    
    .destination-title a {
        color: #2c3e50;
        transition: color 0.3s ease;
    }
    
    .destination-title a:hover {
        color: #3490dc;
    }
    
    .travel-date {
        font-size: 1.1rem;
        color: #666;
    }
    
    .image-wrapper {
        position: relative;
        padding-top: 75%;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .image-wrapper:hover {
        transform: translateY(-5px);
    }
    
    .image-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .gallery-title {
        font-size: 1.2rem;
        color: #2c3e50;
        margin-bottom: 1rem;
    }
    
    .timeline-connector {
        position: absolute;
        left: 60px;
        top: 120px;
        bottom: -20px;
        width: 2px;
        background: linear-gradient(to bottom, #3490dc, transparent);
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #666;
        font-size: 1.2rem;
    }
    
    @media (max-width: 768px) {
        .timeline-connector {
            display: none;
        }
        
        .day-circle {
            width: 100px;
            height: 100px;
        }
        
        .day-number {
            font-size: 1.2rem;
        }
    }
    </style>
    
</div>

<style>
.gallery-link {
    display: block;
    transition: transform 0.2s;
    overflow: hidden;
}

.gallery-link:hover {
    transform: scale(1.02);
}

.game-card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.game-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.card {
    border-radius: 10px;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.facilities-section .card {
    transition: background-color 0.2s;
}

.facilities-section .card:hover {
    background-color: #f8f9fa;
}

.btn-primary {
    padding: 0.5rem 1.5rem;
    border-radius: 5px;
    transition: all 0.2s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}
</style>

@push('after-scripts')
<script>
    $(function() {
        $(".select2").select2();
        
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Initialize Fancybox for gallery
        $('[data-fancybox]').fancybox({
            buttons: [
                "zoom",
                "share",
                "slideShow",
                "fullScreen",
                "download",
                "thumbs",
                "close"
            ],
        });
    });
</script>
@endpush