<div class="tab-pane fade show" id="nav-tourOperators" role="tabpanel" aria-labelledby="nav-tourOperators-tab">
    <div class="row">
            @forelse($tourOperatorsList as $tourOperator)
                <div style="border: 2px solid gainsboro;margin-bottom: 5px">
                <div class="row">
                    <div class="col-md-6">
                        <img
                            src="{{ asset('public/CompaniesTeamImage/' . $tourOperator->company_team_image) }}"
                            alt="Team Image"
                            style="width: 100%; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6); margin-top: 50px;"
                            loading="lazy">
                    </div>

                    <div class="col-md-6" style="margin-top: 20px">
                        <div style="display: flex">
                            <img src="{{ asset('public/TourOperatorsLogos/' . $tourOperator->company_logo) }}"
                                 alt="Company Logo"
                                 style="height: 70px; width: 70px; border-radius:50%;object-fit: cover;" loading="lazy">
                            <h3 style="font-family: 'Lobster', cursive; font-size: 25px;color:dodgerblue">{{$tourOperator->company_name}}</h3>
                        </div>
                        <p>"{{$tourOperator->about_company}}"</p>
                        <p><b>Year established</b>: {{date('jS M Y',strtotime($tourOperator->established_date))}}</p>
                        <p><b>Years of experience</b>: {{$tourOperator->TourCompanyYearsOfExperienceLabel}} years</p>
                        <p><b>Total employees</b>: {{$tourOperator->total_employees}} employees</p>
                        <p><b>Safari Class</b>:
                            @if ($tourOperator->safariClass == 'bothLocalAndInternationalTours')
                                <span>Offers both<a href="#"> Local and International Safari's</a></span>
                            @elseif ($tourOperator->safariClass == 'localTours')
                                <span>Offers <a href="#">Local Safari's</a> Only</span>
                            @elseif ($tourOperator->safariClass == 'internationalTours')
                                <span>Offers <a href="#">International Safari's</a> Only</span>
                            @endif
                        </p>
                        <p><b>Offering custom Safari's?</b>
                            @if ($tourOperator->agreeCustomBooking == 'Yes')
                                <span>Yes, <span style="color:dodgerblue">{{ $tourOperator->company_name }}</span>
                                    offers custom safari's</span>
                            @elseif($tourOperator->agreeCustomBooking == 'No')
                                <span>No, <span style="color:dodgerblue">{{ $tourOperator->company_name }}</span>
                                    does not offer custom safari's</span>
                            @endif
                        </p>
                        <div style="display: flex">

                            <p><b>Country</b>:
                                <a href="{{ route('Tanzania.show', $nation->uuid) }}">
                                    <img src="{{ asset('public/nationFlags/' . $tourOperator->nation->nation_flag) }}"
                                        alt="Tanzania flag"
                                        style="height: 20px; width: 20px; border-radius:50%;object-fit: cover;"
                                        loading="lazy">
                                    {{ $tourOperator->nation->nation_name }} &rightsquigarrow;
                                </a>
                            </p>
                        </div>
                        <p><b>Regions of Operation</b>:
                            @forelse ($tourOperator->TourOperatorRegionsOfOperationLabel as $region)
                                <a href="{{route('tanzaniaRegion.publicView',$region['uuid'])}}" class="region-link" data-toggle="tooltip" data-placement="top"
                                   data-attraction-id="{{ $region['name'] }}" style="color: dodgerblue"
                                   title="{{ $region['description'] }}">{{ $region['name'] }}</a>,
                            @empty
                            @endforelse
                        </p>

                        <p><b>Insurances</b>:
                            @forelse($tourOperator->TourOperatorTourInsuranceTypesLabel as $insurance)
                                <a class="region_link" data-toggle="tooltip" data-placement="top"
                                   data-attraction-id="{{$insurance['name']}}" style="color: dodgerblue"
                                   title="{{ $insurance['description'] }}">{{ $insurance['name'] }}</a>,
                            @empty

                            @endforelse
                        </p>

                        <p>
                            <b>Safari preferences</b>:
                            @forelse($tourOperator->TourOperatorSafariPreferencesLabel as $safari)

                                <a href="{{route('touristicAttraction.show',$safari['uuid'])}}" class="safari_link" data-toggle="tooltip" data-placement="top"
                                   data-attraction-id="{{$safari['name']}}" style="color: dodgerblue"
                                   title="{{$safari['description']}}">{{$safari['name']}}</a>,
                            @empty

                            @endforelse
                        </p>
                        <p>
                            <b>Time range for support</b>:
                            {{$tourOperator->support_time_range}}
                        </p>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-primary btn-sm" onclick="openTourCompanyWebsite('{{$tourOperator->website_url}}')">
                                Preview website <span class="ml-1">&blacktriangleright;</span>
                            </a>
                        </div>
                        <div class="d-flex justify-content-center" style="padding: 10px 10px 10px 10px">
                            <div class="text-center">
                                <a href="{{ route('tourOperator.publicView', $tourOperator->uuid) }}" class="btn btn-primary btn-sm">Packages posted &blacktriangleright;</a>
                            </div>
                            @if ($tourOperator->agreeCustomBooking == 'Yes')
                            <div class="row">
                                <div class="text-center">
                                    <a href="{{ route('customTourBookings.create', $tourOperator->uuid) }}"
                                        class="btn btn-primary btn-sm" style="margin-left: 10px">Request custom tour
                                        &blacktriangleright;</a>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="text-center">
                                    <a onclick="alert('Whoops! It appears this tour company does not support custom tours');"
                                        class="btn btn-primary btn-sm" style="margin-left: 10px">Request custom tour
                                        &blacktriangleright;</a>
                                </div>
                            </div>
                        @endif
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ $tourOperator->instagram_url }}" target="_blank" class="mx-2">
                                <i class="fab fa-instagram fa-2x" style="color: #E4405F;"></i>
                            </a>
                            <a href="{{ $tourOperator->whatsapp_url }}" target="_blank" class="mx-2">
                                <i class="fab fa-whatsapp fa-2x" style="color: #25D366;"></i>
                            </a>
                            <a href="mailto:{{ $tourOperator->email_address }}" target="_blank" class="mx-2">
                                <i class="fas fa-envelope fa-2x" style="color: #007BFF;"></i>
                            </a>
                            <a href="{{ $tourOperator->gps_url }}" target="_blank" class="mx-2">
                                <i class="fas fa-map-marker-alt fa-2x" style="color: #EA4335;"></i>
                            </a>
                            <a href="{{ $tourOperator->website_url }}" target="_blank" class="mx-2">
                                <i class="fas fa-globe fa-2x" style="color: #007BFF;"></i>
                            </a>
                            <a href="tel:{{ $tourOperator->phone_number }}" class="mx-2">
                                <i class="fas fa-phone fa-2x" style="color: #34B7F1;"></i>
                            </a>
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
                </div>
            @empty
                <p>No available tour operators are currently operating around the region. However, if you plan to travel to this area, we will do our best to recommend one for you. Please reach out to us via WhatsApp or email. We value your privacy and assure you that we will not share your information with any third-party software or elsewhere</p>
            @endforelse

    </div>
</div>
@push('after-scripts')
    <script>
        function openTourCompanyWebsite(url) {
            // Set the iframe source to the provided URL
            document.getElementById('websiteIframe').src = url;
            // Show the modal
            var model=$('#tourCompanyWebsiteModal').modal('show');
        }
    </script>
@endpush
