<div class="tab-pane fade" id="nav-tripHierarchy" role="tabpanel" aria-labelledby="nav-tripHierarchy-tab">
    <div class="py-5">
        <h4 class="text-center mb-5 fs-2">Trip Hierarchy</h4>
        
        @forelse ($localTourPackageTripHierachies as $hierarchy)
            <div class="timeline-item position-relative mb-5">
                <div class="d-flex flex-column flex-md-row">
                    <!-- Day Circle with classical design -->
                    <div class="day-circle rounded-circle d-flex align-items-center justify-content-center mx-auto mx-md-0 mb-3 mb-md-0"
                         style="width: 100px; height: 100px; background: linear-gradient(145deg, #3490dc, #2779bd); flex-shrink: 0;">
                        <span class="text-white fw-bold fs-4" style="font-family: 'Playfair Display', serif;">Day {{ $hierarchy->day }}</span>
                    </div>
                    
                    <!-- Enhanced Content Section -->
                    <div class="ms-md-5 flex-grow-1">
                        <!-- Destination Section -->
                       
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                
                                <i class="fas fa-map-marker-alt text-primary me-3 fs-4"></i>
                                <h5 class="mb-0 fs-4">
                                    <a href="{{route('touristicAttraction.show',$hierarchy->localTourPackage->touristicAttraction->uuid)}}" 
                                       class="text-decoration-none link-primary">
                                        {{ $hierarchy->destination }}
                                    </a>
                                </h5>
                            </div>
                          
                            
                            <p class="mb-4 text-muted ps-5" style="margin-left: 10px">{{$hierarchy->localTourPackage->touristicAttraction->basic_information}}</p>
                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt text-primary me-3 fs-4"></i>
                                    <span class="fs-5">{{ \Carbon\Carbon::parse($hierarchy->travel_date)->format('l, F j, Y') }}</span>
                                </div>
                            </div>
                            
                            <!-- Attraction Images Gallery -->
                            <div class="attraction-gallery mb-4">
                                @php
                                    $images = explode(',', $hierarchy->localTourPackage->touristicAttraction->attraction_image);
                                @endphp
                                @if(count($images) > 0)
                                    <div class="row g-3">
                                        @foreach($images as $index => $image)
                                            <div class="col-sm-6 col-lg-4">
                                                <a href="{{ asset('public/'.$image) }}" 
                                                   data-fancybox="attraction-gallery-{{$hierarchy->day}}" 
                                                   class="gallery-item">
                                                    <img src="{{ asset('public/'.$image) }}" 
                                                         class="img-fluid rounded shadow-sm" 
                                                         loading="lazy" 
                                                         alt="{{ $hierarchy->destination }}"
                                                         style="height: 200px; width: 100%; object-fit: cover;">
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
                        <div class="mb-3">
                            
                            
                            @php
                                $reservation = $hierarchy->localTourPackage->tourOperator->tourOperatorReservation
                                    ->firstWhere('reservation_name', $hierarchy->reservation);
                            @endphp

                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-home text-primary me-3 fs-4"></i>
                                <h5 class="mb-0 fs-4"><a href="{{$reservation->reservation_url}}" target="_blank">{{ $reservation->reservation_name }}</a></h5>
                            </div>
                            

                            <p style="margin-left: 10px">{{$reservation->reservation_capacity}}</p>
                            
                            @if($reservation)
                                <!-- Reservation Images Gallery -->
                                <div class="reservation-gallery">
                                    @php
                                        $reservationImages = explode(',', $reservation->reservation_images);
                                    @endphp
                                    @if(count($reservationImages) > 0)
                                        <div class="row g-3">
                                            @foreach($reservationImages as $image)
                                                <div class="col-sm-6 col-lg-4">
                                                    <a href="{{ asset('public/'.$image) }}" 
                                                       data-fancybox="reservation-gallery-{{$hierarchy->day}}" 
                                                       class="gallery-item">
                                                        <img src="{{ asset('public/'.$image) }}" 
                                                             class="img-fluid rounded shadow-sm" 
                                                             loading="lazy" 
                                                             alt="{{ $reservation->reservation_name }}"
                                                             style="height: 200px; width: 100%; object-fit: cover;">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info">No images available</div>
                                    @endif
                                </div>
                            @endif
                        </div>
                        
                    </div>
                </div>
                
                @if (!$loop->last)
                    <div class="timeline-connector d-none d-md-block position-absolute" 
                         style="left: 50px; top: 100px; bottom: -25px; width: 2px; background: linear-gradient(to bottom, #3490dc, #2779bd);">
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center text-muted py-5 fs-4">
                @if ($localTourPackage->trip_kind == 'dayAdventure')
                    <p>No trip hierarchies were added! Since this is a <a href="{{ route('localTourPackage.TripKind', ['trip_kind_name' => 'dayAdventure']) }}">day adventure</a> to <a href="{{route('touristicAttraction.show',$localTourPackage->touristicAttraction->uuid)}}">{{$localTourPackage->touristicAttraction->attraction_name}}</a></p>
                @endif
            </div>
        @endforelse
    </div>
</div>

<style>
.timeline-item {
    position: relative;
    z-index: 1;
    background: #fff;
    padding: 2rem;
    border-radius: 0.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
}

.timeline-item .day-circle {
    transition: transform 0.3s ease;
    z-index: 2;
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    border: 3px solid #fff;
}

.timeline-item:hover .day-circle {
    transform: scale(1.1) rotate(5deg);
}

.gallery-item {
    display: block;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.gallery-item img {
    transition: all 0.5s ease;
}

.gallery-item:hover img {
    transform: scale(1.05);
}

.text-muted {
    color: #6c757d !important;
}

a.link-primary {
    color: #3490dc;
    transition: color 0.2s ease;
}

a.link-primary:hover {
    color: #2779bd;
    text-decoration: underline !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .timeline-item {
        padding: 1rem;
    }
    
    .timeline-item .day-circle {
        width: 80px !important;
        height: 80px !important;
    }
    
    .timeline-item:hover .day-circle {
        transform: none;
    }
}
</style>

@push('after-scripts')
<script>
    $(document).ready(function () {
        $(".select2").select2();
        
        Fancybox.bind("[data-fancybox]", {});
    });
</script>
@endpush