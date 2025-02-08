<?php

namespace App\Http\Controllers\TourOperator\TourOperatorPackages\LocalTourPackages;

use App\Http\Controllers\Controller;
use App\Models\customerSatisfactionCategory\customerSatisfactionCategory;
use App\Models\Nations\nations;
use App\Models\specialNeed\specialNeed;
use App\Models\tanzaniaAndWorldEvents\tanzaniaAndWorldEvents;
use App\Models\TouristicAttractions\category\touristicAttractionCategory;
use App\Models\TouristicAttractions\touristicAttractionHoneyPoint\touristicAttractionHoneyPoints;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\touristicGames\touristicGame;
use App\Models\TourOperator\reservations\reservationFacilities\tourOperatorReservationFacility;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageActivities\localTourPackageActivities;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTouristReviews\localTouristReviews;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageCollectionStops\localTourPackageCollectionStops;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourpackagePriceExclusive\localTourPackagePriceExclusive;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackagePriceInclusive\localTourPackagePriceInclusives;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackageRequirement\localTourPackageRequirements;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Models\TourOperator\TourPackages\LocalTourPackages\TotalViews\localTourPackageTotalViews;
use App\Models\tourPackageType\tourPackageType;
use App\Models\TourTypes\tourTypes;
use App\Models\Transport\transport;
use App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackagesRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Void_;
use Yajra\DataTables\DataTables;

class localTourPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.index')->with('tourOperator',$tourOperator);
    }
    public function verifiedLocalPackagesIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.localTourPackages.verifiedLocalTourPackages.index')->with('tourOperator',$tourOperator);
    }
    public function recentLocalPackagesIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.localTourPackages.recent.index')->with('tourOperator',$tourOperator);
    }
    public function unverifiedLocalPackagesIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.localTourPackages.unverified.index')->with('tourOperator',$tourOperator);
    }
    public function nearLocalToursIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.localTourPackages.nearTours.index')->with('tourOperator',$tourOperator);
    }
    public function expiredLocalToursIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.localTourPackages.expiredTours.index')->with('tourOperator',$tourOperator);
    }

    public function deletedLocalToursIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.localTourPackages.deleted.index')->with('tourOperator',$tourOperator);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tourOperatorId)
    {
        $package_range=['','Quarterly Plan (3 Months)','Semi-Annual Plan (6 Months)','Tri-Annual Plan (9 Months)','Annual Plan (12 Months)'];
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        $touristicAttractions=touristicAttractions::query()->where('status','=',1)->pluck('attraction_name','id');
        $specialNeeds=specialNeed::query()->where('status','=',1)->pluck('special_need_name','id');
        $transports=transport::query()->where('status','=',1)->pluck('transport_name','id');
        $events=tanzaniaAndWorldEvents::query()->where('status','=',1)->pluck('event_name','id');
        $tourPackageTypes=tourPackageType::query()->where('status','=',1)->pluck('tour_package_type_name','id');
        $tourTypeOffered=tourTypes::query()->where('status','=',1)->pluck('tour_type_name','id');
        $customerSatisfactionCategory=customerSatisfactionCategory::query()->pluck('customer_satisfaction_name','id');
        $reservations=tourOperatorReservation::query()->where('tour_operator_id',$tourOperator->id)->pluck('reservation_name','id');

        return view('TourOperator.TourPackages.localTourPackages.create')
            ->with('reservations',$reservations)
            ->with('touristicAttractions',$touristicAttractions)
            ->with('specialNeeds',$specialNeeds)
            ->with('transports',$transports)
            ->with('events',$events)
            ->with('package_range',$package_range)
            ->with('customerSatisfactionCategory',$customerSatisfactionCategory)
            ->with('tourPackageTypes',$tourPackageTypes)
            ->with('tourTypeOffered',$tourTypeOffered)
            ->with('tourOperator',$tourOperator);
    }

    public function allLocalTourPackages()
    {
        $localTourPackages=localTourPackages::query()->where('status','=',1)
            ->where('safari_start_date','>=',Carbon::now())
            ->inRandomOrder()
            ->paginate(12);
        $localTourPackageMonths = localTourPackages::query()
            ->select('*', DB::raw('MONTHNAME(safari_start_date) as month_name'))
            ->where('safari_start_date', '>=', Carbon::now())
            ->where('status', '=', 1)
            ->orderBy('id','DESC')
            ->paginate(12);
        return view('TourOperator.TourPackages.LocalTourPackages.allLocalTourPackages.show')
            ->with('localTourPackageMonths',$localTourPackageMonths)
            ->with('localTourPackages',$localTourPackages);
    }

    public function getMonthlyTourPackages($selectedMonth)
    {
        $localTourPackageMonths = localTourPackages::query()
            ->with('tourOperator')
            ->select('*', DB::raw('MONTHNAME(safari_start_date) as month_name'))
            ->where('status', '=', 1)
            ->where('safari_start_date', '>=', Carbon::now())
            ->orderBy('id','DESC')
            ->paginate(12);
        $localPackageMonths=$localTourPackageMonths->pluck('safari_start_date');
        $packageMonths=[];
        foreach ($localPackageMonths as $month)
        {
            $packageMonths[]=Carbon::parse($month)->format('F');
        }
        $commonMonth = array_intersect([$selectedMonth], $packageMonths);

        $localTourPackages = localTourPackages::query()
            ->where('status', '=', 1)
            ->where('safari_start_date', '>=', Carbon::now())
            ->whereMonth('safari_start_date', Carbon::parse(reset($commonMonth))->month)
            ->get();
        return view('TourOperator.TourPackages.LocalTourPackages.allLocalTourPackages.show')
            ->with('selectedMonth', $selectedMonth)
            ->with('localTourPackageMonths', $localTourPackageMonths)
            ->with('localTourPackages', $localTourPackages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $package_reference_number='REF - '.strtoupper(uniqid());
        $validator=Validator::make($request->all(),[
            'safari_name'=>'required|string',
            'safari_description'=>'required|string',
            'trip_kind'=>'required',
            'safari_poster'=>'required|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:2000,max_width:2000',
            'trip_price_adult_tanzanian'=>'required|numeric',
            'trip_price_child_tanzanian'=>'required|numeric',
            'trip_price_child_foreigner'=>'required|numeric',
            'trip_price_adult_foreigner'=>'required|numeric',
            'safari_start_date'=>'required',
            'safari_end_date'=>'required',
            'payment_deadline'=>'required',
            'travel_age_range'=>'required|string',
            'number_of_views_expecting'=>'required|numeric',
            'payment_start_percent'=>'required|numeric',
            'cancellation_percent'=>'required|numeric',
            'cancellation_due_date'=>'required',
            'cancellation_policy'=>'required|max:200',
            'package_range'=>'required',
            'maximum_travellers'=>'required|numeric',
            'phone_number'=>'required|regex:/^[0-9]{10}$/',
            'email_address'=>'required|email',
            'discount_offered'=>'required',
            'number_of_people_for_discount'=>'required|numeric',
            'payment_start_percent_deadline'=>'required',
            'targeted_event'=>'required',
            'free_of_charge_age'=>'required|numeric',
            'tour_package_type_name'=>'required',
            'local_tour_type'=>'required',
            'emergency_handling'=>'required|string|max:300',
            'transport_used_images.*'=>'required|mimes:jpg,png,jpeg|max:5120|dimensions:max_height:2000,max_width:2000',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        
        $input=$request->all();
        $localTourPackageRepo=new localTourPackagesRepository();
        $localTourPackage=$localTourPackageRepo->storeLocalTourPackage($input,$package_reference_number);
        return back()->with('localTourPackage',$localTourPackage)->withFlashSuccess('Local tour packages uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($localTourPackageUuid)
    {
        $package_range=['','Quarterly Plan (3 Months)','Semi-Annual Plan (6 Months)','Tri-Annual Plan (9 Months)','Annual Plan (12 Months)'];
        $localTourPackage=localTourPackages::query()->where('uuid',$localTourPackageUuid)->first();
        $localTourPackageActivities=localTourPackageActivities::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackageRequirements=localTourPackageRequirements::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackagePriceInclusives=localTourPackagePriceInclusives::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackagePriceExclusives=localTourPackagePriceExclusive::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackageCollectionStops=localTourPackageCollectionStops::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        return view('TourOperator.TourPackages.localTourPackages.view')
            ->with('localTourPackageActivities',$localTourPackageActivities)
            ->with('localTourPackagePriceInclusives',$localTourPackagePriceInclusives)
            ->with('localTourPackageCollectionStops',$localTourPackageCollectionStops)
            ->with('localTourPackagePriceExclusives',$localTourPackagePriceExclusives)
            ->with('localTourPackageRequirements',$localTourPackageRequirements)
            ->with('package_range',$package_range)
            ->with('localTourPackage',$localTourPackage);
    }
    public function viewDeleted($localTourPackageUuId)
    {
        $localTourPackage=localTourPackages::onlyTrashed()->where('uuid',$localTourPackageUuId)->first();
        $localTourPackageActivities=localTourPackageActivities::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackageRequirements=localTourPackageRequirements::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackagePriceInclusives=localTourPackagePriceInclusives::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackagePriceExclusives=localTourPackagePriceExclusive::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackageCollectionStops=localTourPackageCollectionStops::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        return view('TourOperator.TourPackages.localTourPackages.deleted.view')
            ->with('localTourPackageActivities',$localTourPackageActivities)
            ->with('localTourPackagePriceInclusives',$localTourPackagePriceInclusives)
            ->with('localTourPackageCollectionStops',$localTourPackageCollectionStops)
            ->with('localTourPackagePriceExclusives',$localTourPackagePriceExclusives)
            ->with('localTourPackageRequirements',$localTourPackageRequirements)
            ->with('localTourPackage',$localTourPackage);
    }

    public function publicView($localTourPackageId)
    {
        $package_range=['','Quarterly Plan (3 Months)','Semi-Annual Plan (6 Months)','Tri-Annual Plan (9 Months)','Annual Plan (12 Months)'];
        $localTourPackage=localTourPackages::query()->with('tourOperator','tourPackageType','tanzaniaAndWorldEvent','touristicAttraction')->where('uuid',$localTourPackageId)->first();
        $localTourPackagePackageRangeId = $localTourPackage->package_range;
        $localTourPackagePackageRangeName = $package_range[$localTourPackagePackageRangeId] ?? 'Unknown Plan';
        $similarLocalTourPackages=localTourPackages::query()->where('safari_name',$localTourPackage->safari_name)->where('safari_start_date','>=',Carbon::now())->take(4)->get();
        $localTouristReviews=localTouristReviews::query()->with('localTourPackageBooking')->where('tour_operator_id',$localTourPackage->tour_operator_id)->take(1)->get();
        $totalLocalTouristReviews=localTouristReviews::query()->with('localTourPackageBooking')->where('tour_operator_id',$localTourPackage->tour_operator_id)->count();
        $tourOperatorLocalTourPackages=localTourPackages::query()->where('tour_operator_id',$localTourPackage->tour_operator_id)->where('safari_start_date','>=',Carbon::now())->take(4)->get();
        $localTourCollectionStations=localTourPackageCollectionStops::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourActivities=localTourPackageActivities::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackagePriceInclusiveItems=localTourPackagePriceInclusives::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackagePriceExclusiveItems=localTourPackagePriceExclusive::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackageRequirements=localTourPackageRequirements::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $nation=nations::query()->where('status','=',1)->first();
        $localTourPackageReservationsIds=DB::table('local_package_reservation')->where('local_tour_package_id',$localTourPackage->id)->pluck('tour_operator_reservation_id');
        $localTourPackageReservations=tourOperatorReservation::with('localTourPackage')->whereIn('id',$localTourPackageReservationsIds)->get();
        $touristicGames=touristicGame::query()->where('status','=',1)->get();
        $localTourPackageCustomerSatisfactionIds=DB::table('package_customer_satisfaction')->where('local_tour_package_id',$localTourPackage->id)->pluck('customer_satisfaction_id');
        $localTourPackageCustomerSatisfactions=customerSatisfactionCategory::query()->whereIn('id',$localTourPackageCustomerSatisfactionIds)->get();
        $reservationTouristicGameIds=DB::table('reservation_touristic_game')->pluck('touristic_game_id');
        $reservationTouristicGames=touristicGame::query()->whereIn('id',$reservationTouristicGameIds)->get();
        $safariAreaPreferenceReservationsIds=DB::table('reservation_attractions')->where('touristic_attraction_id',$localTourPackage->touristicAttraction->id)->pluck('tour_operator_reservation_id');
        $safariAreaPreferenceReservations=tourOperatorReservation::query()->whereIn('id',$safariAreaPreferenceReservationsIds)->get();
        $localTourPackageSupportedSpecialNeedIds=DB::table('local_package_special_need')->where('local_tour_package_id',$localTourPackage->id)->pluck('special_need_id');
        $localTourPackageSupportedSpecialNeeds=specialNeed::query()->whereIn('id',$localTourPackageSupportedSpecialNeedIds)->pluck('special_need_name');
        $attractionId=$localTourPackage->safari_name;
        $attractionHoneyPoints=touristicAttractionHoneyPoints::query()->where('id',$attractionId)->get();
        // Consider this...
        localTourPackageTotalViews::create([
            'ip_address' => request()->ip(),
            'local_tour_package_id' => $localTourPackage->id,
        ]);
        return view('TourOperator.TourPackages.localTourPackages.publicView.view')
            ->with('localTourPackageSupportedSpecialNeeds',$localTourPackageSupportedSpecialNeeds)
            ->with('safariAreaPreferenceReservations',$safariAreaPreferenceReservations)
            ->with('localTourPackageCustomerSatisfactions',$localTourPackageCustomerSatisfactions)
            ->with('nation',$nation)
            ->with('localTourPackagePackageRangeName',$localTourPackagePackageRangeName)
            ->with('attractionHoneyPoints',$attractionHoneyPoints)
            ->with('reservationTouristicGames',$reservationTouristicGames)
            ->with('touristicGames',$touristicGames)
            ->with('localTourActivities',$localTourActivities)
            ->with('localTourPackageReservations',$localTourPackageReservations)
            ->with('similarLocalTourPackages',$similarLocalTourPackages)
            ->with('localTouristReviews',$localTouristReviews)
            ->with('totalLocalTouristReviews',$totalLocalTouristReviews)
            ->with('tourOperatorLocalTourPackages',$tourOperatorLocalTourPackages)
            ->with('localTourCollectionStations',$localTourCollectionStations)
            ->with('localTourPackagePriceInclusiveItems',$localTourPackagePriceInclusiveItems)
            ->with('localTourPackagePriceExclusiveItems',$localTourPackagePriceExclusiveItems)
            ->with('localTourPackageRequirements',$localTourPackageRequirements)
            ->with('localTourPackage',$localTourPackage);
    }
    public function TripKind($trip_kind_name)
    {
        $localTourPackages=localTourPackages::query()->where('trip_kind',$trip_kind_name)
        ->where('safari_start_date','>=',Carbon::now())
        ->inRandomOrder()
        ->paginate(12);
        return view('TourOperator.TourPackages.localTourPackages.tripKind.view')
        ->with('trip_kind_name',$trip_kind_name)
        ->with('localTourPackages',$localTourPackages);
    }
    public function adventurePaymentTimeFramePlan($package_range)
    {
        $package_range_name=['Quarterly Plan (3 Months)'=>1,'Semi-Annual Plan (6 Months)'=>2,'Tri-Annual Plan (9 Months)'=>3,'Annual Plan (12 Months)'=>4];
        $rangeId=$package_range_name[$package_range];
        $localTourPackages=localTourPackages::query()->where('package_range',$rangeId)->where('status','=',1)->paginate(12);
        return view('adventurePaymentRangeForSafari.spotTripPerPackageRange')
        ->with('package_range',$package_range)
        ->with('localTourPackages',$localTourPackages);
    }
    public function localSafariAttractionCategory($attractionCategoryUuid)
    {
        $touristicAttractionCategories=touristicAttractionCategory::query()->orderBy('id','DESC')->get();
        $attractionCategory=touristicAttractionCategory::query()->where('uuid',$attractionCategoryUuid)->first();
        $touristicAttractions=touristicAttractions::query()->where('attraction_category',$attractionCategory->id)->get();
        $nation=nations::query()->first();
        return view('TouristAttraction.category.publicView')
            ->with('nation',$nation)
            ->with('touristicAttractionCategories',$touristicAttractionCategories)
            ->with('touristicAttractions',$touristicAttractions)
            ->with('attractionCategory',$attractionCategory);
    }
    public function spotLocalTourPackagePlans($localTourPackageRangeId)
    {
        $package_range=['','Quarterly Plan (3 Months)','Semi-Annual Plan (6 Months)','Tri-Annual Plan (9 Months)','Annual Plan (12 Months)'];
        $localTourPackagePackageRangeName = $package_range[$localTourPackageRangeId] ?? 'Unknown Plan';
        $localTourPackages=localTourPackages::query()->where('package_range',$localTourPackageRangeId)
        ->where('safari_start_date','>=',Carbon::now())
            ->inRandomOrder()
            ->paginate(12);
        return view('TourOperator.TourPackages.localTourPackages.packagePlans.view')
            ->with('localTourPackagePackageRangeName',$localTourPackagePackageRangeName)
            ->with('localTourPackages',$localTourPackages)
            ->with('package_range',$package_range);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($localTourPackageUuid)
    {
        $package_range=['','Quarterly Plan (3 Months)','Semi-Annual Plan (6 Months)','Tri-Annual Plan (9 Months)','Annual Plan (12 Months)'];
        $localTourPackage=localTourPackages::query()->where('uuid',$localTourPackageUuid)->first();
        $touristicAttractions=touristicAttractions::query()->where('status','=',1)->pluck('attraction_name','id');
        $specialNeeds=specialNeed::query()->where('status','=',1)->pluck('special_need_name','id');
        $specialNeedIds=DB::table('local_package_special_need')->where('local_tour_package_id',$localTourPackage->id)->pluck('special_need_id');
        $transports=transport::query()->where('status','=',1)->pluck('transport_name','id');
        $transportIds=DB::table('local_package_transport')->where('local_tour_package_id',$localTourPackage->id)->pluck('transport_id');
        $events=tanzaniaAndWorldEvents::query()->where('status','=',1)->pluck('event_name','id');
        $tourPackageTypes=tourPackageType::query()->where('status','=',1)->pluck('tour_package_type_name','id');
        $tourTypeOffered=tourTypes::query()->where('status','=',1)->pluck('tour_type_name','id');
        $customerSatisfactionCategory=customerSatisfactionCategory::query()->pluck('customer_satisfaction_name','id');
        $customerSatisfactionCategoryIds=DB::table('package_customer_satisfaction')->where('local_tour_package_id',$localTourPackage->id)->pluck('customer_satisfaction_id');
        $reservation=tourOperatorReservation::query()->where('tour_operator_id',$localTourPackage->tourOperator->id)->pluck('reservation_name','id');
        $reservationIds=DB::table('local_package_reservation')->where('local_tour_package_id',$localTourPackage->id)->pluck('tour_operator_reservation_id');
        $safariCollectionStations=localTourPackageCollectionStops::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackageIncludedActivities=localTourPackageActivities::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackagePriceInclusives=localTourPackagePriceInclusives::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackagePriceExclusives=localTourPackagePriceExclusive::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $localTourPackageRequirements=localTourPackageRequirements::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        return view('TourOperator.TourPackages.localTourPackages.edit')
            ->with('localTourPackageRequirements',$localTourPackageRequirements)
            ->with('localTourPackagePriceExclusives',$localTourPackagePriceExclusives)
            ->with('localTourPackagePriceInclusives',$localTourPackagePriceInclusives)
            ->with('safariCollectionStations',$safariCollectionStations)
            ->with('localTourPackageIncludedActivities',$localTourPackageIncludedActivities)
            ->with('touristicAttractions',$touristicAttractions)
            ->with('specialNeeds',$specialNeeds)
            ->with('specialNeedIds',$specialNeedIds)
            ->with('reservation',$reservation)
            ->with('reservationIds',$reservationIds)
            ->with('transports',$transports)
            ->with('transportIds',$transportIds)
            ->with('package_range',$package_range)
            ->with('events',$events)
            ->with('customerSatisfactionCategory',$customerSatisfactionCategory)
            ->with('customerSatisfactionCategoryIds',$customerSatisfactionCategoryIds)
            ->with('tourPackageTypes',$tourPackageTypes)
            ->with('tourTypeOffered',$tourTypeOffered)
            ->with('localTourPackage',$localTourPackage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $localTourPackageUuid)
    {
        $validator=Validator::make($request->all(),[
            'safari_name'=>'required|string',
            'safari_description'=>'required|string',
            'trip_kind'=>'required',
            'safari_poster' => 'nullable|sometimes|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:2000,max_width:2000',
            'trip_price_adult_tanzanian'=>'required|numeric',
            'trip_price_child_tanzanian'=>'required|numeric',
            'trip_price_child_foreigner'=>'required|numeric',
            'trip_price_adult_foreigner'=>'required|numeric',
            'safari_start_date'=>'required',
            'safari_end_date'=>'required',
            'payment_deadline'=>'required',
            'travel_age_range'=>'required|string',
            'number_of_views_expecting'=>'required|numeric',
            'payment_start_percent'=>'required|numeric',
            'cancellation_percent'=>'required|numeric',
            'cancellation_due_date'=>'required',
            'cancellation_policy'=>'required|max:200',
            'package_range'=>'required',
            'maximum_travellers'=>'required|numeric',
            'phone_number'=>'required|regex:/^[0-9]{10}$/',
            'email_address'=>'required|email',
            'discount_offered'=>'required',
            'number_of_people_for_discount'=>'required|numeric',
            'payment_start_percent_deadline'=>'required',
            'targeted_event'=>'required',
            'free_of_charge_age'=>'required|numeric',
            'tour_package_type_name'=>'required',
            'local_tour_type'=>'required',
            'emergency_handling'=>'required|string|max:300',
            'transport_used_images.*'=>'nullable|sometimes|mimes:jpg,png,jpeg|max:5120|dimensions:max_height:2000,max_width:2000',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->except('package_reference_number');
        $localTourPackageRepo=new localTourPackagesRepository();
        $localTourPackage=$localTourPackageRepo->updateLocalTourPackage($input,$request,$localTourPackageUuid);
        return back()->with('localTourPackage',$localTourPackage)->withFlashSuccess('Local tour package was updated successfully');
    }
    public function getAllLocalTourPackagesOnSearch()
    {
        $search=localTourPackages::query()
            ->where('safari_start_date','>=',Carbon::now())
            ->select(
                [
                    'local_tour_package.safari_name',
                    'local_tour_package.safari_description',
                    'local_tour_package.safari_poster',
                    'local_tour_package.maximum_travellers',
                    'local_tour_package.trip_price_adult_tanzanian',
                    'local_tour_package.trip_price_child_tanzanian',
                    'local_tour_package.trip_price_child_foreigner',
                    'local_tour_package.trip_price_adult_foreigner',
                    'local_tour_package.safari_start_date',
                    'local_tour_package.safari_end_date',
                    'local_tour_package.phone_number',
                    'local_tour_package.email_address',
                    'local_tour_package.discount_offered',
                    'local_tour_package.tour_operator_id',
                    'local_tour_package.targeted_event',
                    'local_tour_package.tour_package_type_name',
                    'local_tour_package.local_tour_type',
                    'local_tour_package.uuid',
                    'local_tour_package.id',
                    'tourOperator.company_name',
                    'packageType.tour_package_type_name',
                    'event.event_name',
                    'tourType.tour_type_name',
                    ]
            )
            ->leftJoin('touristic_attraction as attraction','attraction.id','=','local_tour_package.safari_name')
            ->leftJoin('tour_operator as tourOperator','tourOperator.id','=','local_tour_package.tour_operator_id')
            ->leftJoin('tanzania_and_world_event as event','event.id','=','local_tour_package.targeted_event')
            ->leftJoin('tour_package_types as packageType','packageType.id','=','local_tour_package.tour_package_type_name')
            ->leftJoin('tour_types as tourType','tourType.id','=','local_tour_package.local_tour_type');
        return $search;
    }

    public function search()
    {
        $searchedLocalTourPackage=request()->all();
        if (($searchedLocalTourPackage['search']!==null)) {
            $localTourPackages=$this->getAllLocalTourPackagesOnSearch()->where('attraction.attraction_name','LIKE','%'.$searchedLocalTourPackage['search'].'%')
                ->orWhere('attraction.attraction_category','LIKE','%'.$searchedLocalTourPackage['search'].'%')
                ->orWhere('tourOperator.company_name','LIKE','%'.$searchedLocalTourPackage['search'].'%')
                ->orWhere('event.event_name','LIKE','%'.$searchedLocalTourPackage['search'].'%')
                ->orWhere('packageType.tour_package_type_name','LIKE','%'.$searchedLocalTourPackage['search'].'%')
                ->orWhere('tourType.tour_type_name','LIKE','%'.$searchedLocalTourPackage['search'].'%')
                ->take(3)
                ->get();

            if ($localTourPackages->isEmpty()){
                return $this->noLocalPackageFoundTourOperatorsRecommendation($searchedLocalTourPackage);
            }
            return view('TourOperator.TourPackages.localTourPackages.searchResults')
                ->with('searchedLocalTourPackage',$searchedLocalTourPackage)
                ->with('localTourPackages',$localTourPackages);
        }
        else
        {
            return back();
        }

    }
    public function noLocalPackageFoundTourOperatorsRecommendation($searchedLocalTourPackage)
    {
        $tourOperatorSafariAreaPreferenceId = DB::table('operator_touristic_attraction')->pluck('touristic_attraction_id');
        $tourOperatorSafariAreaPreferences = touristicAttractions::whereIn('id', $tourOperatorSafariAreaPreferenceId)->pluck('attraction_name')->toArray();
        $foundMatch = false;
        $matchingAttractionIds = [];

        foreach ($tourOperatorSafariAreaPreferences as $preference) {
            foreach ($searchedLocalTourPackage as $localPackage) {
                if (stripos($preference, $localPackage) !== false) {
                    $foundMatch = true;

                    $attractionId = DB::table('touristic_attraction')
                        ->where('attraction_name', 'like', '%' . $localPackage . '%')
                        ->value('id');

                    if ($attractionId) {
                        $matchingAttractionIds[] = $attractionId;
                    }
                    break 2;
                }
            }
        }

        if ($foundMatch) {
            $tourOperatorIds = DB::table('operator_touristic_attraction')
                ->whereIn('touristic_attraction_id', $matchingAttractionIds)
                ->pluck('tour_operator_id')
                ->toArray();

            $tourOperatorsOperatingAround = tourOperator::query()
                ->whereIn('id', $tourOperatorIds)
                ->take(3)
                ->get();
            $nation=nations::query()->where('status','=',1)->first();
            return view('TourOperator.TourPackages.localTourPackages.noLocalPackageFoundRecommendations')
                ->with('nation', $nation)
                ->with('tourOperatorsOperatingAround', $tourOperatorsOperatingAround)
                ->with('searchedLocalTourPackage', $searchedLocalTourPackage);
        }
        else {
            return view('TourOperator.TourPackages.localTourPackages.failedPackageRecommendation')
                ->with('searchedLocalTourPackage', $searchedLocalTourPackage);
        }
    }
    public function filterLocalTourPackages(Request $request)
    {
        $attractionId = $request->attraction_selected;
        $safariQualityId = $request->safari_quality;
        $tourPackageTypeId = $request->tourPackageType;
        $eventId = $request->event;
        $monthOfTravelId = $request->month;

        $localTourPackages = LocalTourPackages::query()
            ->where('safari_name', $attractionId)
            ->where('safari_start_date', '>=', Carbon::now())
            ->get();
        if ($localTourPackages->isEmpty())
        {
            $touristicAttraction=touristicAttractions::query()->where('id',$attractionId)->first();
            return redirect()->route('localTourPackage.noLocalSafariFound',$touristicAttraction->uuid);
        }

        $filteredPackages = $localTourPackages->filter(function ($package) use ($safariQualityId, $eventId, $tourPackageTypeId, $monthOfTravelId) {
            return $package->local_tour_type == $safariQualityId ||
                $package->targeted_event == $eventId ||
                $package->tour_package_type_name == $tourPackageTypeId ||
                Carbon::parse($package->start_date)->format('m') == $monthOfTravelId;
        });

        $successMessage = "We filtered tour packages based on your preferences for safari quality, events, package types, and travel months. If one requirement failed it gives all safaris in the selected attraction. Bon Voyage!";

        if ($filteredPackages->isEmpty()) {
            return redirect()->back()->withErrors(['message' => 'We have not found any matching safari for the selected criteria.']);
        }

        return view('TourOperator.TourPackages.localTourPackages.filteredLocalTourPackages.view')
            ->with('successMessage', $successMessage)
            ->with('filteredPackages', $filteredPackages);
    }

    public function noLocalSafariFound($touristicAttractionUuid)
    {
        $touristicAttraction=touristicAttractions::query()->where('uuid',$touristicAttractionUuid)->first();
        $nation=nations::query()->first();
        $tourOperatorSafariPreferenceIds=DB::table('operator_touristic_attraction')->where('touristic_attraction_id',$touristicAttraction->id)->pluck('tour_operator_id');
        $tourOperators=tourOperator::query()->whereIn('id',$tourOperatorSafariPreferenceIds)->get();
        if ($tourOperators->isNotEmpty())
        {
            return view('TourOperator.TourPackages.LocalTourPackages.filteredLocalTourPackages.noLocalSafariFound')
                ->with('nation',$nation)
                ->with('touristicAttraction',$touristicAttraction)
                ->with('tourOperators',$tourOperators);
        }
        else
        {
            return view('TourOperator.TourPackages.localTourPackages.filteredLocalTourPackages.noTourOperatorFound')
                ->with('touristicAttraction',$touristicAttraction);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($localTourPackageId)
    {
        $localTourPackage=localTourPackages::query()->where('uuid',$localTourPackageId)->first();
        $localTourPackage->specialNeed()->detach();
        $localTourPackage->transport()->detach();
        $localTourPackage->localTourPackageReservations()->detach();
        $localTourPackage->customerSatisfactionCategory()->detach();
        $localTourPackage->localTourPackageActivities()->delete();
        $localTourPackage->localTourPackageCollectionStops()->delete();
        $localTourPackage->localTourPackagePriceInclusives()->delete();
        $localTourPackage->localTourPackagePriceExclusive()->delete();
        $localTourPackage->localTourPackageRequirements()->delete();
        $localTourPackage->localTourPackageBookings()->delete();
        $localTourPackage->localTouristReviews()->delete();
        $localTourPackage->delete();
        return back()->withFlashSuccess('Local tour package deleted successfully');
    }
    public function restore($localTourPackageId)
    {
        $localTourPackage=localTourPackages::onlyTrashed()->where('uuid',$localTourPackageId)->first();
        $localTourPackage->specialNeed()->updateExistingPivot('*', ['deleted_at' => null]);
        $localTourPackage->transport()->updateExistingPivot('*', ['deleted_at' => null]);
        $localTourPackage->customerSatisfactionCategory()->updateExistingPivot('*', ['deleted_at' => null]);
        $localTourPackage->localTourPackageReservations()->updateExistingPivot('*', ['deleted_at'=>null]);
        $localTourPackage->localTourPackageActivities()->restore();
        $localTourPackage->localTourPackageCollectionStops()->restore();
        $localTourPackage->localTourPackagePriceInclusives()->restore();
        $localTourPackage->localTourPackagePriceExclusive()->restore();
        $localTourPackage->localTourPackageRequirements()->restore();
        $localTourPackage->localTourPackageBookings()->restore();
        $localTourPackage->localTouristReviews()->restore();
        $localTourPackage->restore();
        return back()->withFlashSuccess('Local tour package restored successfully');
    }
    public function forceDeleteLocalPackage($localTourPackageId)
    {
        $localTourPackage=localTourPackages::onlyTrashed()->where('uuid',$localTourPackageId)->first();
        $localTourPackage->localTourPackageActivities()->forceDelete();
        $localTourPackage->localTourPackageCollectionStops()->forceDelete();
        $localTourPackage->localTourPackagePriceInclusives()->forceDelete();
        $localTourPackage->localTourPackagePriceExclusive()->forceDelete();
        $localTourPackage->localTourPackageRequirements()->forceDelete();
        $localTourPackage->localTourPackageBookings()->forceDelete();
        $localTourPackage->localTouristReviews()->forceDelete();
        $localTourPackage->forceDelete();
        return back()->withFlashSuccess('Local tour package was permanently deleted');
    }
    public function deleteCollectionStation($collectionStopUuid)
    {
        $localSafariCollectionStop=localTourPackageCollectionStops::query()->where('uuid',$collectionStopUuid)->first();
        $localSafariCollectionStop->delete();
        return back()->withFlashSuccess('Collection stop was deleted successfully');
    }
    public function deleteIncludedActivity($includedActivityUuid)
    {
        $localSafariIncludedActivity=localTourPackageActivities::query()->where('uuid',$includedActivityUuid)->first();
        $localSafariIncludedActivity->delete();
        return back()->withFlashSuccess('Activity was deleted successfully');
    }
    public function deletePriceInclusiveItem($priceIncludedItemUuid)
    {
        $localSafariPriceInclusiveItem=localTourPackagePriceInclusives::query()->where('uuid',$priceIncludedItemUuid)->first();
        $localSafariPriceInclusiveItem->delete();
        return back()->withFlashSuccess('Price inclusive item was deleted successfully');
    }
    public function deletePriceExclusiveItem($priceExcludedItemUuid)
    {
        $localSafariPriceInclusiveItem=localTourPackagePriceExclusive::query()->where('uuid',$priceExcludedItemUuid)->first();
        $localSafariPriceInclusiveItem->delete();
        return back()->withFlashSuccess('Price exclusive item was deleted successfully');
    }
    public function deleteTripRequirement($tripRequirementUuid)
    {
        $localSafariTripRequirement=localTourPackageRequirements::query()->where('uuid',$tripRequirementUuid)->first();
        $localSafariTripRequirement->delete();
        return back()->withFlashSuccess('Trip requirement was deleted successfully');
    }
    public function replicateExpiredTour($localTourPackageUuid)
    {
        $localTourPackage = localTourPackages::where('uuid', $localTourPackageUuid)->first();
        if(!empty($localTourPackage->package_reference_number))
        {
            $localTourPackage->package_reference_number='REF - ' .strtoupper(uniqid());
        }
        $newLocalTourPackage = $localTourPackage->replicate();
        $newLocalTourPackage->save();

        $relatedModels = [
            'localTourPackageActivities',
            'localTourPackageCollectionStops',
            'localTourPackagePriceInclusives',
            'localTourPackagePriceExclusive',
            'localTourPackageRequirements',
            'localTouristReviews',
        ];

        foreach ($relatedModels as $relation) {
            foreach ($localTourPackage->{$relation} as $relatedModel) {
                $newRelatedModel = $relatedModel->replicate();
                $newRelatedModel->local_tour_package_id = $newLocalTourPackage->id;
                $newRelatedModel->save();
            }
        }

        return redirect()->route('localTourPackages.edit', $newLocalTourPackage->uuid)->withFlashSuccess('The local tour package was replicated successfully! Now edit your tour package...');
    }

    public function replicateTourPackage($localTourPackageUuid)
    {
        $localTourPackage = localTourPackages::where('uuid', $localTourPackageUuid)->first();
        if (!empty($localTourPackage->package_reference_number))
        {
            $localTourPackage->package_reference_number='REF - ' .strtoupper(uniqid());

        }
        $newLocalTourPackage = $localTourPackage->replicate();
        $newLocalTourPackage->save();

        $relatedModels = [
            'localTourPackageActivities',
            'localTourPackageCollectionStops',
            'localTourPackagePriceInclusives',
            'localTourPackagePriceExclusive',
            'localTourPackageRequirements',
            'localTouristReviews',
        ];

        foreach ($relatedModels as $relation) {
            foreach ($localTourPackage->{$relation} as $relatedModel) {
                $newRelatedModel = $relatedModel->replicate();
                $newRelatedModel->local_tour_package_id = $newLocalTourPackage->id;
                $newRelatedModel->save();
            }
        }

        return redirect()->route('localTourPackages.edit', $newLocalTourPackage->uuid)->withFlashSuccess('The local tour package was duplicated successfully! Now edit your new tour package...');
    }
    public function ActivateOrDeactivateLocalTourPackage(Request $request)
    {
        $localTourPackage=localTourPackages::find($request->id);
        $status=$localTourPackage->status;
        switch ($status)
        {
            case 0:
                $localTourPackage->status=1;
                break;
            case 1:
                $localTourPackage->status=0;
                break;
            default:
                $localTourPackage->status=0;
                break;
        }
        $localTourPackage->save();
        return response()->json(['success'=>true]);
    }
    public function getCompanyLocalTourPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $localTourPackages=localTourPackages::query()->with('tourOperator','touristicAttraction')->where('tour_operator_id',$tourOperator->id)->get();
        return DataTables::of($localTourPackages)
            ->addIndexColumn()
            ->addColumn('id',function ($localTourPackages){
                return $localTourPackages->id;
            })
            ->addColumn('companyPostedLocalTourPackage',function ($localTourPackages){
                return $localTourPackages->tourOperator->company_name;
            })
            ->addColumn('localTourPackagePostedTime',function ($localTourPackages){
                return date('jS M Y H:m:s a',strtotime($localTourPackages->created_at));
            })
            ->addColumn('localTourPackageExpired', function ($localTourPackages){
                if ($localTourPackages->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($localTourPackages->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('localTourPackageCountDownDays', function ($tourPackages){
                return $tourPackages->CountDownDaysForLocalTourPackageTripLabel;
            })
            ->addColumn('safari_name',function ($localTourPackages){
                return $localTourPackages->touristicAttraction->attraction_name;
            })
            ->addColumn('safari_start_date', function ($localTourPackages){
                return $localTourPackages->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($localTourPackages){
                return $localTourPackages->safari_end_date;
            })
        
            ->addColumn('activate_or_deactivate_local_tourPackage',function($localTourPackages){
                $btn='<label class="switch{{$localTourPackages->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('localTourPackageStatus', function ($localTourPackages){
                return $localTourPackages->localTourPackageStatusLabel;
            })
            ->addColumn('actions', function ($localTourPackages){
                return $localTourPackages->localTourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','localTourPackageCountDownDays','companyPostedLocalTourPackage','localTourPackageExpired','localTourPackagePostedTime','localTourPackageStatus','activate_or_deactivate_local_tourPackage'])
            ->make(true);
    }
    public function getVerifiedLocalTourPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $totalVerifiedLocalTourPackages=localTourPackages::query()->with('tourOperator','touristicAttraction')->where('tour_operator_id',$tourOperator->id)->where('status','=',1)->get();
        return DataTables::of($totalVerifiedLocalTourPackages)
            ->addIndexColumn()
            ->addColumn('id',function ($totalVerifiedLocalTourPackages){
                return $totalVerifiedLocalTourPackages->id;
            })
            ->addColumn('companyPostedLocalTourPackage',function ($totalVerifiedLocalTourPackages){
                return $totalVerifiedLocalTourPackages->tourOperator->company_name;
            })
            ->addColumn('localTourPackagePostedTime',function ($totalVerifiedLocalTourPackages){
                return date('jS M Y H:m:s a',strtotime($totalVerifiedLocalTourPackages->created_at));
            })
            ->addColumn('localTourPackageExpired', function ($totalVerifiedLocalTourPackages){
                if ($totalVerifiedLocalTourPackages->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($totalVerifiedLocalTourPackages->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('localTourPackageCountDownDays', function ($totalVerifiedLocalTourPackages){
                return $totalVerifiedLocalTourPackages->CountDownDaysForLocalTourPackageTripLabel;
            })
            ->addColumn('safari_name',function ($totalVerifiedLocalTourPackages){
                return $totalVerifiedLocalTourPackages->touristicAttraction->attraction_name;
            })
            ->addColumn('safari_start_date', function ($totalVerifiedLocalTourPackages){
                return $totalVerifiedLocalTourPackages->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($totalVerifiedLocalTourPackages){
                return $totalVerifiedLocalTourPackages->safari_end_date;
            })
            ->addColumn('activate_or_deactivate_local_tourPackage',function($totalVerifiedLocalTourPackages){
                $btn='<label class="switch{{$totalVerifiedLocalTourPackages->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('localTourPackageStatus', function ($totalVerifiedLocalTourPackages){
                return $totalVerifiedLocalTourPackages->localTourPackageStatusLabel;
            })
            ->addColumn('actions', function ($totalVerifiedLocalTourPackages){
                return $totalVerifiedLocalTourPackages->localTourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','localTourPackageCountDownDays','companyPostedLocalTourPackage','localTourPackageExpired','localTourPackagePostedTime','localTourPackageStatus','activate_or_deactivate_local_tourPackage'])
            ->make(true);
    }
    public function getRecentLocalTourPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $recentLocalTourPackages=localTourPackages::query()->with('tourOperator')->where('tour_operator_id',$tourOperator->id)->whereBetween('created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->get();
        return DataTables::of($recentLocalTourPackages)
            ->addIndexColumn()
            ->addColumn('id',function ($recentLocalTourPackages){
                return $recentLocalTourPackages->id;
            })
            ->addColumn('companyPostedLocalTourPackage',function ($recentLocalTourPackages){
                return $recentLocalTourPackages->tourOperator->company_name;
            })
            ->addColumn('localTourPackagePostedTime',function ($recentLocalTourPackages){
                return date('jS M Y H:m:s a',strtotime($recentLocalTourPackages->created_at));
            })
            ->addColumn('localTourPackageExpired', function ($recentLocalTourPackages){
                if ($recentLocalTourPackages->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($recentLocalTourPackages->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('localTourPackageCountDownDays', function ($recentLocalTourPackages){
                return $recentLocalTourPackages->CountDownDaysForLocalTourPackageTripLabel;
            })
            ->addColumn('safari_name',function ($recentLocalTourPackages){
                return $recentLocalTourPackages->touristicAttraction->attraction_name;
            })
            ->addColumn('safari_start_date', function ($recentLocalTourPackages){
                return $recentLocalTourPackages->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($recentLocalTourPackages){
                return $recentLocalTourPackages->safari_end_date;
            })
            ->addColumn('activate_or_deactivate_local_tourPackage',function($recentLocalTourPackages){
                $btn='<label class="switch{{$recentLocalTourPackages->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('localTourPackageStatus', function ($recentLocalTourPackages){
                return $recentLocalTourPackages->localTourPackageStatusLabel;
            })
            ->addColumn('actions', function ($recentLocalTourPackages){
                return $recentLocalTourPackages->localTourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','localTourPackageCountDownDays','companyPostedLocalTourPackage','localTourPackageExpired','localTourPackagePostedTime','localTourPackageStatus','activate_or_deactivate_local_tourPackage'])
            ->make(true);
    }
    public function getUnverifiedLocalPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $unverifiedLocalTourPackages=localTourPackages::query()->with('tourOperator','touristicAttraction')->where('tour_operator_id',$tourOperator->id)->where('status','=',0)->get();
        return DataTables::of($unverifiedLocalTourPackages)
            ->addIndexColumn()
            ->addColumn('id',function ($unverifiedLocalTourPackages){
                return $unverifiedLocalTourPackages->id;
            })
            ->addColumn('companyPostedLocalTourPackage',function ($unverifiedLocalTourPackages){
                return $unverifiedLocalTourPackages->tourOperator->company_name;
            })
            ->addColumn('localTourPackagePostedTime',function ($unverifiedLocalTourPackages){
                return date('jS M Y H:m:s a',strtotime($unverifiedLocalTourPackages->created_at));
            })
            ->addColumn('localTourPackageExpired', function ($unverifiedLocalTourPackages){
                if ($unverifiedLocalTourPackages->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($unverifiedLocalTourPackages->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('localTourPackageCountDownDays', function ($unverifiedLocalTourPackages){
                return $unverifiedLocalTourPackages->CountDownDaysForLocalTourPackageTripLabel;
            })
            ->addColumn('safari_name',function ($unverifiedLocalTourPackages){
                return $unverifiedLocalTourPackages->touristicAttraction->attraction_name;
            })
            ->addColumn('safari_start_date', function ($unverifiedLocalTourPackages){
                return $unverifiedLocalTourPackages->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($unverifiedLocalTourPackages){
                return $unverifiedLocalTourPackages->safari_end_date;
            })
            ->addColumn('activate_or_deactivate_local_tourPackage',function($unverifiedLocalTourPackages){
                $btn='<label class="switch{{$unverifiedLocalTourPackages->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('localTourPackageStatus', function ($unverifiedLocalTourPackages){
                return $unverifiedLocalTourPackages->localTourPackageStatusLabel;
            })
            ->addColumn('actions', function ($unverifiedLocalTourPackages){
                return $unverifiedLocalTourPackages->localTourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','localTourPackageCountDownDays','companyPostedLocalTourPackage','localTourPackageExpired','localTourPackagePostedTime','localTourPackageStatus','activate_or_deactivate_local_tourPackage'])
            ->make(true);
    }
    public function getNearLocalTours($tourOperatorId)
    {
        $startDay=Carbon::now()->startOfDay();
        $endDay=Carbon::now()->addDays(40)->endOfDay();
        $tourOperator=tourOperator::find($tourOperatorId);
        $localNearTours=localTourPackages::query()->with('tourOperator','touristicAttraction')->where('tour_operator_id',$tourOperator->id)
            ->whereBetween('safari_start_date',[$startDay,$endDay])
            ->orderBy('safari_start_date','asc')
            ->get();
        return DataTables::of($localNearTours)
            ->addIndexColumn()
            ->addColumn('id',function ($localNearTours){
                return $localNearTours->id;
            })
            ->addColumn('urgencyStatus',function($localNearTours){
                return $localNearTours->safariUrgencyStatusLabel;
            })
            ->addColumn('companyPostedLocalTourPackage',function ($localNearTours){
                return $localNearTours->tourOperator->company_name;
            })
            ->addColumn('localTourPackagePostedTime',function ($localNearTours){
                return date('jS M Y H:m:s a',strtotime($localNearTours->created_at));
            })
            ->addColumn('localTourPackageExpired', function ($localNearTours){
                if ($localNearTours->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($localNearTours->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('localTourPackageCountDownDays', function ($localNearTours){
                return $localNearTours->CountDownDaysForLocalTourPackageTripLabel;
            })
            ->addColumn('safari_name',function ($localNearTours){
                return $localNearTours->touristicAttraction->attraction_name;
            })
            ->addColumn('safari_start_date', function ($localNearTours){
                return $localNearTours->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($localNearTours){
                return $localNearTours->safari_end_date;
            })
            ->addColumn('activate_or_deactivate_local_tourPackage',function($localNearTours){
                $btn='<label class="switch{{$localNearTours->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('localTourPackageStatus', function ($localNearTours){
                return $localNearTours->localTourPackageStatusLabel;
            })
            ->addColumn('actions', function ($localNearTours){
                return $localNearTours->localTourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','localTourPackageCountDownDays','urgencyStatus','companyPostedLocalTourPackage','localTourPackageExpired','localTourPackagePostedTime','localTourPackageStatus','activate_or_deactivate_local_tourPackage'])
            ->make(true);
    }
    public function getExpiredLocalPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $localTourPackagesExpired=localTourPackages::query()->with('tourOperator','touristicAttraction')->where('tour_operator_id',$tourOperator->id)->where('safari_start_date','<=',[Carbon::now()])->get();
        return DataTables::of($localTourPackagesExpired)
            ->addIndexColumn()
            ->addColumn('id',function ($localTourPackagesExpired){
                return $localTourPackagesExpired->id;
            })
            ->addColumn('companyPostedLocalTourPackage',function ($localTourPackagesExpired){
                return $localTourPackagesExpired->tourOperator->company_name;
            })
            ->addColumn('localTourPackagePostedTime',function ($localTourPackagesExpired){
                return date('jS M Y H:m:s a',strtotime($localTourPackagesExpired->created_at));
            })
            ->addColumn('localTourPackageExpired', function ($localTourPackagesExpired){
                if ($localTourPackagesExpired->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($localTourPackagesExpired->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('localTourPackageCountDownDays', function ($localTourPackagesExpired){
                return $localTourPackagesExpired->CountDownDaysForLocalTourPackageTripLabel;
            })
            ->addColumn('safari_name',function ($localTourPackagesExpired){
                return $localTourPackagesExpired->touristicAttraction->attraction_name;
            })
            ->addColumn('safari_start_date', function ($localTourPackagesExpired){
                return $localTourPackagesExpired->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($localTourPackagesExpired){
                return $localTourPackagesExpired->safari_end_date;
            })
            ->addColumn('localTourPackageStatus', function ($localTourPackagesExpired){
                return $localTourPackagesExpired->ExpiredLocalTourPackageStatusLabel;
            })
            ->addColumn('actions', function ($localTourPackagesExpired){
                return $localTourPackagesExpired->ExpiredLocalTourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','localTourPackageCountDownDays','companyPostedLocalTourPackage','localTourPackageExpired','localTourPackagePostedTime','localTourPackageStatus'])
            ->make(true);
    }
    public function getDeletedLocalTourPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $localTourPackagesDeleted=localTourPackages::onlyTrashed()->with('tourOperator','touristicAttraction')->where('tour_operator_id',$tourOperator->id)->get();
        return DataTables::of($localTourPackagesDeleted)
            ->addIndexColumn()
            ->addColumn('id',function ($localTourPackagesDeleted){
                return $localTourPackagesDeleted->id;
            })
            ->addColumn('companyPostedLocalTourPackage',function ($localTourPackagesDeleted){
                return $localTourPackagesDeleted->tourOperator->company_name;
            })
            ->addColumn('localTourPackagePostedTime',function ($localTourPackagesDeleted){
                return date('jS M Y H:m:s a',strtotime($localTourPackagesDeleted->created_at));
            })
            ->addColumn('localTourPackageExpired', function ($localTourPackagesDeleted){
                if ($localTourPackagesDeleted->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($localTourPackagesDeleted->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('localTourPackageCountDownDays', function ($localTourPackagesDeleted){
                return $localTourPackagesDeleted->CountDownDaysForDeletedLocalTourPackageTripLabel;
            })
            ->addColumn('safari_name',function ($localTourPackagesDeleted){
                return $localTourPackagesDeleted->touristicAttraction->attraction_name;
            })
            ->addColumn('safari_start_date', function ($localTourPackagesDeleted){
                return $localTourPackagesDeleted->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($localTourPackagesDeleted){
                return $localTourPackagesDeleted->safari_end_date;
            })
            ->addColumn('localTourPackageStatus', function ($localTourPackagesDeleted){
                return $localTourPackagesDeleted->DeletedLocalTourPackageStatusLabel;
            })
            ->addColumn('actions', function ($localTourPackagesDeleted){
                return $localTourPackagesDeleted->DeletedLocalPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','localTourPackageCountDownDays','companyPostedLocalTourPackage','localTourPackageExpired','localTourPackagePostedTime','localTourPackageStatus'])
            ->make(true);
    }
}
