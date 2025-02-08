<?php

namespace App\Models\TourOperator\reservations;

use App\Models\BaseModel\BaseModel;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\touristicGames\touristicGame;
use App\Models\TourOperator\reservations\reservationFacilities\tourOperatorReservationFacility;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Repositories\TourOperator\reservations\reservationFacilities\tourOperatorReservationFacilitiesRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class tourOperatorReservation extends BaseModel
{
    use SoftDeletes;

    protected $table = 'tour_operator_reservation';
    protected $guarded = ['uuid'];

    public function tanzaniaRegion()
    {
        return $this->belongsTo(tanzaniaRegions::class,'region_found');
    }
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }

    public function localTourPackage()
    {
        return $this->belongsToMany(localTourPackages::class, 'local_package_reservation', 'tour_operator_reservation_id', 'local_tour_package_id');
    }

    public function tourOperatorReservationFacility()
    {
        return $this->hasMany(tourOperatorReservationFacility::class);
    }
    public function facilitySafariPreference()
    {
        return $this->belongsToMany(tourOperatorReservation::class,'reservation_attractions','tour_operator_reservation_id','touristic_attraction_id');
    }
    public function tourOperatorReservationTouristicGame()
    {
        return $this->belongsToMany(tourOperatorReservation::class,'reservation_touristic_game','tour_operator_reservation_id','touristic_game_id');
    }
    public function getReservationSafariAreaPreference(array $input,Model $tourOperatorReservations)
    {
        $reservationSafariAreaPreferencesArray=[];
        foreach($input as $key =>$value)
        {
            switch ($key)
            {
                case 'facility_safari_preference':
                    $reservationSafariAreaPreferencesArray=$value;
                    break;
            }
        }
        $tourOperatorReservations->facilitySafariPreference()->sync($reservationSafariAreaPreferencesArray);
    }
    public function getReservationSafariAreaPreferenceLabelAttribute()
    {
        $reservationSafariAreaPreferenceIds=DB::table('reservation_attractions')->where('tour_operator_reservation_id',$this->id)->pluck('touristic_attraction_id');
        $reservationSafariAreaPreferences=touristicAttractions::query()->whereIn('id',$reservationSafariAreaPreferenceIds)->get();
        $safaris=[];
        foreach($reservationSafariAreaPreferences as $reservationSafariAreaPreference)
        {
            $safaris[]=[
                'attraction_name'=>$reservationSafariAreaPreference->attraction_name,
                'attraction_description'=>$reservationSafariAreaPreference->attraction_description,
                'uuid'=>$reservationSafariAreaPreference->uuid,
            ];
        }
        return $safaris;
    }
    public function getTourOperatorReservationTouristicGame(array $input,Model $tourOperatorReservations)
    {
        $tourOperatorReservationTouristicGameArray=[];
        foreach ($input as $key =>$value)
        {
            switch ($key)
            {
                case 'touristic_game_deployed':
                    $tourOperatorReservationTouristicGameArray=$value;
                    break;
            }
        }
        $tourOperatorReservations->tourOperatorReservationTouristicGame()->sync($tourOperatorReservationTouristicGameArray);
    }
    public function getReservationTouristicGameLabelAttribute()
    {
        $reservationTouristicGameIds=DB::table('reservation_touristic_game')->where('tour_operator_reservation_id',$this->id)->pluck('touristic_game_id');
        $reservationTouristicGames=touristicGame::query()->whereIn('id',$reservationTouristicGameIds)->get();
        $games=[];
        foreach($reservationTouristicGames as $reservationTouristicGame)
        {
            $games[]=[
                'game_name'=>$reservationTouristicGame->game_name,
                'game_theme'=>$reservationTouristicGame->game_theme,
                'uuid'=>$reservationTouristicGame->uuid,
            ];
        }
        return $games;
    }

    public function saveReservationFacilities($input,$tourOperatorReservations)
    {
        $reservationFacilitiesRepo=new tourOperatorReservationFacilitiesRepository();
        $reservationFacilities=$reservationFacilitiesRepo->saveReservationFacilities($input,$tourOperatorReservations);
        return back()->with('reservationFacilities',$reservationFacilities);
    }
    public function updateReservationFacilities($input,$tourOperatorReservation)
    {
        $reservationFacilitiesRepo=new tourOperatorReservationFacilitiesRepository();
        $reservationFacilities=$reservationFacilitiesRepo->updateReservationFacilities($input,$tourOperatorReservation);
        return back()->with('reservationFacilities',$reservationFacilities);
    }
    public function getReservationStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-danger">Inactive</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Active</span>';
                break;
        }
    }
    public function getDeletedReservationStatusLabelAttribute()
    {
        return '<span class="badge badge-danger">Deleted</span>';
    }

    public function getButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                    <option value=''>Select &check;</option>
                    <option data-route='".route('tourOperatorReservation.view',$this->uuid)."' value='2'>View</option>
                    <option data-route='".route('tourOperatorReservation.edit',$this->uuid)."' value='2'>Edit</option>
                    <option data-route='".route('tourOperatorReservation.delete',$this->uuid)."' value='1'>Delete</option>
                </select>";
    }
    public function getDeletedReservationButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
                    <option value=''>Select &check;</option>
                    <option data-route='".route('tourOperatorReservation.viewDeletedReservation',$this->uuid)."' value='2'>View</option>
                    <option data-route='".route('tourOperatorReservation.restoreDeletedReservation',$this->uuid)."' value='2'>Restore</option>
                    <option data-route='".route('tourOperatorReservation.deletePermanently',$this->uuid)."' value='1'>Delete permanently</option>
                </select>";
    }

}
