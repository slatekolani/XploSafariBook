<?php

namespace App\Repositories\Admin\TouristicAttraction;

use App\Models\TouristicAttractions\touristicAttractions;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class touristicAttractionRepository.
 */
class touristicAttractionRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristicAttractions::class;
    }
    public function storeTouristicAttractions(array $input)
    {
        $touristicAttraction=new touristicAttractions();
        $touristicAttraction->attraction_name=$input['attraction_name'];
        $touristicAttraction->attraction_description=$input['attraction_description'];
        $touristicAttraction->attraction_region=$input['attraction_region'];
        $touristicAttraction->attraction_category=$input['attraction_category'];
        $touristicAttraction->establishment_year=$input['establishment_year'];
        $touristicAttraction->seasonal_variation=$input['seasonal_variation'];
        $touristicAttraction->flora_fauna=$input['flora_fauna'];
        $touristicAttraction->attraction_visit_month=$input['attraction_visit_month'];
        $touristicAttraction->basic_information=$input['basic_information'];
        $touristicAttraction->governing_body=$input['governing_body'];
        $touristicAttraction->website_link=$input['website_link'];
        $touristicAttraction->entry_fee_adult_foreigner=$input['entry_fee_adult_foreigner'];
        $touristicAttraction->entry_fee_child_foreigner=$input['entry_fee_child_foreigner'];
        $touristicAttraction->entry_fee_child_local=$input['entry_fee_child_local'];
        $touristicAttraction->entry_fee_adult_local=$input['entry_fee_adult_local'];
        $touristicAttraction->personal_experience=$input['personal_experience'];
        if (!empty($input['attraction_map'])) {
            $file = $input['attraction_map'];
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/attractionMaps/', $filename);
            $touristicAttraction->attraction_map = $filename;
        } else {
            $touristicAttraction->attraction_map = null; 
        }
        
        if ($input['attraction_image'] && is_array($input['attraction_image'])) {
            $imagePaths = [];

            foreach ($input['attraction_image'] as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $image->move('public/touristAttraction/', $filename);
                $imagePaths[] = '/touristAttraction/' . $filename;
            }
            $touristicAttraction->attraction_image = implode(',', $imagePaths);
        }
        $touristicAttraction->save();
        $touristicAttraction->saveTouristicAttractionVisitAdvices($input,$touristicAttraction);
        $touristicAttraction->saveTouristicAttractionVisitReasons($input,$touristicAttraction);
        $touristicAttraction->getTouristicAttractionActivities($input,$touristicAttraction);
    }
    public function updateTouristicAttraction(array $input, $touristicAttraction,$request)
    {
        $touristicAttraction=touristicAttractions::query()->where('uuid',$touristicAttraction)->first();
        $touristicAttraction->attraction_name=$input['attraction_name'];
        $touristicAttraction->attraction_description=$input['attraction_description'];
        $touristicAttraction->attraction_region=$input['attraction_region'];
        $touristicAttraction->attraction_category=$input['attraction_category'];
        $touristicAttraction->establishment_year=$input['establishment_year'];
        $touristicAttraction->seasonal_variation=$input['seasonal_variation'];
        $touristicAttraction->flora_fauna=$input['flora_fauna'];
        $touristicAttraction->attraction_visit_month=$input['attraction_visit_month'];
        $touristicAttraction->basic_information=$input['basic_information'];
        $touristicAttraction->governing_body=$input['governing_body'];
        $touristicAttraction->website_link=$input['website_link'];
        $touristicAttraction->entry_fee_adult_foreigner=$input['entry_fee_adult_foreigner'];
        $touristicAttraction->entry_fee_child_foreigner=$input['entry_fee_child_foreigner'];
        $touristicAttraction->entry_fee_child_local=$input['entry_fee_child_local'];
        $touristicAttraction->entry_fee_adult_local=$input['entry_fee_adult_local'];
        $touristicAttraction->personal_experience=$input['personal_experience'];
        $input=$request->all();
        if ($request->hasFile('attraction_map') && !empty($input['attraction_map'])) {
            $file = $input['attraction_map'];
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/attractionMaps/', $filename);
            $touristicAttraction->attraction_map = $filename;
        } elseif (!$request->hasFile('attraction_map')) { // Corrected condition
            $touristicAttraction->attraction_map = null;
        }
        

        if ($request->hasFile('attraction_image') && is_array($input['attraction_image'])) {
            $imagePaths = [];

            foreach ($input['attraction_image'] as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $image->move('public/touristAttraction/', $filename);

                $imagePaths[] = '/touristAttraction/' . $filename;
            }
            $touristicAttraction->attraction_image = implode(',', $imagePaths);
        }
        
        $touristicAttraction->save();
        $touristicAttraction->updateTouristicAttractionVisitAdvices($input,$touristicAttraction);
        $touristicAttraction->updateTouristicAttractionVisitReasons($input,$touristicAttraction);
        $touristicAttraction->getTouristicAttractionActivities($input,$touristicAttraction);
    }
}
