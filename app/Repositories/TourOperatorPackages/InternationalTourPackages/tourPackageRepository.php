<?php

namespace App\Repositories\TourOperatorPackages\InternationalTourPackages;

use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourPackageRepository.
 */
class tourPackageRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return TourPackages::class;
    }

    public function storeTourPackageInformation(array $input)
    {
        $tourPackage=new TourPackages();
        $tourPackage->main_safari_name=$input['main_safari_name'];
        $tourPackage->safari_package_description=$input['safari_package_description'];
        $tourPackage->trip_price_adult_tanzanian=$input['trip_price_adult_tanzanian'];
        $tourPackage->trip_price_child_tanzanian=$input['trip_price_child_tanzanian'];
        $tourPackage->trip_price_adult_foreigner=$input['trip_price_adult_foreigner'];
        $tourPackage->trip_price_child_foreigner=$input['trip_price_child_foreigner'];
        $tourPackage->safari_start_date=$input['safari_start_date'];
        $tourPackage->safari_end_date=$input['safari_end_date'];
        $tourPackage->tour_operator_id=$input['tour_operator_id'];
        $tourPackage->users_id=auth()->user()->id;
        if($input['safari_poster'])
        {
            $file=$input['safari_poster'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/blogImages/',$filename);
            $tourPackage->safari_poster=$filename;
        }
        $tourPackage->save();
        $tourPackage->saveTourPackageFeatures($input,$tourPackage);
        $tourPackage->saveTourPackageActivities($input,$tourPackage);
        $tourPackage->saveTourPackageTrips($input, $tourPackage);
        $tourPackage->saveTourPackageAccommodations($input, $tourPackage);
        $tourPackage->getTourPackageSpecialNeedCategory($input, $tourPackage);
        $tourPackage->getTourPackageTransport($input,$tourPackage);
        $tourPackage->getTourPackageTourType($input, $tourPackage);

    }
    public function updateTourPackageInformation(array $input, $tour_package)
    {
        $tourPackage=TourPackages::query()->where('uuid',$tour_package)->first();
        $tourPackage->main_safari_name=$input['main_safari_name'];
        $tourPackage->safari_package_description=$input['safari_package_description'];
        $tourPackage->trip_price_adult_tanzanian=$input['trip_price_adult_tanzanian'];
        $tourPackage->trip_price_child_tanzanian=$input['trip_price_child_tanzanian'];
        $tourPackage->trip_price_adult_foreigner=$input['trip_price_adult_foreigner'];
        $tourPackage->trip_price_child_foreigner=$input['trip_price_child_foreigner'];
        $tourPackage->safari_start_date=$input['safari_start_date'];
        $tourPackage->safari_end_date=$input['safari_end_date'];
        $tourPackage->tour_operator_id=$input['tour_operator_id'];
        $tourPackage->users_id=auth()->user()->id;
        if($input['safari_poster'])
        {
            $file=$input['safari_poster'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/blogImages/',$filename);
            $tourPackage->safari_poster=$filename;
        }
        $tourPackage->save();
        $tourPackage->saveTourPackageFeatures($input,$tourPackage);
        $tourPackage->saveTourPackageActivities($input,$tourPackage);
        $tourPackage->saveTourPackageTrips($input, $tourPackage);
        $tourPackage->saveTourPackageAccommodations($input, $tourPackage);
        $tourPackage->getTourPackageSpecialNeedCategory($input, $tourPackage);
        $tourPackage->getTourPackageTransport($input,$tourPackage);
        $tourPackage->getTourPackageTourType($input, $tourPackage);
    }
}
