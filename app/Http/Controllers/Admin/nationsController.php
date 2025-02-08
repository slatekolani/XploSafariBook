<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nations\economicActivity\nationEconomicActivity;
use App\Models\Nations\nations;
use App\Models\Nations\Precaution\nationPrecautions;
use App\Repositories\Admin\Nations\nationsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class nationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Nations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Nations.create');
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
            'nation_name'=>'required|string',
            'nation_flag'=>'required|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:500,max_width:500',
            'tourist_map'=>'required|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:5000,max_width:5000',
            'nation_description'=>'required|string',
            'nation_history'=>'required|string|max:500',
            'population'=>'required|numeric',
            'google_map'=>'required|string',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $nationsRepo=new nationsRepository();
        $nations=$nationsRepo->storenation($input);
        return redirect()->route('nation.index')->with('nations',$nations)->withFlashSuccess('Nation submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nation)
    {
        $nation=nations::query()->where('uuid',$nation)->first();
        $nationEconomicActivities=nationEconomicActivity::query()->where('nation_id',$nation->id)->get();
        $nationPrecautions=nationPrecautions::query()->where('nation_id',$nation->id)->get();
        return view('nations.edit')
            ->with('nationPrecautions',$nationPrecautions)
            ->with('nationEconomicActivities',$nationEconomicActivities)
            ->with('nation',$nation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nation)
    {
        $validator=Validator::make($request->all(),[
            'nation_name'=>'required|string',
            'nation_flag'=>'nullable|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:500,max_width:500',
            'tourist_map'=>'nullable|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:6000,max_width:6000',
            'nation_description'=>'required|string',
            'nation_history'=>'required|string|max:500',
            'population'=>'required|numeric',
            'google_map'=>'required|string',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $nationsRepo=new nationsRepository();
        $nation_name=$nationsRepo->updateNation($input,$nation,$request);
        return back()->with('nation_name',$nation_name)->withFlashSuccess('Nation Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(nations $nation)
    {
        $nation->delete();
        return redirect()->back()->withFlashSuccess('Nation removed successfully');
    }
    public function deleteEconomicActivity($nationEconomicActivityUuid)
    {
        $nationEconomicActivity=nationEconomicActivity::query()->where('uuid',$nationEconomicActivityUuid)->first();
        $nationEconomicActivity->delete();
        return back()->withFlashSuccess('Economic activity deleted successfully');
    }
    public function deleteNationPrecaution($nationPrecautionUuid)
    {
        $nationPrecaution=nationPrecautions::query()->where('uuid',$nationPrecautionUuid)->first();
        $nationPrecaution->delete();
        return back()->withFlashSuccess('Precaution deleted successfully');
    }

    public function activateNation(Request $request)
    {

        $nation=nations::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $nation->status=1;
                break;
            case 1:
                $nation->status=0;
                break;
        }
        $nation->save();
        return response()->json(['success'=>true,'message'=>'operation successful']);
    }

    public function getNations()
    {
        $nations=nations::query()->orderBy('nation_name')->get();
        return DataTables::of($nations)
            ->addIndexColumn()
            ->addColumn('nation_name',function ($nations){
                return $nations->nation_name;
            })
            ->addColumn('nation_flag',function ($nations){
                return $nations->nationFlagLabel;
            })
            ->addColumn('activate_nation',function ($nations){
                $btn='<label class="switch{{$nations->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('nation_status',function ($nations){
                return $nations->nation_status_label;
            })
            ->addColumn('actions',function ($nations){
                return $nations->buttonActionsLabel;
            })
            ->rawColumns(['actions','activate_nation','nation_status','nation_flag'])
            ->make(true);
    }
}
