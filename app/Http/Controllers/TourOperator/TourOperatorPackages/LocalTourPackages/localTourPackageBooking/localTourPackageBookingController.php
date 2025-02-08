<?php

namespace App\Http\Controllers\TourOperator\TourOperatorPackages\LocalTourPackages\localTourPackageBooking;

use App\Http\Controllers\Controller;
use App\Models\BaseModel\Traits\BookingSmsTrait;
use App\Models\specialNeed\specialNeed;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTripCancellation\localTourPackageCancelledbookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageCollectionStops\localTourPackageCollectionStops;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackageBooking\localTourPackageBookingRepository;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class localTourPackageBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($localTourPackageUuid)
    {
        
        $localTourPackage=localTourPackages::query()->where('uuid',$localTourPackageUuid)->first();
        $localTourPackageBooking=localTourPackageBookings::query()->where('local_tour_package_id',$localTourPackage->id)->first();

        return view('TourOperator.TourPackages.localTourPackages.bookings.index')
        ->with('localTourPackageBooking',$localTourPackageBooking)
        ->with('localTourPackage',$localTourPackage);
    }
    public function approvedLocalBookingsIndex($localTourPackageUuid)
    {
        $localTourPackage=localTourPackages::query()->where('uuid',$localTourPackageUuid)->first();
        $localTourPackageBooking=localTourPackageBookings::query()->where('local_tour_package_id',$localTourPackage->id)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.approvedBookings.index')
            ->with('localTourPackageBooking',$localTourPackageBooking)
            ->with('localTourPackage',$localTourPackage);
    }
    public function unapprovedLocalBookingIndex($localTourPackageUuid)
    {
        $localTourPackage=localTourPackages::query()->where('uuid',$localTourPackageUuid)->first();
        $localTourPackageBooking=localTourPackageBookings::query()->where('local_tour_package_id',$localTourPackage->id)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.unapprovedBookings.index')
            ->with('localTourPackageBooking',$localTourPackageBooking)
            ->with('localTourPackage',$localTourPackage);
    }
    public function deletedLocalBookingIndex($localTourPackageUuid)
    {
        $localTourPackage=localTourPackages::query()->where('uuid',$localTourPackageUuid)->first();
        $localTourPackageBooking=localTourPackageBookings::query()->where('local_tour_package_id',$localTourPackage->id)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.deletedBookings.index')
            ->with('localTourPackageBooking',$localTourPackageBooking)
            ->with('localTourPackage',$localTourPackage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reference_number='REF - '.strtoupper(uniqid());
        $validator=Validator::make($request->all(),
        [
            'tourist_name' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'email_address' => 'required|email',
            'total_number_foreigner_child' => 'required|numeric|max:999',
            'total_number_local_child' => 'required|numeric|max:999',
            'total_number_foreigner_adult' => 'required|numeric|max:999',
            'total_number_local_adult' => 'required|numeric|max:999',
            'collection_station' => 'required',
            'payment_mode'=>'required',
            'special_attention' => 'nullable',
            'reservation_id' => 'nullable',
            'user_id'=>'required',
            'accept_terms' => 'required',
            'payment_agreement' => 'required',
            'message' => 'required|string|max:100',
            'total_free_of_charge_children'=>'required|numeric',
            'tour_operator_id' => 'required|numeric',
            'local_tour_package_id' => 'required|numeric',
        ]);

        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $localtourPackageBooking=new localTourPackages();
        $localTourPackageBookingRepo=new localTourPackageBookingRepository();
        $localTourPackageBooking=$localTourPackageBookingRepo->storeLocalTourBooking($input,$reference_number);
        return back()->with('localTourPackageBooking',$localTourPackageBooking)->withFlashSuccess('Your request has been submitted. Please relax while waiting for the best response from the tour operator');
    }
    public function previewInvoice($localTourPackageBookingUuid)
    {
        $localTourPackageBooking=localTourPackageBookings::query()->where('uuid',$localTourPackageBookingUuid)->first();
        $localTourPackageReservationIds=DB::table('local_package_reservation')->where('local_tour_package_id',$localTourPackageBooking->localTourPackages->id)->pluck('tour_operator_reservation_id');
        $localTourPackageReservations=tourOperatorReservation::query()->whereIn('id',$localTourPackageReservationIds)->get();
        $tanzaniaRegions=tanzaniaRegions::query()->where('status','=',1)->pluck('region_name','id');
        return view('TourOperator.TourPackages.localTourPackages.paymentDetails.invoices.preview')
            ->with('tanzaniaRegions',$tanzaniaRegions)
            ->with('localTourPackageBooking',$localTourPackageBooking)
            ->with('localTourPackageReservations',$localTourPackageReservations);
    }
    public function printInvoice($localTourPackageBookingUuid)
{
    $localTourPackageBooking = localTourPackageBookings::with([
        'tourOperator',
        'localTourPackages.touristicAttraction',
        'tourOperatorReservation',
        'collectionStop'
    ])->where('uuid', $localTourPackageBookingUuid)->firstOrFail();

    $tanzaniaRegions = cache()->remember('tanzania_regions', 60*24, function() {
        return tanzaniaRegions::where('status', 1)->pluck('region_name', 'id');
    });

    // Configure mPDF with default fonts instead of Lato
    $mpdf = new Mpdf([
        'tempDir' => storage_path('tmp'),
        'format' => 'A4',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 16,
        'margin_bottom' => 16,
        'margin_header' => 9,
        'margin_footer' => 9,
        'default_font' => 'dejavusans',
    ]);

    $html = view('TourOperator.TourPackages.localTourPackages.paymentDetails.invoices.printable', compact(
        'localTourPackageBooking',
        'tanzaniaRegions'
    ))->render();

    $mpdf->WriteHTML($html);
    
    return $mpdf->Output('Tour Invoice.pdf', 'I');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($localTourBookingUuid)
    {
        $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.view')
            ->with('localTourBooking',$localTourBooking);
    }
    public function viewDeleted($localTourBookingUuid)
    {
        $localTourBooking=localTourPackageBookings::onlyTrashed()->where('uuid',$localTourBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.deletedBookings.view')
            ->with('localTourBooking',$localTourBooking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($localTourPackageBookingUuid)
    {
        
        $localTourPackageBooking=localTourPackageBookings::query()->with('localTourPackages')->where('uuid',$localTourPackageBookingUuid)->first();
        $package_range=['','Quarterly Plan (3 Months)','Semi-Annual Plan (6 Months)','Tri-Annual Plan (9 Months)','Annual Plan (12 Months)'];
        $localTourPackage=localTourPackages::query()->with('tourOperator','tourPackageType','tanzaniaAndWorldEvent','touristicAttraction')->where('uuid',$localTourPackageBooking->localTourPackages->uuid)->first();
        $localTourPackagePackageRangeId = $localTourPackage->package_range;
        $localTourPackagePackageRangeName = $package_range[$localTourPackagePackageRangeId] ?? 'Unknown Plan';
        $localTourCollectionStations=localTourPackageCollectionStops::query()->where('local_tour_package_id',$localTourPackageBooking->local_tour_package_id)->get();
        $safariAreaPreferenceReservationsIds=DB::table('reservation_attractions')->where('touristic_attraction_id',$localTourPackageBooking->localTourpackages->touristicAttraction->id)->pluck('tour_operator_reservation_id');
        $safariAreaPreferenceReservations=tourOperatorReservation::query()->whereIn('id',$safariAreaPreferenceReservationsIds)->get();
        $localTourPackageSupportedSpecialNeedIds=DB::table('local_package_special_need')->where('local_tour_package_id',$localTourPackageBooking->localTourPackages->id)->pluck('special_need_id');
        $localTourPackageSupportedSpecialNeeds=specialNeed::query()->whereIn('id',$localTourPackageSupportedSpecialNeedIds)->pluck('special_need_name');
        $localTourPackageReservationsIds=DB::table('local_package_reservation')->where('local_tour_package_id',$localTourPackage->id)->pluck('tour_operator_reservation_id');
        $localTourPackageReservations=tourOperatorReservation::with('localTourPackage')->whereIn('id',$localTourPackageReservationsIds)->get();
        return view('TourOperator.TourPackages.localTourPackages.bookings.edit')
            ->with('safariAreaPreferenceReservations',$safariAreaPreferenceReservations)
            ->with('localTourPackageReservations',$localTourPackageReservations)
            ->with('localTourPackagePackageRangeName',$localTourPackagePackageRangeName)
            ->with('localTourCollectionStations',$localTourCollectionStations)
            ->with('localTourPackageSupportedSpecialNeeds',$localTourPackageSupportedSpecialNeeds)
            ->with('localTourPackageBooking',$localTourPackageBooking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $localTourBookingUuid)
    {
        $validator=Validator::make($request->all(),
            [
                'tourist_name' => 'required|string|max:255',
                'phone_number' => 'required|regex:/^[0-9]{10}$/',
                'email_address' => 'required|email',
                'total_number_foreigner_child' => 'required|numeric|max:999',
                'total_number_local_child' => 'required|numeric|max:999',
                'total_number_foreigner_adult' => 'required|numeric|max:999',
                'total_number_local_adult' => 'required|numeric|max:999',
                'collection_station' => 'required',
                'special_attention' => 'nullable',
                'reservation_id' => 'nullable',
                'user_id'=>'required',
                'accept_terms' => 'required',
                'payment_mode' => 'required',
                'payment_agreement' => 'required',
                'message' => 'required|string|max:100',
                'tour_operator_id' => 'required|numeric',
                'total_free_of_charge_children'=>'required|numeric',
                'local_tour_package_id' => 'required|numeric',
            ]);

        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->except('reference_number');
        $localTourPackageBookingRepo=new localTourPackageBookingRepository();
        $localTourPackageBooking=$localTourPackageBookingRepo->updatelocalTourBooking($input,$localTourBookingUuid);
        return back()->with('localTourBooking',$localTourPackageBooking)->withFlashSuccess('Local tour booking was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($localTourBookingUuid)
    {
        $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
        $localTourBooking->delete();
        return back()->withFlashSuccess('The local tour booking was deleted successfully. You can restore it when needed from the deleted bookings section');
    }

    public function restore($localTourBookingUuid)
    {
        $deletedLocalTourBooking=localTourPackageBookings::onlyTrashed()->where('uuid',$localTourBookingUuid)->first();
        $deletedLocalTourBooking->restore();
        return back()->withFlashSuccess('The local tour booking was restored successfully');
    }
    public function forceDelete($localTourBookingUuid)
    {
        $deletedLocalTourBooking=localTourPackageBookings::onlyTrashed()->where('uuid',$localTourBookingUuid)->first();
        $deletedLocalTourBooking->forceDelete();
        return back()->withFlashSuccess('The local tour booking was deleted permanently');
    }
    public function approveOrUnApproveBooking(Request $request)
    {
        $booking=localTourPackageBookings::find($request->id);
        $status=$booking->status;
        switch ($status)
        {
            case 0:
                $booking->status=1;
                break;
            case 1:
                $booking->status=0;
                break;
        }
        $booking->save();
        return response()->json(['success'=>true]);
    }

    public function getLocalTourBookings($localTourPackageId)
    {
        $localTourPackageBooking=localTourPackageBookings::query()->where('local_tour_package_id',$localTourPackageId)->with('localTourPackages','localTourPackageCancelledBookings')->orderBy('id','DESC')->get();
        return DataTables::of($localTourPackageBooking)
            ->addColumn('booking_date_and_time',function ($localTourPackageBooking)
            {
                return (date('jS M Y H:i a',strtotime($localTourPackageBooking->created_at)));
            })
            ->addColumn('tourist_name',function ($localTourPackageBooking)
            {
                return $localTourPackageBooking->tourist_name;
            })
            ->addColumn('phone_number',function ($localTourPackageBooking)
            {
                return $localTourPackageBooking->phone_number;
            })
            ->addColumn('email_address',function ($localTourPackageBooking)
            {
                return $localTourPackageBooking->email_address;
            })
            ->addColumn('collection_station',function ($localTourPackageBooking)
            {
                return localTourPackageCollectionStops::find($localTourPackageBooking->collection_station)->collection_stop_name;
            })
            ->addColumn('total_tourists',function ($localTourPackageBooking)
            {
                return $localTourPackageBooking->totalTouristsLabel;
            })
            ->addColumn('tour_price',function ($localTourPackageBooking){
                return '<span class="badge badge-primary">Tshs ' . number_format($localTourPackageBooking->tourPriceLabel, 2) . ' /=</span>';
            })
            ->addColumn('discount_offered',function ($localTourPackageBooking){
                return  $localTourPackageBooking->localTourPackages->discount_offered .'%';
            })
            ->addColumn('discount_eligibility',function ($localTourPackageBooking){
                return $localTourPackageBooking->TouristEligibilityForDiscountLabel;
            })
            ->addColumn('tour_price_after_discount',function ($localTourPackageBooking){
                return '<span class="badge badge-primary">Tshs ' . number_format($localTourPackageBooking->DiscountedTourPriceLabel, 2) . ' /=</span>';
            })
            ->addColumn('payment_mode',function ($localTourPackageBooking){
                return $localTourPackageBooking->paymentModeLabel;
            })
            ->addColumn('amount_paid',function ($localTourPackageBooking){
                return $localTourPackageBooking->AmountPaidLabel;
            })
            ->addColumn('payment_progress',function ($localTourPackageBooking){
                return $localTourPackageBooking->PaymentProgressLabel;
            })
            ->addColumn('approve_or_un_approve_booking',function($localTourPackageBooking){
                $btn='<label class="switch{{$localTourPackageBooking->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function($localTourPackageBooking){
                return $localTourPackageBooking->bookingStatusLabel;
            })
            ->addColumn('tripCancellationRequest',function($localTourPackageBooking){
                if($localTourPackageBooking->TotalLocalCancelledTripBookingsLabel == 1)
                {
                    return '<span class="badge badge-danger">Cancellation Requested</span>';
                }
                else
                {
                    return '<span class="badge badge-success">Not Requested Cancel</span>';

                }
            })
            ->addColumn('tripCancellationStatus', function ($localTourPackageBooking) {
                return $localTourPackageBooking->LocalCancelledTripBookingStatusLabel;
            })
            
            ->addColumn('actions',function ($localTourPackageBooking){
                return $localTourPackageBooking->localBookingButtonActionLabel;
            })
            ->rawColumns(['tour_price','tripCancellationRequest','tripCancellationStatus','amount_paid','payment_progress','booking_status','payment_mode','discount_eligibility','tour_price_after_discount','actions','approve_or_un_approve_booking'])
            ->make(true);
    }
    public function getApprovedLocalTourBookings($localTourPackageId)
    {
        $approvedLocalTourBookings=localTourPackageBookings::query()->where('local_tour_package_id',$localTourPackageId)->where('status','=',1)->with('localTourPackages','localTourPackageCancelledBookings')->orderBy('id','DESC')->get();
        return DataTables::of($approvedLocalTourBookings)
            ->addColumn('booking_date_and_time',function ($approvedLocalTourBookings)
            {
                return (date('jS M Y H:i a',strtotime($approvedLocalTourBookings->created_at)));
            })
            ->addColumn('tourist_name',function ($approvedLocalTourBookings)
            {
                return $approvedLocalTourBookings->tourist_name;
            })
            ->addColumn('phone_number',function ($approvedLocalTourBookings)
            {
                return $approvedLocalTourBookings->phone_number;
            })
            ->addColumn('email_address',function ($approvedLocalTourBookings)
            {
                return $approvedLocalTourBookings->email_address;
            })
            ->addColumn('collection_station',function ($approvedLocalTourBookings)
            {
                return localTourPackageCollectionStops::find($approvedLocalTourBookings->collection_station)->collection_stop_name;
            })
            ->addColumn('total_tourists',function ($approvedLocalTourBookings)
            {
                return $approvedLocalTourBookings->totalTouristsLabel;
            })
            ->addColumn('tour_price',function ($approvedLocalTourBookings){
                return '<span class="badge badge-primary">Tshs ' . number_format($approvedLocalTourBookings->tourPriceLabel, 2) . ' /=</span>';
            })
            ->addColumn('discount_offered',function ($approvedLocalTourBookings){
                return  $approvedLocalTourBookings->localTourPackages->discount_offered .'%';
            })
            ->addColumn('discount_eligibility',function ($approvedLocalTourBookings){
                return $approvedLocalTourBookings->TouristEligibilityForDiscountLabel;
            })
            ->addColumn('tour_price_after_discount',function ($approvedLocalTourBookings){
                return '<span class="badge badge-primary">Tshs ' . number_format($approvedLocalTourBookings->DiscountedTourPriceLabel, 2) . ' /=</span>';
            })
            ->addColumn('payment_mode',function ($approvedLocalTourBookings){
                return $approvedLocalTourBookings->paymentModeLabel;
            })
            ->addColumn('amount_paid',function ($approvedLocalTourBookings){
                return $approvedLocalTourBookings->AmountPaidLabel;
            })
            ->addColumn('payment_progress',function ($approvedLocalTourBookings){
                return $approvedLocalTourBookings->PaymentProgressLabel;
            })
            ->addColumn('approve_or_un_approve_booking',function($approvedLocalTourBookings){
                $btn='<label class="switch{{$approvedLocalTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function($approvedLocalTourBookings){
                return $approvedLocalTourBookings->bookingStatusLabel;
            })
            ->addColumn('tripCancellationRequest',function($localTourPackageBooking){
                if($localTourPackageBooking->TotalLocalCancelledTripBookingsLabel == 1)
                {
                    return '<span class="badge badge-danger">Cancellation Requested</span>';
                }
                else
                {
                    return '<span class="badge badge-success">Not Requested Cancel</span>';

                }
            })
            ->addColumn('tripCancellationStatus', function ($localTourPackageBooking) {
                return $localTourPackageBooking->LocalCancelledTripBookingStatusLabel;
            })
            ->addColumn('actions',function ($approvedLocalTourBookings){
                return $approvedLocalTourBookings->localBookingButtonActionLabel;
            })
            ->rawColumns(['tour_price','tripCancellationRequest','tripCancellationStatus','tripCancellationStatus','tripCancellationRequest','amount_paid','payment_progress','booking_status','payment_mode','discount_eligibility','tour_price_after_discount','actions','approve_or_un_approve_booking'])
            ->make(true);
    }
    public function getUnapprovedLocalTourBookings($localTourPackageId)
    {
        $unapprovedLocalTourBookings=localTourPackageBookings::query()->where('local_tour_package_id',$localTourPackageId)->where('status','=',0)->with('localTourPackages','localTourPackageCancelledBookings')->orderBy('id','DESC')->get();
        return DataTables::of($unapprovedLocalTourBookings)
            ->addColumn('booking_date_and_time',function ($unapprovedLocalTourBookings)
            {
                return (date('jS M Y H:i a',strtotime($unapprovedLocalTourBookings->created_at)));
            })
            ->addColumn('tourist_name',function ($unapprovedLocalTourBookings)
            {
                return $unapprovedLocalTourBookings->tourist_name;
            })
            ->addColumn('phone_number',function ($unapprovedLocalTourBookings)
            {
                return $unapprovedLocalTourBookings->phone_number;
            })
            ->addColumn('email_address',function ($unapprovedLocalTourBookings)
            {
                return $unapprovedLocalTourBookings->email_address;
            })
            ->addColumn('collection_station',function ($unapprovedLocalTourBookings)
            {
                return localTourPackageCollectionStops::find($unapprovedLocalTourBookings->collection_station)->collection_stop_name;
            })
            ->addColumn('total_tourists',function ($unapprovedLocalTourBookings)
            {
                return $unapprovedLocalTourBookings->totalTouristsLabel;
            })
            ->addColumn('tour_price',function ($unapprovedLocalTourBookings){
                return '<span class="badge badge-primary">Tshs ' . number_format($unapprovedLocalTourBookings->tourPriceLabel, 2) . ' /=</span>';
            })
            ->addColumn('discount_offered',function ($unapprovedLocalTourBookings){
                return  $unapprovedLocalTourBookings->localTourPackages->discount_offered .'%';
            })
            ->addColumn('discount_eligibility',function ($unapprovedLocalTourBookings){
                return $unapprovedLocalTourBookings->TouristEligibilityForDiscountLabel;
            })
            ->addColumn('tour_price_after_discount',function ($unapprovedLocalTourBookings){
                return '<span class="badge badge-primary">Tshs ' . number_format($unapprovedLocalTourBookings->DiscountedTourPriceLabel, 2) . ' /=</span>';
            })
            ->addColumn('payment_mode',function ($unapprovedLocalTourBookings){
                return $unapprovedLocalTourBookings->paymentModeLabel;
            })
            ->addColumn('amount_paid',function ($unapprovedLocalTourBookings){
                return $unapprovedLocalTourBookings->AmountPaidLabel;
            })
            ->addColumn('payment_progress',function ($unapprovedLocalTourBookings){
                return $unapprovedLocalTourBookings->PaymentProgressLabel;
            })
            ->addColumn('approve_or_un_approve_booking',function($unapprovedLocalTourBookings){
                $btn='<label class="switch{{$unapprovedLocalTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
        
            ->addColumn('booking_status',function($unapprovedLocalTourBookings){
                return $unapprovedLocalTourBookings->bookingStatusLabel;
            })
            ->addColumn('tripCancellationRequest',function($localTourPackageBooking){
                if($localTourPackageBooking->TotalLocalCancelledTripBookingsLabel == 1)
                {
                    return '<span class="badge badge-danger">Cancellation Requested</span>';
                }
                else
                {
                    return '<span class="badge badge-success">Not Requested Cancel</span>';

                }
            })
            ->addColumn('tripCancellationStatus', function ($localTourPackageBooking) {
                return $localTourPackageBooking->LocalCancelledTripBookingStatusLabel;
            })
            ->addColumn('actions',function ($unapprovedLocalTourBookings){
                return $unapprovedLocalTourBookings->localBookingButtonActionLabel;
            })
            ->rawColumns(['tour_price','tripCancellationRequest','tripCancellationStatus','amount_paid','payment_progress','booking_status','payment_mode','discount_eligibility','tour_price_after_discount','actions','approve_or_un_approve_booking'])
            ->make(true);
    }
    public function getDeletedLocalTourBookings($localTourPackageId)
    {
        $deletedLocalTourBookings=localTourPackageBookings::onlyTrashed()->where('local_tour_package_id',$localTourPackageId)->with('localTourPackages','localTourPackageCancelledBookings')->orderBy('id','DESC')->get();
        return DataTables::of($deletedLocalTourBookings)
            ->addColumn('booking_date_and_time',function ($deletedLocalTourBookings)
            {
                return (date('jS M Y H:i a',strtotime($deletedLocalTourBookings->created_at)));
            })
            ->addColumn('tourist_name',function ($deletedLocalTourBookings)
            {
                return $deletedLocalTourBookings->tourist_name;
            })
            ->addColumn('phone_number',function ($deletedLocalTourBookings)
            {
                return $deletedLocalTourBookings->phone_number;
            })
            ->addColumn('email_address',function ($deletedLocalTourBookings)
            {
                return $deletedLocalTourBookings->email_address;
            })
            ->addColumn('collection_station',function ($deletedLocalTourBookings)
            {
                return localTourPackageCollectionStops::find($deletedLocalTourBookings->collection_station)->collection_stop_name;
            })
            ->addColumn('total_tourists',function ($deletedLocalTourBookings)
            {
                return $deletedLocalTourBookings->DeletedTotalTouristsLabel;
            })
            ->addColumn('tour_price',function ($deletedLocalTourBookings){
                return '<span class="badge badge-primary">Tshs ' . number_format($deletedLocalTourBookings->TourPriceForDeletedBookingLabel, 2) . ' /=</span>';
            })
            ->addColumn('discount_offered',function ($deletedLocalTourBookings){
                return  $deletedLocalTourBookings->localTourPackages->discount_offered .'%';
            })
            ->addColumn('discount_eligibility',function ($deletedLocalTourBookings){
                return $deletedLocalTourBookings->DeletedTouristEligibilityForDiscountLabel;
            })
            ->addColumn('tour_price_after_discount',function ($deletedLocalTourBookings){
                return '<span class="badge badge-primary">Tshs ' . number_format($deletedLocalTourBookings->DiscountedTourPriceForDeletedBookingLabel, 2) . ' /=</span>';
            })
            ->addColumn('payment_mode',function ($deletedLocalTourBookings){
                return $deletedLocalTourBookings->paymentModeLabel;
            })
            ->addColumn('amount_paid',function ($deletedLocalTourBookings){
                return $deletedLocalTourBookings->AmountPaidLabel;
            })
            ->addColumn('payment_progress',function ($deletedLocalTourBookings){
                return $deletedLocalTourBookings->PaymentProgressLabel;
            })

            ->addColumn('booking_status',function($deletedLocalTourBookings){
                return $deletedLocalTourBookings->deletedLocalBookingStatusLabel;
            })
            ->addColumn('tripCancellationRequest',function($localTourPackageBooking){
                if($localTourPackageBooking->TotalLocalCancelledDeletedTripBookingsLabel == 1)
                {
                    return '<span class="badge badge-danger">Cancellation Requested</span>';
                }
                else
                {
                    return '<span class="badge badge-success">Not Requested Cancel</span>';

                }
            })
            ->addColumn('tripCancellationStatus', function ($localTourPackageBooking) {
                return $localTourPackageBooking->LocalCancelledDeletedTripBookingStatusLabel;
            })
            ->addColumn('actions',function ($deletedLocalTourBookings){
                return $deletedLocalTourBookings->deletedLocalBookingButtonActionLabel;
            })
            ->rawColumns(['tour_price','tripCancellationRequest','tripCancellationStatus','amount_paid','payment_progress','booking_status','payment_mode','discount_eligibility','tour_price_after_discount','actions','approve_or_un_approve_booking'])
            ->make(true);
    }
}
