<?php

namespace App\Repositories\tourPackageType;

use App\Models\tourPackageType\tourPackageType;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourPackageTypeRepository.
 */
class tourPackageTypeRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourPackageType::class;
    }
    public function storeTourPackageType(array $input)
    {
        $tourPackageType=new tourPackageType();
        $tourPackageType->tour_package_type_name=$input['tour_package_type_name'];
        $tourPackageType->tour_package_type_description=$input['tour_package_type_description'];
        if($input['tour_package_type_image'])
        {
            $file=$input['tour_package_type_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/packageTypeImage/',$filename);
            $tourPackageType->tour_package_type_image=$filename;
        }
        $tourPackageType->save();
    }

    public function updateTourPackageType(array $input, $tourPackageTypeId,$request)
    {
        $tourPackageType=tourPackageType::query()->where('uuid',$tourPackageTypeId)->first();
        $tourPackageType->tour_package_type_name=$input['tour_package_type_name'];
        $tourPackageType->tour_package_type_description=$input['tour_package_type_description'];
        $input=$request->all();
        if($request->hasFile('tour_package_type_image') && $input['tour_package_type_image'])
        {
            $file=$input['tour_package_type_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/packageTypeImage/',$filename);
            $tourPackageType->tour_package_type_image=$filename;
        }
        $tourPackageType->save();
    }
}
