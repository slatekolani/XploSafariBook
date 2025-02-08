<?php

namespace App\Http\Controllers\tourPackageType;

use App\Http\Controllers\Controller;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Models\tourPackageType\tourPackageType;
use App\Repositories\tourPackageType\tourPackageTypeRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function foo\func;

class tourPackageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tourPackageType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tourPackageType.create');
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
            'tour_package_type_name'=>'required',
            'tour_package_type_description'=>'required|max:300',
            'tour_package_type_image'=>'required|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:1000,max_width:1000',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourPackageTypeRepo=new tourPackageTypeRepository();
        $tourPackageType=$tourPackageTypeRepo->storeTourPackageType($input);
        return redirect()->route('tourPackageType.index')->with('tourPackageType',$tourPackageType)->withFlashSuccess('Tour package type submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tourPackageTypeId)
    {
        $tourPackageType=tourPackageType::query()->where('uuid',$tourPackageTypeId)->first();
        return view('tourPackageType.view')->with('tourPackageType',$tourPackageType);
    }

    public function spotLocalSafaris($tourPackageTypeUuid)
    {
        $tourPackageType=tourPackageType::query()->where('uuid',$tourPackageTypeUuid)->first();
        $spottedLocalTourPackages=localTourPackages::query()
            ->where('tour_package_type_name',$tourPackageType->id)
            ->where('safari_start_date','>=',Carbon::now())
            ->inRandomOrder()
            ->paginate(12);
        return view('tourPackageType.localSafaris.spottedLocalSafaris')
            ->with('tourPackageType',$tourPackageType)
            ->with('spottedLocalTourPackages',$spottedLocalTourPackages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tourPackageTypeId)
    {
        $tourPackageType=tourPackageType::query()->where('uuid',$tourPackageTypeId)->first();
        return view('tourPackageType.edit')->with('tourPackageType',$tourPackageType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tourPackageTypeId)
    {
        $validator=Validator::make($request->all(),
        [
            'tour_package_type_name'=>'required',
            'tour_package_type_description'=>'required|max:300',
            'tour_package_type_image'=>'nullable|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:1000,max_width:1000',

        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourPackageTypeRepo=new tourPackageTypeRepository();
        $tourPackageType=$tourPackageTypeRepo->updateTourPackageType($input,$tourPackageTypeId,$request);
        return redirect()->route('tourPackageType.index')->with('tourPackageType',$tourPackageType)->withFlashSuccess('Tour package type update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tourPackageTypeId)
    {
        $tourPackageType=tourPackageType::query()->where('uuid',$tourPackageTypeId)->first();
        $tourPackageType->delete();
        return back()->withFlashSuccess('Tour package deleted successfully');
    }
    public function activateTourPackageType(Request $request)
    {
        $tourPackageType=tourPackageType::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $tourPackageType->status=1;
                break;
            case 1:
                $tourPackageType->status=0;
                break;
        }
        $tourPackageType->save();
        return response()->json(['success'=>true]);

    }
    public function getTourPackageTypes()
    {
        $tourPackageType=tourPackageType::query()->orderBy('tour_package_type_name')->get();
        return DataTables::of($tourPackageType)
            ->addColumn('tour_package_type_name',function ($tourPackageType)
            {
                return $tourPackageType->tour_package_type_name;
            })
            ->addColumn('tour_package_type_description',function ($tourPackageType)
            {
                return $tourPackageType->tour_package_type_description;
            })
            ->addColumn('activateTourPackageType',function ($tourPackageType){
                $btn='<label class="switch{{$tourPackageType->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tourPackageTypeStatus',function ($tourPackageType)
            {
                return $tourPackageType->tourPackageTypeStatusLabel;
            })
            ->addColumn('actions',function ($tourPackageType)
            {
                return $tourPackageType->tourPackageTypeButtonActions;
            })
            ->rawColumns(['activateTourPackageType','tourPackageTypeStatus','actions'])
            ->make(true);
    }
}
