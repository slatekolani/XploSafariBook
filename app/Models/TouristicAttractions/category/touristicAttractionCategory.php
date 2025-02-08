<?php

namespace App\Models\TouristicAttractions\category;

use App\Models\BaseModel\BaseModel;
use App\Models\touristicActivities\touristicActivities;
use App\Models\TouristicAttractions\touristicAttractions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class touristicAttractionCategory extends BaseModel
{
    protected $table='touristic_attraction_category';
    protected $guarded=['uuid'];

    public function touristicAttractionCategoryActivities()
    {
        return $this->belongsToMany(touristicAttractionCategory::class,'category_activities','touristic_attraction_category_id','touristic_activities_id');
    }
    public function getButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('touristicAttractionCategory.view',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('touristicAttractionCategory.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('touristicAttractionCategory.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }

    public function getTouristicAttractionCategoryActivities(array $input, Model $touristicAttractionCategory)
    {
        $touristicAttractionCategoryActivitiesArray=[];
        foreach($input as $key =>$value)
        {
            switch($key)
            {
                case 'attraction_category_touristic_activities':
                    $touristicAttractionCategoryActivitiesArray=$value;
                    break;
            }
        }
        $touristicAttractionCategory->touristicAttractionCategoryActivities()->sync($touristicAttractionCategoryActivitiesArray);
    }

    public function getTouristicAttractionCategoryActivitiesLabelAttribute()
    {
        $touristicAttractionCategoryActivitiesIds=DB::table('category_activities')->where('touristic_attraction_category_id',$this->id)->pluck('touristic_activities_id');
        $categoryTouristicActivities=touristicActivities::whereIn('id',$touristicAttractionCategoryActivitiesIds)->get();
        $categoryActivities=[];
        foreach($categoryTouristicActivities as $categoryTouristicActivity)
        {
            $categoryActivities[]=[
                'name'=>$categoryTouristicActivity->activity_name,
                'description'=>$categoryTouristicActivity->activity_description,
                'uuid'=>$categoryTouristicActivity->uuid,
            ];
        }
        return $categoryActivities;
    }
}
