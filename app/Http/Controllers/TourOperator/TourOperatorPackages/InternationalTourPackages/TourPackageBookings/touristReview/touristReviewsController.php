<?php

namespace App\Http\Controllers\TourOperator\TourOperatorPackages\InternationalTourPackages\TourPackageBookings\touristReview;

use App\Http\Controllers\Controller;
use App\Models\TourOperator\touristReview\touristReview;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookings;
use App\Repositories\touristReview\touristReviewRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class touristReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$tourPackageBookingId)->first();
        $touristReview=touristReview::query()->where('tour_package_booking_id',$tourPackageBooking->id)->get();
        return view('TourOperator.touristReviews.index')
            ->with('touristReview',$touristReview)
            ->with('tourPackageBooking',$tourPackageBooking);
    }
    public function approvedTouristReviewsIndex($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$tourPackageBookingId)->first();
        $touristReview=touristReview::query()->where('tour_package_booking_id',$tourPackageBooking->id)->where('status','=',1)->get();
        return view('TourOperator.touristReviews.approvedTouristReviews.index')
            ->with('touristReview',$touristReview)
            ->with('tourPackageBooking',$tourPackageBooking);
    }
    public function unApprovedTouristReviewIndex($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$tourPackageBookingId)->first();
        $touristReview=touristReview::query()->where('tour_package_booking_id',$tourPackageBooking->id)->where('status','=',0)->get();
        return view('TourOperator.touristReviews.unApprovedTouristReviews.index')
            ->with('touristReview',$touristReview)
            ->with('tourPackageBooking',$tourPackageBooking);
    }
    public function deletedTouristReviewIndex($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$tourPackageBookingId)->first();
        $touristReview=touristReview::query()->where('tour_package_booking_id',$tourPackageBooking->id)->get();
        return view('TourOperator.touristReviews.deletedTouristReviews.index')
            ->with('touristReview',$touristReview)
            ->with('tourPackageBooking',$tourPackageBooking);
    }
    public function allTouristReviews($tourOperatorId)
    {
        $touristReviews=touristReview::all()->where('tour_operator_id',$tourOperatorId)->where('status','=',1);
        $totalTouristReviews=touristReview::query()->where('tour_operator_id',$tourOperatorId)->count();
        return view('TourOperator.touristReviews.allTouristReviews.show')
            ->with('totalTouristReviews',$totalTouristReviews)
            ->with('touristReviews',$touristReviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$tourPackageBookingId)->first();
        return view('TourOperator.touristReviews.review')
            ->with('tourPackageBooking',$tourPackageBooking);
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
            'review_title'=>'required|max:100',
            'review_message'=>'required|max:500',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $touristReviewRepo=new touristReviewRepository();
        $touristReview=$touristReviewRepo->storeTouristReviews($input);
        return back()->withFlashSuccess('Your review was successfully delivered. Thanks for your support to our services')
            ->with('touristReview',$touristReview);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($touristReviewId)
    {
        $touristReview=touristReview::query()->where('uuid',$touristReviewId)->first();
        return view('TourOperator.touristReviews.view')->with('touristReview',$touristReview);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($touristReviewId)
    {
        $touristReview=touristReview::query()->where('uuid',$touristReviewId)->first();
        $touristReview->delete();
        return back()->withFlashSuccess('Review deleted successfully');
    }
    public function restoreDeletedTouristReviews($touristReviewId)
    {
        $touristReview=touristReview::onlyTrashed()->where('uuid',$touristReviewId)->first();
        $touristReview->restore();
        return back()->withFlashSuccess('Tourist Review Restored Successfully');
    }
    public function approveOrUnApproveReview(Request $request)
    {
        if (Auth::user()->role==1)
        {
            $touristReview=touristReview::find($request->id);
            $status=$touristReview->status;
            switch ($status)
            {
                case 0:
                    $touristReview->status=1;
                    break;
                case 1:
                    $touristReview->status=0;
                    break;
            }
            $touristReview->save();
        }
    }

    public function getTouristReviews($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::find($tourPackageBookingId);
        $touristReview=touristReview::query()->where('tour_package_booking_id',$tourPackageBooking->id)->get();
        return DataTables::of($touristReview)
            ->addIndexColumn()
            ->addColumn('review_posted_time',function ($touristReview){
                return date('jS M Y H:m:s a',strtotime($touristReview->created_at));
            })
            ->addColumn('tourist_posted_review',function ($touristReview){
                return tourPackageBookings::find($touristReview->tour_package_booking_id)->tourist_name;
            })
            ->addColumn('review_title',function ($touristReview){
                return $touristReview->review_title;
            })
            ->addColumn('review_message', function ($touristReview){
                return $touristReview->review_message;
            })
            ->addColumn('approve_or_un_approve_review',function($touristReview){
                $btn='<label class="switch{{$touristReview->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('review_status',function ($touristReview){
                return $touristReview->reviewStatusLabel;
            })
            ->addColumn('actions',function ($touristReview){
                return $touristReview->TouristReviewButtonActionsLabel;
            })
            ->rawColumns(['actions','review_status','approve_or_un_approve_review'])
            ->make(true);
    }
    public function getApprovedTouristReviews($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::find($tourPackageBookingId);
        $touristReview=touristReview::query()->where('tour_package_booking_id',$tourPackageBooking->id)->where('status','=',1)->get();
        return DataTables::of($touristReview)
            ->addIndexColumn()
            ->addColumn('review_posted_time',function ($touristReview){
                return date('jS M Y H:m:s a',strtotime($touristReview->created_at));
            })
            ->addColumn('tourist_posted_review',function ($touristReview){
                return tourPackageBookings::find($touristReview->tour_package_booking_id)->tourist_name;
            })
            ->addColumn('review_title',function ($touristReview){
                return $touristReview->review_title;
            })
            ->addColumn('review_message', function ($touristReview){
                return $touristReview->review_message;
            })
            ->addColumn('approve_or_un_approve_review',function($touristReview){
                $btn='<label class="switch{{$touristReview->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('review_status',function ($touristReview){
                return $touristReview->reviewStatusLabel;
            })
            ->addColumn('actions',function ($touristReview){
                return $touristReview->TouristReviewButtonActionsLabel;
            })
            ->rawColumns(['actions','review_status','approve_or_un_approve_review'])
            ->make(true);
    }
    public function getUnApprovedTouristReviews($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::find($tourPackageBookingId);
        $touristReview=touristReview::query()->where('tour_package_booking_id',$tourPackageBooking->id)->where('status','=',0)->get();
        return DataTables::of($touristReview)
            ->addIndexColumn()
            ->addColumn('review_posted_time',function ($touristReview){
                return date('jS M Y H:m:s a',strtotime($touristReview->created_at));
            })
            ->addColumn('tourist_posted_review',function ($touristReview){
                return tourPackageBookings::find($touristReview->tour_package_booking_id)->tourist_name;
            })
            ->addColumn('review_title',function ($touristReview){
                return $touristReview->review_title;
            })
            ->addColumn('review_message', function ($touristReview){
                return $touristReview->review_message;
            })
            ->addColumn('approve_or_un_approve_review',function($touristReview){
                $btn='<label class="switch{{$touristReview->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('review_status',function ($touristReview){
                return $touristReview->reviewStatusLabel;
            })
            ->addColumn('actions',function ($touristReview){
                return $touristReview->TouristReviewButtonActionsLabel;
            })
            ->rawColumns(['actions','review_status','approve_or_un_approve_review'])
            ->make(true);
    }
    public function getDeletedTouristReviews($tourPackageBookingId)
    {
        $tourPackageBooking=tourPackageBookings::find($tourPackageBookingId);
        $touristReview=touristReview::onlyTrashed()->where('tour_package_booking_id',$tourPackageBooking->id)->get();
        return DataTables::of($touristReview)
            ->addIndexColumn()
            ->addColumn('review_posted_time',function ($touristReview){
                return date('jS M Y H:m:s a',strtotime($touristReview->created_at));
            })
            ->addColumn('tourist_posted_review',function ($touristReview){
                return tourPackageBookings::find($touristReview->tour_package_booking_id)->tourist_name;
            })
            ->addColumn('review_title',function ($touristReview){
                return $touristReview->review_title;
            })
            ->addColumn('review_message', function ($touristReview){
                return $touristReview->review_message;
            })
            ->addColumn('approve_or_un_approve_review',function($touristReview){
                $btn='<label class="switch{{$touristReview->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('review_status',function ($touristReview){
                return $touristReview->reviewStatusLabel;
            })
            ->addColumn('actions',function ($touristReview){
                return $touristReview->DeletedTouristReviewButtonActionsLabel;
            })
            ->rawColumns(['actions','review_status','approve_or_un_approve_review'])
            ->make(true);
    }
}
