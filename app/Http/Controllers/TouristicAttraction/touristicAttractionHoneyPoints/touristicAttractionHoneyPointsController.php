<?php

namespace App\Http\Controllers\TouristicAttraction\touristicAttractionHoneyPoints;

use App\Http\Controllers\Controller;
use App\Models\TouristicAttractions\touristicAttractionHoneyPoint\touristicAttractionHoneyPoints;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Repositories\Admin\TouristicAttraction\touristAttractionHoneyPoint\touristicAttractionHoneyPointsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class touristicAttractionHoneyPointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($touristicAttractionUuid)
    {
        $touristicAttraction=touristicAttractions::query()->where('uuid',$touristicAttractionUuid)->first();
        return view('TouristAttraction.honeyPoints.index')
            ->with('touristicAttraction',$touristicAttraction);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($touristicAttractionUuid)
    {
        $touristicAttraction=touristicAttractions::query()->where('uuid',$touristicAttractionUuid)->first();
        return view('TouristAttraction.honeyPoints.create')
            ->with('touristicAttraction',$touristicAttraction);
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
            'honey_point_name'=>'required|string',
            'honey_point_description'=>'required|string|max:200',
            'honey_point_image'=>'required|mimes:jpg,jpeg,png|max:2048|dimensions:max_height:2000,max_width:2000',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $touristicAttraction=touristicAttractions::query()->first();
        $honeyPointRepo=new touristicAttractionHoneyPointsRepository();
        $honeyPoint=$honeyPointRepo->storeTouristicAttractionHoneyPoints($input);
        return redirect()->route('touristicAttractionHoneyPoint.index',$touristicAttraction->uuid)->with('honeyPoint',$honeyPoint)->withFlashSuccess('Honey point uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($honeyPointUuid)
    {
        $honeyPoint=touristicAttractionHoneyPoints::query()->where('uuid',$honeyPointUuid)->first();
        return view('TouristAttraction.honeyPoints.view')
            ->with('honeyPoint',$honeyPoint);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($honeyPointUuid)
    {
        $honeyPoint=touristicAttractionHoneyPoints::query()->where('uuid',$honeyPointUuid)->first();
        return view('TouristAttraction.honeyPoints.edit')
            ->with('honeyPoint',$honeyPoint);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $honeyPointUuid)
    {
        $validator=Validator::make($request->all(),
            [
                'honey_point_name'=>'required|string',
                'honey_point_description'=>'required|string|max:200',
                'honey_point_image'=>'nullable|mimes:jpg,jpeg,png|max:2048|dimensions:max_height:2000,max_width:2000',
            ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $honeyPointRepo=new touristicAttractionHoneyPointsRepository();
        $honeyPoint=$honeyPointRepo->updateTouristicAttractionHoneyPoint($input,$honeyPointUuid,$request);
        return back()->withFlashSuccess('Honey point updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($honeyPointUuid)
    {
        $honeyPoint=touristicAttractionHoneyPoints::query()->where('uuid',$honeyPointUuid)->first();
        $honeyPoint->delete();
        return back()->withFlashSuccess('Honey point deleted successfully');
    }
    public function getHoneyPoints($touristicAttractionUuid)
    {
        $touristicAttraction=touristicAttractions::query()->where('uuid',$touristicAttractionUuid)->first();
        $honeyPoint=touristicAttractionHoneyPoints::query()->where('touristic_attraction_id',$touristicAttraction->id)->orderBy('honey_point_name')->get();
        return DataTables::of($honeyPoint)
            ->addIndexColumn()
            ->addColumn('honey_point_name',function ($honeyPoint){
                return $honeyPoint->honey_point_name;
            })
            ->addColumn('honey_point_description',function ($honeyPoint){
                return $honeyPoint->honey_point_description;
            })
            ->addColumn('actions',function ($honeyPoint){
                return $honeyPoint->buttonActionLabel;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
