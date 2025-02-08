<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\specialNeed\specialNeed;
use App\Models\tanzaniaRegions\regionCulture\tanzaniaRegionCulture;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\touristicActivities\touristicActivities;
use App\Models\TouristicAttractions\attractionVisitReasons;
use App\Models\TouristicAttractions\category\touristicAttractionCategory;
use App\Models\TouristicAttractions\touristAttractionFaq;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TouristicAttractions\touristicAttractionVisitAdvices;
use App\Repositories\Admin\TouristicAttraction\FAQ\frequentAskedQuestionsRepository;
use App\Repositories\Admin\TouristicAttraction\touristAttractionFaqRepository;
use App\Repositories\Admin\TouristicAttraction\touristicAttractionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Days;
use Yajra\DataTables\DataTables;

class touristicAttractionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('TouristAttraction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $touristicActivities=touristicActivities::query()->pluck('activity_name','id');
        $regions = tanzaniaRegions::query()->where('status', '=', 1)->pluck('region_name', 'id');
        $attractionCategory = touristicAttractionCategory::query()->pluck('attraction_category', 'id');
        $years = range(date('Y'), 1900);
        return view('TouristAttraction.create')
            ->with('touristicActivities', $touristicActivities)
            ->with('attractionCategory', $attractionCategory)
            ->with('regions', $regions)
            ->with('years', $years);
    }

    public function touristAttractionFAQ($touristicAttractionId)
    {
        $touristicAttraction = touristicAttractions::query()->where('uuid', $touristicAttractionId)->first();
        return view('TouristAttraction.touristAttractionFAQ.create')
            ->with('touristicAttraction', $touristicAttraction);
    }
    public function touristAttractionFAQIndex($touristicAttractionId)
    {
        $touristicAttraction = touristicAttractions::query()->where('uuid', $touristicAttractionId)->first();
        return view('TouristAttraction.touristAttractionFAQ.index')
            ->with('touristicAttraction', $touristicAttraction);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attraction_name' => 'required|string',
            'attraction_description' => 'required|string|max:500',
            'attraction_category' => 'required|string',
            'establishment_year' => 'required|string',
            'seasonal_variation' => 'required|string|max:500',
            'flora_fauna' => 'required|string|max:500',
            'attraction_region' => 'required|string',
            'governing_body' => 'required|string',
            'attraction_visit_month' => 'required|string',
            'website_link' => 'required|url',
            'basic_information' => 'required|string|max:1000',
            'entry_fee_adult_foreigner' => 'required|numeric',
            'entry_fee_child_foreigner' => 'required|numeric',
            'entry_fee_child_local' => 'required|numeric',
            'entry_fee_adult_local' => 'required|numeric',
            'personal_experience' => 'required|string|max:500',
            'attraction_map' => 'nullable|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:2000,max_width:2000',
            'attraction_image.*' => 'required|mimes:png,jpg,jpeg|max:5120|dimensions:max_height:2000,max_width:2000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $input = $request->all();
        $touristicAttractionRepo = new TouristicAttractionRepository();
        $touristicAttraction = $touristicAttractionRepo->storeTouristicAttractions($input);

        return redirect()->route('touristicAttraction.index')
            ->with('touristicAttraction', $touristicAttraction)
            ->withFlashSuccess('Touristic attraction submitted successfully');
    }

    public function touristAttractionFaqStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'question_title' => 'required|max:50',
                'question_description' => 'required|max:500',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input = $request->all();
        $touristAttractionFaqRepo = new touristAttractionFaqRepository();
        $touristAttractionFaq = $touristAttractionFaqRepo->storeTouristAttractionFaq($input);
        return back()->with('touristAttractionFaq', $touristAttractionFaq)->withFlashSuccess('Tourist Attraction FAQ posted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($touristicAttractionUuid)
    {
        $touristicActivities=touristicActivities::query()->pluck('activity_name','id');
        $touristicAttraction = touristicAttractions::query()->where('uuid', $touristicAttractionUuid)->first();
        $regions = tanzaniaRegions::query()->where('status', '=', 1)->pluck('region_name', 'id');
        $attractionVisitAdvices = touristicAttractionVisitAdvices::query()->where('touristic_attraction_id', $touristicAttraction->id)->get();
        $attractionVisitReasons = attractionVisitReasons::query()->where('touristic_attraction_id', $touristicAttraction->id)->get();
        $attractionCategory = touristicAttractionCategory::query()->pluck('attraction_category', 'id');
        $years=range(date('Y'),1900);
        $touristicAttractionActivitiesId=DB::table('touristic_attraction_activities')->where('touristic_attraction_id',$touristicAttraction->id)->pluck('touristic_activities_id');
        $touristicAttractionActivities=touristicActivities::query()->whereIn('id',$touristicAttractionActivitiesId)->pluck('id','activity_name');
        return view('TouristAttraction.edit')
            ->with('touristicAttractionActivities', $touristicAttractionActivities)
            ->with('touristicActivities', $touristicActivities)
            ->with('attractionVisitReasons', $attractionVisitReasons)
            ->with('attractionVisitAdvices', $attractionVisitAdvices)
            ->with('attractionCategory', $attractionCategory)
            ->with('regions', $regions)
            ->with('years', $years)
            ->with('touristicAttraction', $touristicAttraction);
    }
    public function editTouristAttractionFAQ($touristAttractionFaqId)
    {
        $touristAttractionFaq = touristAttractionFaq::query()->where('uuid', $touristAttractionFaqId)->first();
        return view('TouristAttraction.touristAttractionFAQ.edit')->with('touristAttractionFaq', $touristAttractionFaq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $touristicAttraction)
    {
        $validator = Validator::make($request->all(), [
            'attraction_name' => 'required|string',
            'attraction_description' => 'required|string|max:500',
            'attraction_category' => 'required|string',
            'establishment_year' => 'required|string',
            'seasonal_variation' => 'required|string|max:500',
            'flora_fauna' => 'required|string|max:500',
            'attraction_region' => 'required|string',
            'governing_body' => 'required|string',
            'attraction_visit_month' => 'required|string',
            'website_link' => 'required|url',
            'basic_information' => 'required|string|max:1000',
            'entry_fee_adult_foreigner' => 'required|numeric',
            'entry_fee_child_foreigner' => 'required|numeric',
            'entry_fee_child_local' => 'required|numeric',
            'entry_fee_adult_local' => 'required|numeric',
            'personal_experience' => 'required|string|max:500',
            'attraction_map' => 'nullable|mimes:jpg,png,jpeg|max:2048|dimensions:max_height:2000,max_width:2000',
            'attraction_image.*' => 'nullable|mimes:png,jpg,jpeg|max:5120|dimensions:max_height:2000,max_width:2000',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $input = $request->all();
        $touristicAttractionRepo = new touristicAttractionRepository();
        $touristicAttraction = $touristicAttractionRepo->updateTouristicAttraction($input, $touristicAttraction, $request);
        return redirect()->back()->with('touristicAttraction', $touristicAttraction)->withFlashSuccess('Tourist Attraction Updated Successfully');
    }
    public function updateTouristAttractionFAQ(Request $request, $touristAttractionFaqId)
    {
        $input = $request->all();
        $touristAttractionFaqRepo = new touristAttractionFaqRepository();
        $touristAttractionFaq = $touristAttractionFaqRepo->updateTouristicAttraction($input, $touristAttractionFaqId);
        return redirect()->back()->with('touristAttractionFaq', $touristAttractionFaq)->withFlashSuccess('Tourist Attraction Faq updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(touristicAttractions $touristicAttraction)
    {
        $touristicAttraction->delete();
        return back()->withFlashSuccess('Touristic attraction removed successfully');
    }
    public function deleteTouristAttractionFAQ(touristAttractionFaq $touristAttractionFaq)
    {
        $touristAttractionFaq->delete();
        return back()->withFlashSuccess('Tourist Attraction FAQ removed successfully');
    }
    public function deleteVisitAdvice($visitAdviceUuid)
    {
        $touristicAttractionVisitAdvice = touristicAttractionVisitAdvices::query()->where('uuid', $visitAdviceUuid)->first();
        $touristicAttractionVisitAdvice->delete();
        return back()->withFlashSuccess('Visit advice deleted successfully');
    }

    public function deleteVisitReason($visitReasonUuid)
    {
        $touristicAttractionVisitReason = attractionVisitReasons::query()->where('uuid', $visitReasonUuid)->first();
        $touristicAttractionVisitReason->delete();
        return back()->withFlashSuccess('Visit reason deleted successfully');
    }
    public function activateAttraction(Request $request)
    {
        $touristAttraction = touristicAttractions::find($request->id);
        $status = $request->status;
        switch ($status) {
            case 0:
                $touristAttraction->status = 1;
                break;
            case 1:
                $touristAttraction->status = 0;
                break;
        }
        $touristAttraction->save();
        return response()->json(['success' => true]);
    }
    public function activateFAQ(Request $request)
    {
        $touristAttractionFAQ = touristAttractionFaq::find($request->id);
        $status = $request->status;
        switch ($status) {
            case 0:
                $touristAttractionFAQ->status = 1;
                break;
            case 1:
                $touristAttractionFAQ->status = 0;
                break;
        }
        $touristAttractionFAQ->save();
        return response()->json(['success' => true]);
    }
    public function getTouristicAttractions()
    {
        $touristicAttractions = touristicAttractions::query()->with('touristicAttractionCategory')->orderBy('attraction_name')->get();
        return DataTables::of($touristicAttractions)
            ->addIndexColumn()
            ->addColumn('attraction_name', function ($touristicAttractions) {
                return $touristicAttractions->attraction_name;
            })
            ->addColumn('attraction_description', function ($touristicAttractions) {
                return $touristicAttractions->attraction_description;
            })
            ->addColumn('attraction_category', function ($touristicAttractions) {
                return  $touristicAttractions->touristicAttractionCategory->attraction_category;
            })

            ->addColumn('activate_attraction', function ($touristicAttractions) {
                $btn = '<label class="switch{{$touristicAttractions->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('attraction_status', function ($touristicAttractions) {
                return $touristicAttractions->attraction_status_label;
            })
            ->addColumn('actions', function ($touristicAttractions) {
                return $touristicAttractions->button_action_label;
            })
            ->rawColumns(['attraction_status', 'actions', 'activate_attraction'])
            ->make(true);
    }
    public function getTouristicAttractionsFAQ($touristicAttractionId)
    {
        $touristicAttraction = touristicAttractions::find($touristicAttractionId);
        $touristicAttractionsFAQ = touristAttractionFaq::query()->where('touristic_attraction_id', $touristicAttraction->id)->get();
        return DataTables::of($touristicAttractionsFAQ)
            ->addIndexColumn()
            ->addColumn('question_title', function ($touristicAttractionsFAQ) {
                return $touristicAttractionsFAQ->question_title;
            })
            ->addColumn('question_description', function ($touristicAttractionsFAQ) {
                return $touristicAttractionsFAQ->question_description;
            })
            ->addColumn('activate_question', function ($touristicAttractionsFAQ) {
                $btn = '<label class="switch{{$touristicAttractionsFAQ->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('question_status', function ($touristicAttractionsFAQ) {
                return $touristicAttractionsFAQ->question_status_label;
            })
            ->addColumn('actions', function ($touristicAttractionsFAQ) {
                return $touristicAttractionsFAQ->button_action_label;
            })
            ->rawColumns(['question_status', 'actions', 'activate_question'])
            ->make(true);
    }
}
