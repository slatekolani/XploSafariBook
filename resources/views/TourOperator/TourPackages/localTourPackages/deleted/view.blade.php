@extends('layouts.main', ['title' => __('Deleted ocal tour package for ' . \App\Models\TouristicAttractions\touristicAttractions::find($localTourPackage->safari_name)->attraction_name), 'header' => __('Deleted local Tour Package')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Safari name</th>
                                <td>{{\App\Models\TouristicAttractions\touristicAttractions::find($localTourPackage->safari_name)->attraction_name}}</td>
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
                                <th>Email address</th>
                                <td>{{$localTourPackage->email_address}}</td>
                            </tr>
                            <tr>
                                <th>Maximum travellers</th>
                                <td>{{$localTourPackage->maximum_travellers}}</td>
                            </tr>
                            <tr>
                                <th>Trip price adult residents</th>
                                <td>{{number_format($localTourPackage->trip_price_adult_tanzanian)}}</td>
                            </tr>
                            <tr>
                                <th>Trip price child residents</th>
                                <td>{{number_format($localTourPackage->trip_price_child_tanzanian)}}</td>
                            </tr>
                            <tr>
                                <th>Trip price adult foreigner</th>
                                <td>{{number_format($localTourPackage->trip_price_adult_foreigner)}}</td>
                            </tr>
                            <tr>
                                <th>Trip price child foreigner</th>
                                <td>{{number_format($localTourPackage->trip_price_child_foreigner)}}</td>
                            </tr>
                            <tr>
                                <th>Safari start date</th>
                                <td>{{$localTourPackage->safari_start_date}}</td>
                            </tr>
                            <tr>
                                <th>Safari end date</th>
                                <td>{{$localTourPackage->safari_end_date}}</td>
                            </tr>
                            <tr>
                                <th>targeted event</th>
                                <td>{{\App\Models\tanzaniaAndWorldEvents\tanzaniaAndWorldEvents::find($localTourPackage->targeted_event)->event_name}}</td>
                            </tr>
                            <tr>
                                <th>Tour package type</th>
                                <td>{{\App\Models\tourPackageType\tourPackageType::find($localTourPackage->tour_package_type_name)->tour_package_type_name}}</td>
                            </tr>
                            <tr>
                                <th>Tour type</th>
                                <td>{{\App\Models\TourTypes\tourTypes::find($localTourPackage->local_tour_type)->tour_type_name}}</td>
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
                                <td>{{$localTourPackage->LocalTourPackageSpecialNeedsLabel}}</td>
                            </tr>
                            <tr>
                                <th>Transport used</th>
                                <td>{{$localTourPackage->LocalTourPackageTransportsLabel}}</td>
                            </tr>
                            <tr>
                                <th>Collection stops</th>
                            </tr>
                            @forelse($localTourPackageCollectionStops as $localTourPackageCollectionStop)
                                <tr>
                                    <td>{{$localTourPackageCollectionStop->collection_stop_name}}</td>
                                    <td>{{$localTourPackageCollectionStop->collection_stop_price}}</td>
                                    <td>{{$localTourPackageCollectionStop->pick_up_time}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No data found</td>
                                </tr>
                            @endforelse
                            <tr>
                                <th>Discount</th>
                                <td>{{$localTourPackage->discount_offered}}</td>
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


