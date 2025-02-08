<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Models\TourTypes\tourTypes;
use App\Repositories\Admin\TourTypes\tourTypesRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use function foo\func;

class tourTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('TourType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TourType.create');
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
            'rating'=>'required',
            'tour_type_name'=>'required',
            'tour_type_description'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourTypeRepo=new tourTypesRepository();
        $tourType=$tourTypeRepo->storeTourType($input);
        return redirect()->route('tourType.index')->with('tourType',$tourType)->withFlashSuccess('Tour type saved successfully');
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
    public function edit($tourType)
    {
        $tour_type=tourTypes::query()->where('uuid',$tourType)->first();
        return view('TourType.edit')->with('tour_type',$tour_type);
    }

    public function spotLocalSafaris($tourTypeUuid)
    {
        $tourType=tourTypes::query()->where('uuid',$tourTypeUuid)->first();
        $spottedLocalTourPackages=localTourPackages::query()
            ->where('local_tour_type',$tourType->id)
            ->where('safari_start_date','>=',Carbon::now())
            ->inRandomOrder()
            ->paginate(12);
        return view('TourType.localSafaris.spotLocalSafari')
            ->with('tourType',$tourType)
            ->with('spottedLocalTourPackages',$spottedLocalTourPackages);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tourType)
    {
        $validator=Validator::make($request->all(),[
            'rating'=>'required',
            'tour_type_name'=>'required',
            'tour_type_description'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourTypeRepo=new tourTypesRepository();
        $tour_type=$tourTypeRepo->updateTourType($input, $tourType);
        return back()->with('tour_type',$tour_type)->withFlashSuccess("Tour Type Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(tourTypes $tourType)
    {
        $tourType->delete();
        return back()->withFlashSuccess('Tour type removed successfully');
    }
    public function activateTourType(Request $request)
    {
        $tourType=tourTypes::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $tourType->status=1;
                break;
            case 1:
                $tourType->status=0;
                break;
        }
        $tourType->save();
        return response()->json(['success'=>true]);
    }
    public function getTourType()
    {
        $tourType=tourTypes::query()->orderBy('tour_type_name')->get();
        return DataTables::of($tourType)
            ->addColumn('tour_type_name',function ($tourType)
            {
                return $tourType->tour_type_name;
            })
            ->addColumn('activate_tour_type',function ($tourType)
            {
                $btn='<label class="switch{{$tourType->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tourTypeStatus',function ($tourType)
            {
                return $tourType->tourTypeStatusLabel;
            })
            ->addColumn('actions',function ($tourType)
            {
               return $tourType->TourTypeButtonActionsLabel;
            })
            ->rawColumns(['tourTypeStatus','actions','activate_tour_type'])
            ->make(true);
    }
}
