<?php

namespace App\Repositories\AboutTanzania\tanzaniaVisitAdvice;

use App\Models\aboutTanzania\tanzaniaVisitAdvice\tanzaniaVisitAdvice;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tanzaniaVisitAdviceRepository.
 */
class tanzaniaVisitAdviceRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tanzaniaVisitAdvice::class;
    }

    public function storeTanzaniaVisitAdvice($input)
    {
        $tanzaniaVisitAdvice=new tanzaniaVisitAdvice();
        $tanzaniaVisitAdvice->advice_title=$input['advice_title'];
        $tanzaniaVisitAdvice->advice_description=$input['advice_description'];
        $tanzaniaVisitAdvice->directory_url=$input['directory_url'];
        $tanzaniaVisitAdvice->nation_id=$input['nation_id'];
        $tanzaniaVisitAdvice->save();
    }
    public function updateTanzaniaVisitAdvice($input,$tanzaniaVisitAdviceUuid)
    {
        $tanzaniaVisitAdvice=tanzaniaVisitAdvice::query()->where('uuid',$tanzaniaVisitAdviceUuid)->first();
        $tanzaniaVisitAdvice->advice_title=$input['advice_title'];
        $tanzaniaVisitAdvice->advice_description=$input['advice_description'];
        $tanzaniaVisitAdvice->directory_url=$input['directory_url'];
        $tanzaniaVisitAdvice->nation_id=$input['nation_id'];
        $tanzaniaVisitAdvice->save();
    }
}
