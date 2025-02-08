<div class="tab-pane fade" id="nav-Reservation" role="tabpanel" aria-labelledby="nav-Reservation-tab">
    <div class="row" style="margin-top: 10px">
            <div class="card">
                <div class="card-body" style="background-color: rgba(255,255,255,0.85)">
                    <div class="row">

                            @forelse($localTourPackageReservations as $localTourPackageReservation)
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="gallery-row">
                                        @forelse(explode(',', $localTourPackageReservation->reservation_images) as $image)
                                            <div class="gallery-item">
                                                <a data-fancybox="gallery"
                                                   data-caption="{{$localTourPackageReservation->reservation_capacity}}"
                                                   href="{{ asset('public/'.$image) }}">
                                                    <img src="{{ asset('public/'.$image) }}" loading="lazy"
                                                         alt="Gallery Image">
                                                </a>
                                            </div>
                                        @empty
                                            <p>No image found!</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="card-body">
                                        <h2>{{ $localTourPackageReservation->reservation_name }}</h2>
                                        <p class="card-text mb-2">Region found: <a href="{{route('tanzaniaRegion.publicView',$localTourPackageReservation->tanzaniaRegion->uuid)}}">{{ $localTourPackageReservation->tanzaniaRegion->region_name }}</a></p>
                                        <p class="card-text mb-2">Capacity: {{ $localTourPackageReservation->reservation_capacity }}</p>
                                        <div class="alert alert-warning">
                                            <p style="font-size: 20px">Prices for {{$localTourPackageReservation->reservation_name}}</p>
                                            <p>Resident Child Price: TZS {{number_format($localTourPackageReservation->resident_child_price_reservation)}} </p>
                                            <p>Resident Adult Price: TZS {{number_format($localTourPackageReservation->resident_adult_price_reservation)}} </p>
                                            <p>Non Resident Adult Price: TZS {{number_format($localTourPackageReservation->foreigner_adult_price_reservation)}} </p>
                                            <p>Non Resident Child Price: TZS {{number_format($localTourPackageReservation->foreigner_child_price_reservation)}} </p>
                                        </div>
                                        <h3>Facilities</h3>
                                        @forelse($localTourPackageReservation->tourOperatorReservationFacility as $facility)
                                            <div class="card mb-3 border-primary">
                                                <div class="card-body">
                                                    <h5 class="card-title font-weight-bold text-primary">{{ $facility->facility_name }}</h5>
                                                    <p class="card-text">{{ $facility->facility_description }}</p>
                                                </div>
                                            </div>
                                            
                                        @empty
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="card-text">No facilities available</p>
                                                </div>
                                            </div>
                                        @endforelse
                                        <h4>Games to be used in {{$localTourPackageReservation->reservation_name}} while in the <a href="{{route('touristicAttraction.show',$localTourPackage->touristicAttraction->uuid)}}">{{$localTourPackage->touristicAttraction->attraction_name}}</a> tour</h4>
                                        <div class="row">
                                            @forelse($reservationTouristicGames as $touristicGame)
                                                    <a href="{{ route('touristicGame.publicView', $touristicGame->uuid) }}" style="text-decoration: none; position: relative; display: block;">
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
                                                                            <img src="{{ asset('public/'.$image) }}" style="width: 100%; height: 450px; object-fit: cover; filter: contrast(120%);" loading="lazy">
                                                                        </div>
                                                                    @empty
                                                                        <p>No image found!</p>
                                                                    @endforelse
                                                                </div>
                                                            </div>

                                                            <div class="card-img-overlay">
                                                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                                    {{ $touristicGame->game_name }}<br>
                                                                    <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{ $touristicGame->game_category }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                            @empty
                                                <div class="col-md-12">
                                                    <p>Whoops! No games have been published yet. Our personnel are working on it.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                        <h4>Safaris in which {{$localTourPackage->tourOperator->company_name}} uses {{$localTourPackageReservation->reservation_name}} reservation</h4>
                                        <p>
                                            @foreach($localTourPackageReservation->ReservationSafariAreaPreferenceLabel as $safari)
                                                <a href="{{route('touristicAttraction.show',$safari['uuid'])}}" class="safari_link" data-toggle="tooltip" data-placement="top"
                                                   data-attraction-id="{{$safari['attraction_name']}}" style="color: dodgerblue"
                                                   title="{{$safari['attraction_description']}}">{{$safari['attraction_name']}}</a>,
                                            @endforeach
                                        </p>


                                        <div class="text-center mt-3">
                                            <a href="{{$localTourPackageReservation->reservation_url}}" type="button" class="btn btn-primary" target="_blank">
                                                Preview Website
                                            </a>
                                        </div>
                                    </div>
                            </div>

                            


                            @empty
                                <p>Whoops! No reservation is included in this safari. It is possible that this safari is
                                    a day safari. If not, please check with us here to inform us of this issue </p>
                            @endforelse

                        </div>
                    </div>
                </div>
        </div>
    </div>

@push('after-scripts')
    <script>
        $(function () {
            $(".select2").select2();
        });
    </script>
@endpush
@push('after-scripts')
    <script>
        function openReservationWebsite() {
            $('#staticBackdrop').modal('show');
        }
    </script>
@endpush

