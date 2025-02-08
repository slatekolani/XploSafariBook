<?php

namespace App\Http\Controllers\aboutTanzania;

use App\Http\Controllers\Controller;
use App\Models\aboutTanzania\FAQ\tanzaniaFAQ;
use App\Models\aboutTanzania\tanzaniaVisitAdvice\tanzaniaVisitAdvice;
use App\Models\customerSatisfactionCategory\customerSatisfactionCategory;
use App\Models\Nations\economicActivity\nationEconomicActivity;
use App\Models\Nations\nations;
use App\Models\Nations\Precaution\nationPrecautions;
use App\Models\tanzaniaAndWorldEvents\tanzaniaAndWorldEvents;
use App\Models\tanzaniaRegions\regionCulture\tanzaniaRegionCulture;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\tourInsuranceTypes\tourInsuranceTypes;
use App\Models\TouristicAttractions\category\touristicAttractionCategory;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TouristicAttractions\touristicAttractionVisitAdvices;
use App\Models\touristicGames\touristicGame;
use App\Models\TourOperator\reservations\reservationFacilities\tourOperatorReservationFacility;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Models\tourPackageType\tourPackageType;
use App\Models\TourTypes\tourTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TanzaniaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nationUuid)
    {
        $touristicAttractions = touristicAttractions::query()->where('status', '=', 1)->get();
        $touristicAttractionCategories=touristicAttractionCategory::query()->orderBy('id','DESC')->get();
        $regions=tanzaniaRegions::query()->where('status','=',1)->get();
        $cultures=tanzaniaRegionCulture::query()->orderBy('culture_name')->get();
        $nation=nations::query()->where('uuid',$nationUuid)->first();
        $nationEconomicActivities=nationEconomicActivity::query()->where('nation_id',$nation->id)->get();
        $nationNecessaryPrecautions=nationPrecautions::query()->where('nation_id',$nation->id)->get();
        $insuranceTypes=tourInsuranceTypes::query()->where('status','=',1)->get();
        $customerSatisfactionCategories=customerSatisfactionCategory::query()->orderBy('id')->get();
        $tourVisitAdvices=tanzaniaVisitAdvice::query()->where('nation_id',$nation->id)->get();
        $aboutTanzaniaFaqs=tanzaniaFAQ::query()->where('nation_id',$nation->id)->get();
        $localTourPackageReservationsIds=DB::table('local_package_reservation')->pluck('local_tour_package_id');
        $reservationLocalTourPackages=localTourPackages::query()->whereIn('id',$localTourPackageReservationsIds)->where('safari_start_date','>=',Carbon::now())->get();
        $touristicGames=touristicGame::query()->where('status','=',1)->get();
        $reservationTouristicGamesIds=DB::table('reservation_touristic_game')->where('tour_operator_reservation_id')->pluck('touristic_game_id');
        $reservationTouristicGames=touristicGame::query()->whereIn('id',$reservationTouristicGamesIds)->get();
        $tanzaniaEvents=tanzaniaAndWorldEvents::query()->where('status','=',1)->orderBy('id','DESC')->get();
        $tourTypes=tourTypes::query()->where('status','=',1)->get();
        $tourPackageTypes=tourPackageType::query()->where('status','=',1)->get();
        return view('AboutTanzania.details')
            ->with('tourPackageTypes',$tourPackageTypes)
            ->with('tourTypes',$tourTypes)
            ->with('touristicAttractionCategories',$touristicAttractionCategories)
            ->with('touristicGames',$touristicGames)
            ->with('tanzaniaEvents',$tanzaniaEvents)
            ->with('reservationTouristicGames',$reservationTouristicGames)
            ->with('reservationLocalTourPackages',$reservationLocalTourPackages)
            ->with('aboutTanzaniaFaqs',$aboutTanzaniaFaqs)
            ->with('tourVisitAdvices',$tourVisitAdvices)
            ->with('insuranceTypes',$insuranceTypes)
            ->with('nation',$nation)
            ->with('customerSatisfactionCategories',$customerSatisfactionCategories)
            ->with('nationEconomicActivities',$nationEconomicActivities)
            ->with('nationNecessaryPrecautions',$nationNecessaryPrecautions)
            ->with('cultures',$cultures)
            ->with('regions',$regions)
            ->with('touristicAttractions',$touristicAttractions);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
