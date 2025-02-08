<?php

namespace App\Repositories\Admin\Nations\economicActivity;

use App\Models\Nations\economicActivity\nationEconomicActivity;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class nationEconomicActivityRepository.
 */
class nationEconomicActivityRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return nationEconomicActivity::class;
    }
    public function saveNationEconomicActivities($input,$nation)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'economic_activity_description')!==false)
            {
                $key_id=substr($key,29);
                $nationEconomicActivityArray=[
                    'economic_activity_title'=>$input['economic_activity_title'.$key_id],
                    'economic_activity_description'=>$input['economic_activity_description'.$key_id],
                    'nation_id'=>$nation->id,
                ];
                $nationEconomicActivity=new nationEconomicActivity();
                $nationEconomicActivity->economic_activity_title=$nationEconomicActivityArray['economic_activity_title'];
                $nationEconomicActivity->economic_activity_description=$nationEconomicActivityArray['economic_activity_description'];
                $nationEconomicActivity->nation_id=$nationEconomicActivityArray['nation_id'];
                $nationEconomicActivity->save();
            }
        }
    }

    public function updateNationEconomicActivities($input,$nation)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'economic_activity_description')!==false)
            {
                $key_id=substr($key,29);
                $nationEconomicActivityArray=[
                    'economic_activity_title'=>$input['economic_activity_title'.$key_id],
                    'economic_activity_description'=>$input['economic_activity_description'.$key_id],
                    'nation_id'=>$nation->id,
                ];
                $nationEconomicActivity=nationEconomicActivity::query()->where('nation_id',$nation->id)->where('id',$key_id)->first();
                if ($nationEconomicActivity)
                {
                    $nationEconomicActivity->economic_activity_title=$input['economic_activity_title'.$key_id];
                    $nationEconomicActivity->economic_activity_description=$input['economic_activity_description'.$key_id];
                    $nationEconomicActivity->save();
                }
                else
                {
                    $nationEconomicActivity=new nationEconomicActivity();
                    $nationEconomicActivity->economic_activity_title=$nationEconomicActivityArray['economic_activity_title'];
                    $nationEconomicActivity->economic_activity_description=$nationEconomicActivityArray['economic_activity_description'];
                    $nationEconomicActivity->nation_id=$nationEconomicActivityArray['nation_id'];
                    $nationEconomicActivity->save();
                }
            }
        }
    }


}
