<?php

namespace App\Repositories\Admin\TouristicAttraction;

use App\Models\TouristicAttractions\attractionVisitReasons;
use App\Models\TouristicAttractions\touristicAttractionVisitAdvices;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class attractionVisitReasonsRepository.
 */
class attractionVisitReasonsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return attractionVisitReasons::class;
    }
    public function storeTouristicAttractionVisitReasons($input,$touristicAttraction)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'reason_description')!==false)
            {
                $key_id=substr($key,18);
                $touristicAttractionVisitReasonArray=[
                    'reason_number'=>$input['reason_number'.$key_id],
                    'reason_title'=>$input['reason_title'.$key_id],
                    'reason_description'=>$input['reason_description'.$key_id],
                    'touristic_attraction_id'=>$touristicAttraction->id,
                ];
                $touristicAttractionVisitReason=new attractionVisitReasons();
                $touristicAttractionVisitReason->reason_number=$touristicAttractionVisitReasonArray['reason_number'];
                $touristicAttractionVisitReason->reason_title=$touristicAttractionVisitReasonArray['reason_title'];
                $touristicAttractionVisitReason->reason_description=$touristicAttractionVisitReasonArray['reason_description'];
                $touristicAttractionVisitReason->touristic_attraction_id=$touristicAttractionVisitReasonArray['touristic_attraction_id'];
                $touristicAttractionVisitReason->save();
            }
        }
    }

    public function updateTouristicAttractionVisitReasons($input,$touristicAttraction)
    {
        foreach($input as $key =>$value)
        {
            if (str_contains($key,'reason_description')!==false)
            {
                $key_id=substr($key,18);
                $touristicAttractionVisitReasonArray=[
                    'reason_number'=>$input['reason_number'.$key_id],
                    'reason_title'=>$input['reason_title'.$key_id],
                    'reason_description'=>$input['reason_description'.$key_id],
                    'touristic_attraction_id'=>$touristicAttraction->id,
                ];
                $touristicAttractionVisitReason=attractionVisitReasons::query()->where('touristic_attraction_id',$touristicAttraction->id)->where('id',$key_id)->first();
                if ($touristicAttractionVisitReason)
                {
                    $touristicAttractionVisitReason->reason_number=$input['reason_number'.$key_id];
                    $touristicAttractionVisitReason->reason_title=$input['reason_title'.$key_id];
                    $touristicAttractionVisitReason->reason_description=$input['reason_description'.$key_id];
                    $touristicAttractionVisitReason->save();
                }
                else
                {
                    $touristicAttractionVisitReason=new attractionVisitReasons();
                    $touristicAttractionVisitReason->reason_number=$touristicAttractionVisitReasonArray['reason_number'];
                    $touristicAttractionVisitReason->reason_title=$touristicAttractionVisitReasonArray['reason_title'];
                    $touristicAttractionVisitReason->reason_description=$touristicAttractionVisitReasonArray['reason_description'];
                    $touristicAttractionVisitReason->touristic_attraction_id=$touristicAttractionVisitReasonArray['touristic_attraction_id'];
                    $touristicAttractionVisitReason->save();
                }
            }
        }
    }
}
