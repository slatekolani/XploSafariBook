<?php

namespace App\Models\TourOperator\customTourBookings;

use App\Models\BaseModel\BaseModel;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\customTourBookings\reservations\customTourBookingReservations;
use App\Models\TourOperator\customTourBookings\tourPrices\customTourBookingTourPrices;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\tourOperator;
use App\Models\tourPackageType\tourPackageType;
use App\Models\TourTypes\tourTypes;
use App\Models\Transport\transport;
use App\Repositories\customTourPackages\attractionReservations\customTourBookingReservationRepository;
use App\Repositories\customTourPackages\TourPrices\customTourBookingTourPricesRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class customTourBookings extends BaseModel
{
    use SoftDeletes;
    protected $table='custom_tour_booking';
    protected $guarded=['uuid'];
    protected $dates=['deleted_at'];
    public function region()
    {
        return $this->belongsTo(tanzaniaRegions::class,'tourist_region');
    }
    public function customTourBookingTourPrices()
    {
        return $this->belongsTo(customTourBookingTourPrices::class);
    }
    public function tourType()
    {
        return $this->belongsTo(tourTypes::class,'tour_type');
    }
    public function tourPackageType()
    {
        return $this->belongsTo(tourPackageType::class,'tour_package_type');
    }
    public function transportType()
    {
        return $this->belongsTo(transport::class,'transport_type');
    }
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function customTourBookingTouristAttractions()
    {
        return $this->belongsToMany(customTourBookings::class,'custom_booking_attraction','custom_tour_booking_id','tourist_attraction_id');
    }
    public function tourOperatorReservation()
    {
        return $this->belongsTo(tourOperatorReservation::class,'tour_operator_reservation_id');
    }
    public function getBookingStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-danger">Un approved</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Approved</span>';
                break;
        }
    }
    public function getBookingStatusForDeletedLabelAttribute()
    {
        return '<span class="badge badge-danger">Deleted</span>';
    }
    public function getBookingStatusForExpiredLabelAttribute()
    {
        return '<span class="badge badge-danger">Expired</span>';
    }
    public function getButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                        <option value=''>Select &check;</option>
                        <option data-route='".route('customTourBookings.view',$this->uuid)."' value='2'>View</option>
                        <option data-route='".route('customTourBookings.edit',$this->uuid)."' value='2'>Edit</option>
                        <option data-route='".route('customTourBookings.delete',$this->uuid)."' value='1'>Delete</option>
                        <option data-route='".route('customTourBookings.invoicePreview',$this->uuid)."' value='2'>Invoice</option>
                        <option data-route='".route('customTourBookings.delete',$this->uuid)."' value='2'>Payment detail</option>
                 </select>";
    }
    public function getButtonActionForDeletedBookingLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                        <option value=''>Select &check;</option>
                        <option data-route='".route('customTourBookings.viewDeleted',$this->uuid)."' value='3'>view</option>
                        <option data-route='".route('customTourBookings.RestoreDeletedCustomBooking',$this->uuid)."' value='2'>Restore</option>
                        <option data-route='".route('customTourBookings.forceDeleteCustomBooking',$this->uuid)."' value='1'>Delete permanently</option>
                 </select>";
    }
    public function getCustomTourBookingTouristAttractions(array $input, Model $customTourBooking)
    {
        $CustomTourBookingTouristAttractionsArray=[];
        foreach($input as $key =>$value)
        {
            switch ($key)
            {
                case 'tourist_visit_areas':
                    $CustomTourBookingTouristAttractionsArray=$value;
                    break;
            }
        }
        $customTourBooking->customTourBookingTouristAttractions()->sync($CustomTourBookingTouristAttractionsArray);
    }
    public function getCustomTourBookingTouristAttractionLabelAttribute()
    {
        $customTourBookingsTouristAttractionId=DB::table('custom_booking_attraction')->where('custom_tour_booking_id',$this->id)->pluck('tourist_attraction_id');
        $customTourBookingsTouristAttractions=touristicAttractions::whereIn('id',$customTourBookingsTouristAttractionId)->get();
        $attractions=[];
        foreach ($customTourBookingsTouristAttractions as $customTourBookingsTouristAttraction)
        {
            $attractions[]=[
                'attraction_name'=>$customTourBookingsTouristAttraction->attraction_name,
                'id'=>$customTourBookingsTouristAttraction->id,
            ];
        }
        return $attractions;
    }
    public function getCountDownDaysForACustomTourLabelAttribute()
    {
        $customTourBooking=customTourBookings::find($this->id);
        $today=Carbon::now();
        $startDate=$customTourBooking->start_date;
        $dateTime1=new \DateTime($today);
        $dateTime2=new \DateTime($startDate);
        $interval=$dateTime1->diff($dateTime2);
        return $interval->format('%R%d');
    }
    public function getCountDownDaysForADeletedCustomTourLabelAttribute()
    {
        $customTourBooking=customTourBookings::onlyTrashed()->find($this->id);
        $today=Carbon::now();
        $startDate=$customTourBooking->start_date;
        $dateTime1=new \DateTime($today);
        $dateTime2=new \DateTime($startDate);
        $interval=$dateTime1->diff($dateTime2);
        return $interval->format('%R%d');
    }
    public function getCustomTourDurationLabelAttribute()
    {
        $customTourBooking=customTourBookings::find($this->id);
        $startDate=$customTourBooking->start_date;
        $endDate=$customTourBooking->end_date;
        $dateTime1=new \DateTime($startDate);
        $dateTime2=new \DateTime($endDate);
        $interval=$dateTime1->diff($dateTime2);
        return $interval->format('%d');
    }
    public function getDeletedCustomTourDurationLabelAttribute()
    {
        $customTourBooking=customTourBookings::onlyTrashed()->find($this->id);
        $startDate=$customTourBooking->start_date;
        $endDate=$customTourBooking->end_date;
        $dateTime1=new \DateTime($startDate);
        $dateTime2=new \DateTime($endDate);
        $interval=$dateTime1->diff($dateTime2);
        return $interval->format('%d');
    }
    public function getUrgencystatusLabelAttribute()
    {
        $startDate=Carbon::parse($this->start_date);
        $todayDate=Carbon::now();
        $daysDifference=$todayDate->diffInDays($startDate);
        if ($daysDifference <= 3)
        {
           return '<span class="badge badge-danger">Critical</span>';
        }
        else if ($daysDifference <= 10)
        {
            return '<span class="badge badge-warning">High Priority</span>';
        } else if ($daysDifference <= 30)
        {
            return '<span class="badge badge-info">Medium Priority</span>';
        } else
        {
            return '<span class="badge badge-success">Low Priority</span>';
        }
    }
    public function saveCustomTourBookingReservations($input,$customTourBooking)
    {
        $customTourBookingReservationRepo=new customTourBookingReservationRepository();
        $customTourBookingReservation=$customTourBookingReservationRepo->saveCustomTourBookingReservations($input,$customTourBooking);
        return back()->with('customTourBookingReservation',$customTourBookingReservation);
    }
    public function saveCustomTourBookingTourPrices($input,$customTourBooking)
    {
        $customTourBookingTourPricesRepo=new customTourBookingTourPricesRepository();
        $customTourBookingTourPrices=$customTourBookingTourPricesRepo->saveCustomTourBookingTourPrices($input,$customTourBooking);
        return back()->with('customTourBookingTourPrices',$customTourBookingTourPrices);
    }
    public function getTotalNumberOfTravellersLabelAttribute()
    {
        // Assuming $this refers to a single instance of customTourBookings
        $totalResidentChildrenTravellers = $this->total_children_residents;
        $totalResidentAdultTravellers = $this->total_adult_residents;
        $totalForeignerAdultTravellers = $this->total_adult_foreigners;
        $totalForeignerChildrenTravellers = $this->total_children_foreigners;

        $totalTravellers = $totalForeignerAdultTravellers + $totalForeignerChildrenTravellers + $totalResidentAdultTravellers + $totalResidentChildrenTravellers;

        return $totalTravellers;
    }
    public function getTotalSafariPriceLabelAttribute()
    {
        $totalResidentChildrenTravellers = $this->total_children_residents;
        $totalResidentAdultTravellers = $this->total_adult_residents;
        $totalForeignerAdultTravellers = $this->total_adult_foreigners;
        $totalForeignerChildrenTravellers = $this->total_children_foreigners;

        $residentChildTourPrice=$this->resident_child_price;
        $residentAdultTourPrice=$this->resident_adult_price;
        $nonResidentChildTourPrice=$this->foreigner_child_price;
        $nonResidentAdultTourPrice=$this->foreigner_adult_price;

        $GrandTotalTourPrice=($totalResidentChildrenTravellers *$residentChildTourPrice) + ($totalResidentAdultTravellers * $residentAdultTourPrice) + ($totalForeignerAdultTravellers * $nonResidentAdultTourPrice) + ($totalForeignerChildrenTravellers * $nonResidentChildTourPrice);
        return $GrandTotalTourPrice;
    }
    public function getTotalReservationPriceLabelAttribute()
    {
        $customTourBookingReservation=customTourBookingReservations::query()->where('custom_tour_booking_id',$this->id)->first();
        if (empty($customTourBookingReservation))
        {

        }
        else
        {
            $totalResidentChildrenTravellers = $this->total_children_residents;
            $totalResidentAdultTravellers = $this->total_adult_residents;
            $totalForeignerAdultTravellers = $this->total_adult_foreigners;
            $totalForeignerChildrenTravellers = $this->total_children_foreigners;
            $residentChildReservationPrice=$customTourBookingReservation->tourOperatorReservation->resident_child_price_reservation;
            $residentAdultReservationPrice=$customTourBookingReservation->tourOperatorReservation->resident_adult_price_reservation;
            $foreignerAdultReservationPrice=$customTourBookingReservation->tourOperatorReservation->foreigner_adult_price_reservation;
            $foreignerChildReservationPrice=$customTourBookingReservation->tourOperatorReservation->foreigner_child_price_reservation;

            $grandTotalReservationPrice=($totalResidentChildrenTravellers * $residentChildReservationPrice) + ($totalResidentAdultTravellers * $residentAdultReservationPrice) + ($totalForeignerAdultTravellers * $foreignerAdultReservationPrice) + ($totalForeignerChildrenTravellers * $foreignerChildReservationPrice);
            return $grandTotalReservationPrice;
        }
    }
}

