<?php

namespace App\Models\TourOperator\TourPackages\InternationalTourPackages;

use App\Models\Auth\User;
use App\Models\BaseModel\BaseModel;
use App\Models\specialNeed\specialNeed;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageAccommodations\tourPackageAccommodations;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageActivities\tourPackageActivities;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookings;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageFeatures\tourPackageFeatures;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageTrips\tourPackageTrips;
use App\Models\TourTypes\tourTypes;
use App\Models\Transport\transport;
use App\Repositories\TourOperatorPackages\InternationalTourPackages\TourPackageAccommodations\tourPackageAccommodationsRepository;
use App\Repositories\TourOperatorPackages\InternationalTourPackages\TourPackageActivities\tourPackageActivitiesRepository;
use App\Repositories\TourOperatorPackages\InternationalTourPackages\TourPackageFeaturesRepository\tourPackageFeaturesRepository;
use App\Repositories\TourOperatorPackages\InternationalTourPackages\TourPackageTrips\tourPackageTripsRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class TourPackages extends BaseModel
{
    use SoftDeletes;
    protected $table='tour_package';
    protected $guarded=['uuid'];

    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function tourPackageFeatures()
    {
        return $this->hasMany(tourPackageFeatures::class);
    }
    public function tourPackageActivities()
    {
        return $this->hasMany(tourPackageActivities::class);
    }
    public function tourPackageAccommodations()
    {
        return $this->hasMany(tourPackageAccommodations::class);
    }
    public function tourPackageTrips()
    {
        return $this->hasMany(tourPackageTrips::class);
    }

    public function tourPackageBookings()
    {
        return $this->hasMany(tourPackageBookings::class);
    }
    public function specialNeed()
    {
        return $this->belongsToMany(specialNeed::class,'tour_package_special_need','tour_package_id','special_need_id');
    }
    public function transport()
    {
        return $this->belongsToMany(transport::class,'tour_package_transport','tour_package_id','transport_id');
    }
    public function tourTypes()
    {
        return $this->belongsToMany(tourTypes::class,'tour_package_tour_type','tour_package_id','tour_type_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function getSafariPosterLabelAttribute()
    {
        return url('public/blogImages/'.$this->safari_poster);
    }

    public function saveTourPackageFeatures($input,$tourPackage)
    {
        $tourPackageFeaturesRepo=new tourPackageFeaturesRepository();
        $tourPackageFeatures=$tourPackageFeaturesRepo->storeTourpackageFeatures($input,$tourPackage);
        return redirect()->back()->with('tourPackageFeatures',$tourPackageFeatures);
    }
    public function saveTourPackageActivities($input, $tourPackage)
    {
        $tourPackageActivitiesRepo=new tourPackageActivitiesRepository();
        $tourPackageActivities=$tourPackageActivitiesRepo->storeTourPackageActivities($input,$tourPackage);
        return redirect()->back()->with('tourPackageActivities',$tourPackageActivities);
    }
    public function saveTourPackageAccommodations($input, $tourPackage)
    {
        $tourPackageAccommodationsRepo=new tourPackageAccommodationsRepository();
        $tourPackageAccommodations=$tourPackageAccommodationsRepo->storeTourPackageAccommodations($input, $tourPackage);
        return redirect()->back()->with('tourPackageAccommodations',$tourPackageAccommodations);
    }
    public function saveTourPackageTrips($input, $tourPackage)
    {
        $tourPackageTripsRepo=new tourPackageTripsRepository();
        $tourPackageTrips=$tourPackageTripsRepo->storeTourPackageTrips($input, $tourPackage);
        return redirect()->back()->with('tourPackageTrips',$tourPackageTrips);
    }

    public function getTourPackageSpecialNeedCategory(array $input,Model $tourPackage)
    {
        $tourPackageSpecialNeedCategoryArray=[];
        foreach ($input as $key => $value)
        {
            switch ($key)
            {
                case 'special_need':
                    $tourPackageSpecialNeedCategoryArray=$value;
                    break;
            }
        }
        $tourPackage->specialNeed()->sync($tourPackageSpecialNeedCategoryArray);
    }

    public function getTourPackageSpecialNeedCategoryLabelAttribute()
    {
        $tourPackageSpecialNeedId=DB::table('tour_package_special_need')->where('tour_package_id',$this->id)->pluck('special_need_id');
        $tourPackageSpecialNeeds=specialNeed::whereIn('id',$tourPackageSpecialNeedId)->get();
        $label=[];
        foreach ($tourPackageSpecialNeeds as $tourPackageSpecialNeed)
        {
            array_push($label,$tourPackageSpecialNeed->special_need_name);
        }
        return implode('-',$label);
    }


    public function getTourPackageTransport(array $input,Model $tourPackage)
    {
        $tourPackageTransportArray=[];
        foreach ($input as $key => $value)
        {
            switch ($key)
            {
                case 'safari_transport':
                    $tourPackageTransportArray=$value;
                    break;
            }
        }
        $tourPackage->transport()->sync($tourPackageTransportArray);
    }
    public function getTourPackageTransportLabelAttribute()
    {
        $tourPackageTransportId=DB::table('tour_package_transport')->where('tour_package_id',$this->id)->pluck('transport_id');
        $tourPackageTransports=transport::whereIn('id',$tourPackageTransportId)->get();
        $label=[];
        foreach ($tourPackageTransports as $tourPackageTransport)
        {
            array_push($label,$tourPackageTransport->transport_name);
        }
        return implode('-',$label);
    }

    public function getTourPackageTourType(array $input, Model $tourPackage)
    {
        $tourPackageTourTypeArray=[];
        foreach ($input as $key =>$value)
        {
            switch ($key)
            {
                case 'safari_tour_type':
                    $tourPackageTourTypeArray=$value;
                    break;
            }
        }
        $tourPackage->tourTypes()->sync($tourPackageTourTypeArray);
    }

    public function getTourPackagesTourTypesLabelAttribute()
    {
        $tourPackagesTourTypeId=DB::table('tour_package_tour_type')->where('tour_package_id',$this->id)->pluck('tour_type_id');
        $tourPackagesTourTypes=tourTypes::whereIn('id',$tourPackagesTourTypeId)->get();
        $label=[];
        foreach ($tourPackagesTourTypes as $tourPackagesTourType)
        {
            array_push($label,$tourPackagesTourType->tour_type_name);
        }
        return implode('-',$label);
    }

    public function getTourPackageStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-warning badge-lg">In Active</span>';
                break;
            case 1:
                return '<span class="badge badge-success badge-lg">Active</span>';
                break;
            default:
                return '<span class="badge badge-danger badge-lg">UnIdentified package</span>';
                break;
        }
    }
    public function getTourPackagesButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                <option value=''>Select</option>
                <option data-route='" . route('tourPackages.delete', $this->uuid) . "' value='1'>Delete</option>
                <option data-route='".route('tourPackages.show', $this->uuid)."' value='2'>View</option>
                <option data-route='" . route('tourPackageBookings.index', $this->uuid) . "' value='2'>Bookings</option>
                <option data-route='".route('tourPackages.edit', $this->uuid)."' value='2'>Edit</option>
               </select>";
    }
    public function getDeletedTourPackagesButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                    <option value=''>Select</option>
                    <option data-route='".route('tourPackages.showDeletedTourPackage', $this->uuid)."' value='3'>View</option>
                    <option data-route='".route('tourPackages.restoreInternationalDeletedTourPackages',$this->uuid)."' value='1'>Restore</option>
                    <option data-route='".route('tourPackages.forceDeleteInternationalTourPackages',$this->uuid)."' value='2'>Delete Completely</option>
                 </select>";
    }
    public function getExpiredTourPackagesButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                <option value=''>Select</option>
                <option data-route='".route('tourPackages.delete', $this->uuid)."' value='1'>Delete</option>
                <option data-route='".route('tourPackages.show', $this->uuid)."' value='2'>View</option>
                <option data-route='".route('tourPackageBookings.index', $this->uuid)."' value='2'>Bookings</option>
                <option data-route='".route('tourPackages.renew', $this->uuid)."' value='3'>Renew package</option>
                <option data-route='".route('tourPackages.edit', $this->uuid)."' value='2'>Edit</option>
                </select>";
    }
    public function getTotalTourPackageBookingsLabelAttribute()
    {
        $totalTourPackageBookings=tourPackageBookings::query()->where('tour_package_id',$this->id)->count();
        return $totalTourPackageBookings;
    }
    public function getApprovedTourPackageBookingsLabelAttribute()
    {
        $approvedTourPackageBookings=tourPackageBookings::query()->where('tour_package_id',$this->id)->where('status','=','1')->count();
        return $approvedTourPackageBookings;
    }
    public function getUnApprovedTourPackageBookingsLabelAttribute()
    {
        $unApprovedTourPackageBookings=tourPackageBookings::query()->where('tour_package_id',$this->id)->where('status','=',0)->count();
        return $unApprovedTourPackageBookings;
    }
    public function getDeletedTourBookingsLabelAttribute()
    {
        $deletedTourBookings=tourPackageBookings::onlyTrashed()->where('tour_package_id',$this->id)->count();
        return $deletedTourBookings;
    }

    public function getCountDownDaysForTourPackageTripLabelAttribute()
    {
        $tourPackage=TourPackages::find($this->id);
        $today=Carbon::now();
        $startDate=$tourPackage->safari_start_date;
        $dateTime1=new \DateTime($today);
        $dateTime2=new \DateTime($startDate);
        $interval=$dateTime2->diff($dateTime1);
        return $interval->format('%R%d');
    }
    public function getCountDownDaysForDeletedTourPackageTripLabelAttribute()
    {
        $tourPackage=TourPackages::onlyTrashed()->find($this->id);
        $today=Carbon::now();
        $startDate=$tourPackage->safari_start_date;
        $dateTime1=new \DateTime($today);
        $dateTime2=new \DateTime($startDate);
        $interval=$dateTime1->diff($dateTime2);
        return $interval->format('%R%d');
    }
}
