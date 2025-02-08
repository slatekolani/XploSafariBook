<?php

namespace App\Repositories\Admin\TouristicAttraction;

use App\Models\TouristicAttractions\touristicAttractionVisitAdvices;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class touristicAttractionVisitAdvicesRepository.
 */
class touristicAttractionVisitAdvicesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristicAttractionVisitAdvices::class;
    }
    public function storeTouristicAttractionVisitAdvices($input,$touristicAttraction)
    {
        foreach ($input as $key => $value)
        {
            if(str_contains($key,'advice_description')!==false)
            {
                $key_id=substr($key,18);
                $touristicAttractionVisitAdvicesArray=[
                    'advice_number'=>$input['advice_number'.$key_id],
                    'advice_title'=>$input['advice_title'.$key_id],
                    'advice_description'=>$input['advice_description'.$key_id],
                    'touristic_attraction_id'=>$touristicAttraction->id
                ];
                $touristicAttractionVisitAdvices=new touristicAttractionVisitAdvices();
                $touristicAttractionVisitAdvices->advice_number=$touristicAttractionVisitAdvicesArray['advice_number'];
                $touristicAttractionVisitAdvices->advice_title=$touristicAttractionVisitAdvicesArray['advice_title'];
                $touristicAttractionVisitAdvices->advice_description=$touristicAttractionVisitAdvicesArray['advice_description'];
                $touristicAttractionVisitAdvices->touristic_attraction_id=$touristicAttractionVisitAdvicesArray['touristic_attraction_id'];
                $touristicAttractionVisitAdvices->save();
            }
        }
    }
    public function updateTouristicAttractionVisitAdvices($input,$touristicAttraction)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'advice_description')!==false)
            {
                $key_id=substr($key,18);
                $touristicAttractionVisitAdvicesArray=[
                    'advice_number'=>$input['advice_number'.$key_id],
                    'advice_title'=>$input['advice_title'.$key_id],
                    'advice_description'=>$input['advice_description'.$key_id],
                    'touristic_attraction_id'=>$touristicAttraction->id
                ];
                $touristicAttractionVisitAdvice=touristicAttractionVisitAdvices::query()->where('touristic_attraction_id',$touristicAttraction->id)->where('id',$key_id)->first();
                if ($touristicAttractionVisitAdvice)
                {
                    $touristicAttractionVisitAdvice->advice_number=$input['advice_number'.$key_id];
                    $touristicAttractionVisitAdvice->advice_title=$input['advice_title'.$key_id];
                    $touristicAttractionVisitAdvice->advice_description=$input['advice_description'.$key_id];
                    $touristicAttractionVisitAdvice->save();
                }
                else{
                    $touristicAttractionVisitAdvice=new touristicAttractionVisitAdvices();
                    $touristicAttractionVisitAdvice->advice_number=$touristicAttractionVisitAdvicesArray['advice_number'];
                    $touristicAttractionVisitAdvice->advice_title=$touristicAttractionVisitAdvicesArray['advice_title'];
                    $touristicAttractionVisitAdvice->advice_description=$touristicAttractionVisitAdvicesArray['advice_description'];
                    $touristicAttractionVisitAdvice->touristic_attraction_id=$touristicAttractionVisitAdvicesArray['touristic_attraction_id'];
                    $touristicAttractionVisitAdvice->save();
                }

            }
        }
    }
}
