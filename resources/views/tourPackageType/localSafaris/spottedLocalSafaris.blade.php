@extends('layouts.main', [
    'title' => __('Event - ' . $tourPackageType->tour_package_type_name),
    'header' => __('Event - ' . $tourPackageType->tour_package_type_name),
])

@include('includes.validate_assets')

@section('content')
    @php
        $noTourPackageTypeMessage = false;
    @endphp
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg">
                        <div class="card-body bg-white bg-opacity-85">

                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card-header bg-primary text-white py-3">
                                        <h2 class="mb-2 fs-3">
                                            {{ $tourPackageType->tour_package_type_name }} 
                                        </h2>
                                        <p class="text-warning fst-italic mb-0 fs-6">
                                            "Exploration enthusiasts, Travel on a {{$tourPackageType->tour_package_type_name}} for an incredible memory."
                                        </p>
                                    </div>
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="row g-4">
                                @forelse($spottedLocalTourPackages as $spottedLocalTourPackage)
                                    @if ($spottedLocalTourPackage->tourOperator->status == 1)
                                        <div class="col-md-4" style="margin-top: 15px">
                                            <div class="card h-100 border-primary card-with-gradient">
                                                <a href="{{ route('localTourPackage.view', $spottedLocalTourPackage->uuid) }}"
                                                    style="text-decoration: none; position: relative; display: block;">
                                                    <img class="card-img-top"
                                                        src="{{ asset('public/localSafariBlogImages/' . $spottedLocalTourPackage->safari_poster) }}"
                                                        style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%)"
                                                        loading="lazy">
                                                    <div class="card-img-overlay">
                                                        <p class="card-text card-text-white"
                                                            style="font-size: 1.5rem; font-weight: bold; position: absolute; top: 0; right: 0; padding: 1rem;">
                                                            @if ($spottedLocalTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)
                                                                <span
                                                                    class="badge badge-primary badge-pill badge-sm">Upcoming</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-danger badge-pill badge-sm">Expired</span>
                                                            @endif
                                                        </p>
                                                        <p class="card-text card-text-white"
                                                            style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                            {{ $spottedLocalTourPackage->touristicAttraction->attraction_name }}<br>
                                                            <span
                                                                style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{ $spottedLocalTourPackage->safari_description }}</span>
                                                        </p>
                                                    </div>
                                                </a>
                                                <div class="card-body" style="position: relative; z-index: 2;">
                                                    @if ($spottedLocalTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)
                                                        <p>{!! $spottedLocalTourPackage->CountDownDaysForLocalTourPackageTripLabel !!} ~ Book Now! A lifetime experience
                                                            awaits...</p>
                                                    @else
                                                        <span class="badge badge-danger badge-pill">Expired</span>
                                                    @endif
                                                    <h5 class="card-title" style="font-size: 14px;font-weight: bold">A
                                                        {{ $spottedLocalTourPackage->tourPackageType->tour_package_type_name }}
                                                        special for
                                                        {{ $spottedLocalTourPackage->tanzaniaAndWorldEvent->event_name }}
                                                    </h5>
                                                    <div style="display: flex">
                                                        <h5 class="card-title"
                                                            style="font-size: 14px;font-weight: bold;color:#ffd700">&starf;
                                                            {{ $spottedLocalTourPackage->tourType->tour_type_name }}</h5>
                                                        <h5 class="card-title"
                                                            style="font-size: 14px;font-weight: bold;margin-left: 50px"> <i
                                                                class="fas fa-users" style="color: red"></i> <span
                                                                style="font-size: 13px;color:red">{{ number_format($spottedLocalTourPackage->TotalSpacesRemainedLabel) }}
                                                                /
                                                                {{ number_format($spottedLocalTourPackage->maximum_travellers) }}
                                                                seats</span></h5>
                                                    </div>
                                                    <p class="card-text" style="font-size: 14px;margin-bottom: 8px">
                                                        <b>Local</b>:
                                                        Tshs
                                                        {{ number_format($spottedLocalTourPackage->trip_price_adult_tanzanian) }}
                                                        <span style="color: dodgerblue">/Adult</span> ~
                                                        Tshs
                                                        {{ number_format($spottedLocalTourPackage->trip_price_child_tanzanian) }}
                                                        <span style="color: dodgerblue">/child</span>
                                                    </p>
                                                    <p class="card-text" style="font-size: 14px;">
                                                        <b>Foreigner</b>:
                                                        Tshs
                                                        {{ number_format($spottedLocalTourPackage->trip_price_adult_foreigner) }}
                                                        <span style="color: dodgerblue">/Adult</span> ~
                                                        Tshs
                                                        {{ number_format($spottedLocalTourPackage->trip_price_child_foreigner) }}
                                                        <span style="color: dodgerblue">/child</span>
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <a href="{{ route('localTourPackage.view', $spottedLocalTourPackage->uuid) }}"
                                                            class="btn btn-primary">View Details</a>
                                                        <p style="margin: 0;">Safari offered by: <a
                                                                href="{{ route('tourOperator.publicView', $spottedLocalTourPackage->tourOperator->uuid) }}">{{ $spottedLocalTourPackage->tourOperator->company_name }}
                                                                &rightsquigarrow;</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if (!$noTourTypeMessage)
                                            <div class="col-md-12">
                                                <p style="padding-left: 20px">No local package with <span
                                                        style="color: dodgerblue">{{ $tourPackageType->tour_package_type_name }}</span>
                                                    travel experience has been published yet. However, we can find one for
                                                    you. Please check here to request assistance in finding a suitable
                                                    package.</p>
                                            </div>
                                            @php
                                                $noTourTypeMessage = true;
                                            @endphp
                                        @endif
                                    @endif
                                @empty
                                    <div class="col-md-12">
                                        <p style="padding-left: 20px">No local package with <span
                                                style="color: dodgerblue">{{ $tourPackageType->tour_package_type_name }}</span>
                                            travel experience has been published yet. However, we can find one for you.
                                            Please check here to request assistance in finding a suitable package.</p>
                                    </div>
                                @endforelse
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination">
            {{ $spottedLocalTourPackages->links() }}
        </div>
    @endsection
