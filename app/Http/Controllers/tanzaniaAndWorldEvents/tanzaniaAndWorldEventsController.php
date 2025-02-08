<?php

namespace App\Http\Controllers\tanzaniaAndWorldEvents;

use App\Http\Controllers\Controller;
use App\Models\tanzaniaAndWorldEvents\tanzaniaAndWorldEvents;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Repositories\tanzaniaAndWorldEvents\tanzaniaAndWorldEventsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class tanzaniaAndWorldEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tanzaniaAndWorldEvent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tanzaniaAndWorldEvent.create');
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
            'event_name'=>'required',
            'event_description'=>'required|max:300',
            'event_date'=>'nullable',
            'event_image'=>'required|mimes:jpg,jpeg,png|max:2048|dimensions:max_height=1000,max_width=1000',

        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $eventRepo=new tanzaniaAndWorldEventsRepository();
        $event=$eventRepo->storeEvent($input,$request);
        return redirect()->route('event.index')->with('event',$event)->withFlashSuccess('Event uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($eventId)
    {
        $event=tanzaniaAndWorldEvents::query()->where('uuid',$eventId)->first();
        return view('tanzaniaAndWorldEvent.view')->with('event',$event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($eventId)
    {
        $event=tanzaniaAndWorldEvents::query()->where('uuid',$eventId)->first();
        return view('tanzaniaAndWorldEvent.edit')->with('event',$event);
    }
    public function spotLocalSafaris($eventUuid)
    {
        $event=tanzaniaAndWorldEvents::query()->where('uuid',$eventUuid)->first();
        $localTourPackages=localTourPackages::query()->with('touristicAttraction')
            ->where('targeted_event',$event->id)
            ->where('safari_start_date','>=',Carbon::now())
            ->inRandomOrder()
            ->paginate(12);
        return view('tanzaniaAndWorldEvent.LocalSafaris.spottedLocalSafaris')
            ->with('event',$event)
            ->with('localTourPackages',$localTourPackages);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $eventId)
    {
        $validator=Validator::make($request->all(),
        [
            'event_name'=>'required',
            'event_date'=>'nullable',
            'event_description'=>'required|max:300',
            'event_image'=>'nullable|mimes:jpg,jpeg,png|max:2048|dimensions:max_height=1000,max_width=1000',

        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $eventRepo=new tanzaniaAndWorldEventsRepository();
        $event=$eventRepo->updateEvent($input,$eventId,$request);
        return redirect()->route('event.index')
            ->with('event',$event)
            ->withFlashSuccess('Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($eventId)
    {
        $event=tanzaniaAndWorldEvents::query()->where('uuid',$eventId)->first();
        $event->delete();
        return redirect()->back()->withFlashSuccess('Event deleted successfully!');

    }
    public function activateEvent(Request $request)
    {
        $event=tanzaniaAndWorldEvents::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $event->status=1;
                break;
            case 1:
                $event->status=0;
                break;
        }
        $event->save();
        return response()->json(['success'=>true]);
    }
    public function getTanzaniaAndWorldEvents()
    {
        $event=tanzaniaAndWorldEvents::query()->orderBy('event_name')->get();
        return DataTables::of($event)
            ->addColumn('event_name',function ($event)
            {
                return $event->event_name;
            })
            ->addColumn('event_description',function ($event)
            {
                return $event->event_description;
            })
            ->addColumn('event_date',function ($event)
            {
                return date('jS M Y H:m a',strtotime($event->event_date));
            })
            ->addColumn('activate_event',function ($event){
                $btn='<label class="switch{{$event->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('event_status',function ($event){
                return $event->eventStatusLabel;
            })
            ->addColumn('actions',function ($event){
                return $event->eventButtonActionLabel;
            })
            ->rawColumns(['activate_event','event_status','actions',])
            ->make(true);
    }
}
