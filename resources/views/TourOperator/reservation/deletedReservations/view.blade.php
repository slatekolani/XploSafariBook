@extends('layouts.main', ['title' => __("Deleted reservation - " . $tourOperatorReservation->reservation_name), 'header' => __('Deleted reservation - ' . $tourOperatorReservation->reservation_name)])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-warning btn-sm'  href="{{route('tourOperatorReservation.restoreDeletedReservation',$tourOperatorReservation->uuid)}}">Restore reservation</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">

                            <tr>
                                <th>Reservation name</th>
                                <td>{{$tourOperatorReservation->reservation_name}}</td>
                            </tr>
                            <tr>
                                <th>Reservation capacity</th>
                                <td>{{$tourOperatorReservation->reservation_capacity}}</td>
                            </tr>
                            <tr>
                                <th>Reservation url</th>
                                <td><a href="{{$tourOperatorReservation->reservation_url}}">Reservation url</a></td>
                            </tr>
                            <tr>
                                <th>Region found</th>
                                <td>{{$tourOperatorReservation->tanzaniaRegion->region_name}}</td>
                            </tr>
                            <tr>
                                @forelse(explode(',', $tourOperatorReservation->reservation_images) as $index => $image)
                                    <div class="gallery-item">
                                        <a data-fancybox="gallery" data-caption="{{$tourOperatorReservation->reservation_name}}, {{ $tourOperatorReservation->reservation_capacity }}" href="{{ asset('public/'.$image) }}">
                                            <img src="{{ asset('public/'.$image) }}" loading="lazy" alt="Gallery Image">
                                        </a>
                                    </div>
                                @empty
                                    <p>No image found!</p>
                                @endforelse
                            </tr>
                            <tr>
                                <th>Facilities</th>
                            </tr>

                            @forelse($tourOperatorReservationFacilities as $tourOperatorReservationFacility)
                                <tr>
                                    <td>{{$tourOperatorReservationFacility->facility_name}}</td>
                                    <td>{{$tourOperatorReservationFacility->facility_description}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">No facilities available</td>
                                </tr>
                            @endforelse
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($tourOperatorReservation->status==1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


