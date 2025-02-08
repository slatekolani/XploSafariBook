<?php

namespace App\Repositories\Admin\TourTypes;

use App\Models\TourTypes\tourTypes;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourTypesRepository.
 */
class tourTypesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourTypes::class;
    }
    public function storeTourType(array $input)
    {
        $tourType=new tourTypes();
        $tourType->rating=$input['rating'];
        $tourType->tour_type_name=$input['tour_type_name'];
        $tourType->tour_type_description=$input['tour_type_description'];
        $tourType->save();
    }
    public function updateTourType(array $input, $tourType)
    {
        $tourType=tourTypes::query()->where('uuid',$tourType)->first();
        $tourType->rating=$input['rating'];
        $tourType->tour_type_name=$input['tour_type_name'];
        $tourType->tour_type_description=$input['tour_type_description'];
        $tourType->save();
    }
}
