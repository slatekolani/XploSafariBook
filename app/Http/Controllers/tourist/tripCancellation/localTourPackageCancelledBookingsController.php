<?php

namespace App\Http\Controllers\tourist\tripCancellation;

use App\Http\Controllers\Controller;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTripCancellation\localTourPackageCancelledbookings;
use App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackageBooking\localTripCancellation\localTripCancellationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\Facades\DataTables;

class localTourPackageCancelledBookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($localTourPackageBookingUuid)
    {
        $localTourPackageBooking=localTourPackageBookings::query()->where('uuid',$localTourPackageBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.cancelledBookings.index')->with('localTourPackageBooking',$localTourPackageBooking);
    }
    public function approvedLocalTripCancelationRequestIndex($localTourPackageBookingUuid)
    {
        $localTourPackageBooking=localTourPackageBookings::query()->where('uuid',$localTourPackageBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.cancelledBookings.approvedCancellation.index')->with('localTourPackageBooking',$localTourPackageBooking);
    }
    public function unapprovedLocalTripCancelationRequestIndex($localTourPackageBookingUuid)
    {
        $localTourPackageBooking=localTourPackageBookings::query()->where('uuid',$localTourPackageBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.cancelledBookings.unapprovedCancellation.index')->with('localTourPackageBooking',$localTourPackageBooking);
    }
    public function deletedLocalTripCancelationRequestIndex($localTourPackageBookingUuid)
    {
        $localTourPackageBooking=localTourPackageBookings::query()->where('uuid',$localTourPackageBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.cancelledBookings.deletedCancellation.index')->with('localTourPackageBooking',$localTourPackageBooking);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($upcomingTripUuid)
    {
        $localTourBooking=localTourPackageBookings::query()->where('uuid',$upcomingTripUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.cancelledBookings.create')
        ->with('localTourBooking',$localTourBooking);
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
            'cancellation_type'=>'required',
            'cancellation_reason'=>'required',
            'cancellation_reason_description'=>'required',
            'accept_cancellation_policy'=>'required',
            'local_tour_booking_id'=>'required',
        ]);
        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $localTourPackageCancelledTripRepo=new localTripCancellationRepository();
        $localTourPackageCancelledTrip=$localTourPackageCancelledTripRepo->storeLocalTripCancelledBooking($input);
        return redirect()->back()->withFlashSuccess('Local tour package cancelled booking submitted successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($localTripCancellationUuid)
    {
        $localTripCancellationRequest=localTourPackageCancelledbookings::query()->where('uuid',$localTripCancellationUuid)->first();
        $localTourBooking=localTourPackageBookings::query()->where('id',$localTripCancellationRequest->local_tour_booking_id)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.cancelledBookings.show')
        ->with('localTourBooking',$localTourBooking)
        ->with('localTripCancellationRequest',$localTripCancellationRequest);
    }

    public function showDeletedCancellatioRequest($localTripCancellationUuid)
    {
        $localTripCancellationRequest=localTourPackageCancelledbookings::onlyTrashed()->where('uuid',$localTripCancellationUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.cancelledBookings.show')->with('localTripCancellationRequest',$localTripCancellationRequest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($localTripCancellationUuid)
    {
        $localTripCancellationRequest=localTourPackageCancelledbookings::query()->where('uuid',$localTripCancellationUuid)->first();
        $localTourBooking=localTourPackageBookings::query()->where('id',$localTripCancellationRequest->local_tour_booking_id)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.cancelledBookings.edit')
        ->with('localTourBooking',$localTourBooking)  
        ->with('localTripCancellationRequest',$localTripCancellationRequest);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $localTripCancellationUuid)
    {
        $validator=Validator::make($request->all(),[
            'cancellation_type'=>'required|string',
            'cancellation_reason'=>'required|string',
            'cancellation_reason_description'=>'required|string',
            'accept_cancellation_policy'=>'required',
            'local_tour_booking_id'=>'required',
        ]);
        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $localTourPackageCancelledTripRepo=new localTripCancellationRepository();
        $localTourPackageCancelledTrip=$localTourPackageCancelledTripRepo->updateLocalTripCancelledBooking($input,$localTripCancellationUuid);
        return back()->withFlashSuccess('Local tour package cancelled booking updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($localTripCancellationUuid)
    {
        $localTourPackageCancelledTrip=localTourPackageCancelledbookings::query()->where('uuid',$localTripCancellationUuid)->first();
        $localTourPackageCancelledTrip->delete();
        return back()->withFlashSuccess('Local trip cancellation request deleted successfully');
    }
    public function deletePermanently($localTripCancellationUuid)
    {
        $localTourPackageCancelledTrip=localTourPackageCancelledbookings::onlyTrashed()->where('uuid',$localTripCancellationUuid)->first();
        $localTourPackageCancelledTrip->forceDelete();
        return back()->withFlashSuccess('Local trip cancellation request was permanently deleted successfully');
    }

    public function restore($localTripCancellationUuid)
    {
        $localTourPackageCancelledTrip=localTourPackageCancelledbookings::onlyTrashed()->where('uuid',$localTripCancellationUuid)->first();
        $localTourPackageCancelledTrip->restore();
        return back()->withFlashSuccess('Local trip cancellation request was restored successfully');
    }
   

    public function activateOrDeactivateLocalTripCancelRequest(Request $request)
    {
        $localTourPackageBookingCancelRequest=localTourPackageCancelledbookings::find($request->id);
        $status=$localTourPackageBookingCancelRequest->cancellation_status;
        switch ($status)
        {
            case 0:
                $localTourPackageBookingCancelRequest->cancellation_status=1;
                break;
            case 1:
                $localTourPackageBookingCancelRequest->cancellation_status=0;
                break;
        }
        $localTourPackageBookingCancelRequest->save();
        return response()->json(['success'=>true]);
    }
    public function getLocalTourPackageCancellationRequests($localTourPackageBookingUuid)
    {
        $localTourpackageBooking=localTourPackageBookings::query()->where('uuid',$localTourPackageBookingUuid)->first();
        $localTourPackageCancelledBookingRequest=localTourPackageCancelledbookings::query()->where('local_tour_booking_id',$localTourpackageBooking->id)->get();
        return DataTables::of($localTourPackageCancelledBookingRequest)
            ->addColumn('cancellation_date_and_time',function ($localTourPackageCancelledBookingRequest)
            {
                return (date('jS M Y H:i a',strtotime($localTourPackageCancelledBookingRequest->created_at)));
            })
            ->addColumn('cancellation_type',function ($localTourPackageCancelledBookingRequest)
            {
                return $localTourPackageCancelledBookingRequest->cancellation_type;
            })
            ->addColumn('cancellation_reason',function ($localTourPackageCancelledBookingRequest)
            {
                return $localTourPackageCancelledBookingRequest->cancellation_reason;
            })
            ->addColumn('approve_or_un_approve_cancellationRequest',function($localTourPackageCancelledBookingRequest){
                $btn='<label class="switch{{$localTourPackageCancelledBookingRequest->cancellation_status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tripCancellationStatus', function ($localTourPackageBooking) {
                return $localTourPackageBooking->localTourPackageBookings->LocalCancelledTripBookingStatusLabel;
            })
         
            ->addColumn('actions',function ($localTourPackageCancelledBookingRequest){
                return $localTourPackageCancelledBookingRequest->localBookingCancelRequestButtonActionLabel;
            })
            ->rawColumns(['actions','tripCancellationStatus'])
            ->make(true);
    }

    public function getApprovedLocalTourPackageCancellationRequests($localTourPackageBookingUuid)
    {
        $localTourpackageBooking=localTourPackageBookings::query()->where('uuid',$localTourPackageBookingUuid)->first();
        $localTourPackageCancelledBookingRequest=localTourPackageCancelledbookings::query()->where('cancellation_status','=',1)->where('local_tour_booking_id',$localTourpackageBooking->id)->get();
        return DataTables::of($localTourPackageCancelledBookingRequest)
            ->addColumn('cancellation_date_and_time',function ($localTourPackageCancelledBookingRequest)
            {
                return (date('jS M Y H:i a',strtotime($localTourPackageCancelledBookingRequest->created_at)));
            })
            ->addColumn('cancellation_type',function ($localTourPackageCancelledBookingRequest)
            {
                return $localTourPackageCancelledBookingRequest->cancellation_type;
            })
            ->addColumn('cancellation_reason',function ($localTourPackageCancelledBookingRequest)
            {
                return $localTourPackageCancelledBookingRequest->cancellation_reason;
            })
            ->addColumn('approve_or_un_approve_cancellationRequest',function($localTourPackageCancelledBookingRequest){
                $btn='<label class="switch{{$localTourPackageCancelledBookingRequest->cancellation_status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tripCancellationStatus', function ($localTourPackageBooking) {
                return $localTourPackageBooking->localTourPackageBookings->LocalCancelledTripBookingStatusLabel;
            })
         
            ->addColumn('actions',function ($localTourPackageCancelledBookingRequest){
                return $localTourPackageCancelledBookingRequest->localBookingCancelRequestButtonActionLabel;
            })
            ->rawColumns(['actions','tripCancellationStatus'])
            ->make(true);
    }

    public function getUnapprovedLocalTourPackageCancellationRequests($localTourPackageBookingUuid)
    {
        $localTourpackageBooking=localTourPackageBookings::query()->where('uuid',$localTourPackageBookingUuid)->first();
        $localTourPackageCancelledBookingRequest=localTourPackageCancelledbookings::query()->where('cancellation_status','=',0)->where('local_tour_booking_id',$localTourpackageBooking->id)->get();
        return DataTables::of($localTourPackageCancelledBookingRequest)
            ->addColumn('cancellation_date_and_time',function ($localTourPackageCancelledBookingRequest)
            {
                return (date('jS M Y H:i a',strtotime($localTourPackageCancelledBookingRequest->created_at)));
            })
            ->addColumn('cancellation_type',function ($localTourPackageCancelledBookingRequest)
            {
                return $localTourPackageCancelledBookingRequest->cancellation_type;
            })
            ->addColumn('cancellation_reason',function ($localTourPackageCancelledBookingRequest)
            {
                return $localTourPackageCancelledBookingRequest->cancellation_reason;
            })
            ->addColumn('approve_or_un_approve_cancellationRequest',function($localTourPackageCancelledBookingRequest){
                $btn='<label class="switch{{$localTourPackageCancelledBookingRequest->cancellation_status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tripCancellationStatus', function ($localTourPackageBooking) {
                return $localTourPackageBooking->localTourPackageBookings->LocalCancelledTripBookingStatusLabel;
            })
         
            ->addColumn('actions',function ($localTourPackageCancelledBookingRequest){
                return $localTourPackageCancelledBookingRequest->localBookingCancelRequestButtonActionLabel;
            })
            ->rawColumns(['actions','tripCancellationStatus'])
            ->make(true);
    }

    public function getDeletedLocalTourPackageCancellationRequests($localTourPackageBookingUuid)
    {
        $localTourpackageBooking=localTourPackageBookings::query()->where('uuid',$localTourPackageBookingUuid)->first();
        $localTourPackageCancelledBookingRequest=localTourPackageCancelledbookings::onlyTrashed()->where('local_tour_booking_id',$localTourpackageBooking->id)->get();
        return DataTables::of($localTourPackageCancelledBookingRequest)
            ->addColumn('cancellation_date_and_time',function ($localTourPackageCancelledBookingRequest)
            {
                return (date('jS M Y H:i a',strtotime($localTourPackageCancelledBookingRequest->created_at)));
            })
            ->addColumn('cancellation_type',function ($localTourPackageCancelledBookingRequest)
            {
                return $localTourPackageCancelledBookingRequest->cancellation_type;
            })
            ->addColumn('cancellation_reason',function ($localTourPackageCancelledBookingRequest)
            {
                return $localTourPackageCancelledBookingRequest->cancellation_reason;
            })
            ->addColumn('approve_or_un_approve_cancellationRequest',function($localTourPackageCancelledBookingRequest){
                $btn='<label class="switch{{$localTourPackageCancelledBookingRequest->cancellation_status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tripCancellationStatus', function ($localTourPackageBooking) {
                return $localTourPackageBooking->localTourPackageBookings->LocalCancelledTripBookingStatusLabel;
            })
         
            ->addColumn('actions',function ($localTourPackageCancelledBookingRequest){
                return $localTourPackageCancelledBookingRequest->deletedLocalBookingCancelRequestButtonActionLabel;
            })
            ->rawColumns(['actions','tripCancellationStatus'])
            ->make(true);
    }
}
