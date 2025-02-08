<?php

namespace App\Http\Controllers;

use App\Models\customerSatisfactionCategory\customerSatisfactionCategory;
use App\Models\Nations\nations;
use App\Models\tanzaniaAndWorldEvents\tanzaniaAndWorldEvents;
use App\Models\tanzaniaRegions\regionCulture\tanzaniaRegionCulture;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\touristicActivities\touristicActivities;
use App\Models\TouristicAttractions\category\touristicAttractionCategory;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\touristicGames\touristicGame;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Models\tourPackageType\tourPackageType;
use App\Models\TourTypes\tourTypes;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localTourPackages=localTourPackages::query()->where('status','=',1)
            ->with('touristicAttraction','tourOperator')
            ->where('safari_start_date','>=',Carbon::now())
            ->orderBy('created_at','desc')
            ->take(3)
            ->inRandomOrder()
            ->get();
        $localTourPackageReservationsIds=DB::table('local_package_reservation')->pluck('local_tour_package_id');
        $reservationLocalTourPackages=localTourPackages::query()
            ->whereIn('id',$localTourPackageReservationsIds)
            ->where('safari_start_date','>=',Carbon::now())
            ->take(3)
            ->inRandomOrder()
            ->get();
        $touristicAttractions=touristicAttractions::query()
            ->where('status','=',1)
            ->orderBy('id','desc')
            ->take(3)
            ->inRandomOrder()
            ->get();
        $regions=tanzaniaRegions::query()
            ->where('status','=',1)
            ->orderBy('id','desc')
            ->take(3)
            ->inRandomOrder()
            ->get();
        $cultures=tanzaniaRegionCulture::query()
            ->with('tanzaniaRegion')
            ->orderBy('id','desc')
            ->take(3)
            ->inRandomOrder()
            ->get();
        $nation=nations::query()->where('status','=',1)->first();
        $touristicGames=touristicGame::query()->where('status','=',1)->orderBy('id','DESC')->take(4)->inRandomOrder()->get();
        $events=tanzaniaAndWorldEvents::query()->where('status','=',1)->orderBy('id','DESC')->take(4)->inRandomOrder()->get();
        $tourPackageTypes=tourPackageType::query()->where('status','=',1)->orderBy('id','DESC')->take(4)->inRandomOrder()->get();
        $customerSatisfactionCategories=customerSatisfactionCategory::query()->orderBy('id')->orderBy('id','DESC')->get();
        $tourTypes=tourTypes::query()->where('status','=',1)->orderBy('id','DESC')->get();
        $touristicAttractionCategories=touristicAttractionCategory::query()->orderBy('id','DESC')->get();
        $touristicActivities=touristicActivities::query()->orderBy('id','DESC')->get();
        return view('home')
            ->with('touristicActivities',$touristicActivities)
            ->with('reservationLocalTourPackages',$reservationLocalTourPackages)
            ->with('customerSatisfactionCategories',$customerSatisfactionCategories)
            ->with('tourTypes',$tourTypes)
            ->with('touristicAttractionCategories',$touristicAttractionCategories)
            ->with('tourPackageTypes',$tourPackageTypes)
            ->with('events',$events)
            ->with('nation',$nation)
            ->with('cultures',$cultures)
            ->with('touristicGames',$touristicGames)
            ->with('regions',$regions)
            ->with('localTourPackages',$localTourPackages)
            ->with('touristicAttractions',$touristicAttractions);
    }
}
