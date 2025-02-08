<?php

namespace App\Repositories\tanzaniaRegions\tanzaniaRegionFAQ;

use App\Models\tanzaniaRegions\tanzaniaRegionFAQ\tanzaniaRegionFAQ;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tanzaniaRegionFAQRepository.
 */
class tanzaniaRegionFAQRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tanzaniaRegionFAQ::class;
    }
    public function storeTanzaniaRegionFAQ($input)
    {
        $tanzaniaRegionFAQ=new tanzaniaRegionFAQ();
        $tanzaniaRegionFAQ->question_title=$input['question_title'];
        $tanzaniaRegionFAQ->question_answer=$input['question_answer'];
        $tanzaniaRegionFAQ->tanzania_region_id=$input['tanzania_region_id'];
        $tanzaniaRegionFAQ->save();
    }
    public function updateRegionFAQ($input,$regionFAQUuid)
    {
        $tanzaniaRegionFAQ=tanzaniaRegionFAQ::query()->where('uuid',$regionFAQUuid)->first();
        $tanzaniaRegionFAQ->question_title=$input['question_title'];
        $tanzaniaRegionFAQ->question_answer=$input['question_answer'];
        $tanzaniaRegionFAQ->tanzania_region_id=$input['tanzania_region_id'];
        $tanzaniaRegionFAQ->save();
    }
}
