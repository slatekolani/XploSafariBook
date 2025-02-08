<?php

namespace App\Repositories\TourOperator;

use App\Http\Requests\Request;
use App\Models\TourOperator\tourOperator;
use Illuminate\Support\Facades\Validator;
use App\Repositories\BaseRepository;


//use Your Model

/**
 * Class tourOperatorRepository.
 */
class tourOperatorRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourOperator::class;
    }
    public function construct()
    {

    }

    public function storeTourOperatorInformation(array $input)
    {
        $tourOperatorCompany=new tourOperator();
        $tourOperatorCompany->company_name=$input['company_name'];
        $tourOperatorCompany->email_address=$input['email_address'];
        $tourOperatorCompany->phone_number=$input['phone_number'];
        $tourOperatorCompany->established_date=$input['established_date'];
        $tourOperatorCompany->total_employees=$input['total_employees'];
        $tourOperatorCompany->website_url=$input['website_url'];
        $tourOperatorCompany->instagram_url=$input['instagram_url'];
        $tourOperatorCompany->whatsapp_url=$input['whatsapp_url'];
        $tourOperatorCompany->gps_url=$input['gps_url'];
        $tourOperatorCompany->company_nation=$input['company_nation'];
        $tourOperatorCompany->about_company=$input['about_company'];
        $tourOperatorCompany->support_time_range=$input['support_time_range'];
        $tourOperatorCompany->region=$input['region'];
        $tourOperatorCompany->safariClass=$input['safariClass'];
        $tourOperatorCompany->agreeCustomBooking=$input['agreeCustomBooking'];
        $tourOperatorCompany->postal_code=$input['postal_code'];
        $tourOperatorCompany->tin_number=$input['tin_number'];
        $tourOperatorCompany->physical_location=$input['physical_location'];
        $tourOperatorCompany->users_id=auth()->user()->id;
        if($input['company_logo'])
        {
            $file=$input['company_logo'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/TourOperatorsLogos/',$filename);
            $tourOperatorCompany->company_logo=$filename;
        }
        if($input['company_team_image'])
        {
            $file=$input['company_team_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/CompaniesTeamImage/',$filename);
            $tourOperatorCompany->company_team_image=$filename;
        }
        if($input['verification_certificate'])
        {
            $file=$input['verification_certificate'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/VerificationCertificates/',$filename);
            $tourOperatorCompany->verification_certificate=$filename;
        }
        if($input['terms_and_conditions'])
        {
            $file=$input['terms_and_conditions'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/companyTermsAndConditions/',$filename);
            $tourOperatorCompany->terms_and_conditions=$filename;
        }
        if ($input['tato_membership_certificate'])
        {
            $file=$input['tato_membership_certificate'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/membershipCertificates/',$filename);
            $tourOperatorCompany->tato_membership_certificate=$filename;
        }
        $tourOperatorCompany->save();
        $tourOperatorCompany->getTourOperatorSafariAreaPreferences($input,$tourOperatorCompany);
        $tourOperatorCompany->getTourOperatorRegionsOfOperations($input,$tourOperatorCompany);
        $tourOperatorCompany->getTourOperatorTourInsuranceTypes($input,$tourOperatorCompany);
        $tourOperatorCompany->getTourOperatorTouristicActivities($input,$tourOperatorCompany);
    }
    public function updateTourOperatorInformation(array $input,$tour_operator_company_id,$request)
    {
        $tourOperatorCompany=tourOperator::query()->where('uuid',$tour_operator_company_id)->first();
        $tourOperatorCompany->company_name=$input['company_name'];
        $tourOperatorCompany->email_address=$input['email_address'];
        $tourOperatorCompany->phone_number=$input['phone_number'];
        $tourOperatorCompany->established_date=$input['established_date'];
        $tourOperatorCompany->total_employees=$input['total_employees'];
        $tourOperatorCompany->website_url=$input['website_url'];
        $tourOperatorCompany->instagram_url=$input['instagram_url'];
        $tourOperatorCompany->whatsapp_url=$input['whatsapp_url'];
        $tourOperatorCompany->gps_url=$input['gps_url'];
        $tourOperatorCompany->company_nation=$input['company_nation'];
        $tourOperatorCompany->support_time_range=$input['support_time_range'];
        $tourOperatorCompany->about_company=$input['about_company'];
        $tourOperatorCompany->safariClass=$input['safariClass'];
        $tourOperatorCompany->agreeCustomBooking=$input['agreeCustomBooking'];
        $tourOperatorCompany->region=$input['region'];
        $tourOperatorCompany->postal_code=$input['postal_code'];
        $tourOperatorCompany->tin_number=$input['tin_number'];
        $tourOperatorCompany->physical_location=$input['physical_location'];
        $tourOperatorCompany->users_id=auth()->user()->id;
        $input=$request->all();
        if($request->hasFile('company_logo') && $input['company_logo'])
        {
            $file=$input['company_logo'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/TourOperatorsLogos/',$filename);
            $tourOperatorCompany->company_logo=$filename;
        }
        if($request->hasFile('company_team_image') && $input['company_team_image'])
        {
            $file=$input['company_team_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/CompaniesTeamImage/',$filename);
            $tourOperatorCompany->company_team_image=$filename;
        }
        if($request->hasFile('verification_certificate') && $input['verification_certificate'])
        {
            $file=$input['verification_certificate'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/VerificationCertificates/',$filename);
            $tourOperatorCompany->verification_certificate=$filename;
        }
        if($request->hasFile('terms_and_conditions') && $input['terms_and_conditions'])
        {
            $file=$input['terms_and_conditions'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/companyTermsAndConditions/',$filename);
            $tourOperatorCompany->terms_and_conditions=$filename;
        }
        if($request->hasFile('tato_membership_certificate') && $input['tato_membership_certificate'])
        {
            $file=$input['tato_membership_certificate'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/membershipCertificates/',$filename);
            $tourOperatorCompany->tato_membership_certificate=$filename;
        }
        $tourOperatorCompany->save();
        $tourOperatorCompany->getTourOperatorSafariAreaPreferences($input,$tourOperatorCompany);
        $tourOperatorCompany->getTourOperatorRegionsOfOperations($input,$tourOperatorCompany);
        $tourOperatorCompany->getTourOperatorTourInsuranceTypes($input,$tourOperatorCompany);
        $tourOperatorCompany->getTourOperatorTouristicActivities($input,$tourOperatorCompany);


    }
}
