<?php

namespace App\Http\Controllers\TourOperator\TourOperatorPackages\InternationalTourPackages;

use App\Http\Controllers\Controller;
use App\Models\specialNeed\specialNeed;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageAccommodations\tourPackageAccommodations;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageActivities\tourPackageActivities;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookings;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageFeatures\tourPackageFeatures;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageTrips\tourPackageTrips;
use App\Models\TourTypes\tourTypes;
use App\Models\Transport\transport;
use App\Repositories\TourOperatorPackages\InternationalTourPackages\tourPackageRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class TourPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tour_operator_id)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tour_operator_id)->first();
        $tourPackages=TourPackages::query()->where('tour_operator_id',$tourOperator->id)->get();
        return view('TourOperator.TourPackages.internationalTourPackages.index')
            ->with('tourOperator',$tourOperator)
            ->with('tourPackages',$tourPackages);
    }
    public function companyInternationalTourPackagesIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.internationalTourPackages.index')->with('tourOperator',$tourOperator);
    }
    public function recentInternationalPostedTourPackagesIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.internationalTourPackages.recentPostedTourPackages.index')->with('tourOperator',$tourOperator);
    }
    public function verifiedInternationalTourPackagesIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.internationalTourPackages.verifiedTourPackages.index')->with('tourOperator',$tourOperator);
    }
    public function unverifiedInternationalTourPackagesIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.internationalTourPackages.unverifiedTourPackages.index')->with('tourOperator',$tourOperator);
    }
    public function nearInternationalToursToBeConductedIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.internationalTourPackages.nearTours.index')->with('tourOperator',$tourOperator);
    }
    public function expiredInternationalTourPackagesIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.internationalTourPackages.expiredTourPackages.index')->with('tourOperator',$tourOperator);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tour_operator_id)
    {
        $touristAttractions=touristicAttractions::query()->where('status','=',1)->pluck('attraction_name','id');
        $tourOperator=tourOperator::query()->where('uuid',$tour_operator_id)->first();
        $specialNeed=specialNeed::query()->where('status','=',1)->pluck('special_need_name','id');
        $safariTransport=transport::query()->where('status','=',1)->pluck('transport_name','id');
        $safariTourTypes=tourTypes::query()->where('status','=',1)->pluck('tour_type_name','id');
        return view('TourOperator.TourPackages.internationalTourPackages.create')
            ->with('tourOperator',$tourOperator)
            ->with('specialNeed',$specialNeed)
            ->with('safariTransport',$safariTransport)
            ->with('safariTourTypes',$safariTourTypes)
            ->with('touristAttractions',$touristAttractions);
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
            'main_safari_name'=>'required',
            'safari_package_description'=>'required',
            'safari_poster'=>'required|mimes:jpg,jpeg,png|max:2048|dimensions:max_height=2000,max_width=2000',
            'trip_price_adult_tanzanian'=>'required',
            'trip_price_child_tanzanian'=>'required',
            'trip_price_adult_foreigner'=>'required',
            'trip_price_child_foreigner'=>'required',
            'safari_start_date'=>'required',
            'safari_end_date'=>'required',
            'special_need'=>'required',
            'safari_transport'=>'required',
            'safari_tour_type'=>'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourPackageRepo=new tourPackageRepository();
        $tourPackage=$tourPackageRepo->storeTourPackageInformation($input,$request);
        return redirect()->back()->with('tourPackage',$tourPackage)->withFlashSuccess('Package uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tour_package)
    {
        $tourPackage=TourPackages::query()->where('uuid',$tour_package)->first();
        $tourPackageFeatures=tourPackageFeatures::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageActivities=tourPackageActivities::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageAccommodations=tourPackageAccommodations::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageTrips=tourPackageTrips::query()->where('tour_package_id',$tourPackage->id)->get();
        return view('TourOperator.TourPackages.internationalTourPackages.view')
            ->with('tourPackageFeatures',$tourPackageFeatures)
            ->with('tourPackageTrips',$tourPackageTrips)
            ->with('tourPackageActivities',$tourPackageActivities)
            ->with('tourPackageAccommodations',$tourPackageAccommodations)
            ->with('tourPackage',$tourPackage);
    }
    public function showDeletedTourPackage($tour_package)
    {
        $tourPackage=TourPackages::onlyTrashed()->where('uuid',$tour_package)->first();
        $tourPackageFeatures=tourPackageFeatures::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageActivities=tourPackageActivities::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageAccommodations=tourPackageAccommodations::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageTrips=tourPackageTrips::query()->where('tour_package_id',$tourPackage->id)->get();
        return view('TourOperator.TourPackages.internationalTourPackages.viewDeletedPackage')
            ->with('tourPackageFeatures',$tourPackageFeatures)
            ->with('tourPackageTrips',$tourPackageTrips)
            ->with('tourPackageActivities',$tourPackageActivities)
            ->with('tourPackageAccommodations',$tourPackageAccommodations)
            ->with('tourPackage',$tourPackage);
    }


    public function publicView($tour_package)
    {
        $tourPackage=TourPackages::query()->where('uuid',$tour_package)->first();
        $tourPackageFeatures=tourPackageFeatures::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageActivities=tourPackageActivities::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageAccommodations=tourPackageAccommodations::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageTrips=tourPackageTrips::query()->where('tour_package_id',$tourPackage->id)->get();
        return view('TourOperator.TourPackages.internationalTourPackages.publicView')
            ->with('tourPackageFeatures',$tourPackageFeatures)
            ->with('tourPackageTrips',$tourPackageTrips)
            ->with('tourPackageActivities',$tourPackageActivities)
            ->with('tourPackageAccommodations',$tourPackageAccommodations)
            ->with('tourPackage',$tourPackage);
    }
    public function allInternationalTourPackages()
    {
        $internationalTourPackages=TourPackages::query()->where('status','=',1)->where('safari_start_date','>=',Carbon::now())->get();
        return view('TourOperator.TourPackages.internationalTourPackages.allInternationalTourPackages.show')->with('internationalTourPackages',$internationalTourPackages);
    }

    public function renew($tour_package)
    {
//        still buggy!
        $tourPackage = TourPackages::query()->where('uuid', $tour_package)->first();
        $renewedTourPackage = $tourPackage->replicate();

        tourPackageActivities::query()->where('tour_package_id', $tourPackage->id)->cursor()->each(function ($activity) use ($renewedTourPackage) {
            $renewedTourPackageActivity = $activity->replicate();
            $renewedTourPackageActivity->tour_package_id = $renewedTourPackage->id;
            $renewedTourPackageActivity->save();
        });

        $renewedTourPackage->save();
        $tourPackage->delete();

        return redirect()->back()->withFlashSuccess('Your tour package has been renewed successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tour_package)
    {
        $tourPackage=TourPackages::query()->where('uuid',$tour_package)->first();
        $specialNeed=specialNeed::query()->where('status','=',1)->pluck('special_need_name','id');
        $specialNeedId=DB::table('tour_package_special_need')->where('tour_package_id',$tourPackage->id)->pluck('special_need_id');
        $touristAttractions=touristicAttractions::query()->where('status','=',1)->pluck('attraction_name','id');
        $tourPackageFeatures=tourPackageFeatures::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageActivities=tourPackageActivities::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageTrips=tourPackageTrips::query()->where('tour_package_id',$tourPackage->id)->get();
        $tourPackageAccommodations=tourPackageAccommodations::query()->where('tour_package_id',$tourPackage->id)->get();
        $safariTransport=transport::query()->where('status','=',1)->pluck('transport_name','id');
        $safariTransportId=DB::table('tour_package_transport')->where('tour_package_id',$tourPackage->id)->pluck('transport_id');
        $safariTourTypes=tourTypes::query()->where('status','=',1)->pluck('tour_type_name','id');
        $safariTourTypesId=DB::table('tour_package_tour_type')->where('tour_package_id',$tourPackage->id)->pluck('tour_type_id');
        return view('TourOperator.TourPackages.internationalTourPackages.edit')
            ->with('tourPackage',$tourPackage)
            ->with('tourPackageTrips',$tourPackageTrips)
            ->with('tourPackageAccommodations',$tourPackageAccommodations)
            ->with('tourPackageFeatures',$tourPackageFeatures)
            ->with('specialNeed',$specialNeed)
            ->with('specialNeedId',$specialNeedId)
            ->with('safariTransport',$safariTransport)
            ->with('safariTransportId',$safariTransportId)
            ->with('safariTourTypes',$safariTourTypes)
            ->with('safariTourTypesId',$safariTourTypesId)
            ->with('tourPackageActivities',$tourPackageActivities)
            ->with('touristAttractions',$touristAttractions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tour_package)
    {
        $validator=Validator::make($request->all(),[
            'main_safari_name'=>'required',
            'safari_package_description'=>'required',
            'safari_poster'=>'required|mimes:jpg,jpeg,png|max:2048|dimensions:max_height=600,max_width=800',
            'trip_price_adult_tanzanian'=>'required',
            'trip_price_child_tanzanian'=>'required',
            'trip_price_adult_foreigner'=>'required',
            'trip_price_child_foreigner'=>'required',
            'safari_start_date'=>'required',
            'safari_end_date'=>'required',
            'special_need'=>'required',
            'safari_transport'=>'required',
            'safari_tour_type'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourPackageRepo=new tourPackageRepository();
        $tourPackage=$tourPackageRepo->updateTourPackageInformation($input,$tour_package);
        return redirect()->back()->with('tourPackage',$tourPackage)->withFlashSuccess('Tour package updated successfully');
    }
    public function getAllInternationalTourPackagesOnSearch()
    {
        $search=DB::table('tour_package')
        ->where('safari_start_date','>=',Carbon::now())
            ->select(
                [
                    'tour_package.main_safari_name as main_safari_name',
                    'tour_package.safari_package_description as safari_package_description',
                    'tour_package.safari_poster as safari_poster',
                    'tour_package.trip_price_adult_tanzanian as trip_price_adult_tanzanian',
                    'tour_package.trip_price_child_tanzanian as trip_price_child_tanzanian',
                    'tour_package.trip_price_adult_foreigner as trip_price_adult_foreigner',
                    'tour_package.trip_price_child_foreigner as trip_price_child_foreigner',
                    'tour_package.safari_start_date as safari_start_date',
                    'tour_package.safari_end_date as safari_end_date',
                    'tour_package.safari_end_date as safari_end_date',
                    'tour_package.uuid as uuid',
                    'tour_package.id as id',
                    'tour_package.tour_operator_id as tour_operator_id',
                    'tourOperator.company_name as company_name',
                ]
            )
            ->leftJoin('touristic_attraction as attraction','attraction.id','=','tour_package.main_safari_name')
            ->leftJoin('tour_operator as tourOperator','tourOperator.id','=','tour_package.tour_operator_id');
        return $search;
    }
    public function search()
    {
     $searchedTourPackage=request()->all();
     $tourPackages=$this->getAllInternationalTourPackagesOnSearch()->where('attraction.attraction_name','LIKE','%'.$searchedTourPackage['search'].'%')
         ->orWhere('attraction.attraction_description','LIKE','%'.$searchedTourPackage['search'].'%')
         ->orWhere('attraction.attraction_category','LIKE','%'.$searchedTourPackage['search'].'%')
         ->orWhere('tourOperator.company_name','LIKE','%'.$searchedTourPackage['search'].'%')
         ->get();
     if ($tourPackages->isEmpty()){
         return $this->noInternationalPackagePostedSearchRecommendation($searchedTourPackage);
     }
        return view('TourOperator.TourPackages.internationalTourPackages.searchResults')
            ->with('tourPackages',$tourPackages)
            ->with('searchedTourPackage',$searchedTourPackage);
    }
    protected function noInternationalPackagePostedSearchRecommendation($searchedTourPackage)
    {
        $tourOperatorSafariPreferenceId = DB::table('tour_operator_touristic_attraction')->pluck('touristic_attraction_id');
        $tourOperatorSafariPreferences = touristicAttractions::whereIn('id', $tourOperatorSafariPreferenceId)->pluck('attraction_name')->toArray();

        $foundMatch = false;
        $matchingAttractionIds = [];

        foreach ($tourOperatorSafariPreferences as $preference) {
            foreach ($searchedTourPackage as $term) {
                if (stripos($preference, $term) !== false) {
                    $foundMatch = true;

                    $attractionId = DB::table('touristic_attraction')
                        ->where('attraction_name', 'like', '%' . $term . '%')
                        ->value('id');

                    if ($attractionId) {
                        $matchingAttractionIds[] = $attractionId;
                    }
                    break 2;
                }
            }
        }

        if ($foundMatch) {
            $tourOperatorIds = DB::table('tour_operator_touristic_attraction')
                ->whereIn('touristic_attraction_id', $matchingAttractionIds)
                ->where('status','=',1)
                ->pluck('tour_operator_id')
                ->toArray();

            $tourOperatorsOperatingAround = tourOperator::query()
                ->whereIn('id', $tourOperatorIds)
                ->get();
            return view('TourOperator.TourPackages.internationalTourPackages.noPackageResults')
                ->with('tourOperatorsOperatingAround',$tourOperatorsOperatingAround)
                ->with('term',$term);
        } else {
            return view('TourOperator.TourPackages.internationalTourPackages.searchResults');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tourPackage)
    {
        $tour_package=TourPackages::query()->where('uuid',$tourPackage)->first();
        $tour_package->delete();
        return redirect()->route('tourPackages.index', $tour_package->tourOperator->uuid)->withFlashSuccess('Tour package deleted successfully');
    }
    public function forceDeleteInternationalTourPackages($tourPackage)
    {
        $tour_package=TourPackages::onlyTrashed()->where('uuid',$tourPackage)->first();
        $tour_package->forceDelete();
        return redirect()->route('tourPackages.index', $tour_package->tourOperator->uuid)->withFlashSuccess('Tour package was deleted completely. You wont be able to retrieve this package');
    }
    public function deletedInternationalTourPackagesIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.TourPackages.internationalTourPackages.deletedTourPackages.index')->with('tourOperator',$tourOperator);
    }
    public function restoreInternationalDeletedTourPackages($tourPackageId)
    {
        $tourPackage=TourPackages::onlyTrashed()->where('uuid',$tourPackageId)->first();
        $tourPackage->restore();
        return redirect()->route('tourPackages.index', $tourPackage->tourOperator->uuid)->withFlashSuccess('Tour Package restored successfully');
    }
    public function ActivateOrDeactivateInternationalTourPackage(Request $request)
    {
        $tourPackage=TourPackages::find($request->id);
        $status=$tourPackage->status;
        switch ($status)
        {
            case 0:
                $tourPackage->status=1;
                break;
            case 1:
                $tourPackage->status=0;
                break;
            default:
                $tourPackage->status=0;
                break;
        }
          $tourPackage->save();
    }
    public function getCompanyInternationalTourPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $tourPackages=TourPackages::query()->with('tourOperator')->where('tour_operator_id',$tourOperator->id)->get();
        return DataTables::of($tourPackages)
            ->addIndexColumn()
            ->addColumn('id',function ($tourPackages){
                return $tourPackages->id;
            })
            ->addColumn('companyPostedTourPackage',function ($tourPackages){
                return $tourPackages->tourOperator->company_name;
            })
            ->addColumn('tourPackagePostedTime',function ($tourPackages){
                return date('jS M Y H:m:s a',strtotime($tourPackages->created_at));
            })
            ->addColumn('tourPackageExpired', function ($tourPackages){
                if ($tourPackages->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($tourPackages->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('tourPackageCountDownDays', function ($tourPackages){
                return $tourPackages->CountDownDaysForTourPackageTripLabel;
            })
            ->addColumn('main_safari_name',function ($tourPackages){
                return touristicAttractions::find($tourPackages->main_safari_name)->attraction_name;
            })
            ->addColumn('safari_start_date', function ($tourPackages){
                return $tourPackages->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($tourPackages){
                return $tourPackages->safari_end_date;
            })
            ->addColumn('activate_or_deactivate_international_tourPackage',function($tourPackages){
                $btn='<label class="switch{{$tourPackages->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tourPackageStatus', function ($tourPackages){
                return $tourPackages->TourPackageStatusLabel;
            })
            ->addColumn('actions', function ($tourPackages){
                return $tourPackages->TourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','companyPostedTourPackage','tourPackageCountDownDays','tourPackageExpired','tourPackagePostedTime','safari_poster','tourPackageStatus','activate_or_deactivate_international_tourPackage'])
            ->make(true);
    }
    public function getRecentInternationalPostedTourPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $tourPackages=TourPackages::query()->with('tourOperator')->where('tour_operator_id',$tourOperator->id)->whereBetween('created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->get();
        return DataTables::of($tourPackages)
            ->addIndexColumn()
            ->addColumn('id',function ($tourPackages){
                return $tourPackages->id;
            })
            ->addColumn('companyPostedTourPackage',function ($tourPackages){
                return $tourPackages->tourOperator->company_name;
            })
            ->addColumn('tourPackagePostedTime',function ($tourPackages){
                return date('jS M Y H:m:s a',strtotime($tourPackages->created_at));
            })
            ->addColumn('tourPackageExpired', function ($tourPackages){
                if ($tourPackages->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($tourPackages->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('tourPackageCountDownDays', function ($tourPackages){
                return $tourPackages->CountDownDaysForTourPackageTripLabel;
            })
            ->addColumn('main_safari_name',function ($tourPackages){
                return touristicAttractions::find($tourPackages->main_safari_name)->attraction_name;
            })
            ->addColumn('safari_start_date', function ($tourPackages){
                return $tourPackages->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($tourPackages){
                return $tourPackages->safari_end_date;
            })
            ->addColumn('activate_or_deactivate_international_tourPackage',function($tourPackages){
                $btn='<label class="switch{{$tourPackages->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tourPackageStatus', function ($tourPackages){
                return $tourPackages->TourPackageStatusLabel;
            })
            ->addColumn('actions', function ($tourPackages){
                return $tourPackages->TourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','companyPostedTourPackage','tourPackageCountDownDays','tourPackageExpired','tourPackagePostedTime','safari_poster','tourPackageStatus','activate_or_deactivate_international_tourPackage'])
            ->make(true);
    }
    public function getVerifiedInternationalTourPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $tourPackages=TourPackages::query()->with('tourOperator')->where('tour_operator_id',$tourOperator->id)->where('status','=',1)->get();
        return DataTables::of($tourPackages)
            ->addIndexColumn()
            ->addColumn('id',function ($tourPackages){
                return $tourPackages->id;
            })
            ->addColumn('companyPostedTourPackage',function ($tourPackages){
                return $tourPackages->tourOperator->company_name;
            })
            ->addColumn('tourPackagePostedTime',function ($tourPackages){
                return date('jS M Y H:m:s a',strtotime($tourPackages->created_at));
            })
            ->addColumn('tourPackageExpired', function ($tourPackages){
                if ($tourPackages->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($tourPackages->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('tourPackageCountDownDays', function ($tourPackages){
                return $tourPackages->CountDownDaysForTourPackageTripLabel;
            })
            ->addColumn('main_safari_name',function ($tourPackages){
                return touristicAttractions::find($tourPackages->main_safari_name)->attraction_name;
            })
            ->addColumn('safari_start_date', function ($tourPackages){
                return $tourPackages->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($tourPackages){
                return $tourPackages->safari_end_date;
            })
            ->addColumn('activate_or_deactivate_international_tourPackage',function($tourPackages){
                $btn='<label class="switch{{$tourPackages->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tourPackageStatus', function ($tourPackages){
                return $tourPackages->TourPackageStatusLabel;
            })
            ->addColumn('actions', function ($tourPackages){
                return $tourPackages->TourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','companyPostedTourPackage','tourPackageCountDownDays','tourPackageExpired','tourPackagePostedTime','safari_poster','tourPackageStatus','activate_or_deactivate_international_tourPackage'])
            ->make(true);
    }
    public function getUnVerifiedInternationalTourPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $tourPackages=TourPackages::query()->with('tourOperator')->where('tour_operator_id',$tourOperator->id)->where('status','=',0)->get();
        return DataTables::of($tourPackages)
            ->addIndexColumn()
            ->addColumn('id',function ($tourPackages){
                return $tourPackages->id;
            })
            ->addColumn('companyPostedTourPackage',function ($tourPackages){
                return $tourPackages->tourOperator->company_name;
            })
            ->addColumn('tourPackagePostedTime',function ($tourPackages){
                return date('jS M Y H:m:s a',strtotime($tourPackages->created_at));
            })
            ->addColumn('tourPackageExpired', function ($tourPackages){
                if ($tourPackages->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($tourPackages->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('tourPackageCountDownDays', function ($tourPackages){
                return $tourPackages->CountDownDaysForTourPackageTripLabel;
            })
            ->addColumn('main_safari_name',function ($tourPackages){
                return touristicAttractions::find($tourPackages->main_safari_name)->attraction_name;
            })
            ->addColumn('safari_start_date', function ($tourPackages){
                return $tourPackages->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($tourPackages){
                return $tourPackages->safari_end_date;
            })
            ->addColumn('activate_or_deactivate_international_tourPackage',function($tourPackages){
                $btn='<label class="switch{{$tourPackages->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tourPackageStatus', function ($tourPackages){
                return $tourPackages->TourPackageStatusLabel;
            })
            ->addColumn('actions', function ($tourPackages){
                return $tourPackages->TourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','companyPostedTourPackage','tourPackageCountDownDays','tourPackageExpired','tourPackagePostedTime','safari_poster','tourPackageStatus','activate_or_deactivate_international_tourPackage'])
            ->make(true);
    }
    public function getNearInternationalToursToBeConducted($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $tourPackages=TourPackages::query()->with('tourOperator')->where('tour_operator_id',$tourOperator->id)->whereBetween('safari_start_date',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->get();
       return DataTables::of($tourPackages)
           ->addIndexColumn()
           ->addColumn('id',function ($tourPackages){
               return $tourPackages->id;
           })
           ->addColumn('companyPostedTourPackage',function ($tourPackages){
               return $tourPackages->tourOperator->company_name;
           })
           ->addColumn('tourPackagePostedTime',function ($tourPackages){
               return date('jS M Y H:m:s a',strtotime($tourPackages->created_at));
           })
           ->addColumn('tourPackageExpired', function ($tourPackages){
               if ($tourPackages->safari_start_date > Carbon::now())
               {
                   return '<span class="badge badge-primary" style="font-size:12px">No</span>';
               }
               elseif ($tourPackages->safari_start_date <= Carbon::now())
               {
                   return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
               }
               else
               {
                   return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
               }
           })
           ->addColumn('tourPackageCountDownDays', function ($tourPackages){
               return $tourPackages->CountDownDaysForTourPackageTripLabel;
           })
           ->addColumn('main_safari_name',function ($tourPackages){
               return touristicAttractions::find($tourPackages->main_safari_name)->attraction_name;
           })
           ->addColumn('safari_start_date', function ($tourPackages){
               return $tourPackages->safari_start_date;
           })
           ->addColumn('safari_end_date', function ($tourPackages){
               return $tourPackages->safari_end_date;
           })
           ->addColumn('activate_or_deactivate_international_tourPackage',function($tourPackages){
               $btn='<label class="switch{{$tourPackages->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
               return $btn;
           })
           ->addColumn('tourPackageStatus', function ($tourPackages){
               return $tourPackages->TourPackageStatusLabel;
           })
           ->addColumn('actions', function ($tourPackages){
               return $tourPackages->TourPackagesButtonActionLabel;
           })
            ->rawColumns(['actions','companyPostedTourPackage','tourPackageCountDownDays','tourPackageExpired','tourPackagePostedTime','safari_poster','tourPackageStatus','activate_or_deactivate_international_tourPackage'])
            ->make(true);
    }
    public function getExpiredInternationalTourPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $tourPackages=TourPackages::query()->with('tourOperator')->where('tour_operator_id',$tourOperator->id)->where('safari_start_date','<=',[Carbon::now()])->get();
        return DataTables::of($tourPackages)
            ->addIndexColumn()
            ->addColumn('id',function ($tourPackages){
                return $tourPackages->id;
            })
            ->addColumn('companyPostedTourPackage',function ($tourPackages){
                return $tourPackages->tourOperator->company_name;
            })
            ->addColumn('tourPackagePostedTime',function ($tourPackages){
                return date('jS M Y H:m:s a',strtotime($tourPackages->created_at));
            })
            ->addColumn('tourPackageExpired', function ($tourPackages){
                if ($tourPackages->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($tourPackages->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('tourPackageCountDownDays', function ($tourPackages){
                return $tourPackages->CountDownDaysForTourPackageTripLabel;
            })
            ->addColumn('main_safari_name',function ($tourPackages){
                return touristicAttractions::find($tourPackages->main_safari_name)->attraction_name;
            })
            ->addColumn('safari_start_date', function ($tourPackages){
                return $tourPackages->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($tourPackages){
                return $tourPackages->safari_end_date;
            })
            ->addColumn('activate_or_deactivate_international_tourPackage',function($tourPackages){
                $btn='<label class="switch{{$tourPackages->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tourPackageStatus', function ($tourPackages){
                return $tourPackages->TourPackageStatusLabel;
            })
            ->addColumn('actions', function ($tourPackages){
                return $tourPackages->expiredTourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','tourPackageUpdatedTime','companyPostedTourPackage','tourPackageCountDownDays','tourPackageExpired','tourPackagePostedTime','safari_poster','tourPackageStatus','activate_or_deactivate_international_tourPackage'])
            ->make(true);
    }
    public function getDeletedInternationalTourPackages($tourOperatorId)
    {
        $tourOperator=tourOperator::find($tourOperatorId);
        $tourPackages=TourPackages::with('tourOperator')->onlyTrashed()->where('tour_operator_id',$tourOperator->id)->get();
        return DataTables::of($tourPackages)
            ->addIndexColumn()
            ->addColumn('id',function ($tourPackages){
                return $tourPackages->id;
            })
            ->addColumn('companyPostedTourPackage',function ($tourPackages){
                return $tourPackages->tourOperator->company_name;
            })
            ->addColumn('tourPackagePostedTime',function ($tourPackages){
                return date('jS M Y H:m:s a',strtotime($tourPackages->created_at));
            })
            ->addColumn('tourPackageDeletedTime',function ($tourPackages){
                return date('jS M Y H:m:s a',strtotime($tourPackages->deleted_at));
            })
            ->addColumn('tourPackageExpired', function ($tourPackages){
                if ($tourPackages->safari_start_date > Carbon::now())
                {
                    return '<span class="badge badge-primary" style="font-size:12px">No</span>';
                }
                elseif ($tourPackages->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger badge-sm" style="font-size:12px">Yes</span>';
                }
                else
                {
                    return '<span class="badge badge-warning" style="font-size: 12px">Yes</span>';
                }
            })
            ->addColumn('tourPackageCountDownDays', function ($tourPackages){
                return $tourPackages->CountDownDaysForDeletedTourPackageTripLabel;
            })
            ->addColumn('safari_poster', function ($tourPackages){
                return $tourPackages->SafariPosterLabel;
            })
            ->addColumn('main_safari_name',function ($tourPackages){
                return touristicAttractions::find($tourPackages->main_safari_name)->attraction_name;
            })
            ->addColumn('safari_start_date', function ($tourPackages){
                return $tourPackages->safari_start_date;
            })
            ->addColumn('safari_end_date', function ($tourPackages){
                return $tourPackages->safari_end_date;
            })
            ->addColumn('tourPackageStatus', function ($tourPackages){
                return $tourPackages->TourPackageStatusLabel;
            })
            ->addColumn('actions', function ($tourPackages){
                return $tourPackages->DeletedTourPackagesButtonActionLabel;
            })
            ->rawColumns(['actions','tourPackageUpdatedTime','companyPostedTourPackage','tourPackageCountDownDays','tourPackageExpired','tourPackagePostedTime','safari_poster','tourPackageStatus'])
            ->make(true);

    }
}
