@extends('layouts.main', ['title' => __("Search Results"), 'header' => __("Search Results")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    <style>

    </style>
@endpush

@section('content')
    @guest
        <div class="card" style="padding-top: 30px">
            <div class="card-body">
                <p  class="alert alert-danger d-flex align-items-center" role="alert" style="border-radius: 8px;" style="padding-left: 20px;border-left: 2px solid gold" style="padding-left: 20px;padding-top:40px">Unfortunately, it
                    appears that our tour operators have not yet posted the package you are looking for. However, here
                    is a list of tour operators operating in the region. Please check their profiles to choose the one
                    that can take you to your desired attraction</p>
                <h4> Exploring tour operators operating around your searched item:
                    @forelse($searchedLocalTourPackage as $localPackage)
                        <span>{{$localPackage}}</span>
                    @empty
                    @endforelse
                </h4>

                <form class="search-bar" type="get" action="{{route('localTourPackage.search')}}"
                      style="padding-top: 20px;position: relative">
                    <div class="input-group">
                        <div class="form-outline">
                            <input type="search" id="form1" name="search" class="form-control"
                                   style="width: 400px;" placeholder="Wanna explore more. Search again..."/>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search" style="width: 40px"></i>
                        </button>
                    </div>
                </form>
                @forelse($tourOperatorsOperatingAround as $tourOperatorOperatingAround)
                    <div class="row" style="border: 1px solid gainsboro;margin-top: 10px">
                        <div class="col-md-6">
                            <img
                                src="{{ asset('public/CompaniesTeamImage/' . $tourOperatorOperatingAround->company_team_image) }}"
                                alt="Team Image"
                                style="width: 100%; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6); margin-top: 50px;"
                                loading="lazy">
                        </div>

                        <div class="col-md-6" style="margin-top: 20px">
                            <div style="display: flex">
                                <img src="{{ asset('public/TourOperatorsLogos/' . $tourOperatorOperatingAround->company_logo) }}" alt="Company Logo" style="height: 70px; width: 70px; border-radius:50%;object-fit: cover;" loading="lazy">
                                <h3 style="font-family: 'Lobster', cursive; font-size: 25px;">{{$tourOperatorOperatingAround->company_name}}</h3>
                            </div>
                            <p>"{{$tourOperatorOperatingAround->about_company}}"</p>
                            <p><b>Year established</b>: {{date('jS M Y',strtotime($tourOperatorOperatingAround->established_date))}}
                            </p>
                            <p><b>Years of experience</b>: {{$tourOperatorOperatingAround->TourCompanyYearsOfExperienceLabel}}years</p>
                            <p><b>Total employees</b>: {{$tourOperatorOperatingAround->total_employees}} employees</p>
                            <p><b>Safari Class</b>:
                                @if ($tourOperatorOperatingAround->safariClass == 'bothLocalAndInternationalTours')
                                    <span>Offers both<a href="#"> Local and International Safari's</a></span>
                                @elseif ($tourOperatorOperatingAround->safariClass == 'localTours')
                                    <span>Offers <a href="#">Local Safari's</a> Only</span>
                                @elseif ($tourOperatorOperatingAround->safariClass == 'internationalTours')
                                    <span>Offers <a href="#">International Safari's</a> Only</span>
                                @endif
                            </p>
                            <div style="display: flex">
                                <p><b>Country</b>:
                                    <a href="{{route('Tanzania.show',$nation->uuid)}}">
                                        <img
                                            src="{{ asset('public/nationFlags/' . $tourOperatorOperatingAround->nation->nation_flag)}}"
                                            alt="Tanzania flag"
                                            style="height: 20px; width: 20px; border-radius:50%;object-fit: cover;"
                                            loading="lazy">
                                        {{$tourOperatorOperatingAround->nation->nation_name}} &rightsquigarrow;
                                    </a>
                                </p>
                            </div>
                            <p><b>Regions of Operation</b>:
                                @foreach ($tourOperatorOperatingAround->TourOperatorRegionsOfOperationLabel as $region)
                                    <a href="{{route('tanzaniaRegion.publicView',$region['uuid'])}}" class="region-link"
                                       data-toggle="tooltip" data-placement="top"
                                       data-attraction-id="{{ $region['name'] }}" style="color: dodgerblue"
                                       title="{{ $region['description'] }}">{{ $region['name'] }}</a>,
                                @endforeach
                            </p>

                            <p><b>Insurances</b>:
                                @foreach($tourOperatorOperatingAround->TourOperatorTourInsuranceTypesLabel as $insurance)
                                    <a class="region_link" data-toggle="tooltip" data-placement="top"
                                       data-attraction-id="{{$insurance['name']}}" style="color: dodgerblue"
                                       title="{{ $insurance['description'] }}">{{ $insurance['name'] }}</a>,
                                @endforeach
                            </p>

                            <p>
                                <b>Safari preferences</b>:
                                @foreach($tourOperatorOperatingAround->TourOperatorSafariPreferencesLabel as $safari)
                                    <a href="{{route('touristicAttraction.show',$safari['uuid'])}}" class="safari_link"
                                       data-toggle="tooltip" data-placement="top"
                                       data-attraction-id="{{$safari['name']}}" style="color: dodgerblue"
                                       title="{{$safari['description']}}">{{$safari['name']}}</a>,
                                @endforeach
                            </p>
                            <p>
                                <b>Time range for support</b>:
                                {{$tourOperatorOperatingAround->support_time_range}}
                            </p>

                            <div class="text-center mt-3">
                                <a href="#" class="btn btn-primary btn-sm" onclick="openTourCompanyWebsite('{{$tourOperatorOperatingAround->website_url}}')">
                                    Preview website <span class="ml-1">&blacktriangleright;</span>
                                </a>
                            </div>
                            <div class="d-flex justify-content-center" style="padding: 10px 10px 10px 10px">
                                <div class="text-center">
                                    <a href="{{ route('tourOperator.publicView', $tourOperatorOperatingAround->uuid) }}" class="btn btn-primary btn-sm">Packages posted &blacktriangleright;</a>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('customTourBookings.create', $tourOperatorOperatingAround->uuid) }}" class="btn btn-primary btn-sm" style="margin-left: 10px">Request custom tour &blacktriangleright;</a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <a href="{{$tourOperatorOperatingAround->instagram_url}}" target="_blank" class="mx-2">
                                    <i class="fab fa-instagram fa-2x" style="color: #E4405F;"></i>
                                </a>
                                <a href="{{$tourOperatorOperatingAround->whatsapp_url}}" target="_blank" class="mx-2">
                                    <i class="fab fa-whatsapp fa-2x" style="color: #25D366;"></i>
                                </a>
                                <a href="mailto:{{$tourOperatorOperatingAround->email_address}}" target="_blank" class="mx-2">
                                    <i class="fas fa-envelope fa-2x" style="color: #007BFF;"></i>
                                </a>
                                <a href="{{$tourOperatorOperatingAround->gps_url}}" target="_blank" class="mx-2">
                                    <i class="fas fa-map-marker-alt fa-2x" style="color: #EA4335;"></i>
                                </a>
                                <a href="{{$tourOperatorOperatingAround->website_url}}" target="_blank" class="mx-2">
                                    <i class="fas fa-globe fa-2x" style="color: #007BFF;"></i>
                                </a>
                                <a href="tel:{{$tourOperatorOperatingAround->phone_number}}" class="mx-2">
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
                @empty
                    <p style="padding-left: 20px;background-color: rgba(30,144,255,0.2);border-left: 2px solid red">
                        Whoops!Seems we have an error on our end. We are working had to get it fixed</p>
                @endforelse
                <div class="row pull-right" style="margin-top: 20px;margin-bottom: 20px">
                    <div class="text-center">
                        <a href="#" class="btn btn-primary btn-sm" style="margin-left: 10px">More? &blacktriangledown;</a>
                    </div>
                </div>
            </div>

        </div>
    @endguest
@endsection
@push('after-scripts')
    <script>
        function openTourCompanyWebsite(url) {
            document.getElementById('websiteIframe').src = url;
            $('#tourCompanyWebsiteModal').modal('show');
        }
    </script>
@endpush
