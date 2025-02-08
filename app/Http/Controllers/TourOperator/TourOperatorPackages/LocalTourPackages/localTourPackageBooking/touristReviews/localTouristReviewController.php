<?php

namespace App\Http\Controllers\TourOperator\TourOperatorPackages\LocalTourPackages\localTourPackageBooking\touristReviews;

use App\Http\Controllers\Controller;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTouristReviews\localTouristReviews;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackageBooking\localTouristReviews\localTouristReviewRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class localTouristReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($localTourBookingUuid)
    {
        $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.touristReview.index')
            ->with('localTourBooking',$localTourBooking);
    }
    public function approvedLocalTouristReviewsIndex($localTourBookingUuid)
    {
        $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.touristReview.approvedTouristReview.index')
            ->with('localTourBooking',$localTourBooking);
    }

    public function unApprovedTouristReviewIndex($localTourBookingUuid)
    {
        $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.touristReview.unapprovedTouristReview.index')
            ->with('localTourBooking',$localTourBooking);
    }
    public function deletedTouristReviewIndex($localTourBookingUuid)
    {
        $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.touristReview.deletedTouristReview.index')
            ->with('localTourBooking',$localTourBooking);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($localTourBookingUuid)
    {
        $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.touristReview.create')
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
    $validator = Validator::make($request->all(), [
        'review_company' => 'required|max:500|string',
        'title_review_company' => 'required|string',
        'title_review_attraction' => 'required|string',
        'review_attraction' => 'required|max:500|string',
        'local_tour_booking_id' => 'required',
        'local_tour_package_id' => 'required',
        'tour_operator_id' => 'required',
        'rating' => 'required|numeric|min:1|max:5',
    ]);

    if ($validator->fails()) {
        return back()->withInput()->withErrors($validator);
    }

    $input = $request->all();
    $localTouristReviewRepo = new localTouristReviewRepository();
    $localTouristReview = $localTouristReviewRepo->storeLocalTouristReview($input);

    return back()->withFlashSuccess('Much appreciation for your support to this tour operator. Your review was submitted successfully.')
        ->with('localTouristReview', $localTouristReview);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($localTouristReviewUuid)
    {
        $localTouristReview=localTouristReviews::query()->where('uuid',$localTouristReviewUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.touristReview.view')
            ->with('localTouristReview',$localTouristReview);
    }
    public function allLocalTouristReviews($tourOperatorUuid)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorUuid)->where('status','=',1)->first();
        $localTouristReviews=localTouristReviews::query()->where('tour_operator_id',$tourOperator->id)->where('status','=',1)->paginate(20);
        $totalLocalTouristReviews=localTouristReviews::query()->where('tour_operator_id',$tourOperator->id)->where('status','=',1)->count();
        return view('TourOperator.TourPackages.localTourPackages.bookings.touristReview.allTouristReviews.show')
            ->with('tourOperator',$tourOperator)
            ->with('totalLocalTouristReviews',$totalLocalTouristReviews)
            ->with('localTouristReviews',$localTouristReviews);
    }
    public function showDeletedTouristReview($localTouristReviewUuid)
    {
        $localTouristReview=localTouristReviews::onlyTrashed()->where('uuid',$localTouristReviewUuid)->first();
        return view('TourOperator.TourPackages.localTourPackages.bookings.touristReview.deletedTouristReview.view')
            ->with('localTouristReview',$localTouristReview);
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
    public function destroy($localTouristReviewUuid)
    {
        $localTouristReview=localTouristReviews::query()->where('uuid',$localTouristReviewUuid)->first();
        $localTouristReview->delete();
        return back()->withFlashSuccess('The tourist review was deleted successfully. You can restore it when needed in the deleted reviews section');
    }

    public function restoreDeletedTouristReviews($localTouristReviewUuid)
    {
        $localTouristReview=localTouristReviews::onlyTrashed()->where('uuid',$localTouristReviewUuid)->first();
        $localTouristReview->restore();
        return back()->withFlashSuccess('The tourist review was restored successfully');
    }
    public function deletePermanentlyTouristReview($localTouristReviewUuid)
    {
        $localTouristReview=localTouristReviews::onlyTrashed()->where('uuid',$localTouristReviewUuid)->first();
        $localTouristReview->forceDelete();
        return back()->withFlashSuccess('The tourist review was permanently deleted.');
    }
    public function approveOrUnApproveReview(Request $request)
    {
        if(Auth::user()->role==1)
        {
            $localTouristReview=localTouristReviews::find($request->id);
            $status=$localTouristReview->status;
            switch ($status)
            {
                case 0:
                    $localTouristReview->status=1;
                    break;
                case 1:
                    $localTouristReview->status=0;
                    break;
            }
            $localTouristReview->save();
            return response()->json(['success'=>true]);
        }
        else
        {
            return response()->json(['warning'=>true]);
        }
    }
    public function getLocalTouristReviews($localTouristBookingId)
    {
        $localTouristReview=localTouristReviews::query()->where('local_tour_booking_id',$localTouristBookingId)->get();
        return DataTables::of($localTouristReview)
            ->addColumn('review_posted_time',function ($localTouristReview){
                return date('jS M Y H:i',strtotime($localTouristReview->created_at));
            })
            ->addColumn('review_message',function ($localTouristReview){
                return $localTouristReview->review_company;
            })
            ->addColumn('approve_or_un_approve_review',function($localTouristReview){
                $btn='<label class="switch{{$localTouristReview->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('review_status',function ($localTouristReview){
                return $localTouristReview->reviewStatusLabel;
            })
            ->addColumn('actions',function ($localTouristReview){
                return $localTouristReview->buttonActionLabel;
            })
            ->rawColumns(['review_posted_time','review_status','actions'])
            ->make(true);
    }
    public function getApprovedLocalTouristReview($localTouristBookingId)
    {
        $localTouristReview=localTouristReviews::query()->where('local_tour_booking_id',$localTouristBookingId)->where('status','=',1)->get();
        return DataTables::of($localTouristReview)
            ->addColumn('review_posted_time',function ($localTouristReview){
                return date('jS M Y H:i',strtotime($localTouristReview->created_at));
            })
            ->addColumn('review_message',function ($localTouristReview){
                return $localTouristReview->review_company;
            })
            ->addColumn('approve_or_un_approve_review',function($localTouristReview){
                $btn='<label class="switch{{$localTouristReview->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('review_status',function ($localTouristReview){
                return $localTouristReview->reviewStatusLabel;
            })
            ->addColumn('actions',function ($localTouristReview){
                return $localTouristReview->buttonActionLabel;
            })
            ->rawColumns(['review_posted_time','review_status','actions'])
            ->make(true);
    }
    public function getUnapprovedLocalTouristReview($localTouristBookingId)
    {
        $localTouristReview=localTouristReviews::query()->where('local_tour_booking_id',$localTouristBookingId)->where('status','=',0)->get();
        return DataTables::of($localTouristReview)
            ->addColumn('review_posted_time',function ($localTouristReview){
                return date('jS M Y H:i',strtotime($localTouristReview->created_at));
            })
            ->addColumn('review_message',function ($localTouristReview){
                return $localTouristReview->review_company;
            })
            ->addColumn('approve_or_un_approve_review',function($localTouristReview){
                $btn='<label class="switch{{$localTouristReview->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('review_status',function ($localTouristReview){
                return $localTouristReview->reviewStatusLabel;
            })
            ->addColumn('actions',function ($localTouristReview){
                return $localTouristReview->buttonActionLabel;
            })
            ->rawColumns(['review_posted_time','review_status','actions'])
            ->make(true);
    }
    public function getDeletedLocalTouristReview($localTouristBookingId)
    {
        $localTouristReview=localTouristReviews::onlyTrashed()->where('local_tour_booking_id',$localTouristBookingId)->get();
        return DataTables::of($localTouristReview)
            ->addColumn('review_posted_time',function ($localTouristReview){
                return date('jS M Y H:i',strtotime($localTouristReview->created_at));
            })
            ->addColumn('review_message',function ($localTouristReview){
                return $localTouristReview->review_company;
            })
            ->addColumn('approve_or_un_approve_review',function($localTouristReview){
                $btn='<label class="switch{{$localTouristReview->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('review_status',function ($localTouristReview){
                return $localTouristReview->reviewStatusLabel;
            })
            ->addColumn('actions',function ($localTouristReview){
                return $localTouristReview->DeletedTouristReviewButtonActionsLabel;
            })
            ->rawColumns(['review_posted_time','review_status','actions'])
            ->make(true);
    }
}
