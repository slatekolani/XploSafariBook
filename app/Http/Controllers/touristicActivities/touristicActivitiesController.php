<?php

namespace App\Http\Controllers\touristicActivities;

use App\Http\Controllers\Controller;
use App\Models\touristicActivities\touristicActivities;
use App\Models\touristicActivities\touristicActivityConductTips\touristicActivityConductTips;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Repositories\touristicActivities\touristicActivitiesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class touristicActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('touristicActivity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('touristicActivity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'activity_name'=>'required|string',
            'activity_description'=>'required|string',
            'best_activity_period'=>'required|string',
            'basic_information'=>'required|string',
            'activity_image'=>'required|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:500,max_width:500',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $touristicActivityRepo=new touristicActivitiesRepository();
        $touristicActivity=$touristicActivityRepo->storeTouristicActivity($input,$request);
        return redirect()->route('touristicActivity.index')->with('touristicActivity',$touristicActivity)->withFlashSuccess('Touristic Activity submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($touristicActivityUuid)
    {
        $touristicActivity=touristicActivities::query()->where('uuid',$touristicActivityUuid)->first();
        $touristicActivityConductTips=touristicActivityConductTips::query()->where('touristic_activities_id',$touristicActivity->id)->get();  
        return view('touristicActivity.view')
        ->with('touristicActivityConductTips',$touristicActivityConductTips)
        ->with('touristicActivity',$touristicActivity); 
    }

    public function showActivity($touristicActivityUuid)
    {
        $touristicActivity=touristicActivities::query()->where('uuid',$touristicActivityUuid)->first();
        $touristicActivityTips=touristicActivityConductTips::query()->where('touristic_activities_id',$touristicActivity->id)->get();
        return view('touristicActivity.publicView.show')
        ->with('touristicActivityTips',$touristicActivityTips)
        ->with('touristicActivity',$touristicActivity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($touristicActivityUuid)
    {
        $touristicActivity=touristicActivities::query()->where('uuid',$touristicActivityUuid)->first();
        $touristicActivityConductTips=touristicActivityConductTips::query()->where('touristic_activities_id',$touristicActivity->id)->get();
        $touristicAttractions=touristicAttractions::query()->pluck('attraction_name','id');
        return view('touristicActivity.edit')
        ->with('touristicActivity',$touristicActivity)
        ->with('touristicAttractions',$touristicAttractions)
        ->with('touristicActivityConductTips',$touristicActivityConductTips);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $touristicActivityUuid)
    {
        $validator=Validator::make($request->all(),[
            'activity_name'=>'required|string',
            'activity_description'=>'required|string',
            'activity_image'=>'nullable|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:500,max_width:500',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $touristicActivityRepo=new touristicActivitiesRepository();
        $touristicActivity=$touristicActivityRepo->updateTouristicActivity($input,$touristicActivityUuid,$request);
        return redirect()->route('touristicActivity.index')->with('touristicActivity',$touristicActivity)->withFlashSuccess('Touristic Activity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($touristicActivityUuid)
    {
        $touristicActivity=touristicActivities::query()->where('uuid',$touristicActivityUuid)->first();
        $touristicActivity->delete();
        return back()->withFlashSuccess('Touristic Activity deleted successfully');
    }
    public function deleteTouristicActivityConductTip($touristicActivityConductTipUuid)
    {
        $touristicActivityConductTip=touristicActivityConductTips::query()->where('uuid',$touristicActivityConductTipUuid)->first();
        $touristicActivityConductTip->delete();
        return back()->withFlashSuccess('Touristic activity conduct tip deleted successfully');
    }
    public function getTouristicActivity()
    {
        $touristicActivity=touristicActivities::query()->orderBy('activity_name')->get();
        return DataTables::of($touristicActivity)
        ->addIndexColumn()
        ->addColumn('activity_name',function($touristicActivity){
            return $touristicActivity->activity_name;
        })
        ->addColumn('activity_description', function($touristicActivity) {
            return (strlen($touristicActivity->activity_description) > 30) 
                ? substr($touristicActivity->activity_description, 0, 30) . '...' 
                : $touristicActivity->activity_description;
        })
        
        ->addColumn('actions',function($touristicActivity){
            return $touristicActivity->buttonActionsLabel;
        })
        ->rawColumns(['actions'])
        ->make(true);
    }
}
