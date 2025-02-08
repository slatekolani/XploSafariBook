<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\specialNeed\specialNeed;
use App\Repositories\Admin\specialNeed\specialNeedRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class specialNeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('specialNeed.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specialNeed.create');
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
            'special_need_name'=>'required',
            'special_need_icon'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $specialNeedRepo=new specialNeedRepository();
        $specialNeed=$specialNeedRepo->storeSpecialNeed($input);
        return redirect()->route('specialNeed.index')->with('specialNeed',$specialNeed)->withFlashSuccess('Special need added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($specialNeed)
    {
        $special_need=specialNeed::query()->where('uuid',$specialNeed)->first();
        return view('specialNeed.edit')->with('special_need',$special_need);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $specialNeed)
    {
        $validator=Validator::make($request->all(),[
            'special_need_name'=>'required',
            'special_need_icon'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $specialNeedRepo=new specialNeedRepository();
        $special_need=$specialNeedRepo->updateSpecialNeed($input,$specialNeed);
        return redirect()->back()->with('special_need',$special_need)->withFlashSuccess('Special Need Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(specialNeed $specialNeed)
    {
        $specialNeed->delete();
        return back()->withFlashSuccess('Special need is removed successfully');
    }
    public function activateSpecialNeed(Request $request)
    {
        $specialNeed=specialNeed::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $specialNeed->status=1;
                break;
            case 1:
                $specialNeed->status=0;
                break;
        }
        $specialNeed->save();
        return response()->json(['success'=>true]);
    }
    public function getSpecialNeeds()
    {
        $specialNeed=specialNeed::query()->orderBy('special_need_name')->get();
        return DataTables::of($specialNeed)
            ->addColumn('special_need_name',function ($specialNeed){
                return $specialNeed->special_need_name;
            })
            ->addColumn('activate_specialNeed',function ($specialNeed){
                $btn='<label class="switch{{$specialNeed->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('special_need_status',function ($specialNeed){
                return $specialNeed->specialNeedStatusLabel;
            })
            ->addColumn('actions',function ($specialNeed){
                return $specialNeed->SpecialNeedsButtonActionsLabel;
            })
            ->rawColumns(['activate_specialNeed','special_need_status','actions'])
            ->make(true);
    }
}
