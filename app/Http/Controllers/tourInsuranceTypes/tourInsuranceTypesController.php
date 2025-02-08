<?php

namespace App\Http\Controllers\tourInsuranceTypes;

use App\Http\Controllers\Controller;
use App\Models\Nations\nations;
use App\Models\tourInsuranceTypes\tourInsuranceTypes;
use App\Models\TourOperator\tourOperator;
use App\Repositories\tourInsuranceTypes\tourInsuranceTypesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class tourInsuranceTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tourInsuranceTypes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tourInsuranceTypes.create');
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
            'tour_insurance_name'=>'required|string',
            'tour_insurance_description'=>'required|string|max:200',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourInsuranceTypeRepo=new tourInsuranceTypesRepository();
        $tourInsuranceType=$tourInsuranceTypeRepo->storeTourInsuranceType($input);
        return redirect()->route('tourInsuranceType.index')->with('tourInsuranceType',$tourInsuranceType)->withFlashSuccess('Tour insurance type submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tourInsuranceTypeUuid)
    {
        $tourInsuranceType=tourInsuranceTypes::query()->where('uuid',$tourInsuranceTypeUuid)->first();
        return view('tourInsuranceTypes.view')->with('tourInsuranceType',$tourInsuranceType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tourInsuranceTypeUuid)
    {
        $tourInsuranceType=tourInsuranceTypes::query()->where('uuid',$tourInsuranceTypeUuid)->first();
        return view('tourInsuranceTypes.edit')->with('tourInsuranceType',$tourInsuranceType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tourInsuranceTypeUuid)
    {
        $validator=Validator::make($request->all(),
        [
            'tour_insurance_name'=>'required|string',
            'tour_insurance_description'=>'required|string|max:200',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourInsuranceTypeRepo=new tourInsuranceTypesRepository();
        $tourInsuranceType=$tourInsuranceTypeRepo->updateTourInsuranceType($input,$tourInsuranceTypeUuid);
        return redirect()->route('tourInsuranceType.index')->with('tourInsuranceType',$tourInsuranceType)->withFlashSuccess('Tour insurance type was updated successfully');
    }

    public function spotTourOperator($tourInsuranceTypeUuid)
    {
        $insuranceType=tourInsuranceTypes::query()->where('uuid',$tourInsuranceTypeUuid)->first();
        $nation=nations::query()->where('status','=',1)->first();
        $insuranceTypeId=$insuranceType->id;
        $spottedTourOperatorsId=DB::table('operator_insurance_type')
            ->where('tour_insurance_type_id',$insuranceTypeId)
            ->pluck('tour_operator_id')
            ->toArray();
        $spottedTourOperatorsList=tourOperator::query()
            ->with('nation')
            ->where('status','=',1)
            ->whereIn('id',$spottedTourOperatorsId)
            ->inRandomOrder()
            ->paginate(10);
        return view('tourInsuranceTypes.tourOperators.spottedTourOperators')
            ->with('nation',$nation)
            ->with('insuranceType',$insuranceType)
            ->with('spottedTourOperatorsList',$spottedTourOperatorsList);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tourInsuranceTypeUuid)
    {
        $tourInsuranceType=tourInsuranceTypes::query()->where('uuid',$tourInsuranceTypeUuid)->first();
        $tourInsuranceType->delete();
        return redirect()->route('tourInsuranceType.index')->withFlashSuccess('Tour insurance type was deleted successfully');
    }

    public function activateTourInsurance(Request $request)
    {
        $tourInsuranceType=tourInsuranceTypes::find($request->id);
        $status=$tourInsuranceType->status;
        switch ($status)
        {
            case 0:
                $tourInsuranceType->status=1;
                break;
            case 1:
                $tourInsuranceType->status=0;
                break;
        }
        $tourInsuranceType->save();
        return response()->json(['success'=>true]);
    }
    public function getTourInsuranceType()
    {
        $tourInsuranceType=tourInsuranceTypes::query()->orderBy('tour_insurance_name')->get();
        return DataTables::of($tourInsuranceType)
            ->addColumn('tour_insurance_name',function ($tourInsuranceType)
            {
                return $tourInsuranceType->tour_insurance_name;
            })
            ->addColumn('tour_insurance_description',function ($tourInsuranceType)
            {
                return $tourInsuranceType->tour_insurance_description;
            })
            ->addColumn('activate_tour_insurance_type',function ($tourInsuranceType){
                $btn='<label class="switch{{$tourInsuranceType->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tour_insurance_status',function ($tourInsuranceType)
            {
                return $tourInsuranceType->tourInsuranceStatusLabel;
            })
            ->addColumn('actions',function ($tourInsuranceType)
            {
                return $tourInsuranceType->buttonActionLabel;
            })
            ->rawColumns(['actions','tour_insurance_status','activate_tour_insurance_type'])
            ->make(true);
    }
}
