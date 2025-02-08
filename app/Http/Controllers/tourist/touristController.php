<?php

namespace App\Http\Controllers\tourist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTripCancellation\localTourPackageCancelledbookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class touristController extends Controller
{
    public function userManual()
    {
        return view('Tourist.overviewDashboard.UserManual.manual');
    }
    public function bookingsMadeByTourist()
    {

        $upcomingTrips = localTourPackageBookings::query()
        ->where('user_id', Auth::user()->uuid)
        ->whereHas('localTourPackages', function ($query) {
            $query->where('safari_start_date', '>', Carbon::now());
        })
        ->with('localTourPackages') 
        ->paginate(10);

        $completedTrips=localTourPackageBookings::query()
        ->where('user_id',Auth::user()->uuid)
        ->whereHas('localTourPackages', function ($query) {
            $query->where('safari_start_date', '<', Carbon::now());
        })
        ->with('localTourPackages') 
        ->paginate(10);

        return view('Tourist.LocalTripBookings.list')
            ->with('completedTrips',$completedTrips)
            ->with('upcomingTrips',$upcomingTrips);
    }
    public function destinationTravelledbyUser()
    {
        $fourWeeksAgo=Carbon::now()->subWeeks(4);
        $localTourBookingsMadeByUser=localTourPackageBookings::query()
        ->where('user_id',Auth::user()->uuid)->where('status','=',1)->pluck('local_tour_package_id');
        $recentDestinationTravelledIds=localTourPackages::query()
        ->where('safari_start_date','>=',$fourWeeksAgo)
        ->whereIn('id',$localTourBookingsMadeByUser)
        ->pluck('safari_name');
        $allDestinationTravelledIds=localTourPackages::query()
        ->whereIn('id',$localTourBookingsMadeByUser)
        ->pluck('safari_name');
        $recentDestinationsTravelled=touristicAttractions::query()
        ->whereIn('id',$recentDestinationTravelledIds)->get(['attraction_name','uuid']);
        $allDestinationsTravelled=touristicAttractions::query()
        ->whereIn('id',$allDestinationTravelledIds)->get(['attraction_name','uuid']);
        return view('Tourist.destinationTravelled.list')
        ->with('allDestinationsTravelled',$allDestinationsTravelled)
        ->with('recentDestinationsTravelled',$recentDestinationsTravelled);
    }
}
