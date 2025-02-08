<?php

namespace App\Repositories\Admin\TouristicAttraction\category;

use App\Models\TouristicAttractions\category\touristicAttractionCategory;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class touristicAttractionCategoryRepository.
 */
class touristicAttractionCategoryRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristicAttractionCategory::class;
    }
    public function storeTouristicAttractionCategory($input)
    {
        $touristicAttractionCategory=new touristicAttractionCategory();
        $touristicAttractionCategory->attraction_category=$input['attraction_category'];
        $touristicAttractionCategory->attraction_category_description=$input['attraction_category_description'];
        $touristicAttractionCategory->attraction_category_basic_information=$input['attraction_category_basic_information'];
        if($input['attraction_category_iconic_image'])
        {
            $file=$input['attraction_category_iconic_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/TouristicAttractionCategoryIconicImages/',$filename);
            $touristicAttractionCategory->attraction_category_iconic_image=$filename;
        }
        $touristicAttractionCategory->save();
        $touristicAttractionCategory->getTouristicAttractionCategoryActivities($input,$touristicAttractionCategory);
    }
    public function updateTouristicAttractionCategory($input,$attractionCategoryUuid,$request)
    {
        $touristicAttractionCategory=touristicAttractionCategory::query()->where('uuid',$attractionCategoryUuid)->first();
        $touristicAttractionCategory->attraction_category=$input['attraction_category'];
        $touristicAttractionCategory->attraction_category_description=$input['attraction_category_description'];
        $touristicAttractionCategory->attraction_category_basic_information=$input['attraction_category_basic_information'];
        $input=$request->all();
        if($request->hasFile('attraction_category_iconic_image') && $input['attraction_category_iconic_image'])
        {
            $file=$input['attraction_category_iconic_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/TouristicAttractionCategoryIconicImages/',$filename);
            $touristicAttractionCategory->attraction_category_iconic_image=$filename;
        }
        $touristicAttractionCategory->save();
        $touristicAttractionCategory->getTouristicAttractionCategoryActivities($input,$touristicAttractionCategory);

    }
}
