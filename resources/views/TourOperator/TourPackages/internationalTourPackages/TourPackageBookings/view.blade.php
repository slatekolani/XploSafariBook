@extends('layouts.main', ['title' => __("Tour Package"), 'header' => __('Tour Package')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" >
                <a class ='textWhite'  href="{{route('tourPackageBookings.edit',$tourPackageBooking->uuid)}}"  ><i class="fas fa-pencil-alt"></i>&nbsp;{{ trans(' Edit booking') }}</a>&nbsp;&nbsp;
                <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Booking Date and Time</th>
                                <td>{{date('jS M Y, H:m:s',strtotime($tourPackageBooking->created_at))}}</td>
                            </tr>
                            <tr>
                                <th>Tourist Name</th>
                                <td>{{$tourPackageBooking->tourist_name}}</td>
                            </tr>
                            <tr>
                                <th>Email Address</th>
                                <td>{{$tourPackageBooking->tourist_email_address}}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{$tourPackageBooking->tourist_phone_number}}</td>
                            </tr>
                            <tr>
                                <th>Nationality</th>
                                <td>{{$tourPackageBooking->tourist_country}}</td>
                            </tr>
                            <tr>
                                <th>Total Adult Travellers</th>
                                <td>{{$tourPackageBooking->total_adult_travellers}}</td>
                            </tr>
                            <tr>
                                <th>Total Children Travellers</th>
                                <td>{{$tourPackageBooking->total_children_travellers}}</td>
                            </tr>
                            <tr>
                                <th>Tour Price</th>
                                @if($tourPackageBooking->tourist_country=='Tanzania')
                                    <td> {{number_format($tourPackageBooking->TourPriceTanzanianLabel)}} Shs</td>
                                @else
                                    <td> $ {{number_format($tourPackageBooking->TourPriceForeignerLabel)}} USD</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Message</th>
                                <td>{{$tourPackageBooking->message}}</td>
                            </tr>
                            <tr>
                                <th>Tour Duration</th>
                                <td>{{$tourPackageBooking->TotalDaysForTourLabel}} days</td>
                            </tr>
                            <tr>
                                <th>Booking Status</th>
                                @if($tourPackageBooking->status==1)
                                <td><span class="badge badge-success">Approved</span></td>
                                @else
                                <td><span class="badge badge-info">Un Approved</span></td>
                                @endif
                            </tr>
                        </table>
                        <a href="mailto:{{$tourPackageBooking->tourist_email_address}}" style="float: right" class="btn btn-primary btn-sm">Send Mail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


