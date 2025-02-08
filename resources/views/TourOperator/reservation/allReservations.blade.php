@extends('layouts.main', ['title' => __("Reservations"), 'header' => __('Reservations')])
@include('includes.validate_assets')
@section('content')

    @php
    $noLocalSafariMessage=false;
    @endphp
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85)">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header bg-primary text-white">
                                    <h2 class="mb-0">All Reservations</span></h2>
                                    <p style="color:#ffd700;font-size:15px"><i>"Reservations included in Local Safaris."</i></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h3 style="color: dodgerblue"></h3>
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
                                <div class="pagination">
                                    {{$reservationLocalTourPackages->links()}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
