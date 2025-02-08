<?php

namespace App\Http\Controllers\TourOperator\reservations;

use App\Http\Controllers\Controller;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\touristicGames\touristicGame;
use App\Models\TourOperator\reservations\reservationFacilities\tourOperatorReservationFacility;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Repositories\TourOperator\reservations\tourOperatorReservationRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class tourOperatorReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.reservation.index')
            ->with('tourOperator',$tourOperator);
    }
    public function approvedReservationIndex($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.reservation.approvedReservations.index')
            ->with('tourOperator',$tourOperator);
    }

    public function unapprovedReservationIndex($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.reservation.unapprovedReservations.index')
            ->with('tourOperator',$tourOperator);
    }
    public function deletedReservationIndex($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.reservation.deletedReservations.index')
            ->with('tourOperator',$tourOperator);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        $tourOperatorSafariPreferenceIds=DB::table('operator_touristic_attraction')->where('tour_operator_id',$tourOperator->id)->pluck('touristic_attraction_id');
        $tourOperatorSafariPreferences=touristicAttractions::query()->whereIn('id',$tourOperatorSafariPreferenceIds)->pluck('attraction_name','id');
        $reservationRegionIds=DB::table('operator_tanzania_region')->where('tour_operator_id',$tourOperator->id)->pluck('tanzania_region_id');
        $reservationRegion=tanzaniaRegions::query()->whereIn('id',$reservationRegionIds)->pluck('region_name','id');
        $touristicGames=touristicGame::query()->where('status','=',1)->pluck('game_name','id');
        return view('TourOperator.reservation.create')
            ->with('touristicGames',$touristicGames)
            ->with('reservationRegion',$reservationRegion)
            ->with('tourOperatorSafariPreferences',$tourOperatorSafariPreferences)
            ->with('tourOperator',$tourOperator);
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
            'reservation_name'=>'required|string|max:50',
            'reservation_capacity'=>'required|string|max:300',
            'reservation_url'=>'required|url',
            'reservation_images.*' => 'required|mimes:png,jpg,jpeg|max:5120|dimensions:max_height:2000,max_width:2000',
            'region_found'=>'required',
            'resident_child_price_reservation'=>'required|numeric',
            'resident_adult_price_reservation'=>'required|numeric',
            'foreigner_adult_price_reservation'=>'required|numeric',
            'foreigner_child_price_reservation'=>'required|numeric',
            'touristic_game_deployed'=>'nullable',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $input=$request->all();
        $tourOperatorReservationsRepo=new tourOperatorReservationRepository();
        $tourOperatorReservations=$tourOperatorReservationsRepo->storeTourOperatorReservations($input);
        return back()->with('tourOperatorReservations',$tourOperatorReservations)->withFlashSuccess('Reservation added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tourOperatorReservationUuid)
    {
        $tourOperatorReservation=tourOperatorReservation::query()->where('uuid',$tourOperatorReservationUuid)->first();
        $tourOperatorReservationFacilities=tourOperatorReservationFacility::query()->where('tour_operator_reservation_id',$tourOperatorReservation->id)->get();
        return view('TourOperator.reservation.view')
            ->with('tourOperatorReservation',$tourOperatorReservation)
            ->with('tourOperatorReservationFacilities',$tourOperatorReservationFacilities);
    }
    public function viewDeletedReservation($tourOperatorReservationUuid)
    {
        $tourOperatorReservation=tourOperatorReservation::onlyTrashed()->where('uuid',$tourOperatorReservationUuid)->first();
        $tourOperatorReservationFacilities=tourOperatorReservationFacility::query()->where('tour_operator_reservation_id',$tourOperatorReservation->id)->get();
        return view('TourOperator.reservation.deletedReservations.view')
            ->with('tourOperatorReservation',$tourOperatorReservation)
            ->with('tourOperatorReservationFacilities',$tourOperatorReservationFacilities);
    }
    public function allReservations()
    {
        $localTourPackageReservationsIds=DB::table('local_package_reservation')->pluck('local_tour_package_id');
        $reservationLocalTourPackages=localTourPackages::query()
            ->whereIn('id',$localTourPackageReservationsIds)
            ->where('safari_start_date','>=',Carbon::now())
            ->inRandomOrder()
            ->paginate(15);
        return view('TourOperator.reservation.allReservations')
            ->with('reservationLocalTourPackages',$reservationLocalTourPackages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tourOperatorReservationUuid)
    {
        $tourOperatorReservation=tourOperatorReservation::query()->where('uuid',$tourOperatorReservationUuid)->first();
        $tourOperatorReservationFacilities=tourOperatorReservationFacility::query()->where('tour_operator_reservation_id',$tourOperatorReservation->id)->get();
        $tourOperatorReservationSafariPreferenceIds=DB::table('reservation_attractions')->where('tour_operator_reservation_id',$tourOperatorReservation->id)->pluck('touristic_attraction_id');
        $tourOperatorSafariPreferenceIds=DB::table('operator_touristic_attraction')->where('tour_operator_id',$tourOperatorReservation->tourOperator->id)->pluck('touristic_attraction_id');
        $tourOperatorSafariPreferences=touristicAttractions::query()->whereIn('id',$tourOperatorSafariPreferenceIds)->pluck('attraction_name','id');
        $reservationTouristicGamesIds=DB::table('reservation_touristic_game')->where('tour_operator_reservation_id',$tourOperatorReservation->id)->pluck('touristic_game_id');
        $reservationTouristicGames=touristicGame::query()->whereIn('id',$reservationTouristicGamesIds)->pluck('game_name','id');
        $reservationRegionIds=DB::table('operator_tanzania_region')->where('tour_operator_id',$tourOperatorReservation->tourOperator->id)->pluck('tanzania_region_id');
        $reservationRegion=tanzaniaRegions::query()->whereIn('id',$reservationRegionIds)->pluck('region_name','id');
        $touristicGames=touristicGame::query()->where('status','=',1)->pluck('game_name','id');
        return view('TourOperator.reservation.edit')
            ->with('reservationTouristicGamesIds',$reservationTouristicGamesIds)
            ->with('tourOperatorReservationSafariPreferenceIds',$tourOperatorReservationSafariPreferenceIds)
            ->with('reservationRegion',$reservationRegion)
            ->with('tourOperatorSafariPreferences',$tourOperatorSafariPreferences)
            ->with('tourOperatorReservation',$tourOperatorReservation)
            ->with('touristicGames',$touristicGames)
            ->with('reservationTouristicGames',$reservationTouristicGames)
            ->with('tourOperatorReservationFacilities',$tourOperatorReservationFacilities);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tourOperatorReservationUuid)
    {
        $validator=Validator::make($request->all(),
            [
                'reservation_name'=>'required|string|max:50',
                'reservation_capacity'=>'required|string|max:300',
                'reservation_url'=>'required|url',
                'reservation_images.*' => 'nullable|mimes:png,jpg,jpeg|max:5120|dimensions:max_height:2000,max_width:2000',
                'region_found'=>'required',
                'resident_child_price_reservation'=>'required|numeric',
                'resident_adult_price_reservation'=>'required|numeric',
                'foreigner_adult_price_reservation'=>'required|numeric',
                'foreigner_child_price_reservation'=>'required|numeric',
                'touristic_game_deployed'=>'nullable',
            ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $input=$request->all();
        $tourOperatorReservationsRepo=new tourOperatorReservationRepository();
        $tourOperatorReservations=$tourOperatorReservationsRepo->updateTourOperatorReservation($input,$tourOperatorReservationUuid,$request);
        return back()->with('tourOperatorReservations',$tourOperatorReservations)->withFlashSuccess('Reservation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activateTourCompanyReservation(Request $request)
    {
        $tourCompanyReservation=tourOperatorReservation::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $tourCompanyReservation->status=1;
                break;
            case 1:
                $tourCompanyReservation->status=0;
                break;
        }
        $tourCompanyReservation->save();
        return response()->json(['success'=>true]);
    }
    public function destroy($reservationUuid)
    {
        $tourOperatorReservation=tourOperatorReservation::query()->where('uuid',$reservationUuid)->first();
        $tourOperatorReservation->delete();
        return back()->withFlashSuccess('Reservation was deleted successfully');
    }
    public function deleteReservationFacility($reservationFacilityUuid)
    {
        $reservationFacility = tourOperatorReservationFacility::query()->where('uuid', $reservationFacilityUuid)->first();
        $reservationFacility->delete();
        return back()->withFlashSuccess('Reservation facility was deleted successfully');
    }
    public function deletePermanently($reservationUuid)
    {
        $tourOperatorReservation=tourOperatorReservation::onlyTrashed()->where('uuid',$reservationUuid)->first();
        $tourOperatorReservation->forceDelete();
        return back()->withFlashSuccess('Reservation was deleted permanently');
    }
    public function restoreDeletedReservation($reservationUuid)
    {
        $tourOperatorReservation=tourOperatorReservation::onlyTrashed()->where('uuid',$reservationUuid)->first();
        $tourOperatorReservation->restore();
        return redirect()->route('tourOperatorReservation.index',$tourOperatorReservation->tourOperator->uuid)->withFlashSuccess('Reservation was restored successfully');
    }

    public function getTourCompanyReservations($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        $tourOperatorReservation=tourOperatorReservation::query()->with('tanzaniaRegion')->where('tour_operator_id',$tourOperator->id)->orderBy('reservation_name')->get();
        return DataTables::of($tourOperatorReservation)
            ->addIndexColumn()
            ->addColumn('reservation_name',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservation_name;
            })
            ->addColumn('reservation_capacity',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservation_capacity;
            })
            ->addColumn('region_found',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->tanzaniaRegion->region_name;
            })
            ->addColumn('activateTourOperatorReservation',function ($tourOperatorReservation){
                $btn='<label class="switch{{$tourOperatorReservation->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('reservation_status',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservationStatusLabel;
            })
            ->addColumn('actions',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->buttonActionLabel;
            })
            ->rawColumns(['actions','activateTourOperatorReservation','reservation_status'])
            ->make(true);
    }
    public function getApprovedReservations($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        $tourOperatorReservation=tourOperatorReservation::query()->with('tanzaniaRegion')->where('tour_operator_id',$tourOperator->id)->where('status','=',1)->orderBy('reservation_name')->get();
        return DataTables::of($tourOperatorReservation)
            ->addIndexColumn()
            ->addColumn('reservation_name',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservation_name;
            })
            ->addColumn('reservation_capacity',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservation_capacity;
            })
            ->addColumn('region_found',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->tanzaniaRegion->region_name;
            })
            ->addColumn('activateTourOperatorReservation',function ($tourOperatorReservation){
                $btn='<label class="switch{{$tourOperatorReservation->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('reservation_status',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservationStatusLabel;
            })
            ->addColumn('actions',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->buttonActionLabel;
            })
            ->rawColumns(['actions','activateTourOperatorReservation','reservation_status'])
            ->make(true);
    }
    public function getUnapprovedReservations($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        $tourOperatorReservation=tourOperatorReservation::query()->with('tanzaniaRegion')->where('tour_operator_id',$tourOperator->id)->where('status','=',0)->orderBy('reservation_name')->get();
        return DataTables::of($tourOperatorReservation)
            ->addIndexColumn()
            ->addColumn('reservation_name',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservation_name;
            })
            ->addColumn('reservation_capacity',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservation_capacity;
            })
            ->addColumn('region_found',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->tanzaniaRegion->region_name;
            })
            ->addColumn('activateTourOperatorReservation',function ($tourOperatorReservation){
                $btn='<label class="switch{{$tourOperatorReservation->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('reservation_status',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservationStatusLabel;
            })
            ->addColumn('actions',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->buttonActionLabel;
            })
            ->rawColumns(['actions','activateTourOperatorReservation','reservation_status'])
            ->make(true);
    }
    public function getDeletedReservations($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        $tourOperatorReservation=tourOperatorReservation::onlyTrashed()->with('tanzaniaRegion')->where('tour_operator_id',$tourOperator->id)->orderBy('reservation_name')->get();
        return DataTables::of($tourOperatorReservation)
            ->addIndexColumn()
            ->addColumn('reservation_name',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservation_name;
            })
            ->addColumn('reservation_capacity',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->reservation_capacity;
            })
            ->addColumn('region_found',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->tanzaniaRegion->region_name;
            })
            ->addColumn('reservation_status',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->deletedReservationStatusLabel;
            })
            ->addColumn('actions',function ($tourOperatorReservation)
            {
                return $tourOperatorReservation->DeletedReservationButtonActionLabel;
            })
            ->rawColumns(['actions','reservation_status'])
            ->make(true);
    }
}
