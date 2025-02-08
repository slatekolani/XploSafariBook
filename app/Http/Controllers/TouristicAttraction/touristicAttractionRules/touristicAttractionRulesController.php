<?php

namespace App\Http\Controllers\TouristicAttraction\touristicAttractionRules;

use App\Http\Controllers\Controller;
use App\Models\Nations\nations;
use App\Models\TouristicAttractions\touristicAttractionRules\touristicAttractionRules;
use App\Repositories\Admin\TouristicAttraction\touristicAttractionRules\touristicAttractionRulesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class touristicAttractionRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nationUuid)
    {
        $nation=nations::query()->where('uuid',$nationUuid)->first();
        return view('TouristAttraction.rules.index')
            ->with('nation',$nation);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($nationUuid)
    {
        $nation=nations::query()->where('uuid',$nationUuid)->first();
        return view('TouristAttraction.rules.create')
            ->with('nation',$nation);
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
            'rule_title'=>'required|string',
            'rule_description'=>'required|string|max:300',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $nation=nations::query()->first();
        $touristicAttractionRuleRepo=new touristicAttractionRulesRepository();
        $touristicAttractionRule=$touristicAttractionRuleRepo->storeTouristicAttractionRule($input);
        return redirect()->route('touristicAttractionRule.index',$nation->uuid)->with('touristicAttractionRule',$touristicAttractionRule)->withFlashSuccess('Rule added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($touristicAttractionRuleUuid)
    {
        $touristicAttractionRule=touristicAttractionRules::query()->where('uuid',$touristicAttractionRuleUuid)->first();
        return view('TouristAttraction.rules.view')
            ->with('touristicAttractionRule',$touristicAttractionRule);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($touristicAttractionRuleUuid)
    {
        $touristicAttractionRule=touristicAttractionRules::query()->where('uuid',$touristicAttractionRuleUuid)->first();
        return view('TouristAttraction.rules.edit')
            ->with('touristicAttractionRule',$touristicAttractionRule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $touristicAttractionRuleUuid)
    {
        $validator=Validator::make($request->all(),
            [
                'rule_title'=>'required|string',
                'rule_description'=>'required|string|max:300',
            ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $touristicAttractionRule=touristicAttractionRules::query()->with('nation')->where('uuid',$touristicAttractionRuleUuid)->first();
        $nation=$touristicAttractionRule->nation->uuid;
        $touristicAttractionRuleRepo=new touristicAttractionRulesRepository();
        $touristicAttractionRule=$touristicAttractionRuleRepo->updateTouristicAttractionRule($input,$touristicAttractionRuleUuid);
        return redirect()->route('touristicAttractionRule.index',$nation)->with('touristicAttractionRule',$touristicAttractionRule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($touristicAttractionRuleUuid)
    {
        $touristicAttractionRule=touristicAttractionRules::query()->where('uuid',$touristicAttractionRuleUuid)->first();
        $touristicAttractionRule->delete();
        return back()->withFlashSuccess('Rule deleted successfully');
    }

    public function getTouristicAttractionRule($nationUuid)
    {
        $nation=nations::query()->where('uuid',$nationUuid)->first();
        $touristicAttractionRule=touristicAttractionRules::query()->where('nation_id',$nation->id)->get();
        return DataTables::of($touristicAttractionRule)
            ->addIndexColumn()
            ->addColumn('rule_title',function ($touristicAttractionRule){
                return $touristicAttractionRule->rule_title;
            })
            ->addColumn('rule_description',function ($touristicAttractionRule){
                return $touristicAttractionRule->rule_description;
            })
            ->addColumn('actions',function ($touristicAttractionRule){
                return $touristicAttractionRule->buttonActionRuleLabel;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
