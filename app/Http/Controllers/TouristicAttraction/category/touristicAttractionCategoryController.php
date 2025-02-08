<?php

namespace App\Http\Controllers\TouristicAttraction\category;

use App\Http\Controllers\Controller;
use App\Models\touristicActivities\touristicActivities;
use App\Models\TouristicAttractions\category\touristicAttractionCategory;
use App\Repositories\Admin\TouristicAttraction\category\touristicAttractionCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class touristicAttractionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('TouristAttraction.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $touristicActivities=touristicActivities::query()->pluck('activity_name','id');
        return view('TouristAttraction.category.create')->with('touristicActivities',$touristicActivities);
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
            'attraction_category_iconic_image'=>'required|mimes:jpg,jpeg,png|max:2048|dimensions:max_height:1000,max_width:1000',
            'attraction_category_basic_information'=>'required|max:1000',
            'attraction_category'=>'required',
            'attraction_category_description'=>'required|max:200',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $touristicAttractionCategoryRepo=new touristicAttractionCategoryRepository();
        $touristicAttractionCategory=$touristicAttractionCategoryRepo->storeTouristicAttractionCategory($input);
        return redirect()->route('touristicAttractionCategory.index')->with('touristicAttractionCategory',$touristicAttractionCategory)->withFlashSuccess('Attraction category was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($attractionCategoryUuid)
    {
        $touristicAttractionCategory=touristicAttractionCategory::query()->where('uuid',$attractionCategoryUuid)->first();
        return view('TouristAttraction.category.view')
            ->with('touristicAttractionCategory',$touristicAttractionCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($attractionCategoryUuid)
    {
        $touristicActivities=touristicActivities::query()->pluck('activity_name','id');
        $touristicAttractionCategory=touristicAttractionCategory::query()->where('uuid',$attractionCategoryUuid)->first();
        $touristicAttractionCategoryActivitiesIds=DB::table('category_activities')->where('touristic_attraction_category_id',$touristicAttractionCategory->id)->pluck('touristic_activities_id');
        $categoryTouristicActivities=touristicActivities::whereIn('id',$touristicAttractionCategoryActivitiesIds)->pluck('id','activity_name');

        return view('TouristAttraction.category.edit')
            ->with('touristicActivities',$touristicActivities)
            ->with('categoryTouristicActivities',$categoryTouristicActivities)
            ->with('touristicAttractionCategory',$touristicAttractionCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $attractionCategoryUuid)
    {
        $validator=Validator::make($request->all(),
            [
                'attraction_category_iconic_image'=>'nullable|mimes:jpg,jpeg,png|max:2048|dimensions:max_height:1000,max_width:1000',
                'attraction_category_basic_information'=>'required|max:500',
                'attraction_category'=>'required',
                'attraction_category_description'=>'required|max:200',
            ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $touristicAttractionCategoryRepo=new touristicAttractionCategoryRepository();
        $touristicAttractionCategory=$touristicAttractionCategoryRepo->updateTouristicAttractionCategory($input,$attractionCategoryUuid,$request);
        return redirect()->route('touristicAttractionCategory.index')->with('touristicAttractionCategory',$touristicAttractionCategory)->withFlashSuccess('Attraction category was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($attractionCategoryUuid)
    {
        $touristicAttractionCategory=touristicAttractionCategory::query()->where('uuid',$attractionCategoryUuid)->first();
        $touristicAttractionCategory->delete();
        return back()->withFlashSuccess('Attraction category was deleted successfully');
    }
    public function getTouristicAttractionCategories()
    {
        $touristicAttractionCategory=touristicAttractionCategory::query()->orderBy('attraction_category')->get();
        return DataTables::of($touristicAttractionCategory)
            ->addIndexColumn()
            ->addColumn('attraction_category',function ($touristicAttractionCategory)
            {
                return $touristicAttractionCategory->attraction_category;
            })
            ->addColumn('attraction_category_description',function ($touristicAttractionCategory)
            {
                return $touristicAttractionCategory->attraction_category_description;
            })
            ->addColumn('actions',function ($touristicAttractionCategory)
            {
                return $touristicAttractionCategory->buttonActionLabel;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
