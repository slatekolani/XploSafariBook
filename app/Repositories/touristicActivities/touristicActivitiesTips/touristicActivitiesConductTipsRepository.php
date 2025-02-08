<?php

namespace App\Repositories\touristicActivities\touristicActivitiesTips;

use App\Models\touristicActivities\touristicActivityConductTips\touristicActivityConductTips;
use App\Repositories\BaseRepository;


class touristicActivitiesConductTipsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristicActivityConductTips::class;
    }

    public function saveTouristicActivityConductTips($input,$touristicActivity)
    {
        foreach($input as $key =>$value)
        {
            if(str_contains($key,'tip_description')!==false)
            {
                $key_id=substr($key,15);
                $touristicActivityConductTipsArray=[
                    'tip_name'=>$input['tip_name'.$key_id],
                    'tip_description'=>$input['tip_description'.$key_id],
                    'touristic_activities_id'=>$touristicActivity->id,
                ];
                $touristicActivityConductTip=new touristicActivityConductTips();
                $touristicActivityConductTip->tip_name=$touristicActivityConductTipsArray['tip_name'];
                $touristicActivityConductTip->tip_description=$touristicActivityConductTipsArray['tip_description'];
                $touristicActivityConductTip->touristic_activities_id=$touristicActivityConductTipsArray['touristic_activities_id'];
                $touristicActivityConductTip->save();
            }
        }
    }

    public function updateTouristicActivityConductTips($input,$touristicActivity)
    {
        foreach($input as $key =>$value)
        {
            if(str_contains($key,'tip_description')!==false)
            {
                $key_id=substr($key,15);
                $touristicActivityConductTipsArray=[
                    'tip_name'=>$input['tip_name'.$key_id],
                    'tip_description'=>$input['tip_description'.$key_id],
                    'touristic_activities_id'=>$touristicActivity->id,
                ];
                $touristicActivityConductTip=touristicActivityConductTips::query()->where('touristic_activities_id',$touristicActivity->id)->where('id',$key_id)->first();
                if($touristicActivityConductTip)
                {
                    $touristicActivityConductTip->tip_name=$input['tip_name'.$key_id];
                    $touristicActivityConductTip->tip_description=$input['tip_description'.$key_id];
                    $touristicActivityConductTip->save();
                }
                else
                {
                    $touristicActivityConductTip=new touristicActivityConductTips();
                    $touristicActivityConductTip->tip_name=$touristicActivityConductTipsArray['tip_name'];
                    $touristicActivityConductTip->tip_description=$touristicActivityConductTipsArray['tip_description'];
                    $touristicActivityConductTip->touristic_activities_id=$touristicActivityConductTipsArray['touristic_activities_id'];
                    $touristicActivityConductTip->save();
                }
            }
        }
    }
}
