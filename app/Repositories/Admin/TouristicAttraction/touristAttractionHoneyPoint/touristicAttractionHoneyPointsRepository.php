<?php

namespace App\Repositories\Admin\TouristicAttraction\touristAttractionHoneyPoint;

use App\Models\TouristicAttractions\touristicAttractionHoneyPoint\touristicAttractionHoneyPoints;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class touristicAttractionHoneyPointsRepository.
 */
class touristicAttractionHoneyPointsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristicAttractionHoneyPoints::class;
    }
    public function storeTouristicAttractionHoneyPoints($input)
    {
        $honeyPoint=new touristicAttractionHoneyPoints();
        $honeyPoint->honey_point_name=$input['honey_point_name'];
        $honeyPoint->honey_point_description=$input['honey_point_description'];
        $honeyPoint->touristic_attraction_id=$input['touristic_attraction_id'];
        if ($input['honey_point_image'])
        {
            $file=$input['honey_point_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/honeyPointImage/',$filename);
            $honeyPoint->honey_point_image=$filename;
        }
        $honeyPoint->save();
    }
    public function updateTouristicAttractionHoneyPoint($input,$honeyPointUuid,$request)
    {
        $honeyPoint=touristicAttractionHoneyPoints::query()->where('uuid',$honeyPointUuid)->first();
        $honeyPoint->honey_point_name=$input['honey_point_name'];
        $honeyPoint->honey_point_description=$input['honey_point_description'];
        $honeyPoint->touristic_attraction_id=$input['touristic_attraction_id'];
        $input=$request->all();
        if ($request->hasFile('honey_point_image') && $input['honey_point_image'] !==false)
        {
            $file=$input['honey_point_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/honeyPointImage/',$filename);
            $honeyPoint->honey_point_image=$filename;
        }
        $honeyPoint->save();
    }
}
