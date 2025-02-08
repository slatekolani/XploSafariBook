<div class="container-fluid reservation-section" style="margin-top: 50px">

    <div class="row">
        <div class="col-md-12">
            <div class="section-header mb-4">
                <h3 class="section-title">Reservations Included in Local Safaris</h3>
                <p class="section-subtitle">All local safaris come with easy reservation options to ensure a seamless and unforgettable experience</p>
            </div>

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
                                            <div id="ReservationIndicators" class="carousel slide" data-ride="carousel">
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
                    <p style="padding-left: 20px">Whoops! No Reservation included yet from the tour packages.</p>
                </div>
            @endforelse
        </div>
        @if(!empty($reservationLocalTourPackages) && $reservationLocalTourPackages->count())
        @if($reservationLocalTourPackage->tourOperator->status == 1)
            <div class="discover-more-section">
                <a href="{{ route('tourOperatorReservation.allReservations') }}" class="btn btn-discover-more">
                    See More
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        @endif
    @endif
    </div>

</div>

<style>
    .reservation-section{
        background-color: #f8f9f0;
        padding:3rem 0;
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
@media (max-width: 768px) {
        .section-title {
            font-size: 1.8rem; /* Smaller font size for smaller screens */
        }

        .section-subtitle {
            font-size: 0.9rem; /* Adjust subtitle font size */
        }

        .section-header {
            margin-bottom: 1rem; /* Reduce margin for smaller screens */
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1.5rem; /* Further reduce font size for extra small screens */
        }

        .section-subtitle {
            font-size: 0.8rem;
        }
    }
</style>