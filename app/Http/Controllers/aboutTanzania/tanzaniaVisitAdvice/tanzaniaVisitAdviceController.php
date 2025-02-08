<?php

namespace App\Http\Controllers\aboutTanzania\tanzaniaVisitAdvice;

use App\Http\Controllers\Controller;
use App\Models\aboutTanzania\tanzaniaVisitAdvice\tanzaniaVisitAdvice;
use App\Models\Nations\nations;
use App\Repositories\AboutTanzania\tanzaniaVisitAdvice\tanzaniaVisitAdviceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class tanzaniaVisitAdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nationUuid)
    {
        $nation=nations::query()->where('uuid',$nationUuid)->first();
        $tanzaniaVisitAdvice=tanzaniaVisitAdvice::query()->where('nation_id',$nation->id)->first();
        return view('AboutTanzania.tanzaniaVisitAdvice.index')
            ->with('nation',$nation)
            ->with('tanzaniaVisitAdvice',$tanzaniaVisitAdvice);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($nationUuid)
    {
        $nation=nations::query()->where('uuid',$nationUuid)->first();
        return view('AboutTanzania.tanzaniaVisitAdvice.create')
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
            'advice_title'=>'required|string',
            'advice_description'=>'required|string|max:300',
            'directory_url'=>'required|url',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $nation=nations::query()->first();
        $tanzaniaVisitAdviceRepo=new tanzaniaVisitAdviceRepository();
        $tanzaniaVisitAdvice=$tanzaniaVisitAdviceRepo->storeTanzaniaVisitAdvice($input);
        return redirect()->route('tanzaniaVisitAdvice.index',$nation->uuid)->with('tanzaniaVisitAdvice',$tanzaniaVisitAdvice)->withFlashSuccess('Visit advice added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tanzaniaVisitAdviceUuid)
    {
        $tanzaniaVisitAdvice=tanzaniaVisitAdvice::query()->where('uuid',$tanzaniaVisitAdviceUuid)->first();
        return view('AboutTanzania.tanzaniaVisitAdvice.view')
            ->with('tanzaniaVisitAdvice',$tanzaniaVisitAdvice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tanzaniaVisitAdviceUuid)
    {
        $tanzaniaVisitAdvice=tanzaniaVisitAdvice::query()->where('uuid',$tanzaniaVisitAdviceUuid)->first();
        return view('AboutTanzania.tanzaniaVisitAdvice.edit')
            ->with('tanzaniaVisitAdvice',$tanzaniaVisitAdvice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tanzaniaVisitAdviceUuid)
    {
        $validator=Validator::make($request->all(),
            [
                'advice_title'=>'required|string',
                'advice_description'=>'required|string|max:300',
                'directory_url'=>'required|url',
            ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tanzaniaVisitAdvice=tanzaniaVisitAdvice::query()->with('nation')->where('uuid',$tanzaniaVisitAdviceUuid)->first();
        $nation=$tanzaniaVisitAdvice->nation->uuid;
        $tanzaniaVisitAdviceRepo=new tanzaniaVisitAdviceRepository();
        $tanzaniaVisitAdvice=$tanzaniaVisitAdviceRepo->updateTanzaniaVisitAdvice($input,$tanzaniaVisitAdviceUuid);
        return redirect()->route('tanzaniaVisitAdvice.index',$nation)->with('tanzaniaVisitAdvice',$tanzaniaVisitAdvice)->withFlashSuccess('Visit advice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tanzaniaVisitAdviceUuid)
    {
        $tanzaniaVisitAdvice=tanzaniaVisitAdvice::query()->where('uuid',$tanzaniaVisitAdviceUuid)->first();
        $tanzaniaVisitAdvice->delete();
        return back()->withFlashSuccess('Visit advice added successfully');
    }

    public function getTanzaniaVisitAdvices($nationUuid)
    {
        $nation=nations::query()->where('uuid',$nationUuid)->first();
        $tanzaniaVisitAdvice=tanzaniaVisitAdvice::query()->where('nation_id',$nation->id)->orderBy('advice_title')->get();
        return DataTables::of($tanzaniaVisitAdvice)
            ->addIndexColumn()
            ->addColumn('advice_title',function ($tanzaniaVisitAdvice){
                return $tanzaniaVisitAdvice->advice_title;
            })
            ->addColumn('advice_description',function ($tanzaniaVisitAdvice){
                return $tanzaniaVisitAdvice->advice_description;
            })
            ->addColumn('directory_url',function ($tanzaniaVisitAdvice){
                return $tanzaniaVisitAdvice->directory_url;
            })
            ->addColumn('actions',function ($tanzaniaVisitAdvice){
                return $tanzaniaVisitAdvice->buttonActionsLabel;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
