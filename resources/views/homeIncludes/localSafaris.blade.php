<div class="container-fluid localSafari-section">

<div class="row">
    <div class="col-md-12">
        <div class="section-header mb-4">
            <h3 class="section-title">Local Safaris</h3>
            <p class="section-subtitle">Experience the beauty of Tanzania’s wildlife and landscapes on a local safari adventure</p>
        </div>
        <div class="row">

            @forelse($localTourPackages as $localTourPackage)
                @if($localTourPackage->tourOperator->status==1)
                <div class="col-md-4" style="margin-top: 15px">
                    <div class="card h-100 border-primary card-with-gradient">
                        <a href="{{route('localTourPackage.view',$localTourPackage->uuid)}}" style="text-decoration: none; position: relative; display: block;">
                            <img class="card-img-top"
                                 src="{{ asset('public/localSafariBlogImages/'.$localTourPackage->safari_poster) }}"
                                 style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%)" loading="lazy">
                            <div class="card-img-overlay">
                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; top: 0; right: 0; padding: 1rem;">
                                    @if ($localTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)

                                    <span class="badge badge-primary badge-pill badge-sm">Upcoming</span>
                                @else
                                    <span class="badge badge-danger badge-pill badge-sm">Expired</span>
                                @endif
                                </p>
                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                    {{$localTourPackage->touristicAttraction->attraction_name }}<br>
                                    <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$localTourPackage->safari_description}}</span>
                                </p>
                            </div>
                        </a>
                        <div class="card-body" style="position: relative; z-index: 2;">
                            @if ($localTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)

                            <p>{!! ($localTourPackage->CountDownDaysForLocalTourPackageTripLabel) !!} ~ Book Now! A lifetime experience awaits...</p>
                            @else
                                <span class="badge badge-danger badge-pill">Expired</span>
                            @endif
                            <h5 class="card-title" style="font-size: 14px">A {{$localTourPackage->tourPackageType->tour_package_type_name}} special for {{$localTourPackage->tanzaniaAndWorldEvent->event_name}}...</h5>
                            <div style="display: flex">
                                <h5 class="card-title" style="font-size: 14px;font-weight: bold;color:#ffd700">&starf; {{$localTourPackage->tourType->tour_type_name}}</h5>
                                <h5 class="card-title" style="font-size: 14px;font-weight: bold;margin-left: 50px"> <i class="fas fa-users" style="color: red"></i> <span style="font-size: 13px;color:red">{{number_format($localTourPackage->TotalSpacesRemainedLabel)}} / {{ number_format($localTourPackage->maximum_travellers) }} seats</span></h5>
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
                                <a href="{{route('localTourPackage.view',$localTourPackage->uuid)}}" class="btn btn-primary">View Details</a>
                                <p style="margin: 0;">Safari offered by: <a href="{{route('tourOperator.publicView',$localTourPackage->tourOperator->uuid)}}">{{$localTourPackage->tourOperator->company_name}} &rightsquigarrow;</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @empty
                <div class="col-md-12">
                    <p style="padding-left: 20px">No local packages posted yet. We are still working on it</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@if(!empty($localTourPackages) && $localTourPackages->count())
<div class="discover-more-section">
    <a href="{{ route('localTourPackage.allLocalTourPackages') }}" class="btn btn-explore-group">
        Discover More Safari's
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
    </a>
</div>
    @endif
</div>

    <style>
        .localSafari-section{
            background-color: #f8f9f0;
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
    </style>