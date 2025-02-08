<?php

namespace App\Http\Controllers\tanzaniaRegions\tanzaniaRegionFAQ;

use App\Http\Controllers\Controller;
use App\Models\tanzaniaRegions\tanzaniaRegionFAQ\tanzaniaRegionFAQ;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Repositories\tanzaniaRegions\tanzaniaRegionFAQ\tanzaniaRegionFAQRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class tanzaniaRegionFAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tanzaniaRegionUuid)
    {
        $tanzaniaRegion=tanzaniaRegions::query()->where('uuid',$tanzaniaRegionUuid)->first();
        return view('AboutTanzania.tanzaniaRegions.FAQ.index')
            ->with('tanzaniaRegion',$tanzaniaRegion);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tanzaniaRegionUuid)
    {
        $tanzaniaRegion=tanzaniaRegions::query()->where('uuid',$tanzaniaRegionUuid)->first();
        return view('AboutTanzania.tanzaniaRegions.FAQ.create')
            ->with('tanzaniaRegion',$tanzaniaRegion);
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
                'question_title'=>'required|string',
                'question_answer'=>'required|string|max:300',
            ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tanzaniaRegion=tanzaniaRegions::query()->first();
        $tanzaniaRegionFAQRepo=new tanzaniaRegionFAQRepository();
        $tanzaniaRegionFAQ=$tanzaniaRegionFAQRepo->storeTanzaniaRegionFAQ($input);
        return redirect()->route('tanzaniaRegionFAQ.index',$tanzaniaRegion->uuid)->with('tanzaniaRegionFAQ',$tanzaniaRegionFAQ)->withFlashSuccess('FAQ added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tanzaniaRegionFAQUuid)
    {
        $regionFAQ=tanzaniaRegionFAQ::query()->where('uuid',$tanzaniaRegionFAQUuid)->first();
        return view('AboutTanzania.tanzaniaRegions.FAQ.view')
            ->with('regionFAQ',$regionFAQ);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tanzaniaRegionFAQUuid)
    {
        $regionFAQ=tanzaniaRegionFAQ::query()->where('uuid',$tanzaniaRegionFAQUuid)->first();
        return view('AboutTanzania.tanzaniaRegions.FAQ.edit')
            ->with('regionFAQ',$regionFAQ);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $regionFAQUuid)
    {
        $validator=Validator::make($request->all(),
            [
                'question_title'=>'required|string',
                'question_answer'=>'required|string|max:300',
            ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $regionFAQRepo=new tanzaniaRegionFAQRepository();
        $regionFAQ=$regionFAQRepo->updateRegionFAQ($input,$regionFAQUuid);
        return back()->with('regionFAQ',$regionFAQ)->withFlashSuccess('FAQ updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tanzaniaRegionFAQUuid)
    {
        $regionFAQ=tanzaniaRegionFAQ::query()->where('uuid',$tanzaniaRegionFAQUuid)->first();
        $regionFAQ->delete();
        return back()->withFlashSuccess('FAQ was deleted successfully');
    }
    public function getRegionFAQ($tanzaniaRegionUuid)
    {
        $tanzaniaRegion=tanzaniaRegions::query()->where('uuid',$tanzaniaRegionUuid)->first();
        $tanzaniaRegionFAQ=tanzaniaRegionFAQ::query()->where('tanzania_region_id',$tanzaniaRegion->id)->orderBy('question_title')->get();
        return DataTables::of($tanzaniaRegionFAQ)
            ->addIndexColumn()
            ->addColumn('question_title',function ($tanzaniaRegionFAQ){
                return $tanzaniaRegionFAQ->question_title;
            })
            ->addColumn('question_answer',function ($tanzaniaRegionFAQ){
                return $tanzaniaRegionFAQ->question_answer;
            })
            ->addColumn('actions',function ($tanzaniaRegionFAQ){
                return $tanzaniaRegionFAQ->buttonActionLabel;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
