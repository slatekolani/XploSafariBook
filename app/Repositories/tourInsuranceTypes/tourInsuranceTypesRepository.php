<?php

namespace App\Repositories\tourInsuranceTypes;

use App\Models\tourInsuranceTypes\tourInsuranceTypes;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourInsuranceTypesRepository.
 */
class tourInsuranceTypesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourInsuranceTypes::class;
    }
    public function storeTourInsuranceType($input)
    {
        $tourInsuranceType=new tourInsuranceTypes();
        $tourInsuranceType->tour_insurance_name=$input['tour_insurance_name'];
        $tourInsuranceType->tour_insurance_description=$input['tour_insurance_description'];
        $tourInsuranceType->save();
    }
    public function updateTourInsuranceType($input,$tourInsuranceTypeUuid)
    {
        $tourInsuranceType=tourInsuranceTypes::query()->where('uuid',$tourInsuranceTypeUuid)->first();
        $tourInsuranceType->tour_insurance_name=$input['tour_insurance_name'];
        $tourInsuranceType->tour_insurance_description=$input['tour_insurance_description'];
        $tourInsuranceType->save();
    }
}
