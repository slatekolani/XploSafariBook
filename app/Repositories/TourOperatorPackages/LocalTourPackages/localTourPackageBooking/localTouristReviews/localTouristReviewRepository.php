<?php

namespace App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackageBooking\localTouristReviews;

use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTouristReviews\localTouristReviews;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class localTouristReviewRepository.
 */
class localTouristReviewRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTouristReviews::class;
    }

    public function storeLocalTouristReview($input)
    {
        $localTouristReview = new localTouristReviews();
        $localTouristReview->title_review_company = $input['title_review_company'];
        $localTouristReview->review_company = $input['review_company'];
        $localTouristReview->title_review_attraction = $input['title_review_attraction'];
        $localTouristReview->review_attraction = $input['review_attraction'];
        $localTouristReview->tour_operator_id = $input['tour_operator_id'];
        $localTouristReview->local_tour_package_id = $input['local_tour_package_id'];
        $localTouristReview->local_tour_booking_id = $input['local_tour_booking_id'];
        $localTouristReview->rating = $input['rating'];
        $localTouristReview->save();
    }
    
}
