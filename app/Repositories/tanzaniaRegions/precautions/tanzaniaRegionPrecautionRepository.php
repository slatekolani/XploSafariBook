<?php

namespace App\Repositories\tanzaniaRegions\precautions;

use App\Models\tanzaniaRegions\Precautions\tanzaniaRegionPrecautions;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tanzaniaRegionPrecautionRepository.
 */
class tanzaniaRegionPrecautionRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tanzaniaRegionPrecautions::class;
    }
    public function saveTanzaniaRegionPrecautions($input,$tanzaniaRegion)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key, 'precaution_description') !== false)
            {
                $key_id=substr($key,22);
                $tanzaniaRegionPrecautionsArray=[
                    'precaution_title'=>$input['precaution_title'.$key_id],
                    'precaution_description'=>$input['precaution_description'.$key_id],
                    'tanzania_region_id'=>$tanzaniaRegion->id,
                ];
                $tanzaniaRegionPrecautions=new tanzaniaRegionPrecautions();
                $tanzaniaRegionPrecautions->precaution_title=$tanzaniaRegionPrecautionsArray['precaution_title'];
                $tanzaniaRegionPrecautions->precaution_description=$tanzaniaRegionPrecautionsArray['precaution_description'];
                $tanzaniaRegionPrecautions->tanzania_region_id=$tanzaniaRegionPrecautionsArray['tanzania_region_id'];
                $tanzaniaRegionPrecautions->save();
            }
        }
    }
    public function updateTanzaniaRegionPrecautions($input,$tanzaniaRegion)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'precaution_description')!==false)
            {
                $key_id=substr($key,22);
                $tanzaniaRegionPrecautionsArray=[
                    'precaution_title'=>$input['precaution_title'.$key_id],
                    'precaution_description'=>$input['precaution_description'.$key_id],
                    'tanzania_region_id'=>$tanzaniaRegion->id,
                ];
                $tanzaniaRegionPrecaution=tanzaniaRegionPrecautions::query()->where('tanzania_region_id',$tanzaniaRegion->id)->where('id',$key_id)->first();
                if ($tanzaniaRegionPrecaution)
                {
                    $tanzaniaRegionPrecaution->precaution_title=$input['precaution_title'.$key_id];
                    $tanzaniaRegionPrecaution->precaution_description=$input['precaution_description'.$key_id];
                    $tanzaniaRegionPrecaution->save();
                }
                else
                {
                    $tanzaniaRegionPrecaution = new tanzaniaRegionPrecautions();
                    $tanzaniaRegionPrecaution->precaution_title = $tanzaniaRegionPrecautionsArray['precaution_title'];
                    $tanzaniaRegionPrecaution->precaution_description = $tanzaniaRegionPrecautionsArray['precaution_description'];
                    $tanzaniaRegionPrecaution->tanzania_region_id = $tanzaniaRegionPrecautionsArray['tanzania_region_id'];
                    $tanzaniaRegionPrecaution->save();
                }
            }
        }
    }
}
