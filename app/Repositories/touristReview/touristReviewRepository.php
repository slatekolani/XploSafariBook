<?php

namespace App\Repositories\touristReview;

use App\Models\TourOperator\touristReview\touristReview;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class touristReviewRepository.
 */
class touristReviewRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristReview::class;
    }

    public function storeTouristReviews(array $input)
    {
        $touristReview=new touristReview();
        $touristReview->tourist_name=$input['tourist_name'];
        $touristReview->review_title=$input['review_title'];
        $touristReview->review_message=$input['review_message'];
        $touristReview->tour_package_booking_id=$input['tour_package_booking_id'];
        $touristReview->tour_operator_id=$input['tour_operator_id'];
        $touristReview->save();
    }
}
