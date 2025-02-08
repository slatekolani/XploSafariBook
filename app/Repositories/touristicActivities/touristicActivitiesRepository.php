<?php

namespace App\Repositories\touristicActivities;

use App\Models\touristicActivities\touristicActivities;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tanzaniaAndWorldEventsRepository.
 */
class touristicActivitiesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristicActivities::class;
    }

    public function storeTouristicActivity($input,$request)
    {
        $touristicActivity=new touristicActivities();
        $touristicActivity->activity_name=$input['activity_name'];
        $touristicActivity->activity_description=$input['activity_description'];
        $touristicActivity->best_activity_period=$input['best_activity_period'];
        $touristicActivity->basic_information=$input['basic_information'];
        if($input['activity_image'])
        {
            $file=$input['activity_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/touristicActivityImage/',$filename);
            $touristicActivity->activity_image=$filename;
        }
        $touristicActivity->save();
        $touristicActivity->saveTouristicActivityConductTips($input,$touristicActivity);
    }

    public function updateTouristicActivity($input,$touristicActivityUuid,$request)
    {
        $touristicActivity=touristicActivities::query()->where('uuid',$touristicActivityUuid)->first();
        $touristicActivity->activity_name=$input['activity_name'];
        $touristicActivity->activity_description=$input['activity_description'];
        $touristicActivity->best_activity_period=$input['best_activity_period'];
        $touristicActivity->basic_information=$input['basic_information'];
        if($request->hasFile('activity_image') && $input['activity_image'])
        {
            $file=$input['activity_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/touristicActivityImage/',$filename);
            $touristicActivity->activity_image=$filename;
        }
        $touristicActivity->save();
        $touristicActivity->updateTouristicActivityConductTips($input,$touristicActivity);
    }
    
}
