@extends('layouts.main', ['title' => __('Deleted Local tour booking for ' . $localTourBooking->tourist_name), 'header' => __('Deleted Local tour booking')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-warning btn-sm'  href="{{route('localTourBooking.restore',$localTourBooking->uuid)}}">Restore</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Tourist name</th>
                                <td>{{$localTourBooking->tourist_name}}</td>
                            </tr>
                            <tr>
                                <th>Phone number</th>
                                <td>{{$localTourBooking->phone_number}}</td>
                            </tr>
                            <tr>
                                <th>Email address</th>
                                <td>{{$localTourBooking->email_address}}</td>
                            </tr>
                            <tr>
                                <th>Total children foreigners</th>
                                <td>{{number_format($localTourBooking->total_number_foreigner_child)}}</td>
                            </tr>
                            <tr>
                                <th>Total adults foreigners</th>
                                <td>{{number_format($localTourBooking->total_number_foreigner_adult)}}</td>
                            </tr>
                            <tr>
                                <th>Total children residents</th>
                                <td>{{number_format($localTourBooking->total_number_local_child)}}</td>
                            </tr>
                            <tr>
                                <th>Total adults residents</th>
                                <td>{{number_format($localTourBooking->total_number_local_adult)}}</td>
                            </tr>
                            <tr>
                                <th>Pick up station</th>
                                <td>{{(\App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageCollectionStops\localTourPackageCollectionStops::find($localTourBooking->collection_station)->collection_stop_name)}}</td>
                            </tr>
                            <tr>
                                <th>Message</th>
                                <td>{{$localTourBooking->message}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                @if($localTourBooking->status==1)
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


