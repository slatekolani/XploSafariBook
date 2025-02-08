@extends('layouts.main', ['title' => __('Local tour package for ' . $localTourPackage->touristicAttraction->attraction_name), 'header' => __('Local Tour Package')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('localTourPackages.edit',$localTourPackage->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Safari name</th>
                                <td>{{$localTourPackage->touristicAttraction->attraction_name}}</td>
                            </tr>
                            <tr>
                                <th>Safari description</th>
                                <td>{{$localTourPackage->safari_description}}</td>
                            </tr>
                            <tr>
                                <th>Phone number</th>
                                <td>{{$localTourPackage->phone_number}}</td>
                            </tr>
                            <tr>
                                <th>Trip Kind</th>
                                <td>{{$localTourPackage->trip_kind}}</td>
                            </tr>
                            <tr>
                                <th>Package range</th>
                                <td>{{$package_range[$localTourPackage->package_range]}}</td>
                            </tr>
                            <tr>
                                <th>Free of charge age</th>
                                <td>{{$localTourPackage->free_of_charge_age}} yrs</td>
                            </tr>
                            <tr>
                                <th>Payment Deadline</th>
                                <td>{{ date('jS M Y', strtotime($localTourPackage->payment_deadline))}}</td>
                            </tr>
                            <tr>
                                <th>Email address</th>
                                <td>{{$localTourPackage->email_address}}</td>
                            </tr>
                            <tr>
                                <th>Maximum travellers</th>
                                <td>{{$localTourPackage->maximum_travellers}} people</td>
                            </tr>
                            <tr>
                                <th>Trip price adult residents</th>
                                <td>T Shs {{number_format($localTourPackage->trip_price_adult_tanzanian)}}</td>
                            </tr>
                            <tr>
                                <th>Trip price child residents</th>
                                <td>T Shs {{number_format($localTourPackage->trip_price_child_tanzanian)}}</td>
                            </tr>
                            <tr>
                                <th>Trip price adult foreigner</th>
                                <td>T Shs {{number_format($localTourPackage->trip_price_adult_foreigner)}}</td>
                            </tr>
                            <tr>
                                <th>Trip price child foreigner</th>
                                <td>T Shs {{number_format($localTourPackage->trip_price_child_foreigner)}}</td>
                            </tr>
                            <tr>
                                <th>Safari start date</th>
                                <td>{{date('jS M Y',strtotime($localTourPackage->safari_start_date))}}</td>
                            </tr>
                            <tr>
                                <th>Safari end date</th>
                                <td>{{date('jS M Y',strtotime($localTourPackage->safari_end_date))}}</td>
                            </tr>
                            <tr>
                                <th>Targeted event</th>
                                <td>{{$localTourPackage->tanzaniaAndWorldEvent->event_name}}</td>
                            </tr>
                            <tr>
                                <th>Travel age range</th>
                                <td>{{$localTourPackage->travel_age_range}}</td>
                            </tr>
                            <tr>
                                <th>Tour package type</th>
                                <td>{{$localTourPackage->tourPackageType->tour_package_type_name}}</td>
                            </tr>
                            <tr>
                                <th>Tour type</th>
                                <td>{{$localTourPackage->tourType->tour_type_name}}</td>
                            </tr>
                            <tr>
                                <th>Activities included</th>
                                @forelse($localTourPackageActivities as $localTourPackageActivity)
                                    <td>{{$localTourPackageActivity->activity_name}} - </td>
                                    <td>{{$localTourPackageActivity->activity_description}}</td>
                                @empty
                                    <td>No data found</td>
                                @endforelse
                            </tr>
                            <tr>
                                <th>Requirements</th>
                                @forelse($localTourPackageRequirements as $localTourPackageRequirement)
                                    <td>{{$localTourPackageRequirement->requirement_name}}</td>
                                    <td>{{$localTourPackageRequirement->requirement_description}}</td>
                                @empty
                                    <td>No data found</td>
                                @endforelse
                            </tr>
                            <tr>
                                <th>Price inclusive</th>
                                @forelse($localTourPackagePriceInclusives as $localTourPackagePriceInclusive)
                                    <td>{{$localTourPackagePriceInclusive->item}}</td>
                                @empty
                                    <td>No data found</td>
                                @endforelse
                            </tr>
                            <tr>
                                <th>Price exclusive</th>
                                @forelse($localTourPackagePriceExclusives as $localTourPackagePriceExclusive)
                                    <td>{{$localTourPackagePriceExclusive->item}}</td>
                                @empty
                                    <td>No data found</td>
                                @endforelse
                            </tr>
                            <tr>
                                <th>Special needs supported</th>
                                <td>
                                    @forelse ($localTourPackage->LocalTourPackageSpecialNeedsLabel as $specialNeeds)
                                    <i class="{{$specialNeeds['special_need_icon']}}" style="font-size:20px;color:dodgerblue"></i> {{$specialNeeds['special_need_name']}}
                                    @empty
                                    No Special attention listed!  
                                    @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th>Transport used</th>
                                <td>
                                    @forelse ($localTourPackage->LocalTourPackageTransportsLabel as $transports)
                                    <i class="{{$transports['transport_icon']}}" style="font-size:20px;color:dodgerblue"></i> {{ $transports['transport_name'] }}
                                    @empty
                                    No transport listed!  
                                    @endforelse
                                </td>   
                            </tr>
                            <tr>
                                <th>Customer Satisfaction Category</th>
                                <td>
                                    @forelse ($localTourPackage->LocalTourPackageCustomerSatisfactionLabel as $customerSatisfactions)
                                        &rightarrow;<span style="font-weight:bolder">{{ $customerSatisfactions['customer_satisfaction_name'] }}</span>
                                        &dot;&dot;<span style="color: dodgerblue">{{ $customerSatisfactions['customer_satisfaction_description'] }}</span>
                                    @empty
                                    
                                    @endforelse
                                </td>
                                
                            </tr>
                            <tr>
                                <th>Collection stops</th>
                            </tr>
                            @forelse($localTourPackageCollectionStops as $localTourPackageCollectionStop)
                                <tr>
                                    <td>{{$localTourPackageCollectionStop->collection_stop_name}}</td>
                                    <td>T Shs {{$localTourPackageCollectionStop->collection_stop_price}}</td>
                                    <td>{{$localTourPackageCollectionStop->pick_up_time}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No data found</td>
                                </tr>
                            @endforelse
                            <tr>
                                <th>Reservation Included in this safari</th>
                                <td>
                                    @forelse ($localTourPackage->LocalTourPackageReservationsLabel as $reservations)
                                        {{$reservations['reservation_name']}} ~ 
                                        {{$reservations['reservation_capacity']}} ~ 
                                        <a href="{{$reservations['reservation_url']}}">{{$reservations['reservation_url']}}</a>                                
                                    @empty
                                        <p>No Reservation Listed!</p>
                                    @endforelse
                                </td>
                                
                            </tr>
                            <tr>
                                <th>Number of views expected</th>
                                <td>{{$localTourPackage->number_of_views_expecting}} Views</td>
                            </tr>
                            <tr>
                                <th>Starting Payment Percent</th>
                                <td>{{$localTourPackage->payment_start_percent}}%</td>
                            </tr>
                            <tr>
                                <th>Cancellation Due Date</th>
                                <td>{{date('jS M Y',strtotime($localTourPackage->cancellation_due_date))}}</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>{{$localTourPackage->discount_offered}}%</td>
                            </tr>
                            <tr>
                                <th>Cancellation Policy</th>
                                <td>{{$localTourPackage->cancellation_policy}}</td>
                            </tr>
                            <tr>
                                <th>Emergency Handling </th>
                                <td>{{$localTourPackage->emergency_handling}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                @if($localTourPackage->status==1)
                                    <td><span class="badge badge-success badge-pill">Approved</span></td>
                                @else
                                    <td><span class="badge badge-danger badge-pill">Unapproved</span></td>
                                @endif
                            </tr>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



