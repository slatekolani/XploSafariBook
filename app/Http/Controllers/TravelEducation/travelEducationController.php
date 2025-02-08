<?php

namespace App\Http\Controllers\TravelEducation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\customerSatisfactionCategory\customerSatisfactionCategory;
use App\Models\tanzaniaAndWorldEvents\tanzaniaAndWorldEvents;
use App\Models\tourInsuranceTypes\tourInsuranceTypes;
use App\Models\tourPackageType\tourPackageType;
use App\Models\TourTypes\tourTypes;

class travelEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicView()
    {
        $events=tanzaniaAndWorldEvents::query()->where('status','=',1)->get();
        $tourPackageTypes=tourPackageType::query()->where('status','=',1)->get();
        $tourTypes=tourTypes::query()->where('status','=',1)->get();
        $customerExperiences=customerSatisfactionCategory::all();
        $travelInsurances=tourInsuranceTypes::query()->where('status','=',1)->get();
        $package_ranges=['Quarterly Plan (3 Months)','Semi-Annual Plan (6 Months)','Tri-Annual Plan (9 Months)','Annual Plan (12 Months)'];
        return view('travelEducation.travelEducation')
        ->with('travelInsurances',$travelInsurances)
        ->with('package_ranges',$package_ranges)
        ->with('customerExperiences',$customerExperiences)
        ->with('events',$events)
        ->with('tourPackageTypes',$tourPackageTypes)
        ->with('tourTypes',$tourTypes);
    }
}
