<?php

namespace App\Repositories\Admin\TouristicAttraction;

use App\Models\TouristicAttractions\touristAttractionFaq;
use App\Repositories\BaseRepository;
//use Your Model

/**
 * Class touristAttractionFaqRepository.
 */
class touristAttractionFaqRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristAttractionFaq::class;
    }
    public function storeTouristAttractionFaq($input)
    {
        $touristAttractionFaq= new touristAttractionFaq();
        $touristAttractionFaq->question_title=$input['question_title'];
        $touristAttractionFaq->question_description=$input['question_description'];
        $touristAttractionFaq->touristic_attraction_id=$input['touristic_attraction_id'];
        $touristAttractionFaq->save();
    }
    public function updateTouristicAttraction($input,$touristAttractionFaqId)
    {
        $touristAttractionFaq=touristAttractionFaq::query()->where('uuid',$touristAttractionFaqId)->first();
        $touristAttractionFaq->question_title=$input['question_title'];
        $touristAttractionFaq->question_description=$input['question_description'];
        $touristAttractionFaq->touristic_attraction_id=$input['touristic_attraction_id'];
        $touristAttractionFaq->save();
    }
}
