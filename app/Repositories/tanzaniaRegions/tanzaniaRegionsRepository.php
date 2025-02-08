<?php

namespace App\Repositories\tanzaniaRegions;

use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tanzaniaRegionsRepository.
 */
class tanzaniaRegionsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tanzaniaRegions::class;
    }
    public function storeTanzaniaRegion($input)
    {
        $tanzaniaRegion=new tanzaniaRegions();
        $tanzaniaRegion->region_name=$input['region_name'];
        $tanzaniaRegion->economic_activity=$input['economic_activity'];
        $tanzaniaRegion->region_size=$input['region_size'];
        $tanzaniaRegion->population=$input['population'];
        $tanzaniaRegion->climatic_condition=$input['climatic_condition'];
        $tanzaniaRegion->transport_nature=$input['transport_nature'];
        $tanzaniaRegion->region_description=$input['region_description'];
        $tanzaniaRegion->region_map=$input['region_map'];
        $tanzaniaRegion->region_history=$input['region_history'];
        $tanzaniaRegion->nation_id=$input['nation_id'];
        if ($input['region_icon_image'] && is_array($input['region_icon_image']))
        {
            $imagePaths=[];
            foreach($input['region_icon_image'] as $image){
                $extension=$image->getClientOriginalExtension();
                $filename=time().'_'.uniqid().'.'.$extension;
                $image->move('public/regionDominantImage/',$filename);

                $imagePaths[]='/regionDominantImage/'.$filename;
            }
            $tanzaniaRegion->region_icon_image=implode(',',$imagePaths);
        }
        $tanzaniaRegion->save();
        $tanzaniaRegion->getRegionEconomicActivities($input,$tanzaniaRegion);
        $tanzaniaRegion->saveTanzaniaRegionPrecautions($input,$tanzaniaRegion);
    }
    public function updateTanzaniaRegion($input,$tanzaniaRegionUuid,$request)
    {
        $tanzaniaRegion=tanzaniaRegions::query()->where('uuid',$tanzaniaRegionUuid)->first();
        $tanzaniaRegion->region_name=$input['region_name'];
        $tanzaniaRegion->economic_activity=$input['economic_activity'];
        $tanzaniaRegion->region_size=$input['region_size'];
        $tanzaniaRegion->population=$input['population'];
        $tanzaniaRegion->climatic_condition=$input['climatic_condition'];
        $tanzaniaRegion->transport_nature=$input['transport_nature'];
        $tanzaniaRegion->region_map=$input['region_map'];
        $tanzaniaRegion->region_description=$input['region_description'];
        $tanzaniaRegion->region_history=$input['region_history'];
        $tanzaniaRegion->nation_id=$input['nation_id'];
        $input=$request->all();
        if ($request->hasFile('region_icon_image') && is_array($input['region_icon_image'])) {
            $imagePaths = [];

            foreach ($input['region_icon_image'] as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $image->move('public/regionDominantImage/', $filename);

                $imagePaths[] = '/regionDominantImage/' . $filename;
            }
            $tanzaniaRegion->region_icon_image = implode(',', $imagePaths);
        }
        $tanzaniaRegion->save();
        $tanzaniaRegion->getRegionEconomicActivities($input,$tanzaniaRegion);
        $tanzaniaRegion->updateTanzaniaRegionPrecautions($input,$tanzaniaRegion);
    }
}
