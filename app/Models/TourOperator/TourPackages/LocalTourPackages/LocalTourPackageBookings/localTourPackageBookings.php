<?php

namespace App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings;

use App\Models\Auth\User;
use App\Models\BaseModel\BaseModel;
use App\Models\specialNeed\specialNeed;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTouristReviews\localTouristReviews;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTripCancellation\localTourPackageCancelledbookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageCollectionStops\localTourPackageCollectionStops;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\SoftDeletes;

class localTourPackageBookings extends BaseModel
{
    use SoftDeletes;
    protected $table = 'local_tour_package_booking';
    protected $guarded = ['uuid'];

    public function localTourPackageCancelledBookings()
    {
        return $this->hasOne(localTourPackageCancelledbookings::class,'local_tour_booking_id','id');
    }

    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function collectionStop()
    {
        return $this->belongsTo(localTourPackageCollectionStops::class, 'collection_station');
    }
    public function localTourPackages()
    {
        return $this->belongsTo(localTourPackages::class, 'local_tour_package_id','id');
    }
    public function localTouristReviews()
    {
        return $this->hasMany(localTouristReviews::class);
    }
    public function tourOperatorReservation()
    {
        return $this->belongsTo(tourOperatorReservation::class, 'reservation_id');
    }
    public function specialNeed()
    {
        return $this->belongsTo(specialNeed::class, 'special_attention');
    }
    public function getBookingStatusLabelAttribute()
    {
        $status = $this->status;
        switch ($status) {
            case 0:
                return '<span class="badge badge-danger badge-pill">Unapproved</span>';
                break;
            case 1:
                return '<span class="badge badge-success badge-pill">Approved</span>';
                break;
        }
    }
    public function getDeletedLocalBookingStatusLabelAttribute()
    {
        return '<span class="badge badge-danger">Deleted</span>';
    }

    public function getLocalBookingButtonActionLabelAttribute()
    {

            return "<select name='action' class='action_select'>
                            <option value=''>Select</option>
                            <option data-route='" . route('localTourBooking.view', $this->uuid) . "' value='2'>View</option>
                            <option data-route='" . route('localTourBooking.edit', $this->uuid) . "' value='2'>Edit</option>
                            <option data-route='" .route('localTripCancellation.index',$this->uuid). "' value='2'>Cancellation request</option>
                            <option data-route='" . route('localTourBooking.previewInvoice', $this->uuid) . "' value='2'>Invoice</option>
                            <option value='2'>Payment details</option>
                            <option data-route='" . route('localTouristReview.index', $this->uuid) . "' value='2'>Reviews</option>
                            <option data-route='" . route('localTourBooking.delete', $this->uuid) . "' value='1'>Delete</option>
                        </select>";
        
    }
    public function getDeletedLocalBookingButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                    <option value=''>Select</option>
                    <option data-route='" . route('localTourBooking.viewDeleted', $this->uuid) . "' value='3'>View</option>
                    <option value='3'>Payment details</option>
                    <option data-route='" . route('localTourBooking.restore', $this->uuid) . "' value='2'>Restore</option>
                    <option data-route='" . route('localTourBooking.forceDelete', $this->uuid) . "' value='1'>Delete permanently</option>
               </select>";
    }
    public function getTourPriceLabelAttribute()
    {
        // Fetch the related Local Tour Package Booking
        $localTourPackageBooking = localTourPackageBookings::find($this->id);
        if (!$localTourPackageBooking) {
            return 0; // Return 0 if booking does not exist
        }

        // Fetch related IDs and data
        $localTourPackage = localTourPackages::find($localTourPackageBooking->local_tour_package_id);
        $tourOperatorReservation = tourOperatorReservation::find($localTourPackageBooking->reservation_id);

        if (!$localTourPackage) {
            return 0; // Return 0 if the tour package does not exist
        }

        // Prices from the Tour Package
        $adultForeignerTourPrice = $localTourPackage->trip_price_adult_foreigner ?? 0;
        $childForeignerTourPrice = $localTourPackage->trip_price_child_foreigner ?? 0;
        $childLocalTourPrice = $localTourPackage->trip_price_child_tanzanian ?? 0;
        $adultLocalTourPrice = $localTourPackage->trip_price_adult_tanzanian ?? 0;

        // Prices from the Reservation (fallback to 0 if null)
        $adultForeignerReservationPrice = $tourOperatorReservation->foreigner_adult_price_reservation ?? 0;
        $childForeignerReservationPrice = $tourOperatorReservation->foreigner_child_price_reservation ?? 0;
        $childLocalReservationPrice = $tourOperatorReservation->resident_child_price_reservation ?? 0;
        $adultLocalReservationPrice = $tourOperatorReservation->resident_adult_price_reservation ?? 0;

        // Traveler Counts
        $totalForeignerChildren = $localTourPackageBooking->total_number_foreigner_child ?? 0;
        $totalForeignerAdults = $localTourPackageBooking->total_number_foreigner_adult ?? 0;
        $totalLocalAdults = $localTourPackageBooking->total_number_local_adult ?? 0;
        $totalLocalChildren = $localTourPackageBooking->total_number_local_child ?? 0;

        // Collecting Station Price
        $collectingStationPrice = $localTourPackageBooking->collectionStop->collection_stop_price ?? 0;

        // Calculate Breakdown of Tour Prices
        $adultForeignersTourPrice = ($adultForeignerTourPrice * $totalForeignerAdults) + ($collectingStationPrice * $totalForeignerAdults);
        $adultLocalsTourPrice = ($adultLocalTourPrice * $totalLocalAdults) + ($collectingStationPrice * $totalLocalAdults);
        $childrenForeignersTourPrice = ($childForeignerTourPrice * $totalForeignerChildren) + ($collectingStationPrice * $totalForeignerChildren);
        $childrenLocalsTourPrice = ($childLocalTourPrice * $totalLocalChildren) + ($collectingStationPrice * $totalLocalChildren);

        // Calculate Breakdown of Reservation Prices
        $adultForeignersReservationPrice = ($adultForeignerReservationPrice * $totalForeignerAdults);
        $adultLocalsReservationPrice = ($adultLocalReservationPrice * $totalLocalAdults);
        $childrenForeignersReservationPrice = ($childForeignerReservationPrice * $totalForeignerChildren);
        $childrenLocalsReservationPrice = ($childLocalReservationPrice * $totalLocalChildren);

        // Calculate Total Prices
        $localTourPrice = $adultLocalsTourPrice + $adultForeignersTourPrice + $childrenForeignersTourPrice + $childrenLocalsTourPrice;
        $reservationPrice =  $adultForeignersReservationPrice + $adultLocalsReservationPrice + $childrenForeignersReservationPrice + $childrenLocalsReservationPrice;

        // Final Tour Price
        $tourPrice = $localTourPrice + $reservationPrice;

        return $tourPrice;
    }
    public function getDiscountedTourPriceLabelAttribute()
    {
        $totalTourPrice = $this->getTourPriceLabelAttribute();
        $localTourPackageBooking = localTourPackageBookings::find($this->id);
        if (!$localTourPackageBooking) {
            return 0; // Return 0 if booking does not exist
        }

        // Fetch related IDs and data
        $localTourPackage = localTourPackages::find($localTourPackageBooking->local_tour_package_id);
        if (!$localTourPackage) {
            return 0; // Return 0 if the tour package does not exist
        }
        $discountPercent = $localTourPackage->discount_offered;
        $discountedAmount = $totalTourPrice * ($discountPercent / 100);
        $amountAfterDiscounted = $totalTourPrice - $discountedAmount;

        return $amountAfterDiscounted;
    }
    public function getPaymentModeLabelAttribute()
    {
        // Fetch the payment mode value
        $paymentMode = $this->payment_mode;

        // Check if payment mode is not null
        if (!is_null($paymentMode)) {
            // Use a switch statement for different payment modes
            switch ($paymentMode) {
                case 'fullPayment':
                    return '<span class="badge badge-success">Full Payment</span>';
                    break;
                case 'partialPayment':
                    return '<span class="badge badge-warning">Partial Payment</span>';
                    break;
                default:
                    return '<span class="badge badge-info">Unknown Payment Mode</span>';
            }
        } else {
            return '<span class="badge badge-danger">No Option Selected</span>';
        }
    }
    public function getAmountPaidLabelAttribute()
    {
        return '<span class="badge badge-success">Tshs 0/=</span>';
    }
    public function getPaymentProgressLabelAttribute()
    {
        return '<span class="badge badge-primary">0%</span>';
    }

    public function getTouristEligibilityForDiscountLabelAttribute()
    {
        $localTourPackageBooking = localTourPackageBookings::find($this->id);
        if (!$localTourPackageBooking) {
            return 0; // Return 0 if booking does not exist
        }

        $totalForeignerChildren = $localTourPackageBooking->total_number_foreigner_child ?? 0;
        $totalForeignerAdults = $localTourPackageBooking->total_number_foreigner_adult ?? 0;
        $totalLocalAdults = $localTourPackageBooking->total_number_local_adult ?? 0;
        $totalLocalChildren = $localTourPackageBooking->total_number_local_child ?? 0;
        $totalTravellers = ($totalForeignerAdults + $totalForeignerChildren + $totalLocalAdults + $totalLocalChildren);


        // Fetch related IDs and data

        $localTourPackage = localTourPackages::find($localTourPackageBooking->local_tour_package_id);
        if (!$localTourPackage) {
            return 0; // Return 0 if the tour package does not exist
        }
        $numberOfPeopleForDiscount = $localTourPackage->number_of_people_for_discount;
        if ($totalTravellers >= $numberOfPeopleForDiscount) {
            return '<span class="badge badge-success">Eligible for Discount</span>';
        } else {
            return '<span class="badge badge-danger">Not Eligible for Discount</span>';
        }
    }

    public function getTotalTouristsLabelAttribute()
    {
        $localTourPackageBooking = localTourPackageBookings::find($this->id);
        $totalForeignerChildren = $localTourPackageBooking->total_number_foreigner_child;
        $totalForeignerAdults = $localTourPackageBooking->total_number_foreigner_adult;
        $totalLocalAdults = $localTourPackageBooking->total_number_local_adult;
        $totalLocalChildren = $localTourPackageBooking->total_number_local_child;

        $totalTouristsBooked = ($totalForeignerChildren + $totalForeignerAdults + $totalLocalAdults + $totalLocalChildren);
        return $totalTouristsBooked;
    }


    public function getTourPriceForDeletedBookingLabelAttribute()
    {
        $localTourPackageBooking = localTourPackageBookings::onlyTrashed()->find($this->id);
        if (!$localTourPackageBooking) {
            return 0; // Return 0 if booking does not exist
        }

        // Fetch related IDs and data
        $localTourPackage = localTourPackages::find($localTourPackageBooking->local_tour_package_id);
        $tourOperatorReservation = tourOperatorReservation::find($localTourPackageBooking->reservation_id);

        if (!$localTourPackage) {
            return 0; // Return 0 if the tour package does not exist
        }

        // Prices from the Tour Package
        $adultForeignerTourPrice = $localTourPackage->trip_price_adult_foreigner ?? 0;
        $childForeignerTourPrice = $localTourPackage->trip_price_child_foreigner ?? 0;
        $childLocalTourPrice = $localTourPackage->trip_price_child_tanzanian ?? 0;
        $adultLocalTourPrice = $localTourPackage->trip_price_adult_tanzanian ?? 0;

        // Prices from the Reservation (fallback to 0 if null)
        $adultForeignerReservationPrice = $tourOperatorReservation->foreigner_adult_price_reservation ?? 0;
        $childForeignerReservationPrice = $tourOperatorReservation->foreigner_child_price_reservation ?? 0;
        $childLocalReservationPrice = $tourOperatorReservation->resident_child_price_reservation ?? 0;
        $adultLocalReservationPrice = $tourOperatorReservation->resident_adult_price_reservation ?? 0;

        // Traveler Counts
        $totalForeignerChildren = $localTourPackageBooking->total_number_foreigner_child ?? 0;
        $totalForeignerAdults = $localTourPackageBooking->total_number_foreigner_adult ?? 0;
        $totalLocalAdults = $localTourPackageBooking->total_number_local_adult ?? 0;
        $totalLocalChildren = $localTourPackageBooking->total_number_local_child ?? 0;

        // Collecting Station Price
        $collectingStationPrice = $localTourPackageBooking->collectionStop->collection_stop_price ?? 0;

        // Calculate Breakdown of Tour Prices
        $adultForeignersTourPrice = ($adultForeignerTourPrice * $totalForeignerAdults) + ($collectingStationPrice * $totalForeignerAdults);
        $adultLocalsTourPrice = ($adultLocalTourPrice * $totalLocalAdults) + ($collectingStationPrice * $totalLocalAdults);
        $childrenForeignersTourPrice = ($childForeignerTourPrice * $totalForeignerChildren) + ($collectingStationPrice * $totalForeignerChildren);
        $childrenLocalsTourPrice = ($childLocalTourPrice * $totalLocalChildren) + ($collectingStationPrice * $totalLocalChildren);

        // Calculate Breakdown of Reservation Prices
        $adultForeignersReservationPrice = ($adultForeignerReservationPrice * $totalForeignerAdults);
        $adultLocalsReservationPrice = ($adultLocalReservationPrice * $totalLocalAdults);
        $childrenForeignersReservationPrice = ($childForeignerReservationPrice * $totalForeignerChildren);
        $childrenLocalsReservationPrice = ($childLocalReservationPrice * $totalLocalChildren);

        // Calculate Total Prices
        $localTourPrice = $adultLocalsTourPrice + $adultForeignersTourPrice + $childrenForeignersTourPrice + $childrenLocalsTourPrice;
        $reservationPrice =  $adultForeignersReservationPrice + $adultLocalsReservationPrice + $childrenForeignersReservationPrice + $childrenLocalsReservationPrice;

        // Final Tour Price
        $tourPrice = $localTourPrice + $reservationPrice;

        return $tourPrice;
    }

    public function getDiscountedTourPriceForDeletedBookingLabelAttribute()
    {
        $totalTourPrice = $this->getTourPriceForDeletedBookingLabelAttribute();
        $localTourPackageBooking = localTourPackageBookings::onlyTrashed()->find($this->id);
        if (!$localTourPackageBooking) {
            return 0; // Return 0 if booking does not exist
        }

        // Fetch related IDs and data
        $localTourPackage = localTourPackages::find($localTourPackageBooking->local_tour_package_id);
        if (!$localTourPackage) {
            return 0; // Return 0 if the tour package does not exist
        }
        $discountPercent = $localTourPackage->discount_offered;
        $discountedAmount = $totalTourPrice * ($discountPercent / 100);
        $amountAfterDiscounted = $totalTourPrice - $discountedAmount;

        return $amountAfterDiscounted;
    }


    public function getDeletedTouristEligibilityForDiscountLabelAttribute()
    {
        $localTourPackageBooking = localTourPackageBookings::onlyTrashed()->find($this->id);
        if (!$localTourPackageBooking) {
            return 0; // Return 0 if booking does not exist
        }

        $totalForeignerChildren = $localTourPackageBooking->total_number_foreigner_child ?? 0;
        $totalForeignerAdults = $localTourPackageBooking->total_number_foreigner_adult ?? 0;
        $totalLocalAdults = $localTourPackageBooking->total_number_local_adult ?? 0;
        $totalLocalChildren = $localTourPackageBooking->total_number_local_child ?? 0;
        $totalTravellers = ($totalForeignerAdults + $totalForeignerChildren + $totalLocalAdults + $totalLocalChildren);


        // Fetch related IDs and data

        $localTourPackage = localTourPackages::find($localTourPackageBooking->local_tour_package_id);
        if (!$localTourPackage) {
            return 0; // Return 0 if the tour package does not exist
        }
        $numberOfPeopleForDiscount = $localTourPackage->number_of_people_for_discount;
        if ($totalTravellers >= $numberOfPeopleForDiscount) {
            return '<span class="badge badge-success">Eligible for Discount</span>';
        } else {
            return '<span class="badge badge-danger">Not Eligible for Discount</span>';
        }
    }

    public function getDeletedTotalTouristsLabelAttribute()
    {
        $localTourPackageBooking = localTourPackageBookings::onlyTrashed()->find($this->id);
        $totalForeignerChildren = $localTourPackageBooking->total_number_foreigner_child;
        $totalForeignerAdults = $localTourPackageBooking->total_number_foreigner_adult;
        $totalLocalAdults = $localTourPackageBooking->total_number_local_adult;
        $totalLocalChildren = $localTourPackageBooking->total_number_local_child;

        $totalTouristsBooked = ($totalForeignerChildren + $totalForeignerAdults + $totalLocalAdults + $totalLocalChildren);
        return $totalTouristsBooked;
    }

    public function getCheckedNumberOfLocalReviewsPerBookingLabelAttribute()
    {
        $localTourBooking = localTourPackageBookings::find($this->id);
        $localTouristReviews = localTouristReviews::query()->where('local_tour_booking_id', $localTourBooking->id)->count();
        return $localTouristReviews;
    }
    public function getTotalLocalTouristReviewsLabelAttribute()
    {
        $localTouristBookings = localTourPackageBookings::find($this->id);
        $localTouristReviews = localTouristReviews::query()->where('local_tour_booking_id', $localTouristBookings->id)->count();
        return $localTouristReviews;
    }
    public function getTotalApprovedLocalTouristReviewsLabelAttribute()
    {
        $localTouristBookings = localTourPackageBookings::find($this->id);
        $localTouristReviews = localTouristReviews::query()->where('local_tour_booking_id', $localTouristBookings->id)->where('status', '=', 1)->count();
        return $localTouristReviews;
    }
    public function getTotalUnApprovedLocalTouristReviewsLabelAttribute()
    {
        $localTouristBookings = localTourPackageBookings::find($this->id);
        $localTouristReviews = localTouristReviews::query()->where('local_tour_booking_id', $localTouristBookings->id)->where('status', '=', 0)->count();
        return $localTouristReviews;
    }
    public function getTotalDeletedLocalTouristReviewsLabelAttribute()
    {
        $localTouristBookings = localTourPackageBookings::find($this->id);
        $localTouristReviews = localTouristReviews::onlyTrashed()->where('local_tour_booking_id', $localTouristBookings->id)->count();
        return $localTouristReviews;
    }
    public function getTotalLocalCancelledTripBookingsLabelAttribute()
    {

        $localTourBooking = localTourPackageBookings::find($this->id);
        $localTourPackageCancelledBookings = localTourPackageCancelledbookings::query()->where('local_tour_booking_id', $localTourBooking->id)->count();
        return $localTourPackageCancelledBookings;
    }
    public function getTotalApprovedLocalCancelledTripBookingsLabelAttribute()
    {

        $localTourBooking = localTourPackageBookings::find($this->id);
        $localTourPackageCancelledBookings = localTourPackageCancelledbookings::query()->where('cancellation_status','=',1)->where('local_tour_booking_id', $localTourBooking->id)->count();
        return $localTourPackageCancelledBookings;
    }
    public function getTotalDeletedLocalCancelledTripBookingsLabelAttribute()
    {

        $localTourBooking = localTourPackageBookings::find($this->id);
        $localTourPackageCancelledBookings = localTourPackageCancelledbookings::query()->onlyTrashed()->where('cancellation_status','=',1)->where('local_tour_booking_id', $localTourBooking->id)->count();
        return $localTourPackageCancelledBookings;
    }
    public function getTotalUnApprovedLocalCancelledTripBookingsLabelAttribute()
    {

        $localTourBooking = localTourPackageBookings::find($this->id);
        $localTourPackageCancelledBookings = localTourPackageCancelledbookings::query()->where('cancellation_status','=',0)->where('local_tour_booking_id', $localTourBooking->id)->count();
        return $localTourPackageCancelledBookings;
    }
    public function getTotalLocalCancelledDeletedTripBookingsLabelAttribute()
    {

        $localTourBooking = localTourPackageBookings::onlyTrashed()->find($this->id);
        $localTourPackageCancelledBookings = localTourPackageCancelledbookings::query()->where('local_tour_booking_id', $localTourBooking->id)->count();
        return $localTourPackageCancelledBookings;
    }
    public function getLocalCancelledTripBookingStatusLabelAttribute()
    {
        $localTourPackageBooking = localTourPackageBookings::find($this->id);
        $cancellation = $localTourPackageBooking->localTourPackageCancelledBookings;

        if ($cancellation && $cancellation->cancellation_status == 1) {
            return '<span class="badge badge-danger">Cancelled</span>';
        }

        if ($cancellation && $cancellation->cancellation_status == 0) {
            return '<span class="badge badge-warning">Cancellation Unapproved</span>';
        }

        return '<span class="badge badge-success">Not Cancelled</span>';
    }
    public function getLocalCancelledDeletedTripBookingStatusLabelAttribute()
    {
        $localTourPackageBooking = localTourPackageBookings::onlyTrashed()->find($this->id);
        $cancellation = $localTourPackageBooking->localTourPackageCancelledBookings;

        if ($cancellation && $cancellation->cancellation_status == 1) {
            return '<span class="badge badge-danger">Cancelled</span>';
        }

        if ($cancellation && $cancellation->cancellation_status == 0) {
            return '<span class="badge badge-warning">Cancellation Unapproved</span>';
        }

        return '<span class="badge badge-success">Not Cancelled</span>';
    }
}
