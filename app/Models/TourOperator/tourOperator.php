<?php

namespace App\Models\TourOperator;

use App\Models\Auth\User;
use App\Models\BaseModel\BaseModel;
use App\Models\Nations\nations;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\tourInsuranceTypes\tourInsuranceTypes;
use App\Models\touristicActivities\touristicActivities;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\customTourBookings\customTourBookings;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\TourCompanyLocalToursGoals\packageSegmentation\localTourGoalsPackageSegmentation;
use App\Models\TourOperator\TourCompanyLocalToursGoals\projectedRevenue\localTourGoalsProjectedRevenue;
use App\Models\TourOperator\TourCompanyLocalToursGoals\tourCompanyLocalToursGoals;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageAccommodations\tourPackageAccommodations;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageActivities\tourPackageActivities;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookings;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageFeatures\tourPackageFeatures;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageTrips\tourPackageTrips;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageActivities\localTourPackageActivities;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTouristReviews\localTouristReviews;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageCollectionStops\localTourPackageCollectionStops;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourpackagePriceExclusive\localTourPackagePriceExclusive;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackagePriceInclusive\localTourPackagePriceInclusives;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackageRequirement\localTourPackageRequirements;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class tourOperator extends BaseModel
{
    use SoftDeletes;
    protected $table = 'tour_operator';
    protected $guarded = ['uuid'];
    protected $dates = ['deleted_at'];

    public function localTourGoalsPackageSegmentation()
    {
        return $this->hasMany(localTourGoalsPackageSegmentation::class); 
    }
    public function localTourGoalsProjectedRevenue()
    {
        return $this->hasMany(localTourGoalsProjectedRevenue::class);
    }
    public function tourCompanyLocalToursGoals()
    {
        return $this->hasMany(tourCompanyLocalToursGoals::class);
    }
    public function nation()
    {
        return $this->belongsTo(nations::class, 'company_nation');
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function localTouristReviews()
    {
        return $this->hasMany(localTouristReviews::class);
    }
    public function tourOperatorReservation()
    {
        return $this->hasMany(tourOperatorReservation::class);
    }
    public function customTourBookings()
    {
        return $this->hasMany(customTourBookings::class);
    }
    public function localTourPackageRequirements()
    {
        return $this->hasMany(localTourPackageRequirements::class);
    }

    public function localTourPackageBookings()
    {
        return $this->hasMany(localTourPackageBookings::class);
    }
    public function localTourPackageActivities()
    {
        return $this->hasMany(localTourPackageActivities::class);
    }
    public function localTourPackagePriceInclusives()
    {
        return $this->hasMany(localTourPackagePriceInclusives::class);
    }
    public function localTourPackagePriceExclusive()
    {
        return $this->hasMany(localTourPackagePriceExclusive::class);
    }
    public function TourPackages()
    {
        return $this->hasMany(TourPackages::class);
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
    public function localTourPackages()
    {
        return $this->hasMany(localTourPackages::class);
    }

    public function localTourPackageCollectionStops()
    {
        return $this->hasMany(localTourPackageCollectionStops::class);
    }
    public function tourOperatorSafariAreaPreferences()
    {
        return $this->belongsToMany(tourOperator::class, 'operator_touristic_attraction', 'tour_operator_id', 'touristic_attraction_id')->withTimestamps();
    }
    public function tourOperatorRegionsOfOperations()
    {
        return $this->belongsToMany(tourOperator::class, 'operator_tanzania_region', 'tour_operator_id', 'tanzania_region_id')->withTimestamps();
    }

    public function tourOperatorTourInsuranceTypes()
    {
        return $this->belongsToMany(tourOperator::class, 'operator_insurance_type', 'tour_operator_id', 'tour_insurance_type_id')->withTimestamps();
    }

    public function tourOperatorTouristicActivities()
    {
        return $this->belongsToMany(tourOperator::class, 'company_touristic_activities','tour_operator_id','touristic_activities_id')->withTimestamps();
    }

    public function getCompanyLogoLabelAttribute()
    {
        return url('public/TourOperatorsLogos/' . $this->company_logo);
    }
    public function getTourCompanyStatusLabelAttribute()
    {
        $status = $this->status;
        switch ($status) {
            case 0:
                return '<span class="badge badge-warning">Inactive</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Active</span>';
                break;
        }
    }
    public function getTourCompanyButtonActionsLabelAttribute()
    {
        $status = $this->status;
        switch ($status) {
            case 0:
                return "<select name='action' class='action_select'>
                            <option value=''>Select</option>
                            <option data-route='" . route('tourOperator.show', $this->uuid) . "' value='2'>View</option>
                            <option data-route='" . route('tourOperator.edit', $this->uuid) . "' value='2'>Edit</option>
                            <option data-route='" . route('tourOperator.delete', $this->uuid) . "' value='1'>Delete</option>
                        </select>";
                break;
            case 1:
                $options = "<select name='action' class='action_select'>
                <option value=''>Select</option>
                <option data-route='" . route('tourOperator.show', $this->uuid) . "' value='2'>View</option>
                <option data-route='" . route('tourOperator.edit', $this->uuid) . "' value='2'>Edit</option>
                <option data-route='" . route('tourCompanyLocalToursGoals.index', $this->uuid) . "' value='2'>Company Analytics</option>
                <option data-route='" . route('tourOperatorReservation.index', $this->uuid) . "' value='2'>Reservations</option>";
            
            if ($this->agreeCustomBooking == "Yes") {
                $options .= "<option data-route='" . route('customTourBookings.index', $this->uuid) . "' value='2'>Custom tour bookings</option>";
            }
            
            if ($this->safariClass == "bothLocalAndInternationalTours") {
                $options .= "<option data-route='" . route('tourPackages.index', $this->uuid) . "' value='2'>International tour packages</option>
                             <option data-route='" . route('localTourPackages.index', $this->uuid) . "' value='2'>Local tour packages</option>";
            } elseif ($this->safariClass == "internationalTours") {
                $options .= "<option data-route='" . route('tourPackages.index', $this->uuid) . "' value='2'>International tour packages</option>";
            } elseif ($this->safariClass == "localTours") {
                $options .= "<option data-route='" . route('localTourPackages.index', $this->uuid) . "' value='2'>Local tour packages</option>";
            }
            
            $options .= "<option data-route='" . route('tourOperator.delete', $this->uuid) . "' value='1'>Delete</option>
            </select>";
            
            return $options;
            
        }
    }
    public function getButtonActionsForDeletedTourCompaniesLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                    <option value=''>Select</option>
                    <option data-route='" . route('tourOperator.showDeletedTourCompany', $this->uuid) . "' value='3'>View</option>
                    <option data-route='" . route('tourOperator.restoreDeletedTourCompany', $this->uuid) . "' value='1'>Restore</option>
                    <option data-route='" . route('tourOperator.forceDeleteTourCompany', $this->uuid) . "' value='2'>Delete completely</option>
                </select>";
    }

    public function getTourCompanyButtonActionsAsAdminLabelAttribute()
    {
        $status = $this->status;
        switch ($status) {
            case 0:
                $btn = '<a href="' . route('tourOperator.delete', $this->uuid) . '" class="btn btn-danger btn-sm">Delete</a>';
                return $btn;
                break;
            case 1:
                $btn = '<a href="' . route('tourOperator.delete', $this->uuid) . '" class="btn btn-danger btn-sm">Delete</a>';
                $btn = $btn . '<a href="' . route('tourPackages.index', $this->uuid) . '" class="btn btn-primary btn-sm">Tour Packages</a>';
                $btn = $btn . '<a href="' . route('customTourBookings.index', $this->uuid) . '" class="btn btn-primary btn-sm">Custom Bookings</a>';
                return $btn;
                break;
        }
    }
    public function getTourOperatorSafariAreaPreferences(array $input, Model $tourOperatorCompany)
    {
        $tourOperatorSafariAreaPreferencesArray = [];
        foreach ($input as $key => $value) {
            switch ($key) {
                case 'safari_area_preferences':
                    $tourOperatorSafariAreaPreferencesArray = $value;
                    break;
            }
        }
        $tourOperatorCompany->tourOperatorSafariAreaPreferences()->sync($tourOperatorSafariAreaPreferencesArray);
    }
    public function getTourOperatorRegionsOfOperations(array $input, Model $tourOperatorCompany)
    {
        $tourOperatorRegionsOfOperationsArray = [];
        foreach ($input as $key => $value) {
            switch ($key) {
                case 'regions_of_operation':
                    $tourOperatorRegionsOfOperationsArray = $value;
                    break;
            }
        }
        $tourOperatorCompany->tourOperatorRegionsOfOperations()->sync($tourOperatorRegionsOfOperationsArray);
    }
    public function getTourOperatorTourInsuranceTypes(array $input, Model $tourOperatorCompany)
    {
        $tourOperatorTourInsuranceTypesArray = [];
        foreach ($input as $key => $value) {
            switch ($key) {
                case 'insurance_types_offered':
                    $tourOperatorTourInsuranceTypesArray = $value;
                    break;
            }
        }
        $tourOperatorCompany->tourOperatorTourInsuranceTypes()->sync($tourOperatorTourInsuranceTypesArray);
    }
    
    public function getTourOperatorTouristicActivities(array $input, Model $tourOperatorCompany)
    {
        $tourOperatorTouristicActivitiesArray = [];
        foreach ($input as $key => $value) {
            switch($key){
                case 'tour_company_touristic_activities':
                    $tourOperatorTouristicActivitiesArray = $value;
                    break;
            }
        }
        $tourOperatorCompany->tourOperatorTouristicActivities()->sync($tourOperatorTouristicActivitiesArray);
    }

    public function getTourOperatorTouristicActivitiesLabelAttribute()
    {
        $tourOperatorTouristicActivitiesIds=DB::table('company_touristic_activities')->where('tour_operator_id',$this->id)->pluck('touristic_activities_id');
        $tourOperatorTouristicActivities=touristicActivities::query()->whereIn('id',$tourOperatorTouristicActivitiesIds)->get();
        $activity = [];
        foreach ($tourOperatorTouristicActivities as $tourOperatorTouristicActivity) {
            $activity[] = [
                'name' => $tourOperatorTouristicActivity->activity_name,
                'description' => $tourOperatorTouristicActivity->activity_description,
            ];
        }
        return $activity;
    }
    public function getTourOperatorSafariPreferencesLabelAttribute()
    {
        $tourOperatorSafariPreferenceId = DB::table('operator_touristic_attraction')->where('tour_operator_id', $this->id)->pluck('touristic_attraction_id');
        $tourOperatorSafariPreferences = touristicAttractions::whereIn('id', $tourOperatorSafariPreferenceId)->get();
        $safaris = [];
        foreach ($tourOperatorSafariPreferences as $tourOperatorSafariPreference) {
            $safaris[] = [
                'name' => $tourOperatorSafariPreference->attraction_name,
                'description' => $tourOperatorSafariPreference->attraction_description,
                'uuid' => $tourOperatorSafariPreference->uuid,
            ];
        }
        return $safaris;
    }
    public function getTourOperatorTourInsuranceTypesLabelAttribute()
    {
        $tourOperatorTourInsuranceTypeId = DB::table('operator_insurance_type')->where('tour_operator_id', $this->id)->pluck('tour_insurance_type_id');
        $tourOperatorTourInsuranceTypes = tourInsuranceTypes::whereIn('id', $tourOperatorTourInsuranceTypeId)->get();
        $insurance = [];
        foreach ($tourOperatorTourInsuranceTypes as $tourOperatorTourInsuranceType) {
            $insurance[] = [
                'name' => $tourOperatorTourInsuranceType->tour_insurance_name,
                'description' => $tourOperatorTourInsuranceType->tour_insurance_description,
            ];
        }
        return $insurance;
    }
    public function getTourOperatorRegionsOfOperationLabelAttribute()
    {
        $tourOperatorRegionsOfOperationId = DB::table('operator_tanzania_region')->where('tour_operator_id', $this->id)->pluck('tanzania_region_id');
        $tourOperatorRegionsOfOperation = tanzaniaRegions::whereIn('id', $tourOperatorRegionsOfOperationId)->get();
        $regions = [];

        foreach ($tourOperatorRegionsOfOperation as $tourOperatorRegionOfOperation) {
            $regions[] = [
                'name' => $tourOperatorRegionOfOperation->region_name,
                'description' => $tourOperatorRegionOfOperation->region_description,
                'uuid' => $tourOperatorRegionOfOperation->uuid,
            ];
        }

        return $regions;
    }

    public function getTotalInternationalTourPackagesPostedLabelAttribute()
    {
        $totalInternationalTourPackages = TourPackages::query()->where('tour_operator_id', $this->id)->count();
        return $totalInternationalTourPackages;
    }

    public function getTotalLocalTourPackagesPostedLabelAttribute()
    {
        $totalLocalTourPackages = localTourPackages::query()->where('tour_operator_id', $this->id)->count();
        return $totalLocalTourPackages;
    }
    public function getTotalRecentInternationalTourPackagesPostedLabelAttribute()
    {
        $totalRecentInternationalTourPackages = TourPackages::query()->where('tour_operator_id', $this->id)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        return $totalRecentInternationalTourPackages;
    }
    public function getTotalRecentLocalTourPackagesPostedLabelAttribute()
    {
        $totalRecentLocalTourPackages = localTourPackages::query()->where('tour_operator_id', $this->id)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        return $totalRecentLocalTourPackages;
    }
    public function getTotalVerifiedInternationalTourPackagesPostedLabelAttribute()
    {
        $totalVerifiedInternationalTourPackages = TourPackages::query()->where('tour_operator_id', $this->id)->where('status', '=', 1)->count();
        return $totalVerifiedInternationalTourPackages;
    }

    public function getTotalVerifiedLocalTourPackagesPostedLabelAttribute()
    {
        $totalVerifiedLocalTourPackages = localTourPackages::query()->where('tour_operator_id', $this->id)->where('status', '=', 1)->count();
        return $totalVerifiedLocalTourPackages;
    }

    public function getTotalUnVerifiedInternationalTourPackagesPostedLabelAttribute()
    {
        $totalUnVerifiedInternationalTourPackages = TourPackages::query()->where('tour_operator_id', $this->id)->where('status', '=', 0)->count();
        return $totalUnVerifiedInternationalTourPackages;
    }

    public function getTotalUnVerifiedLocalTourPackagesPostedLabelAttribute()
    {
        $totalUnVerifiedLocalTourPackages = localTourPackages::query()->where('tour_operator_id', $this->id)->where('status', '=', 0)->count();
        return $totalUnVerifiedLocalTourPackages;
    }

    public function getTotalInternationalNearToursLabelAttribute()
    {
        $internationalNearTours = TourPackages::query()->where('tour_operator_id', $this->id)->whereBetween('safari_start_date', [carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        return $internationalNearTours;
    }

    public function getTotalLocalNearToursLabelAttribute()
    {
        $startOfDay = Carbon::now()->startOfDay();
        $endOfDay = Carbon::now()->addDays(40)->endOfDay();
        $localNearTours = localTourPackages::query()->where('tour_operator_id', $this->id)->whereBetween('safari_start_date', [$startOfDay, $endOfDay])->count();
        return $localNearTours;
    }

    public function getTotalInternationalExpiredTourPackagesLabelAttribute()
    {
        $internationalTourPackagesExpired = DB::table('tour_package')->where('tour_operator_id', $this->id)->where('safari_start_date', '<=', [Carbon::now()])->count();
        return $internationalTourPackagesExpired;
    }

    public function getTotalLocalExpiredTourPackagesLabelAttribute()
    {
        $localTourPackagesExpired = DB::table('local_tour_package')->where('tour_operator_id', $this->id)->where('safari_start_date', '<=', [Carbon::now()])->count();
        return $localTourPackagesExpired;
    }
  
    public function getTotalInternationalDeletedTourPackagesLabelAttribute()
    {
        $internationalTourPackagesDeleted = TourPackages::onlyTrashed()->where('tour_operator_id', $this->id)->count();
        return $internationalTourPackagesDeleted;
    }

    public function getTotalLocalDeletedTourPackagesLabelAttribute()
    {
        $localTourPackagesDeleted = localTourPackages::onlyTrashed()->where('tour_operator_id', $this->id)->count();
        return $localTourPackagesDeleted;
    }

    public function getTotalCustomTourBookingsLabelAttribute()
    {
        $totalCustomTourBookings = customTourBookings::query()->where('tour_operator_id', $this->id)->count();
        return $totalCustomTourBookings;
    }
    public function getTotalApprovedCustomTourBookingsLabelAttribute()
    {
        $totalApprovedCustomTourBookings = customTourBookings::query()->where('tour_operator_id', $this->id)->where('status', '=', 1)->count();
        return $totalApprovedCustomTourBookings;
    }
    public function getTotalUnApprovedCustomTourBookingsLabelAttribute()
    {
        $totalUnApprovedCustomTourBookings = customTourBookings::query()->where('tour_operator_id', $this->id)->where('status', '=', 0)->count();
        return $totalUnApprovedCustomTourBookings;
    }
    public function getTotalRecentCustomTourBookingsLabelAttribute()
    {
        $totalRecentCustomTourBookings = customTourBookings::query()->where('tour_operator_id', $this->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        return $totalRecentCustomTourBookings;
    }
    public function getTotalNearCustomToursLabelAttribute()
    {
        $startOfDay = Carbon::now()->startOfDay();
        $endOfDay = Carbon::now()->addDays(40)->endOfDay();
        $totalNearCustomTours = customTourBookings::query()->where('tour_operator_id', $this->id)->whereBetween('start_date', [$startOfDay, $endOfDay])->count();
        return $totalNearCustomTours;
    }
    public function getTotalExpiredCustomTourBookingsLabelAttribute()
    {
        $totalExpiredCustomTourBookings = customTourBookings::query()->where('tour_operator_id', $this->id)->where('start_date', '<=', Carbon::now())->count();
        return $totalExpiredCustomTourBookings;
    }
    public function getTotalRetrievedDeletedCustomBookingsLabelAttribute()
    {
        $totalRetrievedDeletedCustomBookings = customTourBookings::onlyTrashed()->where('tour_operator_id', $this->id)->count();
        return $totalRetrievedDeletedCustomBookings;
    }

    public function getTourCompanyYearsOfExperienceLabelAttribute()
    {
        $establishedYear = Carbon::parse($this->established_date);
        $todayYear = Carbon::now();
        $yearsOfExperience = $todayYear->diffInYears($establishedYear);
        return $yearsOfExperience;
    }
    public function getTotalTourOperatorReservationsLabelAttribute()
    {
        $tourOperatorReservations = tourOperatorReservation::query()->where('tour_operator_id', $this->id)->count();
        return $tourOperatorReservations;
    }
    public function getApprovedTourOperatorReservationsLabelAttribute()
    {
        $approvedTourOperatorReservations = tourOperatorReservation::query()->where('tour_operator_id', $this->id)->where('status', '=', 1)->count();
        return $approvedTourOperatorReservations;
    }
    public function getUnapprovedTourOperatorReservationsLabelAttribute()
    {
        $unapprovedTourOperatorReservations = tourOperatorReservation::query()->where('tour_operator_id', $this->id)->where('status', '=', 0)->count();
        return $unapprovedTourOperatorReservations;
    }
    public function getDeletedTourOperatorReservationsLabelAttribute()
    {
        $deletedTourOperatorReservations = tourOperatorReservation::onlyTrashed()->where('tour_operator_id', $this->id)->count();
        return $deletedTourOperatorReservations;
    }
}
