@extends('layouts.main', ['title' => 'Spotted tour operators - '. $touristicAttraction->attraction_name, 'header' => 'Spotted tour operators'])
@include('includes.validate_assets')
@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3> Tour Operators operating in {{$touristicAttraction->attraction_name}}</h3>
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
                                        <h3 style="font-family: 'Lobster', cursive; font-size: 25px;">{{$spottedTourOperatorList->company_name}}</h3>
                                    </div>
                                    <p>"{{$spottedTourOperatorList->about_company}}"</p>
                                    <p><b>Year established</b>: {{date('jS M Y',strtotime($spottedTourOperatorList->established_date))}}</p>
                                    <p><b>Years of experience</b>: {{$spottedTourOperatorList->TourCompanyYearsOfExperienceLabel}} years</p>
                                    <p><b>Total employees</b>: {{$spottedTourOperatorList->total_employees}} employees</p>
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
                                        <a href="#" class="btn btn-primary btn-sm" onclick="openTourCompanyWebsite('{{$spottedTourOperatorList->tourOperator->website_url}}')">
                                            Preview website <span class="ml-1">&blacktriangleright;</span>
                                        </a>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <a href="{{$spottedTourOperatorList->instagram_url}}" target="_blank"><img width="30" height="30" src="https://img.icons8.com/color/48/instagram-new--v1.png" alt="instagram-new--v1"/></a>
                                        <a href="{{$spottedTourOperatorList->whatsapp_url}}" target="_blank"><img width="30" height="30" src="https://img.icons8.com/color/48/whatsapp--v1.png" alt="whatsapp--v1"/></a>
                                        <a href=mailto:"{{$spottedTourOperatorList->email_address}}" target="_black"> <img width="30" height="30" src="https://img.icons8.com/fluency/48/email-open.png" alt="email-open"/></a>
                                        <a href="{{$spottedTourOperatorList->gps_url}}" target="_blank"><img width="30" height="30" src="https://img.icons8.com/color/48/google-maps-new.png" alt="google-maps-new"/></a>
                                        <a href="{{$spottedTourOperatorList->website_url}}" target="_blank"><img width="30" height="30" src="https://img.icons8.com/fluency/48/domain.png" alt="domain"/></a>
                                        <a href=tel:"{{$spottedTourOperatorList->phone_number}}"><img width="30" height="30" src="https://img.icons8.com/color/48/phone.png" alt="phone"/></a>
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


                                    <div class="row" style="margin-top: 20px;margin-bottom: 20px">
                                        <div class="text-center">
                                            <a href="{{ route('tourOperator.publicView', $spottedTourOperatorList->uuid) }}" class="btn btn-primary btn-sm">Packages posted &blacktriangleright;</a>
                                        </div>
                                        <div class="text-center">
                                            <a href="{{ route('customTourBookings.create', $spottedTourOperatorList->uuid) }}" class="btn btn-primary btn-sm" style="margin-left: 10px">Request custom tour &blacktriangleright;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No available tour operators are currently offering {{$touristicAttraction->attraction_name}}. However, if you plan to travel to this area, we will do our best to recommend one for you. Please reach out to us via WhatsApp or email. We value your privacy and assure you that we will not share your information with any third-party software or elsewhere.</p>
                        @endforelse
                    </div>
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

