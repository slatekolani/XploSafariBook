<?php

namespace App\Http\Controllers\customerSatisfactionCategory;

use App\Http\Controllers\Controller;
use App\Models\customerSatisfactionCategory\customerSatisfactionCategory;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Repositories\customerSatisfactionCategory\customerSatisfactionCategoryRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class customerSatisfactionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customerSatisfactionCategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customerSatisfactionCategory.create');

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
            'customer_satisfaction_name'=>'required|string',
            'customer_satisfaction_description'=>'required|string|max:300',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $customerSatisfactionCategoryRepo=new customerSatisfactionCategoryRepository();
        $customerSatisfactionCategory=$customerSatisfactionCategoryRepo->storeCustomerSatisfactionCategory($input);
        return back()->with('customerSatisfactionCategory',$customerSatisfactionCategory)->withFlashSuccess('Customer satisfaction category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($satisfactionCategoryUuid)
    {
        $satisfactionCategory=customerSatisfactionCategory::query()->where('uuid',$satisfactionCategoryUuid)->first();
        return view('customerSatisfactionCategory.view')
            ->with('satisfactionCategory',$satisfactionCategory);
    }

    public function spotLocalSafaris($customerSatisfactionCategoryUuid)
    {
        $customerSatisfaction=customerSatisfactionCategory::query()->where('uuid',$customerSatisfactionCategoryUuid)->first();
        $localTourPackagesIds=DB::table('package_customer_satisfaction')->where('customer_satisfaction_id',$customerSatisfaction->id)->pluck('local_tour_package_id');
        $localTourPackages=localTourPackages::query()->whereIn('id',$localTourPackagesIds)->where('safari_start_date','>=',Carbon::now())->inRandomOrder()->paginate(12);
        return view('customerSatisfactionCategory.spottedLocalSafaris')
            ->with('customerSatisfaction',$customerSatisfaction)
            ->with('localTourPackages',$localTourPackages);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($satisfactionCategoryUuid)
    {
        $satisfactionCategory=customerSatisfactionCategory::query()->where('uuid',$satisfactionCategoryUuid)->first();
        return view('customerSatisfactionCategory.edit')
            ->with('satisfactionCategory',$satisfactionCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $satisfactionCategoryUuid)
    {
        $validator=Validator::make($request->all(),
            [
                'customer_satisfaction_name'=>'required|string',
                'customer_satisfaction_description'=>'required|string|max:300',
            ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $customerSatisfactionCategoryRepo=new customerSatisfactionCategoryRepository();
        $customerSatisfactionCategory=$customerSatisfactionCategoryRepo->updateCustomerSatisfactionCategory($input,$satisfactionCategoryUuid);
        return back()->withFlashSuccess('Customer satisfaction category was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($satisfactionCategoryUuid)
    {
        $satisfactionCategory=customerSatisfactionCategory::query()->where('uuid',$satisfactionCategoryUuid)->first();
        $satisfactionCategory->delete();
        return back()->withFlashSuccess('Satisfaction category was deleted successfully');
    }
    public function getCustomerSatisfactionCategory()
    {
        $customerSatisfactionCategory=customerSatisfactionCategory::query()->orderBy('customer_satisfaction_name')->get();
        return DataTables::of($customerSatisfactionCategory)
            ->addIndexColumn($customerSatisfactionCategory)
            ->addColumn('customer_satisfaction_name', function ($customerSatisfactionCategory){
                return $customerSatisfactionCategory->customer_satisfaction_name;
            })
            ->addColumn('customer_satisfaction_description',function ($customerSatisfactionCategory){
                return $customerSatisfactionCategory->customer_satisfaction_description;
            })
            ->addColumn('actions',function ($customerSatisfactionCategory){
                return $customerSatisfactionCategory->buttonActionLabel;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
