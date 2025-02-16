<?php

namespace App\Models\TourOperator\TourPackages\LocalTourPackages;

use App\Models\BaseModel\BaseModel;
use App\Models\customerSatisfactionCategory\customerSatisfactionCategory;
use App\Models\specialNeed\specialNeed;
use App\Models\tanzaniaAndWorldEvents\tanzaniaAndWorldEvents;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageActivities\localTourPackageActivities;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTouristReviews\localTouristReviews;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageCollectionStops\localTourPackageCollectionStops;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourpackagePriceExclusive\localTourPackagePriceExclusive;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackagePriceInclusive\localTourPackagePriceInclusives;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackageRequirement\localTourPackageRequirements;
use app\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackageTripHierachy\localTourPackageTripHierachy;
use App\Models\TourOperator\TourPackages\LocalTourPackages\TotalViews\localTourPackageTotalViews;
use App\Models\tourPackageType\tourPackageType;
use App\Models\TourTypes\tourTypes;
use App\Models\Transport\transport;
use App\Repositories\TourOperatorPackages\LocalTourPackages\LocalTourPackageCollectionStops\localTourPackageCollectionStopsRepository;
use App\Repositories\TourOperatorPackages\LocalTourPackages\LocalTourPackagePriceExclusive\localTourPackagePriceExclusiveRepository;
use App\Repositories\TourOperatorPackages\LocalTourPackages\LocalTourPackagePriceInclusive\localTourPackagePriceInclusivesRepository;
use App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackageRequirement\localTourPackageRequirementsRepository;
use App\Repositories\TourOperatorPackages\LocalTourPackages\LocalTourPackagesActivities\localTourPackageActivitiesRepository;
use App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackageTripHierachy\localTourPackageTripHierachyRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class localTourPackages extends BaseModel
{
    use SoftDeletes;
    protected $table='local_tour_package';
    protected $guarded=['uuid'];

    public function tourType()
    {
        return $this->belongsTo(tourTypes::class,'local_tour_type');
    }

    public function localTourPackageTripHierachy()
    {
        return $this->hasMany(localTourPackageTripHierachy::class);
    }
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class,'tour_operator_id');
    }
    public function localTourPackageTotalViews()
    {
        return $this->hasMany(localTourPackageTotalViews::class);
    }
    public function tanzaniaAndWorldEvent()
    {
        return $this->belongsTo(tanzaniaAndWorldEvents::class,'targeted_event');
    }
    public function touristicAttraction()
    {
        return $this->belongsTo(touristicAttractions::class,'safari_name');
    }
    public function tourPackageType()
    {
        return $this->belongsTo(tourPackageType::class,'tour_package_type_name');
    }
    public function localTouristReviews()
    {
        return $this->hasMany(localTouristReviews::class,'local_tour_package_id');
    }
    public function localTourPackageBookings()
    {
        return $this->hasMany(localTourPackageBookings::class,'id','local_tour_package_id');
    }
    public function localTourPackageRequirements()
    {
        return $this->hasMany(localTourPackageRequirements::class,'local_tour_package_id');
    }
    public function localTourPackagePriceInclusives()
    {
        return $this->hasMany(localTourPackagePriceInclusives::class,'local_tour_package_id');
    }
    public function localTourPackagePriceExclusive()
    {
        return $this->hasMany(localTourPackagePriceExclusive::class,'local_tour_package_id');
    }
    public function specialNeed()
    {
        return $this->belongsToMany(specialNeed::class,'local_package_special_need','local_tour_package_id','special_need_id')->withTimestamps();
    }
    public function transport()
    {
        return $this->belongsToMany(transport::class,'local_package_transport','local_tour_package_id','transport_id')->withTimestamps();
    }

    public function localTourPackageReservations()
    {
        return $this->belongsToMany(tourOperatorReservation::class,'local_package_reservation','local_tour_package_id','tour_operator_reservation_id')->withTimestamps();
    }
    public function customerSatisfactionCategory()
    {
        return $this->belongsToMany(customerSatisfactionCategory::class,'package_customer_satisfaction','local_tour_package_id','customer_satisfaction_id')->withTimestamps();
    }
    public function localTourPackageActivities()
    {
        return $this->hasMany(localTourPackageActivities::class,'local_tour_package_id');
    }
    public function localTourPackageCollectionStops()
    {
        return $this->hasMany(localTourPackageCollectionStops::class,'local_tour_package_id');
    }
    public function getLocalTourPackageSpecialNeeds(array $input, Model $localTourPackage)
    {
        $localTourPackageSpecialNeedArray=[];
        foreach ($input as $key => $value)
        {
            switch ($key)
            {
                case 'local_safari_special_need':
                    $localTourPackageSpecialNeedArray=$value;
                    break;
            }
        }
        $localTourPackage->specialNeed()->sync($localTourPackageSpecialNeedArray);
    }
    public function getLocalTourPackageSpecialNeedsLabelAttribute()
    {
        $localTourPackageSpecialNeedIds=DB::table('local_package_special_need')->where('local_tour_package_id',$this->id)->pluck('special_need_id');
        $localTourPackageSpecialNeeds=specialNeed::whereIn('id',$localTourPackageSpecialNeedIds)->get();
        $specialNeeds=[];
        foreach ($localTourPackageSpecialNeeds as $localTourPackageSpecialNeed)
        {
            $specialNeeds[]=
            [
                'special_need_name'=>$localTourPackageSpecialNeed->special_need_name,
                'special_need_icon'=>$localTourPackageSpecialNeed->special_need_icon,
            ];
        }
        return $specialNeeds;
    }
    public function getLocalTourPackageTransport(array $input, Model $localTourPackage)
    {
        $localTourPackageTransportArray=[];
        foreach ($input as $key => $value)
        {
            switch ($key)
            {
                case 'local_safari_transport':
                    $localTourPackageTransportArray=$value;
                    break;
            }
        }
        $localTourPackage->transport()->sync($localTourPackageTransportArray);
    }
    public function getLocalTourPackageTransportsLabelAttribute()
    {
     $localTourPackageTransportIds=DB::table('local_package_transport')->where('local_tour_package_id',$this->id)->pluck('transport_id');
     $localTourPackageTransports=transport::whereIn('id',$localTourPackageTransportIds)->get();
     $transports=[];
     foreach($localTourPackageTransports as $localTourPackageTransport)
     {
        $transports[]=[
            'transport_icon'=>$localTourPackageTransport->transport_icon,
            'transport_name'=>$localTourPackageTransport->transport_name,
        ];
     }
     return $transports;
    }
    public function getLocalTourPackageCustomerSatisfaction(array $input,Model $localTourPackage)
    {
        $localTourPackageCustomerSatisfactionArray=[];
        foreach($input as $key =>$value)
        {
            switch ($key)
            {
                case 'customer_satisfaction':
                    $localTourPackageCustomerSatisfactionArray=$value;
                    break;
            }
        }
        $localTourPackage->customerSatisfactionCategory()->sync($localTourPackageCustomerSatisfactionArray);
    }
    public function getLocalTourPackageCustomerSatisfactionLabelAttribute()
    {
        $localTourPackageCustomerSatisfactionIds=DB::table('package_customer_satisfaction')->where('local_tour_package_id',$this->id)->pluck('customer_satisfaction_id');
        $localTourPackageCustomerSatisfactions=customerSatisfactionCategory::whereIn('id',$localTourPackageCustomerSatisfactionIds)->get();
        $customerSatisfactions=[];
        foreach($localTourPackageCustomerSatisfactions as $localTourPackageCustomerSatisfaction)
        {
            $customerSatisfactions[]=
            [
                'customer_satisfaction_name'=>$localTourPackageCustomerSatisfaction->customer_satisfaction_name,
                'customer_satisfaction_description'=>$localTourPackageCustomerSatisfaction->customer_satisfaction_description,
            ];
        }
        return $customerSatisfactions;
    }
    public function getLocalTourPackageReservations(array $input, Model $localTourPackage)
    {
        $localTourPackageReservationsArray=[];
        foreach($input as $key =>$value)
        {
            switch ($key)
            {
                case 'reservation_used':
                    $localTourPackageReservationsArray=$value;
                    break;
            }
        }
        $localTourPackage->localTourPackageReservations()->sync($localTourPackageReservationsArray);
    }
    public function getLocalTourPackageReservationsLabelAttribute()
    {
        $localTourPackageReservationIds=DB::table('local_package_reservation')->where('local_tour_package_id',$this->id)->pluck('tour_operator_reservation_id');
        $localTourPackageReservations=tourOperatorReservation::whereIn('id',$localTourPackageReservationIds)->get();
        $reservations=[];
        foreach($localTourPackageReservations as $localTourPackageReservation)
        {
            $reservations[]=
            [
                'reservation_name'=>$localTourPackageReservation->reservation_name,
                'reservation_capacity'=>$localTourPackageReservation->reservation_capacity,
                'reservation_url'=>$localTourPackageReservation->reservation_url,
            ];
        }
        return $reservations;
    }
    public function saveLocalTourPackageActivities($input,$localTourPackage)
    {
        $localTourPackageActivitiesRepo=new localTourPackageActivitiesRepository();
        $localTourPackageActivities=$localTourPackageActivitiesRepo->storeLocalTourPackageActivities($input,$localTourPackage);
        return back()->with('localTourPackageActivities',$localTourPackageActivities);
    }
    public function updateLocalTourPackageActivities($input,$localTourPackage)
    {
        $localTourPackageActivitiesRepo=new localTourPackageActivitiesRepository();
        $localTourPackageActivities=$localTourPackageActivitiesRepo->updateLocalTourPackageActivities($input,$localTourPackage);
        return back()->with('localTourPackageActivities',$localTourPackageActivities);
    }
    public function saveLocalTourPackagePriceInclusives($input,$localTourPackage)
    {
        $localTourPackagePriceinclusivesRepo=new localTourPackagePriceInclusivesRepository();
        $localTourPackagePriceinclusives=$localTourPackagePriceinclusivesRepo->storeLocalTourPackagePriceInclusive($input,$localTourPackage);
        return back()->with('localTourPackagePriceInclusives',$localTourPackagePriceinclusives);
    }
    public function updateLocalTourPackagePriceInclusives($input,$localTourPackage)
    {
        $localTourPackagePriceinclusivesRepo=new localTourPackagePriceInclusivesRepository();
        $localTourPackagePriceinclusives=$localTourPackagePriceinclusivesRepo->updateLocalTourPackagePriceInclusives($input,$localTourPackage);
        return back()->with('localTourPackagePriceInclusives',$localTourPackagePriceinclusives);
    }
    public function saveLocalTourPackagePriceExclusives($input, $localTourPackage)
    {
        $localTourPackagePriceExclusiveRepo=new localTourPackagePriceExclusiveRepository();
        $localTourPackagePriceExclusive=$localTourPackagePriceExclusiveRepo->storeLocalTourPackagePriceExclusive($input,$localTourPackage);
        return back()->with('localTourPackagePriceExclusive',$localTourPackagePriceExclusive);
    }
    public function updateLocalTourPackagePriceExclusives($input,$localTourPackage)
    {
        $localTourPackagePriceExclusiveRepo=new localTourPackagePriceExclusiveRepository();
        $localTourPackagePriceExclusive=$localTourPackagePriceExclusiveRepo->updateLocalTourPackagePriceExclusives($input,$localTourPackage);
        return back()->with('localTourPackagePriceExclusive',$localTourPackagePriceExclusive);
    }
    public function saveLocalTourPackageCollectionStops($input,$localTourPackage)
    {
        $localTourPackageCollectionStopsRepo=new localTourPackageCollectionStopsRepository();
        $localTourPackageCollectionStops=$localTourPackageCollectionStopsRepo->storeLocalTourPackageCollectionStops($input,$localTourPackage);
        return back()->with('localTourPackageCollectionStops',$localTourPackageCollectionStops);
    }
    public function updateLocalTourPackageCollectionStops($input,$localTourPackage)
    {
        $localTourPackageCollectionStopsRepo=new localTourPackageCollectionStopsRepository();
        $localTourPackageCollectionStops=$localTourPackageCollectionStopsRepo->updateLocalTourPackageCollectionStops($input,$localTourPackage);
        return back()->with('localTourPackageCollectionStops',$localTourPackageCollectionStops);
    }
    public function saveLocalTourPackageRequirements($input,$localTourPackage)
    {
        $localTourPackageRequirementsRepo=new localTourPackageRequirementsRepository();
        $localTourPackageRequirements=$localTourPackageRequirementsRepo->storeLocalTourPackageRequirements($input,$localTourPackage);
        return back()->with('localTourPackageRequirements',$localTourPackageRequirements);
    }

    public function saveLocalTourPackageTripHierachies($input,$localTourPackage)
    {
        $localTourPackageTripHierachyRepo=new localTourPackageTripHierachyRepository();
        $localTourPackageTripHierachy=$localTourPackageTripHierachyRepo->storeLocalTourPackageTripHierachies($input,$localTourPackage);
        return back()->with('localTourPackageTripHierachy',$localTourPackageTripHierachy);
    }

    public function updateLocalTourPackageRequirements($input,$localTourPackage)
    {
        $localTourPackageRequirementsRepo=new localTourPackageRequirementsRepository();
        $localTourPackageRequirements=$localTourPackageRequirementsRepo->updateLocalTourPackageRequirements($input,$localTourPackage);
        return back()->with('localTourPackageRequirements',$localTourPackageRequirements);
    }
    public function updateLocalTourPackageTripHierarchies($input,$localTourPackage)
    {
        $localTourPackageTripHierachyRepo=new localTourPackageTripHierachyRepository();
        $localTourPackageTripHierachy=$localTourPackageTripHierachyRepo->updateLocalTourPackageTripHierarchies($input,$localTourPackage);
        return back()->with('localTourPackageTripHierachy',$localTourPackageTripHierachy);
    }
    public function getLocalTourPackageStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-danger">Inactive</span>';
                break;
            case 1:
                if($this->safari_start_date <= Carbon::now())
                {
                    return '<span class="badge badge-danger">Expired</span>';
                }
                else{
                    return '<span class="badge badge-success">Active</span>';
                }
                
                break;
            default:
                return '<span class="badge badge-danger">Inactive</span>';
                break;
        }
    }
    public function getExpiredLocalTourPackageStatusLabelAttribute()
    {
        return '<span class="badge badge-danger">Expired</span>';
    }
    public function getDeletedLocalTourPackageStatusLabelAttribute()
    {
       return '<span class="badge badge-danger">Deleted</span>';
    }
    public function getLocalTourPackagesButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                    <option value=''>Select</option>
                    <option data-route='".route('localTourPackages.view',$this->uuid)."' value='2'>View</option>
                    <option data-route='".route('localTourPackages.edit',$this->uuid)."' value='2'>Edit</option>
                    <option data-route='".route('localTourBooking.index',$this->uuid)."' value='2'>Bookings</option>
                    <option data-route='".route('localTourPackages.delete',$this->uuid)."' value='1'>Delete</option>
                    <option data-route='".route('localTourPackages.replicateTourPackage',$this->uuid)."' value='3'>Duplicate</option>
                 </select>";
    }
    public function getDeletedLocalPackagesButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                    <option value=''>&check;Select</option>
                    <option data-route='".route('localTourPackages.viewDeleted',$this->uuid)."' value='3'>View</option>
                    <option data-route='".route('localTourPackages.restore',$this->uuid)."' value='1'>Restore</option>
                    <option data-route='".route('localTourPackages.forceDeleteLocalPackage',$this->uuid)."' value='2'>Delete permanently</option>
                 </select>";
    }
    public function getExpiredLocalTourPackagesButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                    <option value=''>&check;Select</option>
                    <option data-route='".route('localTourPackages.view',$this->uuid)."' value='2'>View</option>
                    <option data-route='".route('localTourPackages.replicateExpiredTour',$this->uuid)."' value='1'>Re-use the package</option>
                    <option data-route='".route('localTourPackages.forceDeleteLocalPackage',$this->uuid)."' value='3'>Delete permanently</option>
                </select>";
    }

    public function getCountDownDaysForLocalTourPackageTripLabelAttribute()
    {
        $startDate = Carbon::parse($this->safari_start_date);
        $today = Carbon::now();
        $daysLeft = $startDate->diffInDays($today);
        $sign = ($startDate > $today) ? '-' : '';
        $formattedDaysLeft = $sign . abs($daysLeft);
        if($formattedDaysLeft<0)
        {
            return '<span class="badge badge-primary">'.$formattedDaysLeft. ' days'.'</span>';
        }
        else
        {
            return '<span class="badge badge-danger">'.$formattedDaysLeft. ' days old'.'</span>';
        }
    }

    public function getCountDownDaysForLocalTourPackagePaymentLabelAttribute()
    {
        $paymentDeadline = Carbon::parse($this->payment_deadline);
        $today = Carbon::now();
        $daysLeft = $paymentDeadline->diffInDays($today);
        $sign = ($paymentDeadline > $today) ? '-' : '';
        $formattedDaysLeft = $sign . abs($daysLeft);
        if($formattedDaysLeft<0)
        {
            return '<span class="badge badge-warning">'.$formattedDaysLeft. ' days'.'</span>';
        }
        else
        {
            return '<span class="badge badge-danger">'.$formattedDaysLeft. ' days old'.'</span>';
        }
    }

    public function getCountDownDaysForDeletedLocalTourPackageTripLabelAttribute()
    {
        $localTourPackage = localTourPackages::onlyTrashed()->find($this->id);
        if (!$localTourPackage)
        {
            return null;
        }
        $today = Carbon::now();
        $startDate = Carbon::parse($localTourPackage->safari_start_date);
        return $today->diffInDays($startDate, false);
    }

    public function getNumberOfTourSpacesLeftLabelAttribute()
    {
        $localTourPackage=localTourPackages::find($this->id);
        $localTourPackageMaximumTraveller=$localTourPackage->maximum_travellers;
        return $localTourPackageMaximumTraveller;
    }
    public function getNumberOfBookedSpacesLabelAttribute()
    {
        $localTourPackage=localTourPackages::find($this->id);
        $localTourBookings=localTourPackageBookings::query()->where('local_tour_package_id',$localTourPackage->id)->get();
        $totalResidentsChildren=$localTourBookings->sum('total_number_local_child');
        $totalResidentsAdults=$localTourBookings->sum('total_number_local_adult');
        $totalForeignerChildren=$localTourBookings->sum('total_number_foreigner_child');
        $totalForeignerAdult=$localTourBookings->sum('total_number_foreigner_adult');
        $totalBookingsMade=($totalForeignerAdult + $totalForeignerChildren + $totalResidentsAdults + $totalResidentsChildren);
        return $totalBookingsMade;
    }
    public function getTotalSpacesRemainedLabelAttribute()
    {
        $maximumTravellers=$this->getNumberOfTourSpacesLeftLabelAttribute();
        $bookedSpaces=$this->getNumberOfBookedSpacesLabelAttribute();
        $seatsLeft=$maximumTravellers-$bookedSpaces;
        return $seatsLeft;
    }
    public function getTotalLocalTourBookingsLabelAttribute()
    {
        $totalLocalBookings=localTourPackageBookings::query()->where('local_tour_package_id',$this->id)->count();
        return $totalLocalBookings;
    }
    public function getTotalLocalApprovedTourBookingsLabelAttribute()
    {
        $totalApprovedLocalTourBookings=localTourPackageBookings::query()->where('local_tour_package_id',$this->id)->where('status','=',1)->count();
        return $totalApprovedLocalTourBookings;
    }
    public function getTotalLocalUnapprovedTourBookingsLabelAttribute()
    {
        $totalUnapprovedLocalTourBookings=localTourPackageBookings::query()->where('local_tour_package_id',$this->id)->where('status','=',0)->count();
        return $totalUnapprovedLocalTourBookings;
    }
    public function getTotalDeletedLocalTourBookingLabelAttribute()
    {
        $totalDeletedLocalTourBookings=localTourPackageBookings::onlyTrashed()->where('local_tour_package_id',$this->id)->count();
        return $totalDeletedLocalTourBookings;
    }
    public function getsafariUrgencyStatusLabelAttribute()
    {
        $safariStartDate = Carbon::parse($this->safari_start_date);
        $todayDate = Carbon::now();
        $daysUntilStart = $todayDate->diffInDays($safariStartDate);

        if ($daysUntilStart <= 3)
        {
            return '<span class="badge badge-danger">Critical</span>';
        }
        else if ($daysUntilStart <= 10)
        {
            return '<span class="badge badge-warning">High Priority</span>';
        }
        else if ($daysUntilStart <= 30)
        {
            return '<span class="badge badge-info">Medium Priority</span>';
        }
        else
        {
            return '<span class="badge badge-success">Low Priority</span>';
        }
    }

}
