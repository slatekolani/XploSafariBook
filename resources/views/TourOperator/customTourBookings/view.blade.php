@extends('layouts.main', ['title' => __("Custom Tour Booking"), 'header' => __('Custom Tour Booking')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" >
                <a class ='btn btn-primary btn-sm'  href="{{route('customTourBookings.edit',$customTourBooking->uuid)}}" style="margin-bottom:10px ">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Booking Date and Time</th>
                                <td>{{date('jS M Y, H:m:s',strtotime($customTourBooking->created_at))}}</td>
                            </tr>
                            <tr>
                                <th>Company Booked</th>
                                <td>{{$customTourBooking->tourOperator->company_name}}</td>
                            </tr>
                            <tr>
                                <th>Tourist Name</th>
                                <td>{{$customTourBooking->tourist_name}}</td>
                            </tr>
                            <tr>
                                <th>Email Address</th>
                                <td>{{$customTourBooking->tourist_email_address}}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{$customTourBooking->tourist_phone_number}}</td>
                            </tr>
                            <tr>
                                <th>Region</th>
                                <td>{{$customTourBooking->region->region_name}}</td>
                            </tr>
                            <tr>
                                <th>Total Adult Foreigner Travellers</th>
                                <td>{{$customTourBooking->total_adult_foreigners}}</td>
                            </tr>
                            <tr>
                                <th>Total Children Foreigner Travellers</th>
                                <td>{{$customTourBooking->total_children_foreigners}}</td>
                            </tr>
                            <tr>
                                <th>Total Adult Resident Travellers</th>
                                <td>{{$customTourBooking->total_adult_residents}}</td>
                            </tr>
                            <tr>
                                <th>Total Children Resident Travellers</th>
                                <td>{{$customTourBooking->total_children_residents}}</td>
                            </tr>
                            <tr>
                                <th>Tour type</th>
                                <td>{{$customTourBooking->tourType->tour_type_name}}</td>
                            </tr>
                            <tr>
                                <th>Tour package type</th>
                                <td>{{$customTourBooking->tourPackageType->tour_package_type_name}}</td>
                            </tr>
                            <tr>
                                <th>Transport type</th>
                                <td>{{$customTourBooking->transportType->transport_name}}</td>
                            </tr>
                            <tr>
                                <th>Tour Duration</th>
                                <td>{{$customTourBooking->CustomTourDurationLabel}} days</td>
                            </tr>
                            <tr>
                                <th>Countdown Days to Safari</th>
                                <td>{{$customTourBooking->CountDownDaysForACustomTourLabel}} days</td>
                            </tr>
                            <tr>
                                <th>Start Date</th>
                                <td>{{date('jS M Y',strtotime($customTourBooking->start_date))}}</td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td>{{date('jS M Y',strtotime($customTourBooking->end_date))}}</td>
                            </tr>
                            <tr>
                                <th>Is Expired?</th>
                                <td>
                                    @if ($customTourBooking->CountDownDaysForACustomTourLabel>=1)

                                     <span class="badge badge-primary">No</span>

                                    @elseif ($customTourBooking->CountDownDaysForACustomTourLabel==0)

                                     <span class="badge badge-info">Expired today</span>

                                    @else

                                      <span class="badge badge-danger">Yes</span>

                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Visit Places</th>
                                @foreach ($customTourBooking->CustomTourBookingTouristAttractionLabel as $attraction)
                                    <td> {{$attraction['attraction_name']}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>Reservation required?</th>
                                <td>
                                    @if($customTourBooking->reservation_needed==0)
                                        <span class="badge badge-info">No</span>
                                    @else
                                        <span class="badge badge-success">Yes</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Special need description</th>
                                <td>{{$customTourBooking->special_need_description}}</td>
                            </tr>
                            <tr>
                                <th>Allocated reservation per attraction selected</th>
                                @forelse($customTourBookingReservations as $customTourBookingReservation)
                                    <tr>
                                    <td><span style="color: dodgerblue;font-weight: bolder">{{$customTourBookingReservation->touristicAttraction->attraction_name}}</span></td>
                                        <td><span style="color: dodgerblue;font-weight: bolder">{{$customTourBookingReservation->tourOperatorReservation->reservation_name}}</span></td>
                                    </tr>
                                @empty
                                    <span>No allocated reservation per attraction were selected</span>
                                @endforelse
                            </tr>
                            <tr>
                                <th>Tour price</th>
                                <td>T shs {{number_format($customTourBooking->tour_price)}}</td>
                            </tr>
                            <tr>
                                <th>Message</th>
                                <td>{{$customTourBooking->message}}</td>
                            </tr>
                            <tr>
                                <th>Booking Status</th>
                                @if($customTourBooking->status==1)
                                    <td><span class="badge badge-success">Approved</span></td>
                                @else
                                    <td><span class="badge badge-info">Un Approved</span></td>
                                @endif
                            </tr>
                        </table>
                        <a href="mailto:{{$customTourBooking->tourist_email_address}}" style="float: right" class="btn btn-primary btn-sm">Send Mail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


