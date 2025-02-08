<?php

namespace App\Http\Controllers\TouristicAttraction;

use App\Http\Controllers\Controller;
use App\Models\Nations\nations;
use App\Models\TouristicAttractions\attractionVisitReasons;
use App\Models\TouristicAttractions\FAQ\frequentAskedQuestions;
use App\Models\TouristicAttractions\touristAttractionFaq;
use App\Models\TouristicAttractions\touristicAttractionHoneyPoint\touristicAttractionHoneyPoints;
use App\Models\TouristicAttractions\touristicAttractionRules\touristicAttractionRules;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TouristicAttractions\touristicAttractionVisitAdvices;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class touristicAttractionController extends Controller
{
//    This controller is used to display touristic attraction details in public
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
    public function show($touristicAttractionId)
    {
        $touristicAttraction=touristicAttractions::query()->with('tanzaniaRegion')->where('uuid',$touristicAttractionId)->first();
        $years=range(date('Y'),1900);
        $establishmentYear=$touristicAttraction->establishment_year;
        $year=$years[$establishmentYear];
        $attractionId=$touristicAttraction->id;
        $spottedTourOperatorsId=DB::table('operator_touristic_attraction')->where('touristic_attraction_id',$attractionId)->pluck('tour_operator_id')->toArray();
        $spottedTourOperatorsList=tourOperator::whereIn('id',$spottedTourOperatorsId)->with('nation')->where('status','=',1)->take(3)->get();
        $localTourPackages=localTourPackages::query()->where('safari_name',$touristicAttraction->id)->where('status','=',1)->where('safari_start_date','>=',Carbon::now())->take(3)->get();
        $touristicAttractionVisitReasons=attractionVisitReasons::query()->where('touristic_attraction_id',$touristicAttraction->id)->get();
        $touristicAttractionVisitAdvices=touristicAttractionVisitAdvices::query()->where('touristic_attraction_id',$touristicAttraction->id)->get();
        $touristicAttractionsFaq=touristAttractionFaq::query()->where('touristic_attraction_id',$touristicAttraction->id)->get();
        $nation=nations::query()->where('status','=',1)->first();
        $touristicAttractionHoneyPoints=touristicAttractionHoneyPoints::query()->where('touristic_attraction_id',$touristicAttraction->id)->get();
        $touristicAttractionRules=touristicAttractionRules::query()->orderBy('id')->get();
        return view('TouristAttraction.publicView')
            ->with('nation',$nation)
            ->with('year',$year)
            ->with('touristicAttractionRules',$touristicAttractionRules)
            ->with('touristicAttractionVisitReasons',$touristicAttractionVisitReasons)
            ->with('touristicAttractionHoneyPoints',$touristicAttractionHoneyPoints)
            ->with('touristicAttractionVisitAdvices',$touristicAttractionVisitAdvices)
            ->with('localTourPackages',$localTourPackages)
            ->with('spottedTourOperatorsList',$spottedTourOperatorsList)
            ->with('touristicAttractionsFaq',$touristicAttractionsFaq)
            ->with('touristicAttraction',$touristicAttraction);
    }

    public function spotTourOperator($touristicAttractionUuid)
    {
        $touristicAttraction=touristicAttractions::query()->where('uuid',$touristicAttractionUuid)->first();
        $nation=nations::query()->where('status','=',1)->first();
        $touristicAttractionId=$touristicAttraction->id;
        $spottedTourOperatorsId=DB::table('tour_operator_touristic_attraction')
            ->where('touristic_attraction_id',$touristicAttractionId)
            ->pluck('tour_operator_id')
            ->toArray();

        $spottedTourOperatorsList=tourOperator::query()
            ->where('id',$spottedTourOperatorsId)
            ->where('status','=',1)
            ->get();
        return view('TouristAttraction.spotTourOperator')
            ->with('nation',$nation)
            ->with('touristicAttraction',$touristicAttraction)
            ->with('spottedTourOperatorsList',$spottedTourOperatorsList);
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
