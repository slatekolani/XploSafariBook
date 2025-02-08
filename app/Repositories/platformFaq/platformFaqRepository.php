<?php

namespace App\Repositories\platformFaq;

use App\Models\platformFaq\platformFaq;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class platformFaqRepository.
 */
class platformFaqRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return platformFaq::class;
    }

    public function storePlatformFaq(array $input)
    {
        $platformFaq=new platformFaq();
        $platformFaq->question_title=$input['question_title'];
        $platformFaq->question_description=$input['question_description'];
        $platformFaq->save();
    }
    public function updatePlatformFaq(array $input, $platformFaqId)
    {
        $platformFaq=platformFaq::query()->where('uuid',$platformFaqId)->first();
        $platformFaq->question_title=$input['question_title'];
        $platformFaq->question_description=$input['question_description'];
        $platformFaq->save();
    }
}
