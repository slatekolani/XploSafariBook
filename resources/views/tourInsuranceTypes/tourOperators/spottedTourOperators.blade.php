@extends('layouts.main', ['title' => 'Spotted tour operators - '. $insuranceType->tour_insurance_name, 'header' => 'Spotted tour operators'])
@include('includes.validate_assets')
@section('content')

        <div class="row">
                <div class="card">
                    <div class="card-body">
                            <div class="card-header bg-primary text-white">
                                <h2 class="mb-0"> {{$insuranceType->tour_insurance_name}}</h2>
                                <p style="color:#ffd700;font-size:15px"><i>"Tour Operators Offering {{$insuranceType->tour_insurance_name}}"</i></p>
                            </div>
                        @forelse($spottedTourOperatorsList as $spottedTourOperatorList)
                            <div class="row" style="border: 1px solid gainsboro;margin-top: 10px">
                                <div class="col-md-6">
                                    <img
                                        src="{{ asset('public/CompaniesTeamImage/' . $spottedTourOperatorList->company_team_image) }}"
                                        alt="Team Image"
                                        style="width: 100%; object-fit: cover;filter: contrast(120%); border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6); margin-top: 50px;"
                                        loading="lazy">
                                </div>

                                <div class="col-md-6" style="margin-top: 20px">
                                    <div style="display: flex">
                                        <img src="{{ asset('public/TourOperatorsLogos/' . $spottedTourOperatorList->company_logo) }}"
                                             alt="Company Logo"
                                             style="height: 70px; width: 70px; border-radius:50%;object-fit: cover;" loading="lazy">
                                        <h3 style="font-family: 'Lobster', cursive; font-size: 25px;color:dodgerblue">{{$spottedTourOperatorList->company_name}}</h3>
                                    </div>
                                    <p>"{{$spottedTourOperatorList->about_company}}"</p>
                                    <p><b>Year established</b>: {{date('jS M Y',strtotime($spottedTourOperatorList->established_date))}}</p>
                                    <p><b>Years of experience</b>: {{$spottedTourOperatorList->TourCompanyYearsOfExperienceLabel}} years</p>
                                    <p><b>Total employees</b>: {{$spottedTourOperatorList->total_employees}} employees</p>
                                    <p><b>Safari Class</b>:
                                        @if ($spottedTourOperatorList->safariClass == 'bothLocalAndInternationalTours')
                                            <span>Offers both<a href="#"> Local and International Safari's</a></span>
                                        @elseif ($spottedTourOperatorList->safariClass == 'localTours')
                                            <span>Offers <a href="#">Local Safari's</a> Only</span>
                                        @elseif ($spottedTourOperatorList->safariClass == 'internationalTours')
                                            <span>Offers <a href="#">International Safari's</a> Only</span>
                                        @endif
                                    </p>
                                    <p><b>Offering custom Safari's?</b>
                                        @if ($spottedTourOperatorList->agreeCustomBooking == 'Yes')
                                            <span>Yes, <span style="color:dodgerblue">{{ $spottedTourOperatorList->company_name }}</span>
                                                offers custom safari's</span>
                                        @elseif($spottedTourOperatorList->agreeCustomBooking == 'No')
                                            <span>No, <span style="color:dodgerblue">{{ $spottedTourOperatorList->company_name }}</span>
                                                does not offer custom safari's</span>
                                        @endif
                                    </p>
                                    <div style="display: flex">

                                        <p><b>Country</b>:
                                            <a href="{{route('Tanzania.show',$nation->uuid)}}">
                                                <img
                                                    src="{{ asset('public/nationFlags/' . $spottedTourOperatorList->nation->nation_flag)}}"
                                                    alt="Tanzania flag"
                                                    style="height: 20px; width: 20px; border-radius:50%;object-fit: cover;" loading="lazy">
                                                {{$spottedTourOperatorList->nation->nation_name}} &rightsquigarrow;
                                            </a>
                                        </p>
                                    </div>
                                    <p><b>Regions of Operation</b>:
                                        @foreach ($spottedTourOperatorList->TourOperatorRegionsOfOperationLabel as $region)
                                            <a href="{{route('tanzaniaRegion.publicView',$region['uuid'])}}" class="region-link" data-toggle="tooltip" data-placement="top"
                                               data-attraction-id="{{ $region['name'] }}" style="color: dodgerblue"
                                               title="{{ $region['description'] }}">{{ $region['name'] }}</a>,
                                        @endforeach
                                    </p>

                                    <p><b>Insurances</b>:
                                        @foreach($spottedTourOperatorList->TourOperatorTourInsuranceTypesLabel as $insurance)
                                            <a class="region_link" data-toggle="tooltip" data-placement="top"
                                               data-attraction-id="{{$insurance['name']}}" style="color: dodgerblue"
                                               title="{{ $insurance['description'] }}">{{ $insurance['name'] }}</a>,
                                        @endforeach
                                    </p>

                                    <p>
                                        <b>Safari preferences</b>:
                                        @foreach($spottedTourOperatorList->TourOperatorSafariPreferencesLabel as $safari)
                                            <a href="{{route('touristicAttraction.show',$safari['uuid'])}}" class="safari_link" data-toggle="tooltip" data-placement="top"
                                               data-attraction-id="{{$safari['name']}}" style="color: dodgerblue"
                                               title="{{$safari['description']}}">{{$safari['name']}}</a>,
                                        @endforeach
                                    </p>
                                    <p>
                                        <b>Time range for support</b>:
                                        {{$spottedTourOperatorList->support_time_range}}
                                    </p>
                                    <div class="text-center mt-3">
                                        <a href="#" class="btn btn-primary btn-sm" onclick="openTourCompanyWebsite('{{$spottedTourOperatorList->website_url}}')">
                                            Preview website <span class="ml-1">&blacktriangleright;</span>
                                        </a>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <a href="{{ $spottedTourOperatorList->instagram_url }}" target="_blank" class="mx-2">
                                            <i class="fab fa-instagram fa-2x" style="color: #E4405F;"></i>
                                        </a>
                                        <a href="{{ $spottedTourOperatorList->whatsapp_url }}" target="_blank" class="mx-2">
                                            <i class="fab fa-whatsapp fa-2x" style="color: #25D366;"></i>
                                        </a>
                                        <a href="mailto:{{ $spottedTourOperatorList->email_address }}" target="_blank" class="mx-2">
                                            <i class="fas fa-envelope fa-2x" style="color: #007BFF;"></i>
                                        </a>
                                        <a href="{{ $spottedTourOperatorList->gps_url }}" target="_blank" class="mx-2">
                                            <i class="fas fa-map-marker-alt fa-2x" style="color: #EA4335;"></i>
                                        </a>
                                        <a href="{{ $spottedTourOperatorList->website_url }}" target="_blank" class="mx-2">
                                            <i class="fas fa-globe fa-2x" style="color: #007BFF;"></i>
                                        </a>
                                        <a href="tel:{{ $spottedTourOperatorList->phone_number }}" class="mx-2">
                                            <i class="fas fa-phone fa-2x" style="color: #34B7F1;"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-center" style="padding: 10px 10px 10px 10px">
                                        <div class="text-center">
                                            <a href="{{ route('tourOperator.publicView', $spottedTourOperatorList->uuid) }}" class="btn btn-primary btn-sm">Packages posted &blacktriangleright;</a>
                                        </div>
                                        @if ($spottedTourOperatorList->agreeCustomBooking == 'Yes')
                                    <div class="row">
                                        <div class="text-center">
                                            <a href="{{ route('customTourBookings.create', $spottedTourOperatorList->uuid) }}"
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
                        @empty
                            <p>No available tour operators are currently offering {{$insuranceType->tour_type_name}}. However, Our personnel are working to get one for you.</p>
                        @endforelse
                        <div class="pagination">
                            {{$spottedTourOperatorsList->links()}}
                        </div>
                    </div>
                </div>
        </div>
@endsection

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

