@extends('layouts.main', ['title' => __("Filtered Local Tour Packages"), 'header' => __("Filtered Local Tour Packages")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    <style>

    </style>
@endpush

@section('content')
    @guest
        <div class="card" style="padding-top: 10px">
            <div class="card-body">
                <h3>Filtered results</h3>
                <div class="row">
                    <ul>
                        <div class="success">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <strong>Success!</strong> {{ucfirst($successMessage)}}.
                        </div>
                    </ul>


                    <div class="col-md-12">
                        <div class="row">
                            @forelse($filteredPackages as $localTourPackage)
                                @if($localTourPackage->tourOperator->status==1)
                                    <div class="col-md-4" style="margin-top: 15px">
                                        <div class="card h-100 border-primary card-with-gradient">
                                            <a href="{{route('localTourPackage.view',$localTourPackage->uuid)}}" style="text-decoration: none; position: relative; display: block;">
                                                <img class="card-img-top"
                                                     src="{{ asset('public/localSafariBlogImages/'.$localTourPackage->safari_poster) }}"
                                                     style="height: auto; width: 100%; filter: contrast(120%)" loading="lazy">
                                                <div class="card-img-overlay">
                                                    <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                        {{$localTourPackage->touristicAttraction->attraction_name}}<br>
                                                        <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$localTourPackage->safari_description}}</span>
                                                    </p>
                                                </div>
                                            </a>
                                            <div class="card-body" style="position: relative; z-index: 2;">
                                                @if ($localTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)
                                                    <p><span class="badge badge-success badge-pill">{{ number_format(abs($localTourPackage->CountDownDaysForLocalTourPackageTripLabel)) }} days left</span></p>
                                                @else
                                                    <span class="badge badge-danger badge-pill">The tour has expired.</span>
                                                @endif
                                                <h5 class="card-title" style="font-size: 14px;font-weight: bold">A {{\App\Models\tourPackageType\tourPackageType::find($localTourPackage->tour_package_type_name)->tour_package_type_name}} special for {{\App\Models\tanzaniaAndWorldEvents\tanzaniaAndWorldEvents::find($localTourPackage->targeted_event)->event_name}}</h5>
                                                <div style="display: flex">
                                                    <h5 class="card-title" style="font-size: 14px;font-weight: bold;">&starf; {{\App\Models\TourTypes\tourTypes::find($localTourPackage->local_tour_type)->tour_type_name}}</h5>
                                                    <h5 class="card-title" style="font-size: 14px;font-weight: bold;margin-left: 50px">&starf; Seats left: <span class="badge badge-danger badge-pill">{{number_format($localTourPackage->TotalSpacesRemainedLabel)}} / {{ number_format($localTourPackage->maximum_travellers) }} seats</span></h5>
                                                </div>

                                                <p class="card-text" style="font-size: 14px;margin-bottom: 8px">
                                                    <b>Local</b>:
                                                    T shs{{ number_format($localTourPackage->trip_price_adult_tanzanian) }}
                                                    /Adult -
                                                    T shs{{ number_format($localTourPackage->trip_price_child_tanzanian) }}
                                                    /child
                                                </p>
                                                <p class="card-text" style="font-size: 14px;">
                                                    <b>Foreigner</b>:
                                                    T shs {{ number_format($localTourPackage->trip_price_adult_foreigner) }}
                                                    /Adult -
                                                    T shs {{ number_format($localTourPackage->trip_price_child_foreigner) }}
                                                    /child
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{route('localTourPackage.view',$localTourPackage->uuid)}}" class="btn btn-primary">View Details</a>
                                                    <p style="margin: 0;">Safari offered by: <a href="{{route('tourOperator.publicView',\App\Models\TourOperator\tourOperator::find($localTourPackage->tour_operator_id)->uuid)}}">{{\App\Models\TourOperator\tourOperator::find($localTourPackage->tour_operator_id)->company_name}} &rightsquigarrow;</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @if(!$noPackagesMessageDisplayed)
                                        <p style="padding-left: 20px">Thank you for reaching out! Currently, no tour operators have posted packages for this month. However, we can help you find one. Check us on email for assistance</p>
                                        @php
                                            $noPackagesMessageDisplayed=true;
                                        @endphp
                                    @endif
                                @endif
                            @empty
                                <div class="col-md-12">
                                    <p style="padding-left: 20px">Thank you for reaching out! Currently, no tour operators have posted packages for this month. However, we can help you find one. Check us on email for assistance</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
    @auth
        @if(Auth::user()->role==2)
            @include('TourOperator.overviewDashboard.view')
        @endif
    @endauth
@endsection

@push('after-scripts')

    <script>
        $(function () {
            $(".select2").select2();

        });

    </script>
@endpush

