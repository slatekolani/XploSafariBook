<?php

namespace App\Repositories\touristicGames\gameComponents;

use App\Models\touristicGames\gameComponents\touristicGameComponent;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class touristicGameComponentRepository.
 */
class touristicGameComponentRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristicGameComponent::class;
    }
    public function storeTouristicGameComponent($input,$touristicGame)
    {
        foreach($input as $key =>$value)
        {
            if (str_contains($key,'component_description')!==false)
            {
                $key_id=substr($key,21);
                $touristicGameComponentArray=[
                    'game_component'=>$input['game_component'.$key_id],
                    'component_description'=>$input['component_description'.$key_id],
                    'touristic_game_id'=>$touristicGame->id,
                ];
                $touristicGameComponent=new touristicGameComponent();
                $touristicGameComponent->game_component=$touristicGameComponentArray['game_component'];
                $touristicGameComponent->component_description=$touristicGameComponentArray['component_description'];
                $touristicGameComponent->touristic_game_id=$touristicGameComponentArray['touristic_game_id'];
                $touristicGameComponent->save();
            }
        }
    }
    public function updateTouristicGameComponent($input,$touristicGame)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'component_description')!==false)
            {
                $key_id=substr($key,21);
                $touristicGameComponentArray=[
                    'game_component'=>$input['game_component'.$key_id],
                    'component_description'=>$input['component_description'.$key_id],
                    'touristic_game_id'=>$touristicGame->id,
                ];
                $touristicGameComponent=touristicGameComponent::query()->where('touristic_game_id',$touristicGame->id)->where('id',$key_id)->first();
                if ($touristicGameComponent)
                {
                    $touristicGameComponent->game_component=$input['game_component'.$key_id];
                    $touristicGameComponent->component_description=$input['component_description'.$key_id];
                    $touristicGameComponent->save();
                }
                else
                {
                    $touristicGameComponent=new touristicGameComponent();
                    $touristicGameComponent->game_component=$touristicGameComponentArray['game_component'];
                    $touristicGameComponent->component_description=$touristicGameComponentArray['component_description'];
                    $touristicGameComponent->touristic_game_id=$touristicGameComponentArray['touristic_game_id'];
                    $touristicGameComponent->save();
                }
            }
        }
    }
}
