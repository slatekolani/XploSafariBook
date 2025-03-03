@extends('layouts.main', ['title' => __($trip_kind_name . ' Local Tour Packages'), 'header' => __('All Local Tour Packages')])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    <style>

    </style>
@endpush

@section('content')
        <div class="card" style="padding-top: 10px">
            <div class="card-body">
                @php
                    // Define a user-friendly trip kind name based on trip_kind value
                    switch ($trip_kind_name) {
                        case 'dayAdventure':
                            $trip_kind_name = 'Day Adventure';
                            break;
                        case 'weekendGateway':
                            $trip_kind_name = 'Weekend Gateway';
                            break;
                        case 'weekLongAdventure':
                            $trip_kind_name = 'Week Long Adventure';
                            break;
                        default:
                            $trip_kind_name = 'Unknown Adventure'; 
                            break;
                    }
                @endphp

                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">{{ $trip_kind_name }} Tours</h2>
                    <p style="color:#ffd700;font-size:15px">
                        <i>"Local Tour Packages which feature {{ $trip_kind_name }}"</i>
                    </p>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            @forelse($localTourPackages as $localTourPackage)
                                @if ($localTourPackage->tourOperator->status == 1)
                                    <div class="col-md-4" style="margin-top: 15px">
                                        <div class="card h-100 border-primary card-with-gradient">
                                            <a href="{{ route('localTourPackage.view', $localTourPackage->uuid) }}"
                                                style="text-decoration: none; position: relative; display: block;">
                                                <img class="card-img-top"
                                                    src="{{ asset('public/localSafariBlogImages/' . $localTourPackage->safari_poster) }}"
                                                    style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%)"
                                                    loading="lazy">
                                                <div class="card-img-overlay">
                                                    <p class="card-text card-text-white"
                                                        style="font-size: 1.5rem; font-weight: bold; position: absolute; top: 0; right: 0; padding: 1rem;">
                                                        @if ($localTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)
                                                            <span
                                                                class="badge badge-primary badge-pill badge-sm">Upcoming</span>
                                                        @else
                                                            <span class="badge badge-danger badge-pill badge-sm">Expired</span>
                                                        @endif
                                                    </p>
                                                    <p class="card-text card-text-white"
                                                        style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                        {{ $localTourPackage->touristicAttraction->attraction_name }}<br>
                                                        <span
                                                            style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{ $localTourPackage->safari_description }}</span>
                                                    </p>
                                                </div>
                                            </a>
                                            <div class="card-body" style="position: relative; z-index: 2;">
                                                @if ($localTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)
                                                    <p>{!! $localTourPackage->CountDownDaysForLocalTourPackageTripLabel !!} ~ Book Now! A lifetime experience awaits...</p>
                                                @else
                                                    <span class="badge badge-danger badge-pill">Expired</span>
                                                @endif
                                                <h5 class="card-title" style="font-size: 14px;font-weight: bold">A
                                                    {{$localTourPackage->tourPackageType->tour_package_type_name}}
                                                    special for
                                                    {{$localTourPackage->tanzaniaAndWorldEvent->event_name}}
                                                </h5>
                                                <div style="display: flex">
                                                    <h5 class="card-title"
                                                        style="font-size: 14px;font-weight: bold;color:#ffd700">&starf;
                                                        {{ $localTourPackage->tourType->tour_type_name }}</h5>
                                                    <h5 class="card-title"
                                                        style="font-size: 14px;font-weight: bold;margin-left: 50px"> <i
                                                            class="fas fa-users" style="color: red"></i> <span
                                                            style="font-size: 13px;color:red">{{ number_format($localTourPackage->TotalSpacesRemainedLabel) }}
                                                            / {{ number_format($localTourPackage->maximum_travellers) }}
                                                            seats</span></h5>
                                                </div>

                                                <p class="card-text" style="font-size: 14px;margin-bottom: 8px">
                                                    <b>Local</b>:
                                                    Tshs {{ number_format($localTourPackage->trip_price_adult_tanzanian) }}
                                                    <span style="color: dodgerblue">/Adult</span> ~
                                                    Tshs {{ number_format($localTourPackage->trip_price_child_tanzanian) }}
                                                    <span style="color: dodgerblue">/child</span>
                                                </p>
                                                <p class="card-text" style="font-size: 14px;">
                                                    <b>Foreigner</b>:
                                                    Tshs {{ number_format($localTourPackage->trip_price_adult_foreigner) }}
                                                    <span style="color: dodgerblue">/Adult</span> ~
                                                    Tshs {{ number_format($localTourPackage->trip_price_child_foreigner) }}
                                                    <span style="color: dodgerblue">/child</span>
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('localTourPackage.view', $localTourPackage->uuid) }}"
                                                        class="btn btn-primary">View Details</a>
                                                    <p style="margin: 0;">Safari offered by: <a
                                                            href="{{ route('tourOperator.publicView', \App\Models\TourOperator\tourOperator::find($localTourPackage->tour_operator_id)->uuid) }}">{{ \App\Models\TourOperator\tourOperator::find($localTourPackage->tour_operator_id)->company_name }}
                                                            &rightsquigarrow;</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                   
                                @endif
                            @empty
                                <div class="col-md-12">
                                    <div class="alert alert-danger rounded-lg shadow-sm" role="alert">
                                        <p style="padding-left: 20px">Thank you for reaching out! Currently, no tour operators have
                                        posted packages with {{ $trip_kind_name }}. However, we can help you
                                        find one. Check us on email for assistance</p>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>


                <div class="pagination">
                    {{ $localTourPackages->links() }}
                </div>
            </div>
        </div>


    @auth
        @if (Auth::user()->role == 2)
            @include('TourOperator.overviewDashboard.view')
        @endif
    @endauth
@endsection

@push('after-scripts')
    <script>
        $(function() {
            $(".select2").select2();

        });
    </script>
@endpush
