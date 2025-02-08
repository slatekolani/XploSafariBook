<div class="tab-pane fade" id="nav-tourOperator" role="tabpanel" aria-labelledby="nav-tourOperator-tab">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <img
                    src="{{ asset('public/CompaniesTeamImage/' . $localTourPackage->tourOperator->company_team_image) }}"
                    alt="Team Image"
                    style="width: 100%; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6); margin-top: 50px;"
                    loading="lazy">

                    @if ($localTourPackage->tourOperator->agreeCustomBooking == 'Yes')
                    <div class="row" style="margin-top: 20px;margin-bottom: 20px">
                        <div class="text-center">
                            <a href="{{ route('customTourBookings.create', $localTourPackage->tourOperator->uuid) }}"
                                class="btn btn-primary btn-sm" style="margin-left: 10px">Request custom tour
                                &blacktriangleright;</a>
                        </div>
                    </div>
                @else
                    <div class="row" style="margin-top: 20px;margin-bottom: 20px">
                        <div class="text-center">
                            <a onclick="alert('Whoops! It appears this tour company does not support custom tours');"
                                class="btn btn-primary btn-sm" style="margin-left: 10px">Request custom tour
                                &blacktriangleright;</a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-6" style="margin-top: 20px">
                <div style="display: flex">
                    <img src="{{ asset('public/TourOperatorsLogos/' . $localTourPackage->tourOperator->company_logo) }}"
                         alt="Company Logo"
                         style="height: 70px; width: 70px; border-radius:50%;object-fit: cover;" loading="lazy">
                    <h3 style="font-family: 'Lobster', cursive; font-size: 25px;color:dodgerblue">{{$localTourPackage->tourOperator->company_name}}</h3>
                </div>
                <p>"{{$localTourPackage->tourOperator->about_company}}"</p>
                <p><b>Year established</b>: {{date('jS M Y',strtotime($localTourPackage->tourOperator->established_date))}}</p>
                <p><b>Years of experience</b>: {{$localTourPackage->tourOperator->TourCompanyYearsOfExperienceLabel}} years</p>
                <p><b>Total employees</b>: {{$localTourPackage->tourOperator->total_employees}} employees</p>
                <p><b>Safari Class</b>:
                    @if ($localTourPackage->tourOperator->safariClass == 'bothLocalAndInternationalTours')
                        <span>Offers both<a href="#"> Local and International Safari's</a></span>
                    @elseif ($localTourPackage->tourOperator->safariClass == 'localTours')
                        <span>Offers <a href="#">Local Safari's</a> Only</span>
                    @elseif ($localTourPackage->tourOperator->safariClass == 'internationalTours')
                        <span>Offers <a href="#">International Safari's</a> Only</span>
                    @endif
                </p>
                <p><b>Offering custom Safari's?</b>
                    @if ($localTourPackage->tourOperator->agreeCustomBooking == 'Yes')
                        <span>Yes, <span style="color:dodgerblue">{{ $localTourPackage->tourOperator->company_name }}</span>
                            offers custom safari's</span>
                    @elseif($localTourPackage->tourOperator->agreeCustomBooking == 'No')
                        <span>No, <span style="color:dodgerblue">{{ $localTourPackage->tourOperator->company_name }}</span>
                            does not offer custom safari's</span>
                    @endif
                </p>
                <div style="display: flex">

                    <p><b>Country</b>:
                        <a href="{{route('Tanzania.show',$nation->uuid)}}">
                            <img
                                src="{{ asset('public/nationFlags/' . $localTourPackage->tourOperator->nation->nation_flag)}}"
                                alt="Tanzania flag"
                                style="height: 20px; width: 20px; border-radius:50%;object-fit: cover;" loading="lazy">
                            {{$localTourPackage->tourOperator->nation->nation_name}} &rightsquigarrow;
                        </a>
                    </p>
                </div>
                <p><b>Regions of Operation</b>:
                    @foreach ($localTourPackage->tourOperator->TourOperatorRegionsOfOperationLabel as $region)
                        <a href="{{route('tanzaniaRegion.publicView',$region['uuid'])}}" class="region-link" data-toggle="tooltip" data-placement="top"
                           data-attraction-id="{{ $region['name'] }}" style="color: dodgerblue"
                           title="{{ $region['description'] }}">{{ $region['name'] }}</a>,
                    @endforeach
                </p>

                <p><b>Insurances</b>:
                    @foreach($localTourPackage->tourOperator->TourOperatorTourInsuranceTypesLabel as $insurance)
                        <a class="region_link" data-toggle="tooltip" data-placement="top"
                           data-attraction-id="{{$insurance['name']}}" style="color: dodgerblue"
                           title="{{ $insurance['description'] }}">{{ $insurance['name'] }}</a>,
                    @endforeach
                </p>

                <p>
                    <b>Safari preferences</b>:
                    @foreach($localTourPackage->tourOperator->TourOperatorSafariPreferencesLabel as $safari)
                        <a href="{{route('touristicAttraction.show',$safari['uuid'])}}" class="safari_link" data-toggle="tooltip" data-placement="top"
                           data-attraction-id="{{$safari['name']}}" style="color: dodgerblue"
                           title="{{$safari['description']}}">{{$safari['name']}}</a>,
                    @endforeach
                </p>
                <p>
                    <b>Time range for support</b>:
                    {{$localTourPackage->tourOperator->support_time_range}}
                </p>

                <div class="text-center mt-3">
                    <a href="#" class="btn btn-primary btn-sm" onclick="openTourCompanyWebsite('{{$localTourPackage->tourOperator->website_url}}')">
                        Preview website <span class="ml-1">&blacktriangleright;</span>
                    </a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ $localTourPackage->tourOperator->instagram_url }}" target="_blank" class="mx-2">
                        <i class="fab fa-instagram fa-2x" style="color: #E4405F;"></i>
                    </a>
                    <a href="{{ $localTourPackage->tourOperator->whatsapp_url }}" target="_blank" class="mx-2">
                        <i class="fab fa-whatsapp fa-2x" style="color: #25D366;"></i>
                    </a>
                    <a href="mailto:{{ $localTourPackage->tourOperator->email_address }}" target="_blank" class="mx-2">
                        <i class="fas fa-envelope fa-2x" style="color: #007BFF;"></i>
                    </a>
                    <a href="{{ $localTourPackage->tourOperator->gps_url }}" target="_blank" class="mx-2">
                        <i class="fas fa-map-marker-alt fa-2x" style="color: #EA4335;"></i>
                    </a>
                    <a href="{{ $localTourPackage->tourOperator->website_url }}" target="_blank" class="mx-2">
                        <i class="fas fa-globe fa-2x" style="color: #007BFF;"></i>
                    </a>
                    <a href="tel:{{ $localTourPackage->tourOperator->phone_number }}" class="mx-2">
                        <i class="fas fa-phone fa-2x" style="color: #34B7F1;"></i>
                    </a>
                </div>

            </div>
        </div>
        <div class="modal fade" id="tourCompanyWebsiteModal" tabindex="-1" role="dialog" aria-labelledby="websiteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="websiteIframe" width="100%" height="600" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12" style="margin-top: 20px">
            <p class="card-title" style="font-size: 14px;font-weight: bold">Reviews - <span class="badge badge-primary">{{$totalLocalTouristReviews}}</span></p>
            <br>
        @forelse($localTouristReviews as $localTouristReview)
                <img width="24" height="24" src="https://img.icons8.com/material/24/user--v1.png" alt="user--v1"/>
                <span style="font-weight: bold">{{$localTouristReview->localTourPackageBooking->tourist_name}}</span>
                <div style="border: 2px solid gainsboro;padding: 10px 10px 10px 10px;text-align: center">
                    <span style="font-weight: bold">"Travelled to {{$localTouristReview->localTourPackage->touristicAttraction->attraction_name}}"</span><br>
                    <span>{{$localTouristReview->review_message}}</span>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{route('localTouristReview.allLocalTouristReviews',$localTouristReview->tourOperator->uuid)}}"
                       class="btn btn-primary btn-sm text-center" style="margin-top: 20px;">See all
                        &blacktriangleright;</a>
                </div>
            @empty
                <img width="24" height="24" src="https://img.icons8.com/material/24/user--v1.png" alt="user--v1"/>
                <span style="font-weight: bold">Xafari Explore Admin</span>
                <div style="border: 1px solid gainsboro;padding: 10px 10px 10px 10px;text-align: center">
                    <span>This tour operator has not yet received any reviews. However, we are confident in the quality of their services, and you can always choose their company for your trip. Once you are finished, a link will be sent to you automatically or manually at some points. Please support this tour operator by being the first to leave a review. We appreciate both positive and negative feedback; just share your honest opinion</span>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="#"
                       class="btn btn-primary btn-sm text-center" style="margin-top: 20px;">Contact Support Team
                        &blacktriangleright;</a>
                </div>
            @endforelse
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Local Safari's posted by {{$localTourPackage->tourOperator->company_name}} </h3>
            <div class="row">
                @forelse($tourOperatorLocalTourPackages as $tourOperatorLocalTourPackage)
                    <div class="col-md-4" style="margin-top: 15px">
                        <div class="card h-100 border-primary card-with-gradient">
                            <a href="{{route('localTourPackage.view',$tourOperatorLocalTourPackage->uuid)}}" style="text-decoration: none; position: relative; display: block;">
                                <img class="card-img-top"
                                     src="{{ asset('public/localSafariBlogImages/'.$tourOperatorLocalTourPackage->safari_poster) }}"
                                     style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%)" loading="lazy">
                                <div class="card-img-overlay">
                                    <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; top: 0; right: 0; padding: 1rem;">
                                        @if ($tourOperatorLocalTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)

                                        <span class="badge badge-primary badge-pill badge-sm">Upcoming</span>
                                    @else
                                        <span class="badge badge-danger badge-pill badge-sm">Expired</span>
                                    @endif
                                    </p>
                                    <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                        {{$tourOperatorLocalTourPackage->touristicAttraction->attraction_name }}<br>
                                        <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$localTourPackage->safari_description}}</span>
                                    </p>
                                </div>
                            </a>
                            <div class="card-body" style="position: relative; z-index: 2;">
                                @if ($tourOperatorLocalTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)
                                <p>{!! ($tourOperatorLocalTourPackage->CountDownDaysForLocalTourPackageTripLabel) !!} ~ Book Now! A lifetime experience awaits...</p>
                                @else
                                <span class="badge badge-danger badge-pill">Expired</span>
                                @endif
                                <h5 class="card-title" style="font-size: 14px;font-weight: bold">A {{$tourOperatorLocalTourPackage->tourPackageType->tour_package_type_name}} special for {{$tourOperatorLocalTourPackage->tanzaniaAndWorldEvent->event_name}}</h5>
                                <div style="display: flex">
                                    <h5 class="card-title" style="font-size: 14px;font-weight: bold;">&starf; {{$tourOperatorLocalTourPackage->tourType->tour_type_name}}</h5>
                                    <h5 class="card-title" style="font-size: 14px;font-weight: bold;margin-left: 50px">&starf; Seats left: <span class="badge badge-danger badge-pill">{{number_format($tourOperatorLocalTourPackage->TotalSpacesRemainedLabel)}} / {{ number_format($tourOperatorLocalTourPackage->maximum_travellers) }} seats</span></h5>
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
                                    <a href="{{route('localTourPackage.view',$tourOperatorLocalTourPackage->uuid)}}" class="btn btn-primary">View Details</a>
                                    <p style="margin: 0;">Safari offered by: <a href="{{route('tourOperator.publicView',$tourOperatorLocalTourPackage->tourOperator->uuid)}}">{{$tourOperatorLocalTourPackage->tourOperator->company_name}} &rightsquigarrow;</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <p>No safari's posted by this tour operator</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 10px">
        <a href="{{ route('tourOperator.publicView', $localTourPackage->tourOperator->uuid) }}"
           style="float: right;" class="btn btn-primary btn-sm">All Packages posted &blacktriangleright;</a>
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
        function openTourCompanyWebsite(url) {
            document.getElementById('websiteIframe').src = url;
            $('#tourCompanyWebsiteModal').modal('show');
        }
    </script>
@endpush



