<?php

namespace app\Http\Controllers\TourOperator\TourCompanyLocalToursGoals;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TourOperator\TourCompanyLocalToursGoals\packageSegmentation\localTourGoalsPackageSegmentation;
use App\Models\TourOperator\TourCompanyLocalToursGoals\projectedRevenue\localTourGoalsProjectedRevenue;
use App\Models\TourOperator\TourCompanyLocalToursGoals\tourCompanyLocalToursGoals;
use App\Models\TourOperator\tourOperator;
use App\Models\tourPackageType\tourPackageType;
use App\Repositories\TourOperator\TourCompanyLocalToursGoals\tourCompanyLocalToursGoalsRepository;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Days;
use Yajra\DataTables\DataTables;

class tourCompanyLocalToursGoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tourOperatorUuid)
    {
        $tourOperator = tourOperator::query()->where('uuid', $tourOperatorUuid)->first();
        return view('TourOperator.LocalToursGoals.index')->with('tourOperator', $tourOperator);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tourOperatorUuid)
    {
        $years = range(date('Y'), 2100);
        $tourOperator = tourOperator::query()->where('uuid', $tourOperatorUuid)->first();
        $packageTypes = tourPackageType::query()->pluck('tour_package_type_name', 'id');
        return view('TourOperator.LocalToursGoals.create')
            ->with('years', $years)
            ->with('packageTypes', $packageTypes)
            ->with('tourOperator', $tourOperator);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'goal_description' => 'required|max:100',
                'year' => 'required',
                'number_of_tours_to_be_made' => 'required|numeric',
                'number_of_travellers' => 'required|numeric',
                'number_of_mail_subscribers' => 'required|numeric',
                'number_of_tour_reviewers' => 'required|numeric',
                'projected_revenue' => 'required|numeric',
                'tour_operator_id' => 'required',
                'month.*' => 'required|string',
                'revenue_breakdown.*' => 'required|numeric|min:0',
                'package_type.*' => 'required|string',
                'total_tours.*' => 'required|numeric|min:0',
                'total_travellers.*' => 'required|numeric|min:0',
            ]
        );
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $input = $request->all();
        $tourCompanyLocalToursGoalsRepo = new tourCompanyLocalToursGoalsRepository();
        $tourCompanyLocalToursGoals = $tourCompanyLocalToursGoalsRepo->storeTourCompanyLocalToursGoals($input, $request);
        return back()->with('tourCompanyLocalToursGoals', $tourCompanyLocalToursGoals)->withFlashSuccess('Congrats for having a yearly goal. Your Company Goal was created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tourOperatorLocalToursGoalsUuid)
    {
        $tourOperatorLocalTourGoal = tourCompanyLocalToursGoals::query()->where('uuid', $tourOperatorLocalToursGoalsUuid)->first();
        $existingRevenueBreakdown = localTourGoalsProjectedRevenue::query()->where('local_tours_goals_id', $tourOperatorLocalTourGoal->id)->get();
        $existingPackageTypeSegmentations = localTourGoalsPackageSegmentation::query()->where('goal_id', $tourOperatorLocalTourGoal->id)->get();
        $years = range(date('Y'), 2100);
        $packageTypes = tourPackageType::query()->pluck('tour_package_type_name', 'id');
        return view('TourOperator.LocalToursGoals.view')
            ->with('tourOperatorLocalTourGoal',$tourOperatorLocalTourGoal)
            ->with('years',$years)
            ->with('packageTypes',$packageTypes)
            ->with('existingPackageTypeSegmentations',$existingPackageTypeSegmentations)
            ->with('existingRevenueBreakdown',$existingRevenueBreakdown);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tourOperatorLocalToursGoalsUuid)
    {
        $tourOperatorLocalTourGoal = tourCompanyLocalToursGoals::query()->where('uuid', $tourOperatorLocalToursGoalsUuid)->first();
        $existingRevenueBreakdown = localTourGoalsProjectedRevenue::query()->where('local_tours_goals_id', $tourOperatorLocalTourGoal->id)->get();
        $existingPackageTypeSegmentations = localTourGoalsPackageSegmentation::query()->where('goal_id', $tourOperatorLocalTourGoal->id)->get();
        $years = range(date('Y'), 2100);
        $packageTypes = tourPackageType::query()->pluck('tour_package_type_name', 'id');
        return view('TourOperator.LocalToursGoals.edit')
            ->with('existingPackageTypeSegmentations', $existingPackageTypeSegmentations)
            ->with('existingRevenueBreakdown', $existingRevenueBreakdown)
            ->with('packageTypes', $packageTypes)
            ->with('years', $years)
            ->with('tourOperatorLocalTourGoal', $tourOperatorLocalTourGoal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tourOperatorLocalToursGoalsUuid)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'goal_description' => 'required|max:100',
                'year' => 'required',
                'number_of_tours_to_be_made' => 'required|numeric',
                'number_of_travellers' => 'required|numeric',
                'number_of_mail_subscribers' => 'required|numeric',
                'number_of_tour_reviewers' => 'required|numeric',
                'projected_revenue' => 'required|numeric',
                'tour_operator_id' => 'required',
                'month.*' => 'required|string',
                'revenue_breakdown.*' => 'required|numeric|min:0',
                'total_tours.*' => 'required|numeric|min:0',
                'total_travellers.*' => 'required|numeric|min:0',
            ]
        );
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $input = $request->all();
        $tourCompanyLocalToursGoalsRepo = new tourCompanyLocalToursGoalsRepository();
        $tourCompanyLocalToursGoals = $tourCompanyLocalToursGoalsRepo->updateTourCompanyLocalToursGoals($input, $tourOperatorLocalToursGoalsUuid);
        return back()->with('tourCompanyLocalToursGoals', $tourCompanyLocalToursGoals)->withFlashSuccess('Editing your yearly goal was successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteMonthBreakdown($deleteMonthBreakdownUuid)
    {
        $existingRevenueBreakdown = localTourGoalsProjectedRevenue::query()->where('uuid', $deleteMonthBreakdownUuid)->first();
        $existingRevenueBreakdown->delete();
        return back()->withFlashSuccess('Revenue Breakdown was deleted successfully');
    }
    public function deletePackageSegmentation($segmentationUuid)
    {
        $existingPackageTypeSegmentation=localTourGoalsPackageSegmentation::query()->where('uuid',$segmentationUuid)->first();
        $existingPackageTypeSegmentation->delete();
        return back()->withFlashSuccess('Package Segment was deleted successfully');
    }
    public function getTourCompanyLocalTourGoals($tourOperatorUuid)
    {
        $tourOperator = TourOperator::query()->where('uuid', $tourOperatorUuid)->first();
        $tourCompanyLocalTourGoals = TourCompanyLocalToursGoals::query()
            ->where('tour_operator_id', $tourOperator->id)
            ->orderBy('year')
            ->get();

        $years = range(date('Y'), 2024);

        return DataTables::of($tourCompanyLocalTourGoals)
            ->addIndexColumn()
            ->addColumn('year', function ($tourCompanyLocalTourGoal) use ($years) {
                $yearIndex = $tourCompanyLocalTourGoal->year;
                return isset($years[$yearIndex]) ? $years[$yearIndex] : 'N/A';
            })
            ->addColumn('goal_description', function ($tourCompanyLocalTourGoal) {
                return $tourCompanyLocalTourGoal->goal_description;
            })
            ->addColumn('actions', function ($tourCompanyLocalTourGoal) {
                return $tourCompanyLocalTourGoal->buttonActionLabel;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
