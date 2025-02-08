<?php

namespace App\Http\Controllers\TourOperator\TourOperatorPackages\InternationalTourPackages\TourPackageBookings;

use App\Http\Controllers\Controller;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookings;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use App\Repositories\TourOperatorPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class tourPackageBookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tourPackageId)
    {
        $tourPackage=TourPackages::query()->where('uuid',$tourPackageId)->first();
        $tourPackageBookings=tourPackageBookings::query()->where('tour_package_id',$tourPackage->id)->get();
        return view('TourOperator.TourPackages.internationalTourPackages.TourPackageBookings.index')
            ->with('tourPackage',$tourPackage)
            ->with('tourPackageBookings',$tourPackageBookings);
    }
    public function ApprovedTourPackageBookingsIndex($tourPackageId)
    {
        $tourPackage=TourPackages::query()->where('uuid',$tourPackageId)->first();
        $tourPackageBookings=tourPackageBookings::query()->where('tour_package_id',$tourPackage->id)->where('status','=','1')->get();
        return view('TourOperator.TourPackages.internationalTourPackages.TourPackageBookings.ApprovedBookings.index')
            ->with('tourPackage',$tourPackage)
            ->with('tourPackageBookings',$tourPackageBookings);
    }
    public function unApprovedTourPackageBookingsIndex($tourPackageId)
    {
        $tourPackage=TourPackages::query()->where('uuid',$tourPackageId)->first();
        $tourPackageBookings=tourPackageBookings::query()->where('tour_package_id',$tourPackage->id)->where('status','=','0')->get();
        return view('TourOperator.TourPackages.internationalTourPackages.TourPackageBookings.UnApprovedBookings.index')
            ->with('tourPackage',$tourPackage)
            ->with('tourPackageBookings',$tourPackageBookings);
    }
    public function deletedTourPackageBookingsIndex($tourPackageId)
    {
        $tourPackage=TourPackages::query()->where('uuid',$tourPackageId)->first();
        $tourPackageBookings=tourPackageBookings::onlyTrashed()->where('tour_package_id',$tourPackage->id)->get();
        return view('TourOperator.TourPackages.internationalTourPackages.TourPackageBookings.deletedBookings.index')
            ->with('tourPackage',$tourPackage)
            ->with('tourPackageBookings',$tourPackageBookings);
    }
    public function downloadBookings($tourPackageId)
    {
        dd($tourPackageId);
//        $tourPackage=TourPackages::query()->where('uuid',$tourPackageId)->first();
//        $tourPackageBookings=tourPackageBookings::query()->where('tour_package_id',$tourPackage->id)->get();
//        PDF::setOptions(['dpi'=>'150','defaultFont'=>'sans-serif']);
//        $tourPackageBookingsPdf=PDF::loadView('TourOperator.TourPackageBookings.downloadPreview',['tourPackageBookings'=>$tourPackageBookings]);
//        return $tourPackageBookingsPdf->download('Tour Package.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tourPackage)
    {
        $tour_package=TourPackages::query()->where('uuid',$tourPackage)->first();
        return view('TourOperator.TourPackageBookings.create')->with('tour_package',$tour_package);
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
            'tourist_name'=>'required',
            'tourist_email_address'=>'required',
            'tourist_country'=>'required',
            'tourist_phone_number'=>'required|regex:/^[0-9]{10}$/',
            'total_adult_travellers'=>'required',
            'total_children_travellers'=>'required',
            'message'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourPackageBookingsRepo=new tourPackageBookingsRepository();
        $tourPackageBookings=$tourPackageBookingsRepo->storeTourPackageBookings($input);
        return redirect()->back()->with('tourPackageBookings',$tourPackageBookings)->withFlashSuccess('Thank you for booking this trip, the tour operator will reach out to you soon');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$tourPackageBookingId)->first();
        return view('TourOperator.TourPackages.internationalTourPackages.TourPackageBookings.view')
            ->with('tourPackageBooking',$tourPackageBooking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$tourPackageBookingId)->first();
        return view('TourOperator.TourPackages.internationalTourPackages.TourPackageBookings.edit')->with('tourPackageBooking',$tourPackageBooking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tour_package_booking)
    {
        $validator=Validator::make($request->all(),[
            'tourist_name'=>'required',
            'tourist_email_address'=>'required',
            'tourist_country'=>'required',
            'tourist_phone_number'=>'required|regex:/^[0-9]{10}$/',
            'total_adult_travellers'=>'required',
            'total_children_travellers'=>'required',
            'message'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourPackageBookingRepo=new tourPackageBookingsRepository();
        $tourPackageBooking=$tourPackageBookingRepo->updateTourPackageBookingInformation($input,$tour_package_booking);
        return back()->with('tourPackageBooking',$tourPackageBooking)->withFlashSuccess('Booking Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$tourPackageBookingId)->first();
        $tourPackageBooking->delete();
        return redirect()->back()->withFlashSuccess('Booking deletion complete');
    }
    public function restore($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::onlyTrashed()->where('uuid',$tourPackageBookingId)->first();
        $tourPackageBooking->restore();
        return redirect()->back()->withFlashSuccess('Booking restored successfully');
    }
    public function forceDeleteBooking($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::onlyTrashed()->where('uuid',$tourPackageBookingId)->first();
        $tourPackageBooking->forceDelete();
        return redirect()->back()->withFlashSuccess('Booking deleted completely, you will not be able to restore it again');
    }
    public function approveOrUnApproveBooking(Request $request)
    {
        $tourPackageBooking=tourPackageBookings::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $tourPackageBooking->status=1;
                break;
            case 1:
                $tourPackageBooking->status=0;
                break;
        }
        $tourPackageBooking->save();
    }
    public function getTourPackageBookings($tourPackageId)
    {
        $tourPackage=TourPackages::find($tourPackageId);
        $tourPackageBookings=tourPackageBookings::query()->where('tour_package_id',$tourPackage->id)->orderBy('tourist_name')->get();
        return DataTables::of($tourPackageBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($tourPackageBookings){
                return date('jS M Y, H:m:s a',strtotime($tourPackageBookings->created_at));
            })
            ->addColumn('tourist_name',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_phone_number;
            })
            ->addColumn('tourist_country',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($tourPackageBookings){
                return $tourPackageBookings->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($tourPackageBookings){
                return $tourPackageBookings->total_children_travellers;
            })
            ->addColumn('tour_price',function ($tourPackageBookings){
                if($tourPackageBookings->tourist_country=='Tanzania') {
                    return number_format($tourPackageBookings->TourPriceTanzanianLabel);
                }
                else {
                    return number_format($tourPackageBookings->TourPriceForeignerLabel);
                }
            })
            ->addColumn('tour_duration',function ($tourPackageBookings){
                return $tourPackageBookings->TotalDaysForTourLabel;
            })
            ->addColumn('message',function ($tourPackageBookings){
                return $tourPackageBookings->message;
            })
            ->addColumn('approve_or_un_approve_booking',function($tourPackageBookings){
                $btn='<label class="switch{{$tourPackageBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($tourPackageBookings){
                return $tourPackageBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($tourPackageBookings){
                return $tourPackageBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','booking_status','booking_date_and_time','count_down_days_for_tour'])
            ->make(true);
    }
    public function getApprovedTourPackageBookings($tourPackageId)
    {
        $tourPackage=TourPackages::find($tourPackageId);
        $tourPackageBookings=tourPackageBookings::query()->where('tour_package_id',$tourPackage->id)->where('status','=','1')->orderBy('tourist_name')->get();
        return DataTables::of($tourPackageBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($tourPackageBookings){
                return date('jS M Y, H:m:s a',strtotime($tourPackageBookings->created_at));
            })
            ->addColumn('tourist_name',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_phone_number;
            })
            ->addColumn('tourist_country',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($tourPackageBookings){
                return $tourPackageBookings->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($tourPackageBookings){
                return $tourPackageBookings->total_children_travellers;
            })
            ->addColumn('tour_price',function ($tourPackageBookings){
                if($tourPackageBookings->tourist_country=='Tanzania') {
                    return number_format($tourPackageBookings->TourPriceTanzanianLabel);
                }
                else {
                    return number_format($tourPackageBookings->TourPriceForeignerLabel);
                }
            })
            ->addColumn('tour_duration',function ($tourPackageBookings){
                return $tourPackageBookings->TotalDaysForTourLabel;
            })
            ->addColumn('message',function ($tourPackageBookings){
                return $tourPackageBookings->message;
            })
            ->addColumn('approve_or_un_approve_booking',function($tourPackageBookings){
                $btn='<label class="switch{{$tourPackageBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($tourPackageBookings){
                return $tourPackageBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($tourPackageBookings){
                return $tourPackageBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','booking_status','booking_date_and_time','count_down_days_for_tour'])
            ->make(true);
    }
    public function getUnapprovedTourPackageBookings($tourPackageId)
    {
        $tourPackage=TourPackages::find($tourPackageId);
        $tourPackageBookings=tourPackageBookings::query()->where('tour_package_id',$tourPackage->id)->where('status','=','0')->orderBy('tourist_name')->get();
        return DataTables::of($tourPackageBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($tourPackageBookings){
                return date('jS M Y, H:m:s a',strtotime($tourPackageBookings->created_at));
            })
            ->addColumn('tourist_name',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_phone_number;
            })
            ->addColumn('tourist_country',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($tourPackageBookings){
                return $tourPackageBookings->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($tourPackageBookings){
                return $tourPackageBookings->total_children_travellers;
            })
            ->addColumn('tour_price',function ($tourPackageBookings){
                if($tourPackageBookings->tourist_country=='Tanzania') {
                    return number_format($tourPackageBookings->TourPriceTanzanianLabel);
                }
                else {
                    return number_format($tourPackageBookings->TourPriceForeignerLabel);
                }
            })
            ->addColumn('tour_duration',function ($tourPackageBookings){
                return $tourPackageBookings->TotalDaysForTourLabel;
            })
            ->addColumn('message',function ($tourPackageBookings){
                return $tourPackageBookings->message;
            })
            ->addColumn('approve_or_un_approve_booking',function($tourPackageBookings){
                $btn='<label class="switch{{$tourPackageBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($tourPackageBookings){
                return $tourPackageBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($tourPackageBookings){
                return $tourPackageBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','booking_status','booking_date_and_time','count_down_days_for_tour'])
            ->make(true);
    }
    public function getDeletedTourPackageBookings($tourPackageId)
    {
        $tourPackage=TourPackages::find($tourPackageId);
        $tourPackageBookings=tourPackageBookings::onlyTrashed()->where('tour_package_id',$tourPackage->id)->get();
        return DataTables::of($tourPackageBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($tourPackageBookings){
                return date('jS M Y, H:m:s a',strtotime($tourPackageBookings->created_at));
            })
            ->addColumn('deleted_date_and_time',function ($tourPackageBookings){
                return date('jS M Y, H:m:s a',strtotime($tourPackageBookings->deleted_at));
            })
            ->addColumn('tourist_name',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_phone_number;
            })
            ->addColumn('tourist_country',function ($tourPackageBookings){
                return $tourPackageBookings->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($tourPackageBookings){
                return $tourPackageBookings->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($tourPackageBookings){
                return $tourPackageBookings->total_children_travellers;
            })
            ->addColumn('message',function ($tourPackageBookings){
                return $tourPackageBookings->message;
            })
            ->addColumn('booking_status',function ($tourPackageBookings){
                return $tourPackageBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($tourPackageBookings){
                return $tourPackageBookings->buttonActionForDeletedBookingLabel;
            })
            ->rawColumns(['actions','booking_status','booking_date_and_time'])
            ->make(true);
    }
}
