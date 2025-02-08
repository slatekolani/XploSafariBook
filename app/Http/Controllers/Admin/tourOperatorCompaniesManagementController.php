<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaseModel\Traits\SmsTrait;
use App\Models\Nations\nations;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\tourInsuranceTypes\tourInsuranceTypes;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\tourOperator;
use App\Repositories\TourOperator\tourOperatorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class tourOperatorCompaniesManagementController extends Controller
{
    use SmsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tourOperator = tourOperator::all();
        return view('TourOperator.adminView.index')->with('tourOperator', $tourOperator);
    }

    public function verifiedTourOperatorsCompaniesIndex()
    {
        $tourOperator = tourOperator::all();
        return view('TourOperator.adminView.Verified.index')->with('tourOperator',$tourOperator);
    }

    public function unverifiedTourOperatorsCompaniesIndex()
    {
        $tourOperator = tourOperator::all();
        return view('TourOperator.adminView.Unverified.index')->with('tourOperator',$tourOperator);
    }

    public function deletedTourCompaniesIndex()
    {
        $tourOperator=tourOperator::all();
        return view('TourOperator.adminView.deletedTourOperator.index')->with('tourOperator',$tourOperator);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nations=nations::where('status','=',1)->pluck('nation_name','id');
        $tourist_attractions=touristicAttractions::query()->where('status','=',1)->pluck('attraction_name','id');
        $tourInsuranceTypes=tourInsuranceTypes::query()->where('status','=',1)->pluck('tour_insurance_name','id');
        $regionsOfOperations=tanzaniaRegions::query()->where('status','=',1)->pluck('region_name','id');
        return view('TourOperator.register')
            ->with('tourInsuranceTypes',$tourInsuranceTypes)
            ->with('regionsOfOperations',$regionsOfOperations)
            ->with('tourist_attractions',$tourist_attractions)
            ->with('nations',$nations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'company_name'=>'required|string',
            'email_address'=>'required|email',
            'region'=>'required|string|max:15',
            'postal_code'=>'required|numeric|max:10',
            'phone_number'=>'required|regex:/^[0-9]{10}$/',
            'established_date'=>'required|string',
            'total_employees'=>'required|string',
            'about_company'=>'required|string|max:100',
            'support_time_range'=>'required|string',
            'company_nation'=>'required',
            'website_url'=>'required|url',
            'instagram_url'=>'required|url',
            'whatsapp_url'=>'required|url',
            'gps_url'=>'required|url',
            'company_logo'=>'required|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:1000,max_width:1000',
            'company_team_image'=>'required|mimes:jpg,jpeg,png|max:2048|dimensions:max_height=1000,max_width=1000',
            'verification_certificate'=>'required|mimes:pdf|max:2048',
            'tato_membership_certificate'=>'required|mimes:pdf|max:2048',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourOperatorRepo=new tourOperatorRepository();
        $tourOperatorCompany=$tourOperatorRepo->storeTourOperatorInformation($input);
        return redirect()->route('tourOperator.index')->with('tourOperatorCompany',$tourOperatorCompany)->withFlashSuccess('Company information submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($tour_operator_company_id)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tour_operator_company_id)->first();
        return view('TourOperator.view')->with('tourOperator',$tourOperator);
    }
    public function showDeletedTourCompany($tourOperatorCompanyId)
    {
        $tourOperator=tourOperator::onlyTrashed()->where('uuid',$tourOperatorCompanyId)->first();
        return view('TourOperator.viewDeletedTourOperator')->with('tourOperator',$tourOperator);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tour_operator_company_id)
    {
        $nations=nations::where('status','=',1)->pluck('nation_name','id');
        $tourOperator=tourOperator::query()->where('uuid',$tour_operator_company_id)->first();
        $touristAttractions=touristicAttractions::query()->where('status','=',1)->pluck('attraction_name','id');
        $touristAttractionsId=DB::table('operator_touristic_attraction')->where('tour_operator_id',$tourOperator->id)->pluck('touristic_attraction_id');
        $tourOperatorSafariPreferences=touristicAttractions::query()->whereIn('id',$touristAttractionsId)->pluck('id','attraction_name');
        $tourInsuranceTypes=tourInsuranceTypes::query()->where('status','=',1)->pluck('tour_insurance_name','id');
        $regionsOfOperations=tanzaniaRegions::query()->where('status','=',1)->pluck('region_name','id');
        $tourOperatorRegionsOfOperationIds=DB::table('operator_tanzania_region')->where('tour_operator_id',$tourOperator->id)->pluck('tanzania_region_id');
        $tourOperatorRegionsOfOperation=tanzaniaRegions::query()->whereIn('id',$tourOperatorRegionsOfOperationIds)->pluck('id','region_name');
        $tourOperatorInsurancesIds=DB::table('operator_insurance_type')->where('tour_operator_id',$tourOperator->id)->pluck('tour_insurance_type_id');
        $tourOperatorInsurances=tourInsuranceTypes::query()->whereIn('id',$tourOperatorInsurancesIds)->pluck('id','tour_insurance_name');
        return view('TourOperator.edit')
            ->with('tourOperatorInsurances',$tourOperatorInsurances)
            ->with('tourOperatorSafariPreferences',$tourOperatorSafariPreferences)
            ->with('tourOperatorRegionsOfOperation',$tourOperatorRegionsOfOperation)
            ->with('tourInsuranceTypes',$tourInsuranceTypes)
            ->with('regionsOfOperations',$regionsOfOperations)
            ->with('nations',$nations)
            ->with('touristAttractions',$touristAttractions)
            ->with('touristAttractionsId',$touristAttractionsId)
            ->with('tourOperator',$tourOperator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$tour_operator_company_id)
    {
        $validator=Validator::make($request->all(),[
            'company_name'=>'required|string',
            'region'=>'required|string|max:15',
            'postal_code'=>'required|numeric',
            'email_address'=>'required|email',
            'phone_number'=>'required|regex:/^[0-9]{10}$/',
            'established_date'=>'required|string',
            'total_employees'=>'required|string',
            'about_company'=>'required|string|max:100',
            'support_time_range'=>'required|string',
            'company_nation'=>'required',
            'website_url'=>'required|url',
            'instagram_url'=>'required|url',
            'whatsapp_url'=>'required|url',
            'gps_url'=>'required|url',
            'company_logo'=>'nullable|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:1000,max_width:1000',
            'company_team_image'=>'nullable|mimes:jpg,jpeg,png|max:2048|dimensions:max_height=1000,max_width=1000',
            'verification_certificate'=>'nullable|mimes:pdf|max:2048',
            'tato_membership_certificate'=>'nullable|mimes:pdf|max:2048',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourOperatorRepo=new tourOperatorRepository();
        $tourOperatorCompany=$tourOperatorRepo->updateTourOperatorInformation($input,$tour_operator_company_id,$request);
        return redirect()->route('tourOperator.index')->with('tourOperator',$tourOperatorCompany)->withFlashSuccess('Company Information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tourOperatorCompanyUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorCompanyUuid)->first();
        $tourOperator->tourOperatorSafariAreaPreferences()->delete();
        $tourOperator->tourOperatorRegionsOfOperations()->delete();
        $tourOperator->tourOperatorTourInsuranceTypes()->delete();
        $tourOperator->tourOperatorReservation()->delete();
        $tourOperator->localTourPackages()->delete();
        $tourOperator->delete();
        return redirect()->back()->withFlashSuccess('Company Information deleted successfully');
    }

    public function restoreDeletedTourCompany($tourOperatorId)
    {
        $tourOperator = tourOperator::onlyTrashed()->where('uuid', $tourOperatorId)->first();

        $tourOperator->tourOperatorSafariAreaPreferences()->updateExistingPivot('*', ['deleted_at' => null]);
        $tourOperator->tourOperatorRegionsOfOperations()->updateExistingPivot('*', ['deleted_at' => null]);
        $tourOperator->tourOperatorTourInsuranceTypes()->updateExistingPivot('*', ['deleted_at' => null]);

        $tourOperator->tourOperatorReservation()->restore();
        $tourOperator->localTourPackages()->restore();

        $tourOperator->restore();

        return redirect()->route('tourOperator.index', $tourOperator->uuid)->withFlashSuccess('Tour Company Restored Successfully');
    }

    public function forceDeleteTourCompany($tourOperatorId)
    {
        $tourOperator=tourOperator::onlyTrashed()->where('uuid',$tourOperatorId)->first();
        $tourOperator->tourOperatorSafariAreaPreferences()->detach();
        $tourOperator->tourOperatorRegionsOfOperations()->detach();
        $tourOperator->tourOperatorTourInsuranceTypes()->detach();
        $tourOperator->tourOperatorReservation()->forceDelete();
        $tourOperator->localTourPackages()->forceDelete();
        $tourOperator->forceDelete();
        return back()->withFlashSuccess('The tour company has been permanently deleted. You will not be able to restore it.');
    }


    public function ActivateOrDeactivateCompany(Request $request)
    {
        $tourOperatorCompany = tourOperator::find($request->id);
        $status = $request->status;
        
        switch ($status) {
            case 0:
                $tourOperatorCompany->status = 1;
                // $data = [
                //     'phone' => '+255658597924',
                //     'sms'=>'Welcome'
                // ];
                // $this->sendSms($data);
                break;
            case 1:
                $tourOperatorCompany->status = 0;
                break;
        }
        $tourOperatorCompany->save();
        return response()->json(['success'=>true]);
    }

    public function getTourOperatorsCompanies()
    {
        $tour_operator_companies = tourOperator::query()->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('id',function ($tour_operator_companies){
                return ($tour_operator_companies->id);
            })
            ->addColumn('registrationDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->created_at));
            })
       
            ->addColumn('company_name',function($tour_operator_companies){
                return $tour_operator_companies->company_name;
            })
     
            ->addColumn('company_nation',function ($tour_operator_companies){
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })
            ->addColumn('activate_or_deactivate_company', function ($tour_operator_companies) {
                $btn = '<label class="switch{{$tour_operator_companies->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('company_status', function ($tour_operator_companies) {
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions', function ($tour_operator_companies) {
                return $tour_operator_companies->TourCompanyButtonActionsLabel;
            })
            ->rawColumns(['company_logo', 'company_status', 'actions'])
            ->make(true);
    }

    public function getVerifiedTourOperatorsCompanies()
    {
        $tour_operator_companies = tourOperator::query()->where('status', '=', 1)->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('id',function ($tour_operator_companies){
                return ($tour_operator_companies->id);
            })
            ->addColumn('registrationDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->created_at));
            })
       
            ->addColumn('company_name',function($tour_operator_companies){
                return $tour_operator_companies->company_name;
            })
     
            ->addColumn('company_nation',function ($tour_operator_companies){
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })

            ->addColumn('activate_or_deactivate_company', function ($tour_operator_companies) {
                $btn = '<label class="switch{{$tour_operator_companies->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('company_status', function ($tour_operator_companies) {
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions', function ($tour_operator_companies) {
                return $tour_operator_companies->TourCompanyButtonActionsLabel;
            })
            ->rawColumns(['company_logo', 'company_status', 'actions', 'activate_or_deactivate_company'])
            ->make(true);
    }

    public function getUnverifiedTourOperatorsCompanies()
    {
        $tour_operator_companies = tourOperator::query()->where('status', '=', 0)->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('id',function ($tour_operator_companies){
                return ($tour_operator_companies->id);
            })
            ->addColumn('registrationDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->created_at));
            })
       
            ->addColumn('company_name',function($tour_operator_companies){
                return $tour_operator_companies->company_name;
            })
     
            ->addColumn('company_nation',function ($tour_operator_companies){
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })
            ->addColumn('activate_or_deactivate_company', function ($tour_operator_companies) {
                $btn = '<label class="switch{{$tour_operator_companies->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('company_status', function ($tour_operator_companies) {
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions', function ($tour_operator_companies) {
                return $tour_operator_companies->TourCompanyButtonActionsLabel;
            })
            ->rawColumns(['company_logo', 'company_status', 'actions'])
            ->make(true);
    }

    public function getDeletedTourOperatorCompanies()
    {
        $tour_operator_companies=tourOperator::onlyTrashed()->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('id',function ($tour_operator_companies){
                return ($tour_operator_companies->id);
            })
            ->addColumn('registrationDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->created_at));
            })
            ->addColumn('deletedDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->deleted_at));
            })
       
            ->addColumn('company_name',function($tour_operator_companies){
                return $tour_operator_companies->company_name;
            })
     
            ->addColumn('company_nation',function ($tour_operator_companies){
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })
       
            ->addColumn('status',function ($tour_operator_companies){
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions',function ($tour_operator_companies)
            {
                return $tour_operator_companies->ButtonActionsForDeletedTourCompaniesLabel;
            })
            ->rawColumns(['company_logo','status','actions'])
            ->make(true);
    }
}
