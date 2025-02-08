@extends('layouts.main', ['title' => trans('Manage Tour Package Bookings'), 'header' => trans('Manage Tour Package Bookings')])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-responsive-md">
                    <thead>
                    <tr>
                        <th>@lang('Tourist name')</th>
                        <th>@lang('Email address')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($tourPackageBookings) && $tourPackageBookings->count())
                        @foreach($tourPackageBookings as $tourPackageBooking)
                            <td>{{$tourPackageBooking->tourist_name}}</td>
                            <td>{{$tourPackageBooking->tourist_email_address}}</td>
                        @endforeach
                    @else
                    <span>No results found</span>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

