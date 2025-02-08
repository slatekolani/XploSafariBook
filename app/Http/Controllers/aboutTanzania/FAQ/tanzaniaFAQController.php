<?php

namespace App\Http\Controllers\aboutTanzania\FAQ;

use App\Http\Controllers\Controller;
use App\Models\aboutTanzania\FAQ\tanzaniaFAQ;
use App\Models\Nations\nations;
use App\Repositories\AboutTanzania\FAQ\tanzaniaFAQRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class tanzaniaFAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nationUuid)
    {
        $nation=nations::query()->where('uuid',$nationUuid)->first();
        return view('AboutTanzania.FAQ.index')->with('nation',$nation);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($nationUuid)
    {
        $nation=nations::query()->where('uuid',$nationUuid)->first();
        return view('AboutTanzania.FAQ.create')
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
            'question_title'=>'required|string',
            'question_answer'=>'required|string|max:300',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tanzaniaFAQRepo=new tanzaniaFAQRepository();
        $nation=nations::query()->first();
        $tanzaniaFAQ=$tanzaniaFAQRepo->storeTanzaniaFAQ($input);
        return redirect()->route('tanzaniaFAQ.index',$nation->uuid)->with('tanzaniaFAQ',$tanzaniaFAQ)->withFlashSuccess('FAQ added succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tanzaniaFAQUuid)
    {
        $tanzaniaFAQ=tanzaniaFAQ::query()->where('uuid',$tanzaniaFAQUuid)->first();
        return view('AboutTanzania.FAQ.view')
            ->with('tanzaniaFAQ',$tanzaniaFAQ);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tanzaniaFAQUuid)
    {
        $tanzaniaFAQ=tanzaniaFAQ::query()->where('uuid',$tanzaniaFAQUuid)->first();
        return view('AboutTanzania.FAQ.edit')
            ->with('tanzaniaFAQ',$tanzaniaFAQ);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tanzaniaFAQUuid)
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
        $tanzaniaFAQ=tanzaniaFAQ::query()->with('nation')->where('uuid',$tanzaniaFAQUuid)->first();
        $nation=$tanzaniaFAQ->nation->uuid;
        $tanzaniaFAQRepo=new tanzaniaFAQRepository();
        $tanzaniaFAQ=$tanzaniaFAQRepo->updateTanzaniaFAQRepo($input,$tanzaniaFAQUuid);
        return redirect()->route('tanzaniaFAQ.index',$nation)->with('tanzaniaFAQ',$tanzaniaFAQ)->withFlashSuccess('FAQ edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tanzaniaFAQUuid)
    {
        $tanzaniaFAQ=tanzaniaFAQ::query()->where('uuid',$tanzaniaFAQUuid)->first();
        $tanzaniaFAQ->delete();
        return back()->withFlashSuccess('Faq deleted successfully');
    }
    public function getTanzaniaFAQ($nationUuid)
    {
        $nation = nations::query()->where('uuid', $nationUuid)->first();

        $tanzaniaFAQ = tanzaniaFAQ::query()
            ->where('nation_id', $nation->id)
            ->orderBy('question_title')
            ->get();

        return DataTables::of($tanzaniaFAQ)
            ->addIndexColumn()
            ->addColumn('question_title', function ($tanzaniaFAQ) {
                return $tanzaniaFAQ->question_title;
            })
            ->addColumn('question_answer', function ($tanzaniaFAQ) {
                return $tanzaniaFAQ->question_answer;
            })
            ->addColumn('actions', function ($tanzaniaFAQ) {
                return $tanzaniaFAQ->ButtonActionsLabel;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
