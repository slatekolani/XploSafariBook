<?php

namespace App\Repositories\tanzaniaRegions\regionCulture\cultureCharacteristics;

use App\Models\tanzaniaRegions\regionCulture\appreciationActivities\CultureAppreciationActivityModel;
use App\Models\tanzaniaRegions\regionCulture\cultureChallenges\CultureChallengesModel;
use App\Models\tanzaniaRegions\regionCulture\cultureCharacteristics\tanzaniaRegionCultureCharacteristic;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tanzaniaRegionCultureCharacteristicRepository.
 */
class tanzaniaRegionCultureCharacteristicRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tanzaniaRegionCultureCharacteristic::class;
    }
    public function saveTanzaniaRegionCultureCharacteristics($input,$tanzaniaRegionCulture)
    {
        foreach($input as $key =>$value)
        {
            if(str_contains($key,'characteristic_description')!==false)
            {
                $key_id=substr($key,26);
                $tanzaniaRegionCultureCharacteristicsArray=[
                    'characteristic_title'=>$input['characteristic_title'.$key_id],
                    'characteristic_description'=>$input['characteristic_description'.$key_id],
                    'tanzania_region_culture_id'=>$tanzaniaRegionCulture->id,
                ];
                $tanzaniaRegionCultureCharacteristic=new tanzaniaRegionCultureCharacteristic();
                $tanzaniaRegionCultureCharacteristic->characteristic_title=$tanzaniaRegionCultureCharacteristicsArray['characteristic_title'];
                $tanzaniaRegionCultureCharacteristic->characteristic_description=$tanzaniaRegionCultureCharacteristicsArray['characteristic_description'];
                $tanzaniaRegionCultureCharacteristic->tanzania_region_culture_id=$tanzaniaRegionCultureCharacteristicsArray['tanzania_region_culture_id'];
                $tanzaniaRegionCultureCharacteristic->save();
            }
        }
    }
    public function saveCultureAppreciationActivities($input, $tanzaniaRegionCulture)
    {
        foreach ($input as $key =>$value){

            if(str_contains($key,'appreciation_activity_detail')!==false)
            {
                $key_id=substr($key,28);
                $cultureAppreciationActivitiesArray=[
                    'appreciation_activity_detail'=>$input['appreciation_activity_detail'.$key_id],
                    'tanzania_region_culture_id'=>$tanzaniaRegionCulture->id,
                ];
                $cultureAppreciationActivities=new CultureAppreciationActivityModel();
                $cultureAppreciationActivities->appreciation_activity_detail=$cultureAppreciationActivitiesArray['appreciation_activity_detail'];
                $cultureAppreciationActivities->tanzania_region_culture_id=$cultureAppreciationActivitiesArray['tanzania_region_culture_id'];
                $cultureAppreciationActivities->save();
            }
        }
    }

    public function saveCultureChallenges($input,$tanzaniaRegionCulture)
    {
        foreach($input as $key =>$value)
        {
            if(str_contains($key,'culture_challenges_detailed')!==false)
            {
                $key_id=substr($key,27);
                $cultureChallengesArray=[
                    'culture_challenges_detailed' => $input['culture_challenges_detailed'.$key_id],
                    'tanzania_region_culture_id'=> $tanzaniaRegionCulture->id,
                ];
                $cultureChallenges=new CultureChallengesModel();
                $cultureChallenges->culture_challenges_detailed=$cultureChallengesArray['culture_challenges_detailed'];
                $cultureChallenges->tanzania_region_culture_id=$cultureChallengesArray['tanzania_region_culture_id'];
                $cultureChallenges->save();
            }
        }
    }

    public function updateTanzaniaRegionCultureCharacteristic($input,$tanzaniaRegionCulture)
    {
        foreach ($input as $key=>$value) {
            if (str_contains($key,'characteristic_description')!==false)
            {
                $key_id=substr($key,26);
                $tanzaniaRegionCultureCharacteristicsArray=[
                    'characteristic_title'=>$input['characteristic_title'.$key_id],
                    'characteristic_description'=>$input['characteristic_description'.$key_id],
                    'tanzania_region_culture_id'=>$tanzaniaRegionCulture->id,
                ];
                $tanzaniaRegionCultureCharacteristic=tanzaniaRegionCultureCharacteristic::query()->where('tanzania_region_culture_id',$tanzaniaRegionCulture->id)->where('id',$key_id)->first();
                if ($tanzaniaRegionCultureCharacteristic)
                {
                    $tanzaniaRegionCultureCharacteristic->characteristic_title=$input['characteristic_title'.$key_id];
                    $tanzaniaRegionCultureCharacteristic->characteristic_description=$input['characteristic_description'.$key_id];
                    $tanzaniaRegionCultureCharacteristic->save();
                }
                else
                {
                    $tanzaniaRegionCultureCharacteristic=new tanzaniaRegionCultureCharacteristic();
                    $tanzaniaRegionCultureCharacteristic->characteristic_title=$tanzaniaRegionCultureCharacteristicsArray['characteristic_title'];
                    $tanzaniaRegionCultureCharacteristic->characteristic_description=$tanzaniaRegionCultureCharacteristicsArray['characteristic_description'];
                    $tanzaniaRegionCultureCharacteristic->tanzania_region_culture_id=$tanzaniaRegionCultureCharacteristicsArray['tanzania_region_culture_id'];
                    $tanzaniaRegionCultureCharacteristic->save();
                }
            }
        }
    }

    public function updateCultureAppreciationActivities($input,$tanzaniaRegionCulture)
    {
        foreach ($input as $key=>$value) {
            if(str_contains($key,'appreciation_activity_detail')!==false)
            {
                $key_id=substr($key,28);
                $cultureAppreciationActivitiesArray=[
                    'appreciation_activity_detail'=>$input['appreciation_activity_detail'.$key_id],
                    'tanzania_region_culture_id'=>$tanzaniaRegionCulture->id,
                ];
                $cultureAppreciationActivity=CultureAppreciationActivityModel::query()->where('tanzania_region_culture_id',$tanzaniaRegionCulture->id)->where('id',$key_id)->first();
                if ($cultureAppreciationActivity)
                {
                    $cultureAppreciationActivity->appreciation_activity_detail=$input['appreciation_activity_detail'.$key_id];
                    $cultureAppreciationActivity->save();
                }
                else
                {
                    $cultureAppreciationActivity=new CultureAppreciationActivityModel();
                    $cultureAppreciationActivity->appreciation_activity_detail=$cultureAppreciationActivitiesArray['appreciation_activity_detail'];
                    $cultureAppreciationActivity->tanzania_region_culture_id=$cultureAppreciationActivitiesArray['tanzania_region_culture_id'];
                    $cultureAppreciationActivity->save();
                }
            }
        }
    }

    public function updateCultureChallenges($input,$tanzaniaRegionCulture)
    {
        foreach ($input as $key=>$value) {
            if(str_contains($key,'culture_challenges_detailed')!==false)
            {
                $key_id=substr($key,27);
                $cultureChallengesArray=[
                    'culture_challenges_detailed' => $input['culture_challenges_detailed'.$key_id],
                    'tanzania_region_culture_id'=> $tanzaniaRegionCulture->id,
                ];
                $cultureChallenge=CultureChallengesModel::query()->where('tanzania_region_culture_id',$tanzaniaRegionCulture->id)->where('id',$key_id)->first();
                if ($cultureChallenge)
                {
                    $cultureChallenge->culture_challenges_detailed=$input['culture_challenges_detailed'.$key_id];
                    $cultureChallenge->save();
                }
                else
                {
                    $cultureChallenge=new CultureChallengesModel();
                    $cultureChallenge->culture_challenges_detailed=$cultureChallengesArray['culture_challenges_detailed'];
                    $cultureChallenge->tanzania_region_culture_id=$cultureChallengesArray['tanzania_region_culture_id'];
                    $cultureChallenge->save();
                }
            }
        }
    }
}
