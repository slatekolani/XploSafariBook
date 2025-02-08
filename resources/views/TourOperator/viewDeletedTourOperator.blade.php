@extends('layouts.main', ['title' => __("Deleted Tour company"), 'header' => __('Deleted Tour company')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Company logo</th>
                                <td><a href="{{asset('public/TourOperatorsLogos/'.$tourOperator->company_logo)}}" target="_blank"><img src="{{asset('public/TourOperatorsLogos/'.$tourOperator->company_logo)}}" style="width:100%;height: 100%;"></a></td>
                            </tr>
                            <tr>
                                <th>Registration date</th>
                                <td>{{date('jS M Y H:m:s a',strtotime($tourOperator->created_at))}}</td>
                            </tr>
                            <tr>
                                <th>Established date</th>
                                <td>{{date('jS M Y H:m:s a',strtotime($tourOperator->established_date))}}</td>
                            </tr>
                            <tr>
                                <th>Total employees</th>
                                <td>{{number_format($tourOperator->total_employees)}}</td>
                            </tr>

                            <tr>
                                <th>Company name</th>
                                <td>{{$tourOperator->company_name}}</td>
                            </tr>
                            <tr>
                                <th>About</th>
                                <td>{{$tourOperator->about_company}}</td>
                            </tr>
                            <tr>
                                <th>Email address</th>
                                <td>{{$tourOperator->email_address}}</td>
                            </tr>
                            <tr>
                                <th>Phone number</th>
                                <td>{{$tourOperator->phone_number}}</td>
                            </tr>
                            <tr>
                                <th>Company nation</th>
                                <td>{{$tourOperator->nation->nation_name}}</td>
                            </tr>
                            <tr>
                                <th>Registration Certification</th>
                                <td><a href="{{asset('public/VerificationCertificates/'.$tourOperator->verification_certificate)}}" target="_blank">Certification for tour operation</a></td>
                            </tr>
                            <tr>
                                <th>TATO Membership Certification</th>
                                <td><a href="{{asset('public/membershipCertificates/'.$tourOperator->tato_membership_certificate)}}" target="_blank">Certification for tour operation</a></td>
                            </tr>
                            <tr>
                                <th>Support range time</th>
                                <td>{{$tourOperator->support_time_range}}</td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td><a href="{{$tourOperator->website_url}}">{{$tourOperator->website_url}}</a></td>
                            </tr>
                            <tr>
                                <th>Instagram</th>
                                <td><a href="{{$tourOperator->instagram_url}}">{{$tourOperator->instagram_url}}</a></td>
                            </tr>
                            <tr>
                                <th>WhatsApp</th>
                                <td><a href="{{$tourOperator->whatsapp_url}}">{{$tourOperator->whatsapp_url}}</a></td>
                            </tr>
                            <tr>
                                <th>Geographic position (GPS)</th>
                                <td><a href="{{$tourOperator->gps_url}}">{{$tourOperator->gps_url}}</a></td>
                            </tr>
                            <tr>
                                <th>Company team image</th>
                                <td><a href="{{asset('public/CompaniesTeamImage/'.$tourOperator->company_team_image)}}" target="_blank"><img src="{{asset('public/CompaniesTeamImage/'.$tourOperator->company_team_image)}}" style="width: 100%;height: 100%"></a></td>
                            </tr>
                            <tr>
                                <th>Company Terms and Conditions</th>
                                <td><a href="{{asset('public/companyTermsAndConditions/'.$tourOperator->terms_and_conditions)}}" target="_blank">Terms and Conditions</a></td>
                            </tr>
                            <tr>
                                <th>Regions of Operation</th>
                                <td>
                                    @foreach ($tourOperator->TourOperatorRegionsOfOperationLabel as $region)
                                        <a href="{{route('tanzaniaRegion.publicView',$region['uuid'])}}" class="region-link" data-toggle="tooltip" data-placement="top"
                                           data-attraction-id="{{ $region['name'] }}" style="color: dodgerblue"
                                           title="{{ $region['description'] }}">{{ $region['name'] }}</a>,
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Safari preferences</th>
                                <td>
                                    @foreach($tourOperator->TourOperatorSafariPreferencesLabel as $safari)
                                        <a href="{{route('touristicAttraction.show',$safari['uuid'])}}" class="safari_link" data-toggle="tooltip" data-placement="top"
                                           data-attraction-id="{{$safari['name']}}" style="color: dodgerblue"
                                           title="{{$safari['description']}}">{{$safari['name']}}</a>,
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Insurances provided</th>
                                <td>
                                    @foreach($tourOperator->TourOperatorTourInsuranceTypesLabel as $insurance)
                                        <a class="region_link" data-toggle="tooltip" data-placement="top"
                                           data-attraction-id="{{$insurance['name']}}" style="color: dodgerblue"
                                           title="{{ $insurance['description'] }}">{{ $insurance['name'] }}</a>,
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Company status</th>
                                @if($tourOperator->status==1)
                                    <td><span class="badge badge-success">Active</span></td>
                                @else
                                    <td><span class="badge badge-warning">Inactive</span></td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


