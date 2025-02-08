<?php

namespace App\Repositories\Admin\Nations\precaution;

use App\Models\Nations\Precaution\nationPrecautions;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class nationPrecautionRepository.
 */
class nationPrecautionRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return nationPrecautions::class;
    }
    public function saveNationPrecautions($input,$nation)
    {
        foreach($input as $key =>$value)
        {
            if(str_contains($key,'precaution_description')!==false)
            {
                $key_id=substr($key,22);
                $nationPrecautionArray=[
                    'precaution_title'=>$input['precaution_title'.$key_id],
                    'precaution_description'=>$input['precaution_description'.$key_id],
                    'nation_id'=>$nation->id,
                ];
                $nationPrecaution=new nationPrecautions();
                $nationPrecaution->precaution_title=$nationPrecautionArray['precaution_title'];
                $nationPrecaution->precaution_description=$nationPrecautionArray['precaution_description'];
                $nationPrecaution->nation_id=$nationPrecautionArray['nation_id'];
                $nationPrecaution->save();
            }
        }
    }
    public function updateNationPrecautions($input,$nation)
    {
        foreach($input as $key =>$value)
        {
            if (str_contains($key,'precaution_description')!==false)
            {
                $key_id=substr($key,22);
                $nationPrecautionArray=[
                    'precaution_title'=>$input['precaution_title'.$key_id],
                    'precaution_description'=>$input['precaution_description'.$key_id],
                    'nation_id'=>$nation->id,
                ];
                $nationPrecaution=nationPrecautions::query()->where('nation_id',$nation->id)->where('id',$key_id)->first();
                if ($nationPrecaution)
                {
                    $nationPrecaution->precaution_title=$input['precaution_title'.$key_id];
                    $nationPrecaution->precaution_description=$input['precaution_description'.$key_id];
                    $nationPrecaution->save();
                }
                else
                {
                    $nationPrecaution=new nationPrecautions();
                    $nationPrecaution->precaution_title=$nationPrecautionArray['precaution_title'];
                    $nationPrecaution->precaution_description=$nationPrecautionArray['precaution_description'];
                    $nationPrecaution->nation_id=$nationPrecautionArray['nation_id'];
                    $nationPrecaution->save();
                }
            }
        }
    }
}
