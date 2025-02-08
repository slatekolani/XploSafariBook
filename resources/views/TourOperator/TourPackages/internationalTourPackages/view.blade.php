@extends('layouts.main', ['title' => __("Tour Package"), 'header' => __('Tour Package')])
@include('includes.validate_assets')
@section('content')

<div class="row">
    <div class="col-md-12" >
        <div class="pull-left" style="margin-bottom: 10px;">
            <a href="{{route('tourPackages.edit',$tourPackage->uuid)}}" style="font-size: 15px" class="btn btn-primary btn-sm"> Edit tour package &blacktriangleright;</a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-responsive-md">
                        <tr>
                            <th>Id</th>
                            <td>{{$tourPackage->id}}</td>
                        </tr>
                        <tr>
                            <th>Posted Time</th>
                            <td>{{date('jS M Y H:m:s a',strtotime($tourPackage->created_at))}}</td>
                        </tr>
                        <tr>
                            <th>Company posted</th>
                            <td>{{$tourPackage->tourOperator->company_name}}</td>
                        </tr>
                        <tr>
                            <th>Safari name</th>
                            <td>{{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_name}}</td>
                        </tr>
                        <tr>
                            <th>Safari description</th>
                            <td>{{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_description}}</td>
                        </tr>
                        <tr>
                            <th>Safari Trip description</th>
                            <td>{{$tourPackage->safari_package_description}}</td>
                        </tr>
                        <tr>
                            <th>Safari Price (Adult Tanzanian)</th>
                            <td>Tzs {{number_format($tourPackage->trip_price_adult_tanzanian)}}</td>
                        </tr>
                        <tr>
                            <th>Safari Price ( Child Tanzanian)</th>
                            <td>Tzs {{number_format($tourPackage->trip_price_child_tanzanian)}}</td>
                        </tr>
                        <tr>
                            <th>Safari Price ( Adult Foreigner)</th>
                            <td>$ {{number_format($tourPackage->trip_price_adult_foreigner)}}</td>
                        </tr>
                        <tr>
                            <th>Safari Price ( Child Foreigner)</th>
                            <td>$ {{number_format($tourPackage->trip_price_child_foreigner)}}</td>
                        </tr>
                        <tr>
                            <th>Safari start date</th>
                            <td>{{date('jS M Y',strtotime($tourPackage->safari_start_date))}}</td>
                        </tr>
                        <tr>
                            <th>Safari end date</th>
                            <td>{{date('jS M Y',strtotime($tourPackage->safari_end_date))}}</td>
                        </tr>
                        <tr>
                            <th>Special needs included in safari</th>
                            <td>{{$tourPackage->TourPackageSpecialNeedCategoryLabel}}</td>
                        </tr>
                        <tr>
                            <th>Transport included in safari</th>
                            <td>{{$tourPackage->TourPackageTransportLabel}}</td>
                        </tr>
                        <tr>
                            <th>Tour types included</th>
                            <td>{{$tourPackage->TourPackagesTourTypesLabel}}</td>
                        </tr>
                        <tr>
                            <th>Tour package features</th>
                            <td>
                                @if(!empty($tourPackageFeatures) && $tourPackageFeatures->count())
                                    @foreach($tourPackageFeatures as $tourPackageFeature)
                                        <div style="display:flex">
                                            <p> {{$tourPackageFeature->feature_name}} ~ </p>
                                            <p>{{$tourPackageFeature->feature_description}}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <span>No features available!</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tour package activities</th>
                            <td>
                                @if(!empty($tourPackageActivities) && $tourPackageActivities->count())
                                    @foreach($tourPackageActivities as $tourPackageActivity)
                                        <div style="display:flex">
                                            <p> {{$tourPackageActivity->activity_name}} ~ </p>
                                            <p>{{$tourPackageActivity->activity_description}}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <span>No activities listed! </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tour package trips</th>
                            <td>
                                @if(!empty($tourPackageTrips) && $tourPackageTrips->count())
                                    @foreach($tourPackageTrips as $tourPackageTrip)
                                        <div style="display:flex">
                                            <p>Day {{$tourPackageTrip->day_number}} ~ </p>
                                            <p>{{$tourPackageTrip->safari_trip_name}} ~</p>
                                            <p>{{$tourPackageTrip->safari_trip_description}}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <span>No activities listed! </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tour Package Accommodation</th>
                            <td>
                                @if(!empty($tourPackageAccommodations) && $tourPackageAccommodations->count())
                                    @foreach($tourPackageAccommodations as $tourPackageAccommodation)
                                        <div style="display: flex">
                                            <p> Day {{$tourPackageAccommodation->day_number}} ~ </p>
                                            <p style="color: dodgerblue;"> <a href="{{$tourPackageAccommodation->accommodation_link}}" target="_blank" style="color:black">{{$tourPackageAccommodation->accommodation_name}}</a> ~ </p>
                                            <p>{{$tourPackageAccommodation->accommodation_description}}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <span>No accommodations listed!</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Terms and Conditions</th>
                            <td><a href="{{asset('public/companyTermsAndConditions/'.$tourPackage->tourOperator->terms_and_conditions)}}" target="_blank">Click here</a></td>
                        </tr>
                        <tr>
                            <th>Poster Image</th>
                            <td><a href="{{asset('public/blogImages/'.$tourPackage->safari_poster)}}" target="_blank"><img src="{{asset('public/blogImages/'.$tourPackage->safari_poster)}}" style="width: 100px"></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


