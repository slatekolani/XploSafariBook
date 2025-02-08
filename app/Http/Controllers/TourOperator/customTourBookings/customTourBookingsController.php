<?php

namespace App\Http\Controllers\TourOperator\customTourBookings;

use App\Http\Controllers\Controller;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\customTourBookings\customTourBookings;
use App\Models\TourOperator\customTourBookings\reservations\customTourBookingReservations;
use App\Models\TourOperator\customTourBookings\tourPrices\customTourBookingTourPrices;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\tourOperator;
use App\Models\tourPackageType\tourPackageType;
use App\Models\TourTypes\tourTypes;
use App\Models\Transport\transport;
use App\Repositories\customTourPackages\customTourBookingsRepository;
use Mpdf\Mpdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class customTourBookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.customTourBookings.index')
            ->with('tourOperator',$tourOperator);
    }
    public function approvedCustomTourBookingsIndex($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.customTourBookings.approvedCustomTourBookings.index')
            ->with('tourOperator',$tourOperator);
    }
    public function unApprovedCustomTourBookingsIndex($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.customTourBookings.unApprovedCustomTourBookings.index')
            ->with('tourOperator',$tourOperator);
    }

    public function recentCustomTourBookingsIndex($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.customTourBookings.recentCustomTourBookingsMade.index')
            ->with('tourOperator',$tourOperator);
    }

    public function nearCustomTourIndex($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.customTourBookings.nearCustomTours.index')
            ->with('tourOperator',$tourOperator);
    }

    public function expiredCustomTourBookingsIndex($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.customTourBookings.expiredCustomTourBookings.index')
            ->with('tourOperator',$tourOperator);
    }

    public function DeletedCustomBookingsIndex($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->first();
        return view('TourOperator.customTourBookings.deletedCustomTourBookings.index')
            ->with('tourOperator',$tourOperator);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        $tourOperatorSafariPreferenceId=DB::table('operator_touristic_attraction')->where('tour_operator_id',$tourOperator->id)->pluck('touristic_attraction_id');
        $tourOperatorSafariPreferences=touristicAttractions::whereIn('id',$tourOperatorSafariPreferenceId)->pluck('attraction_name','id');
        $tourTypes=tourTypes::query()->where('status','=',1)->pluck('tour_type_name','id');
        $tourPackageTypes=tourPackageType::query()->where('status','=',1)->pluck('tour_package_type_name','id');
        $transports=transport::query()->where('status','=',1)->pluck('transport_name','id');
        $regions=tanzaniaRegions::query()->where('status','=',1)->pluck('region_name','id');
        return view('TourOperator.customTourBookings.create')
            ->with('tourOperatorSafariPreferences',$tourOperatorSafariPreferences)
            ->with('tourPackageTypes',$tourPackageTypes)
            ->with('tourTypes',$tourTypes)
            ->with('regions',$regions)
            ->with('transports',$transports)
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
        $reference_number='REF-'.strtoupper(uniqid());
        $validator=Validator::make($request->all(),[
            'tourist_name'=>'required|string',
            'tourist_email_address'=>'required|email',
            'tourist_region'=>'required',
            'tourist_phone_number'=>'required|regex:/^[0-9]{10}$/',
            'tour_type'=>'required',
            'tour_package_type'=>'required',
            'transport_type'=>'required',
            'special_need_description'=>'required|max:200|string',
            'start_date'=>'required',
            'end_date'=>'required',
            'total_adult_foreigners'=>'required|numeric|max:999',
            'total_children_foreigners'=>'required|numeric|max:999',
            'total_children_residents'=>'required|numeric|max:999',
            'total_adult_residents'=>'required|numeric|max:999',
            'reservation_needed'=>'required',
            'message'=>'required|string|max:200',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $customTourBookingsRepository=new customTourBookingsRepository();
        $customTourBookings=$customTourBookingsRepository->storeCustomTourBookings($input,$reference_number);
        return back()->with('customTourBookings',$customTourBookings)->withFlashSuccess('Thank you for requesting custom safari, this tour operator will reach out to you soon');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($custom_tour_booking_id)
    {
        $customTourBooking=customTourBookings::query()->where('uuid',$custom_tour_booking_id)->first();
        $customTourBookingReservations=customTourBookingReservations::query()->where('custom_tour_booking_id',$customTourBooking->id)->get();
        return view('TourOperator.customTourBookings.view')
            ->with('customTourBookingReservations',$customTourBookingReservations)
            ->with('customTourBooking',$customTourBooking);
    }

    public function viewDeleted($custom_tour_booking_id)
    {
        $customTourBooking=customTourBookings::onlyTrashed()->with('region','tourType','tourPackageType','transportType')->where('uuid',$custom_tour_booking_id)->first();
        return view('TourOperator.customTourBookings.deletedCustomTourBookings.view')
            ->with('customTourBooking',$customTourBooking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($customTourBookingId)
    {
        $customTourBooking=customTourBookings::query()->where('uuid',$customTourBookingId)->first();
        $customTourBookingTourPrices=customTourBookingTourPrices::query()->where('custom_tour_booking_id',$customTourBooking->id)->get();
        $attractionReservations=customTourBookingReservations::query()->where('custom_tour_booking_id',$customTourBooking->id)->get();
        $tourOperator=tourOperator::query()->where('uuid',$customTourBooking->tourOperator->uuid)->first();
        $tourist_attractions=touristicAttractions::query()->where('status','=',1)->pluck('attraction_name','id');
        $customTourBookingTouristAttractionsId=DB::table('custom_booking_attraction')->where('custom_tour_booking_id',$customTourBooking->id)->pluck('tourist_attraction_id');
        $tourOperatorSafariPreferences=touristicAttractions::whereIn('id',$customTourBookingTouristAttractionsId)->pluck('attraction_name','id');
        $tourTypes=tourTypes::query()->where('status','=',1)->pluck('tour_type_name','id');
        $tourPackageTypes=tourPackageType::query()->where('status','=',1)->pluck('tour_package_type_name','id');
        $transports=transport::query()->where('status','=',1)->pluck('transport_name','id');
        $regions=tanzaniaRegions::query()->where('status','=',1)->pluck('region_name','id');
        $reservations=tourOperatorReservation::query()->where('status','=',1)->pluck('reservation_name','id');
        return view('TourOperator.customTourBookings.edit')
            ->with('tourTypes',$tourTypes)
            ->with('customTourBookingTourPrices',$customTourBookingTourPrices)
            ->with('tourPackageTypes',$tourPackageTypes)
            ->with('reservations',$reservations)
            ->with('attractionReservations',$attractionReservations)
            ->with('transports',$transports)
            ->with('tourOperatorSafariPreferences',$tourOperatorSafariPreferences)
            ->with('regions',$regions)
            ->with('tourOperator',$tourOperator)
            ->with('tourist_attractions',$tourist_attractions)
            ->with('customTourBookingTouristAttractionsId',$customTourBookingTouristAttractionsId)
            ->with('customTourBooking',$customTourBooking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customTourBooking)
    {
        $validator=Validator::make($request->all(),[
            'tourist_name'=>'required|string',
            'tourist_email_address'=>'required|email',
            'tourist_region'=>'required',
            'tourist_phone_number'=>'required|regex:/^[0-9]{10}$/',
            'tour_type'=>'required',
            'tour_package_type'=>'required',
            'transport_type'=>'required',
            'special_need_description'=>'required|max:200|string',
            'start_date'=>'required',
            'end_date'=>'required',
            'total_adult_foreigners'=>'required|numeric|max:999',
            'total_children_foreigners'=>'required|numeric|max:999',
            'total_children_residents'=>'required|numeric|max:999',
            'total_adult_residents'=>'required|numeric|max:999',
            'reservation_needed'=>'required',
            'message'=>'required|string|max:200',
            'discount'=>'required|numeric',
            'due_payment_time'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->except('reference_number');
        $customTourBookingRepo=new customTourBookingsRepository();
        $customTourBooking=$customTourBookingRepo->updateCustomTourBooking($input,$customTourBooking);
        return back()->withFlashSuccess('This custom tour was successfully updated')->with('customTourBooking',$customTourBooking);
    }
    public function invoicePreview($customTourBookingUuid)
    {
        $customTourBooking=customTourBookings::query()->where('uuid',$customTourBookingUuid)->first();
        $attractionReservations=customTourBookingReservations::query()->where('custom_tour_booking_id',$customTourBooking->id)->get();
        $customTourBookingTourPrices=customTourBookingTourPrices::query()->where('custom_tour_booking_id',$customTourBooking->id)->get();
        return view('TourOperator.customTourBookings.paymentDetails.invoice.preview')
            ->with('customTourBookingTourPrices',$customTourBookingTourPrices)
            ->with('customTourBooking',$customTourBooking)
            ->with('attractionReservations',$attractionReservations);
    }


    public function printInvoice($customTourBookingUuid)
    {
        $customTourBooking = CustomTourBookings::query()->where('uuid', $customTourBookingUuid)->first();
        $attractionReservations = customTourBookingReservations::query()->where('custom_tour_booking_id', $customTourBooking->id)->get();
        $customTourBookingTourPrices = customTourBookingTourPrices::query()->where('custom_tour_booking_id', $customTourBooking->id)->get();

        if (!$customTourBooking) {
            abort(404);
        }
        // Instantiate mPDF
        $mpdf = new Mpdf([
            'tempDir' => sys_get_temp_dir(), // Set temporary directory
            'default_font' => 'lato', // Set default font
        ]);

        // Render the view
        $html = view('TourOperator.customTourBookings.paymentDetails.invoice.printable', [
            'customTourBooking' => $customTourBooking,
            'attractionReservations' => $attractionReservations,
            'customTourBookingTourPrices' => $customTourBookingTourPrices
        ])->render();

        $mpdf->WriteHTML($html);

        // Output the PDF
        $mpdf->Output('Local_tour_invoice.pdf', 'I');
    }    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($customTourBooking)
    {
        $customTourBooking=customTourBookings::query()->where('uuid',$customTourBooking)->first();
        $customTourBooking->delete();
        return back()->withFlashSuccess('Custom booking deleted successfully');
    }
    public function RestoreDeletedCustomBooking($customTourBookingId)
    {
        $customBooking=customTourBookings::onlyTrashed()->where('uuid',$customTourBookingId)->first();
        $customBooking->restore();
        return back()->withFlashSuccess('Custom booking was restored successfully');
    }
    public function forceDeleteCustomBooking($customTourBookingUuid)
    {
        $customBooking=customTourBookings::onlyTrashed()->where('uuid',$customTourBookingUuid)->first();
        $customBooking->forceDelete();
        return back()->withFlashSuccess('Custom booking was deleted successfully');
    }
    public function approveOrUnApproveBooking(Request $request)
    {
        $customTourBooking=customTourBookings::find($request->id);
        $status=$customTourBooking->status;
        switch ($status)
        {
            case 0:
                $customTourBooking->status=1;
                break;
            case 1:
                $customTourBooking->status=0;
                break;
        }
        $customTourBooking->save();
        return response()->json(['success'=>true]);
    }
    public function deleteAttractionReservation($attractionReservationUuid)
    {
        $attractionReservation=customTourBookingReservations::query()->where('uuid',$attractionReservationUuid)->first();
        $attractionReservation->delete();
        return back()->withFlashSuccess('Attraction reservation was deleted successfully');
    }
    public function getCustomTourBookings($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
               if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
               {
                   return '<span class="badge badge-primary">No</span>';
               }
               else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
               {
                   return '<span class="badge badge-info">Expired today</span>';
               }
               else
               {
                   return '<span class="badge badge-danger">Yes</span>';
               }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                    foreach ($customTourBookings->CustomTourBookingTouristAttractionLabel as $attraction)
                    {
                        return explode(',',$attraction['attraction_name']);
                    }
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getApprovedCustomTourBookings($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->where('status','=',1)->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                foreach ($customTourBookings->CustomTourBookingTouristAttractionLabel as $attraction)
                {
                    return explode(',',$attraction['attraction_name']);
                }
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getUnApprovedCustomTourBookings($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->where('status','=',0)->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                foreach ($customTourBookings->CustomTourBookingTouristAttractionLabel as $attraction)
                {
                    return explode(',',$attraction['attraction_name']);
                }
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getRecentCustomTourBookingsMade($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                foreach ($customTourBookings->CustomTourBookingTouristAttractionLabel as $attraction)
                {
                    return explode(',',$attraction['attraction_name']);
                }
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getNearCustomTours($tourOperatorId)
    {
        $startOfDay=Carbon::now()->startOfDay();
        $endOfDay=Carbon::now()->addDays(30)->endOfDay();
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->whereBetween('start_date',[$startOfDay,$endOfDay])->orderBy('start_date','ASC')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('urgencyStatus',function ($customTourBookings){
                return $customTourBookings->urgencystatusLabel;
            })
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                foreach ($customTourBookings->CustomTourBookingTouristAttractionLabel as $attraction)
                {
                    return explode(',',$attraction['attraction_name']);
                }
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','urgencyStatus','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getExpiredCustomTourBookings($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->where('start_date','<=',Carbon::now())->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                foreach ($customTourBookings->CustomTourBookingTouristAttractionLabel as $attraction)
                {
                    return explode(',',$attraction['attraction_name']);
                }
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusForExpiredLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getDeletedCustomTourBookings($tourOperatorId)
    {
        $deletedCustomBooking = customTourBookings::with('tourOperator')
            ->onlyTrashed()
            ->where('tour_operator_id', $tourOperatorId)
            ->get();
        return DataTables::of($deletedCustomBooking)
            ->addIndexColumn()
            ->addColumn('deleted_at',function ($deletedCustomBooking){
                return date('jS M Y, H:m:s',strtotime($deletedCustomBooking->deleted_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->DeletedCustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForADeletedCustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForADeletedCustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForADeletedCustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                foreach ($customTourBookings->CustomTourBookingTouristAttractionLabel as $attraction)
                {
                    return explode(',',$attraction['attraction_name']);
                }
            })
            ->addColumn('booking_status',function ($deletedCustomBooking){
                return $deletedCustomBooking->bookingStatusForDeletedLabel;
            })
            ->addColumn('actions',function ($deletedCustomBooking){
                return $deletedCustomBooking->buttonActionForDeletedBookingLabel;
            })
            ->rawColumns(['actions','isSafariExpired','CountDownDaysForADeletedCustomTourLabel','company_booked','DeletedCustomTourDurationLabel','booking_status','approve_or_un_approve_booking'])
            ->make(true);
    }
}
