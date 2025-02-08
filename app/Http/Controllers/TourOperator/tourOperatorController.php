<?php

namespace App\Http\Controllers\TourOperator;

use App\Http\Controllers\Controller;
use App\Models\Nations\nations;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\tourInsuranceTypes\tourInsuranceTypes;
use App\Models\touristicActivities\touristicActivities;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\touristReview\touristReview;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTouristReviews\localTouristReviews;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Repositories\TourOperator\tourOperatorRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class tourOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $tour_operator_repo;
    public function __construct(tourOperatorRepository $tour_operator_repo)
    {
        $this->tour_operator_repo = $tour_operator_repo;
    }
    public function index()
    {
        return view('TourOperator.index');
    }

    public function verifiedCompaniesIndex()
    {
        return view('TourOperator.Verified.index');
    }

    public function UnverifiedCompaniesIndex()
    {
        return view('TourOperator.Unverified.index');
    }
    public function deletedTourCompaniesIndex()
    {
        return view('TourOperator.deletedTourOperator.index');
    }
    public function adminViewIndex()
    {
        $tourOperator=tourOperator::all();
        return view('TourOperator.adminView.index')->with('tourOperator',$tourOperator);
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
        $touristicActivities=touristicActivities::query()->pluck('activity_name','id');
        return view('TourOperator.register')
            ->with('touristicActivities',$touristicActivities)
            ->with('tourInsuranceTypes',$tourInsuranceTypes)
            ->with('regionsOfOperations',$regionsOfOperations)
            ->with('tourist_attractions',$tourist_attractions)
            ->with('nations',$nations);
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
            'company_name'=>'required|string',
            'email_address'=>'required|email',
            'region'=>'required|string|max:15',
            'postal_code'=>'required|numeric|max:999999',
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
            'safariClass'=>'required',
            'tin_number'=>'required|numeric|digits:9',
            'physical_location'=>'required|string',
            'agreeCustomBooking'=>'required',
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
     * @param  int  $id
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

    public function publicView($tour_operator_company_id)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tour_operator_company_id)->first();
        $totalLocalTouristReviews=localTouristReviews::query()->where('tour_operator_id',$tourOperator->id)->where('status','=',1)->count();
        $localTouristReviews=localTouristReviews::query()->where('tour_operator_id',$tourOperator->id)->where('status','=',1)->take(4)->get();
        $localTourPackages=localTourPackages::query()
            ->where('tour_operator_id',$tourOperator->id)
            ->where('safari_start_date','>=',Carbon::now())
            ->inRandomOrder()
            ->take(3)
            ->get();
        $nation=nations::query()->where('status','=',1)->first();
        $localTourPackageReservationsIds=DB::table('local_package_reservation')->pluck('local_tour_package_id');
        $reservationLocalTourPackages=localTourPackages::query()
            ->whereIn('id',$localTourPackageReservationsIds)
            ->where('safari_start_date','>=',Carbon::now())
            ->take(3)
            ->get();
        return view('TourOperator.publicView')
            ->with('nation',$nation)
            ->with('totalLocalTouristReviews',$totalLocalTouristReviews)
            ->with('reservationLocalTourPackages',$reservationLocalTourPackages)
            ->with('localTouristReviews',$localTouristReviews)
            ->with('localTourPackages',$localTourPackages)
            ->with('tourOperator',$tourOperator);
    }

    public function allTourOperators()
    {
        $tourOperators=tourOperator::query()->where('status','=',1)
            ->inRandomOrder()
            ->paginate(10);
        $nation=nations::query()->where('status','=',1)->first();
        $tanzaniaRegions=tanzaniaRegions::query()->where('status','=',1)->pluck('region_name','id');
        return view('TourOperator.allTourOperators.show')
            ->with('nation',$nation)
            ->with('tanzaniaRegions',$tanzaniaRegions)
            ->with('tourOperators',$tourOperators);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
        $tourOperatorTouristicActivitiesIds=DB::table('company_touristic_activities')->where('tour_operator_id',$tourOperator->id)->pluck('touristic_activities_id');
        $tourOperatorTouristicActivities=touristicActivities::query()->whereIn('id',$tourOperatorTouristicActivitiesIds)->pluck('id','activity_name');
        $touristicActivities=touristicActivities::query()->pluck('activity_name','id');

        return view('TourOperator.edit')
            ->with('touristicActivities',$touristicActivities)
            ->with('tourOperatorTouristicActivities',$tourOperatorTouristicActivities)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
            'safariClass'=>'required',
            'agreeCustomBooking'=>'required',
            'tin_number'=>'required|numeric|digits:9',
            'physical_location'=>'required|string',
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
     * @param  int  $id
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
    public function getTourOperatorCompanies()
    {
        $tour_operator_companies=tourOperator::query()->where('users_id',auth()->user()->id)->orderBy('company_name')->get();
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
            ->addColumn('status',function ($tour_operator_companies){
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions',function ($tour_operator_companies)
            {
                return $tour_operator_companies->tour_company_button_actions_label;
            })
            ->rawColumns(['status','actions'])
            ->make(true);
    }
    public function getVerifiedTourCompanies()
    {
        $tour_operator_companies=tourOperator::query()->where('users_id',auth()->user()->id)->where('status','=',1)->orderBy('company_name')->get();
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
            ->addColumn('status',function ($tour_operator_companies){
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions',function ($tour_operator_companies)
            {
                return $tour_operator_companies->tour_company_button_actions_label;
            })
            ->rawColumns(['status','actions'])
            ->make(true);
    }
    public function getUnverifiedTourCompanies()
    {
        $tour_operator_companies=tourOperator::query()->where('users_id',auth()->user()->id)->where('status','=',0)->orderBy('company_name')->get();
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
            ->addColumn('status',function ($tour_operator_companies){
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions',function ($tour_operator_companies)
            {
                return $tour_operator_companies->tour_company_button_actions_label;
            })
            ->rawColumns(['status','actions'])
            ->make(true);
    }
    public function getDeletedTourOperatorCompanies()
    {
        $tour_operator_companies=tourOperator::onlyTrashed()->where('users_id',auth()->user()->id)->orderBy('company_name')->get();
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
            ->addColumn('status',function ($tour_operator_companies){
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions',function ($tour_operator_companies)
            {
                return $tour_operator_companies->ButtonActionsForDeletedTourCompaniesLabel;
            })
            ->rawColumns(['status','actions'])
            ->make(true);
    }

}
