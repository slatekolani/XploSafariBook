<?php

namespace App\Http\Controllers\tanzaniaRegions;

use App\Http\Controllers\Controller;
use App\Models\Nations\economicActivity\nationEconomicActivity;
use App\Models\Nations\nations;
use App\Models\tanzaniaRegions\Precautions\tanzaniaRegionPrecautions;
use App\Models\tanzaniaRegions\regionCulture\appreciationActivities\CultureAppreciationActivityModel;
use App\Models\tanzaniaRegions\regionCulture\cultureChallenges\CultureChallengesModel;
use App\Models\tanzaniaRegions\regionCulture\cultureCharacteristics\tanzaniaRegionCultureCharacteristic;
use App\Models\tanzaniaRegions\regionCulture\tanzaniaRegionCulture;
use App\Models\tanzaniaRegions\tanzaniaRegionFAQ\tanzaniaRegionFAQ;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\touristicGames\touristicGame;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Repositories\tanzaniaRegions\tanzaniaRegionsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class tanzaniaRegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AboutTanzania.tanzaniaRegions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nationEconomicActivities=nationEconomicActivity::query()->pluck('economic_activity_title','id');
        $nation=nations::query()->first();
        return view('AboutTanzania.tanzaniaRegions.create')
            ->with('nation',$nation)
            ->with('nationEconomicActivities',$nationEconomicActivities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'region_name'=>'required|string',
            'economic_activity'=>'required|string',
            'region_size'=>'required|string|max:400',
            'population'=>'required|string|max:400',
            'climatic_condition'=>'required|string|max:400',
            'transport_nature'=>'required|string|max:400',
            'region_description'=>'required|string|max:400',
            'region_map'=>'required|string',
            'region_history'=>'required|string|max:400',
            'nation_id'=>'required',
            'region_icon_image.*'=>'required|mimes:jpg,png,jpeg|dimensions:max_height=1000,max_width=1000|max:5120',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tanzaniaRegionsRepo=new tanzaniaRegionsRepository();
        $tanzaniaRegions=$tanzaniaRegionsRepo->storeTanzaniaRegion($input,$request);
        return redirect()->route('tanzaniaRegion.index')->with('tanzaniaRegions',$tanzaniaRegions)->withFlashSuccess('Region submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tanzaniaRegionUuid)
    {
        $tanzaniaRegion=tanzaniaRegions::query()->with('regionEconomicActivity')->where('uuid',$tanzaniaRegionUuid)->first();
        return view('AboutTanzania.tanzaniaRegions.view')->with('tanzaniaRegion',$tanzaniaRegion);
    }

    public function publicView($tanzaniaRegionUuid)
    {
       $tanzaniaRegion=tanzaniaRegions::query()->with('regionEconomicActivity')->where('uuid',$tanzaniaRegionUuid)->where('status','=',1)->first();
       $touristicGames=touristicGame::query()->where('status','=',1)->orderBy('id','DESC')->get();
       $tanzaniaRegionPrecautions=tanzaniaRegionPrecautions::query()->where('tanzania_region_id',$tanzaniaRegion->id)->get();
       $tanzaniaRegionCultures=tanzaniaRegionCulture::query()->with('tanzaniaRegion')->where('tanzania_region_id',$tanzaniaRegion->id)->get();
       $selectedRegionCulture=tanzaniaRegionCulture::query()->where('tanzania_region_id',$tanzaniaRegion->id)->first();
       $regionCultureCharacteristics=tanzaniaRegionCultureCharacteristic::query()->where('tanzania_region_culture_id',$selectedRegionCulture->id)->get();
       $cultureAppreciationActivities=CultureAppreciationActivityModel::query()->where('tanzania_region_culture_id',$selectedRegionCulture->id)->get();
       $cultureChallenges=CultureChallengesModel::query()->where('tanzania_region_culture_id',$selectedRegionCulture->id)->get();
       $touristicAttractions=touristicAttractions::query()->where('status','=',1)->where('attraction_region',$tanzaniaRegion->id)->get();
       $localTourPackages=localTourPackages::query()->whereIn('safari_name',$touristicAttractions->pluck('id'))->where('safari_start_date','>=',Carbon::now())->get();
       $tourOperatorsListIds=DB::table('operator_tanzania_region')->where('tanzania_region_id',$tanzaniaRegion->id)->pluck('tour_operator_id');
       $tourOperatorsList=tourOperator::whereIn('id',$tourOperatorsListIds)->where('status','=',1)->take(3)->get();
       $nation=nations::query()->where('status','=',1)->first();
       $tanzaniaRegionsFAQ=tanzaniaRegionFAQ::query()->where('tanzania_region_id',$tanzaniaRegion->id)->get();
       return view('AboutTanzania.tanzaniaRegions.publicView')
           ->with('tanzaniaRegionsFAQ',$tanzaniaRegionsFAQ)
           ->with('cultureAppreciationActivities',$cultureAppreciationActivities)
           ->with('cultureChallenges',$cultureChallenges)
           ->with('nation',$nation)
           ->with('touristicGames',$touristicGames)
           ->with('tanzaniaRegionPrecautions',$tanzaniaRegionPrecautions)
           ->with('tanzaniaRegionCultures',$tanzaniaRegionCultures)
           ->with('localTourPackages',$localTourPackages)
           ->with('touristicAttractions',$touristicAttractions)
           ->with('regionCultureCharacteristics',$regionCultureCharacteristics)
           ->with('tourOperatorsList',$tourOperatorsList)
           ->with('tanzaniaRegion',$tanzaniaRegion);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tanzaniaRegionUuid)
    {
        $tanzaniaRegion=tanzaniaRegions::query()->where('uuid',$tanzaniaRegionUuid)->first();
        $regionMainEconomicActivities=nationEconomicActivity::query()->pluck('economic_activity_title','id');
        $regionOtherEconomicActivitiesId=DB::table('region_economic_activity')->where('tanzania_region_id',$tanzaniaRegion->id)->pluck('nation_economic_activity_id');
        $regionPrecautions=tanzaniaRegionPrecautions::query()->where('tanzania_region_id',$tanzaniaRegion->id)->get();
        return view('AboutTanzania.tanzaniaRegions.edit')
            ->with('regionOtherEconomicActivitiesId',$regionOtherEconomicActivitiesId)
            ->with('regionMainEconomicActivities',$regionMainEconomicActivities)
            ->with('regionPrecautions',$regionPrecautions)
            ->with('tanzaniaRegion',$tanzaniaRegion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tanzaniaRegionUuid)
    {
        $validator=Validator::make($request->all(),
        [
            'region_name'=>'required|string',
            'economic_activity'=>'required|string',
            'region_size'=>'required|string|max:400',
            'population'=>'required|string|max:400',
            'climatic_condition'=>'required|string|max:400',
            'transport_nature'=>'required|string|max:400',            
            'region_description'=>'required|string|max:400',
            'region_map'=>'required|string',
            'region_history'=>'required|string|max:400',
            'nation_id'=>'required',
            'region_icon_image.*'=>'nullable|mimes:jpg,png,jpeg|dimensions:max_height=1000,max_width=1000|max:5120',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tanzaniaRegionRepo=new tanzaniaRegionsRepository();
        $tanzaniaRegion=$tanzaniaRegionRepo->updateTanzaniaRegion($input,$tanzaniaRegionUuid,$request);
        return back()->with('tanzaniaRegion',$tanzaniaRegion)->withFlashSuccess('Region was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tanzaniaRegionUuid)
    {
        $tanzaniaRegion=tanzaniaRegions::query()->where('uuid',$tanzaniaRegionUuid)->first();
        $tanzaniaRegion->delete();
        return back()->withFlashSuccess('Region was deleted successfully');
    }
    public function deleteRegionPrecaution($tanzaniaRegionPrecautionUuid)
    {
        $tanzaniaRegionPrecaution=tanzaniaRegionPrecautions::query()->where('uuid',$tanzaniaRegionPrecautionUuid)->first();
        $tanzaniaRegionPrecaution->delete();
        return back()->withFlashSuccess('Region precaution deleted successfully');
    }

    public function activateTanzaniaRegion(Request $request)
    {
        $tanzaniaRegion=tanzaniaRegions::find($request->id);
        $status=$tanzaniaRegion->status;
        switch ($status)
        {
            case 0:
                $tanzaniaRegion->status=1;
                break;
            case 1:
                $tanzaniaRegion->status=0;
                break;
        }
        $tanzaniaRegion->save();
        return response()->json(['success'=>true]);
    }

    public function getTanzaniaRegions()
    {
        $tanzaniaRegion=tanzaniaRegions::query()->orderBy('region_name')->get();
        return DataTables::of($tanzaniaRegion)
            ->addColumn('region_name',function ($tanzaniaRegion)
            {
              return $tanzaniaRegion->region_name;
            })
            ->addColumn('region_description',function ($tanzaniaRegion)
            {
                return $tanzaniaRegion->region_description;
            })
            ->addColumn('activate_tanzania_region',function ($tanzaniaRegion){
                $btn='<label class="switch{{$tanzaniaRegion->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tanzania_region_status',function ($tanzaniaRegion)
            {
                return $tanzaniaRegion->tanzaniaRegionStatusLabel;
            })
            ->addColumn('actions',function ($tanzaniaRegion)
            {
                return $tanzaniaRegion->tanzaniaRegionButtonActionLabel;
            })
            ->rawColumns(['actions','tanzania_region_status','activate_tanzania_region'])
            ->make(true);
    }
}
