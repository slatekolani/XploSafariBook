<?php

namespace App\Repositories\TourOperatorPackages\LocalTourPackages;

use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class localTourPackagesRepository.
 */
class localTourPackagesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourPackages::class;
    }

    public function storeLocalTourPackage(array $input,$package_reference_number)
    {
        $localTourPackage=new localTourPackages();
        $localTourPackage->safari_name=$input['safari_name'];
        $localTourPackage->safari_description=$input['safari_description'];
        $localTourPackage->trip_kind=$input['trip_kind'];
        $localTourPackage->travel_age_range=$input['travel_age_range'];
        $localTourPackage->number_of_views_expecting=$input['number_of_views_expecting'];
        $localTourPackage->payment_start_percent=$input['payment_start_percent'];
        $localTourPackage->cancellation_percent=$input['cancellation_percent'];
        $localTourPackage->cancellation_due_date=$input['cancellation_due_date'];
        $localTourPackage->cancellation_policy=$input['cancellation_policy'];
        $localTourPackage->trip_price_adult_tanzanian=$input['trip_price_adult_tanzanian'];
        $localTourPackage->trip_price_child_tanzanian=$input['trip_price_child_tanzanian'];
        $localTourPackage->trip_price_adult_foreigner=$input['trip_price_adult_foreigner'];
        $localTourPackage->trip_price_child_foreigner=$input['trip_price_child_foreigner'];
        $localTourPackage->safari_start_date=$input['safari_start_date'];
        $localTourPackage->safari_end_date=$input['safari_end_date'];
        $localTourPackage->payment_deadline=$input['payment_deadline'];
        $localTourPackage->package_range=$input['package_range'];
        $localTourPackage->maximum_travellers=$input['maximum_travellers'];
        $localTourPackage->phone_number=$input['phone_number'];
        $localTourPackage->email_address=$input['email_address'];
        $localTourPackage->discount_offered=$input['discount_offered'];
        $localTourPackage->number_of_people_for_discount=$input['number_of_people_for_discount'];
        $localTourPackage->payment_start_percent_deadline=$input['payment_start_percent_deadline'];
        $localTourPackage->targeted_event=$input['targeted_event'];
        $localTourPackage->tour_package_type_name=$input['tour_package_type_name'];
        $localTourPackage->emergency_handling=$input['emergency_handling'];
        $localTourPackage->free_of_charge_age=$input['free_of_charge_age'];
        $localTourPackage->package_reference_number=$package_reference_number;
        $localTourPackage->local_tour_type=$input['local_tour_type'];
        $localTourPackage->tour_operator_id=$input['tour_operator_id'];
        if ($input['safari_poster'])
        {
            $file=$input['safari_poster'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/localSafariBlogImages/',$filename);
            $localTourPackage->safari_poster=$filename;
        }
        if ($input['transport_used_images'] && is_array($input['transport_used_images']))
        {
            $imagePaths=[];
            foreach($input['transport_used_images'] as $images)
            {
                $extension=$images->getClientOriginalExtension();
                $filename=time().'_'.uniqid().'.'.$extension;
                $images->move('public/transportImages/',$filename);
                $imagePaths[]='/transportImages/' . $filename;
            }
            $localTourPackage->transport_used_images=implode(',',$imagePaths);
        }
        $localTourPackage->save();
        $localTourPackage->getLocalTourPackageSpecialNeeds($input,$localTourPackage);
        $localTourPackage->getLocalTourPackageReservations($input,$localTourPackage);
        $localTourPackage->getLocalTourPackageTransport($input,$localTourPackage);
        $localTourPackage->getLocalTourPackageCustomerSatisfaction($input,$localTourPackage);
        $localTourPackage->saveLocalTourPackageActivities($input,$localTourPackage);
        $localTourPackage->saveLocalTourPackagePriceInclusives($input,$localTourPackage);
        $localTourPackage->saveLocalTourPackagePriceExclusives($input,$localTourPackage);
        $localTourPackage->saveLocalTourPackageCollectionStops($input,$localTourPackage);
        $localTourPackage->saveLocalTourPackageRequirements($input,$localTourPackage);
    }

    public function updateLocalTourPackage($input,$request,$localTourPackageUuid)
    {
        $localTourPackage=localTourPackages::query()->where('uuid',$localTourPackageUuid)->first();
        $localTourPackage->safari_name=$input['safari_name'];
        $localTourPackage->trip_kind=$input['trip_kind'];
        $localTourPackage->travel_age_range=$input['travel_age_range'];
        $localTourPackage->number_of_views_expecting=$input['number_of_views_expecting'];
        $localTourPackage->payment_start_percent=$input['payment_start_percent'];
        $localTourPackage->cancellation_percent=$input['cancellation_percent'];
        $localTourPackage->cancellation_due_date=$input['cancellation_due_date'];
        $localTourPackage->cancellation_policy=$input['cancellation_policy'];
        $localTourPackage->safari_description=$input['safari_description'];
        $localTourPackage->trip_price_adult_tanzanian=$input['trip_price_adult_tanzanian'];
        $localTourPackage->trip_price_child_tanzanian=$input['trip_price_child_tanzanian'];
        $localTourPackage->trip_price_adult_foreigner=$input['trip_price_adult_foreigner'];
        $localTourPackage->trip_price_child_foreigner=$input['trip_price_child_foreigner'];
        $localTourPackage->safari_start_date=$input['safari_start_date'];
        $localTourPackage->safari_end_date=$input['safari_end_date'];
        $localTourPackage->payment_deadline=$input['payment_deadline'];
        $localTourPackage->package_range=$input['package_range'];
        $localTourPackage->maximum_travellers=$input['maximum_travellers'];
        $localTourPackage->phone_number=$input['phone_number'];
        $localTourPackage->email_address=$input['email_address'];
        $localTourPackage->discount_offered=$input['discount_offered'];
        $localTourPackage->number_of_people_for_discount=$input['number_of_people_for_discount'];
        $localTourPackage->payment_start_percent_deadline=$input['payment_start_percent_deadline'];
        $localTourPackage->targeted_event=$input['targeted_event'];
        $localTourPackage->tour_package_type_name=$input['tour_package_type_name'];
        $localTourPackage->free_of_charge_age=$input['free_of_charge_age'];
        $localTourPackage->emergency_handling=$input['emergency_handling'];
        $localTourPackage->local_tour_type=$input['local_tour_type'];
        $localTourPackage->tour_operator_id=$input['tour_operator_id'];
        $input=$request->all();
        if ($request->hasFile('safari_poster'))
        {
            $file=$input['safari_poster'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/localSafariBlogImages/',$filename);
            $localTourPackage->safari_poster=$filename;
        }
        if ($request->hasFile('transport_used_images') && is_array($input['transport_used_images']))
        {
            $imagePaths=[];
            foreach($input['transport_used_images'] as $images)
            {
                $extension=$images->getClientOriginalExtension();
                $filename=time().'_'.uniqid().'.'.$extension;
                $images->move('public/transportImages/',$filename);
                $imagePaths[]='/transportImages/' . $filename;
            }
            $localTourPackage->transport_used_images=implode(',',$imagePaths);
        }
        $localTourPackage->save();
        $localTourPackage->getLocalTourPackageSpecialNeeds($input,$localTourPackage);
        $localTourPackage->getLocalTourPackageReservations($input,$localTourPackage);
        $localTourPackage->getLocalTourPackageTransport($input,$localTourPackage);
        $localTourPackage->getLocalTourPackageCustomerSatisfaction($input,$localTourPackage);
        $localTourPackage->updateLocalTourPackageActivities($input,$localTourPackage);
        $localTourPackage->updateLocalTourPackagePriceInclusives($input,$localTourPackage);
        $localTourPackage->updateLocalTourPackagePriceExclusives($input,$localTourPackage);
        $localTourPackage->updateLocalTourPackageCollectionStops($input,$localTourPackage);
        $localTourPackage->updateLocalTourPackageRequirements($input,$localTourPackage);
    }
}
