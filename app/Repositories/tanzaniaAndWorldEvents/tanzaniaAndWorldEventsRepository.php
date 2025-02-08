<?php

namespace App\Repositories\tanzaniaAndWorldEvents;

use App\Models\tanzaniaAndWorldEvents\tanzaniaAndWorldEvents;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tanzaniaAndWorldEventsRepository.
 */
class tanzaniaAndWorldEventsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tanzaniaAndWorldEvents::class;
    }

    public function storeEvent($input,$request)
    {
        $event=new tanzaniaAndWorldEvents();
        $event->event_name=$input['event_name'];
        $event->event_description=$input['event_description'];
        $event->event_date=$input['event_date'];
        if($input['event_image'])
        {
            $file=$input['event_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/eventImages/',$filename);
            $event->event_image=$filename;
        }
        $event->save();
    }
    public function updateEvent($input,$eventId,$request)
    {
        $event=tanzaniaAndWorldEvents::query()->where('uuid',$eventId)->first();
        $event->event_name=$input['event_name'];
        $event->event_description=$input['event_description'];
        $event->event_date=$input['event_date'];
        $input=$request->all();
        if($request->hasFile('event_image') && $input['event_image'])
        {
            $file=$input['event_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/eventImages/',$filename);
            $event->event_image=$filename;
        }
        $event->save();
    }
}
