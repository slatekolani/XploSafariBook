<?php

namespace App\Repositories\Admin\Nations;

use App\Models\Nations\nations;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class nationsRepository.
 */
class nationsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return nations::class;
    }
    public function storenation(array $input)
    {
        $nation=new nations();
        $nation->nation_name=$input['nation_name'];
        $nation->nation_description=$input['nation_description'];
        $nation->nation_history=$input['nation_history'];
        $nation->population=$input['population'];
        $nation->google_map=$input['google_map'];
        if($input['nation_flag'])
        {
            $file=$input['nation_flag'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/nationFlags/',$filename);
            $nation->nation_flag=$filename;
        }
        if($input['tourist_map'])
        {
            $file=$input['tourist_map'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/touristMap/',$filename);
            $nation->tourist_map=$filename;
        }
        $nation->save();
        $nation->saveNationEconomicActivities($input,$nation);
        $nation->saveNationPrecautions($input,$nation);
    }
    public function updateNation(array $input, $nation, $request)
    {
        $nation=nations::query()->where('uuid',$nation)->first();
        $nation->nation_name=$input['nation_name'];
        $nation->nation_description=$input['nation_description'];
        $nation->nation_history=$input['nation_history'];
        $nation->population=$input['population'];
        $nation->google_map=$input['google_map'];
        $input = $request->all();
        if ($request->hasFile('nation_flag') && $input['nation_flag'] !== null) {
            $file = $input['nation_flag'];
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/nationFlags/', $filename);
            $nation->nation_flag = $filename;
        }

        if($request->hasFile('tourist_map') && $input['tourist_map'] !==null)
        {
            $file=$input['tourist_map'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/touristMap/',$filename);
            $nation->tourist_map=$filename;
        }

        $nation->save();
        $nation->updateNationEconomicActivities($input,$nation);
        $nation->updateNationPrecautions($input,$nation);
    }
}
