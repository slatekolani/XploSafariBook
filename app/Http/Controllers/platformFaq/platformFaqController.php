<?php

namespace App\Http\Controllers\platformFaq;

use App\Http\Controllers\Controller;
use App\Models\platformFaq\platformFaq;
use App\Repositories\platformFaq\platformFaqRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class platformFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('platformFAQ.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('platformFAQ.create');
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
            'question_title'=>'required|max:200',
            'question_description'=>'required|max:500',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $platformFaqRepo=new platformFaqRepository();
        $platformFaq=$platformFaqRepo->storePlatformFaq($input);
        return back()->with('platformFaq',$platformFaq)->withFlashSuccess('Platform FAQ uploaded successfully');
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

    public function publicView()
    {
        $platformFaqs=platformFaq::query()->where('status','=',1)->get();
        return view('platformFAQ.publicView')->with('platformFaqs',$platformFaqs);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($platformFaqId)
    {
        $platformFaq=platformFaq::query()->where('uuid',$platformFaqId)->first();
        return view('platformFAQ.edit')->with('platformFaq',$platformFaq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $platformFaqId)
    {
        $validator=Validator::make($request->all(),[
            'question_title'=>'required|max:200',
            'question_description'=>'required|max:500',
            ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $platformFaqRepo=new platformFaqRepository();
        $platformFaq=$platformFaqRepo->updatePlatformFaq($input,$platformFaqId);
        return back()->with('platformFaq',$platformFaq)->withFlashSuccess('Platform FAQ updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(platformFaq $platformFaq)
    {
        $platformFaq->delete();
        return back()->withFlashSuccess('Platform Faq deleted successfully');
    }

    public function activatePlatformFAQ(Request $request)
    {
        $platformFaq=platformFaq::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $platformFaq->status=1;
                break;
            case 1:
                $platformFaq->status=0;
                break;
        }
        $platformFaq->save();
        return response()->json(['success'=>true]);
    }
    public function getPlatformFaq()
    {
        $platformFaq=platformFaq::query()->orderBy('question_title')->get();
        return DataTables::of($platformFaq)
            ->addIndexColumn()
            ->addColumn('question_title',function ($platformFaq){
                return substr($platformFaq->question_title,0,50);
            })
            ->addColumn('question_description',function ($platformFaq){
                return substr($platformFaq->question_description,0,50);
            })
            ->addColumn('activate_question',function($platformFaq){
                $btn='<label class="switch{{$platformFaq->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('question_status',function ($platformFaq){
                return $platformFaq->question_status_label;
            })
            ->addColumn('actions',function ($platformFaq){
                return $platformFaq->button_action_label;
            })
            ->rawColumns(['question_status','actions','activate_question'])
            ->make(true);
    }
}
