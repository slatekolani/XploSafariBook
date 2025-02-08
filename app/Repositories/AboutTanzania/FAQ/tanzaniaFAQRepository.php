<?php

namespace App\Repositories\AboutTanzania\FAQ;

use App\Models\aboutTanzania\FAQ\tanzaniaFAQ;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tanzaniaFAQRepository.
 */
class tanzaniaFAQRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tanzaniaFAQ::class;
    }
    public function storeTanzaniaFAQ($input)
    {
        $tanzaniaFAQ=new tanzaniaFAQ();
        $tanzaniaFAQ->question_title=$input['question_title'];
        $tanzaniaFAQ->question_answer=$input['question_answer'];
        $tanzaniaFAQ->nation_id=$input['nation_id'];
        $tanzaniaFAQ->save();
    }
    public function updateTanzaniaFAQRepo($input,$tanzaniaFAQUuid)
    {
        $tanzaniaFAQ=tanzaniaFAQ::query()->where('uuid',$tanzaniaFAQUuid)->first();
        $tanzaniaFAQ->question_title=$input['question_title'];
        $tanzaniaFAQ->question_answer=$input['question_answer'];
        $tanzaniaFAQ->nation_id=$input['nation_id'];
        $tanzaniaFAQ->save();
    }
}
