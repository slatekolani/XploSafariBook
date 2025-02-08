<?php

namespace App\Repositories\touristicGames;

use App\Models\touristicGames\touristicGame;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class touristicGamesRepository.
 */
class touristicGamesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristicGame::class;
    }
    public function storeTouristicGame($input)
    {
        $touristicGame=new touristicGame();
        $touristicGame->game_name=$input['game_name'];
        $touristicGame->game_category=$input['game_category'];
        $touristicGame->game_theme=$input['game_theme'];
        $touristicGame->total_players=$input['total_players'];
        $touristicGame->age=$input['age'];
        $touristicGame->tutorial_directory_link=$input['tutorial_directory_link'];
        $touristicGame->game_price=$input['game_price'];
        $touristicGame->mode_of_play=$input['mode_of_play'];
        $touristicGame->development_inspiration=$input['development_inspiration'];
        if ($input['game_images'] && is_array(['game_images']))
        {
            $imagePaths=[];
            foreach($input['game_images'] as $images)
            {
                $extension=$images->getClientOriginalExtension();
                $filename=time().'_'.uniqid().'.'.$extension;
                $images->move('public/touristicGames/',$filename);
                $imagePaths[]='/touristicGames/'.$filename;
            }
            $touristicGame->game_images=implode(',',$imagePaths);
        }
        $touristicGame->save();
        $touristicGame->saveTouristicGameComponents($input,$touristicGame);
    }
    public function updateTouristicGames($input, $touristicGameUuid,$request)
    {
        $touristicGame=touristicGame::query()->where('uuid',$touristicGameUuid)->first();
        $touristicGame->game_name=$input['game_name'];
        $touristicGame->game_category=$input['game_category'];
        $touristicGame->game_theme=$input['game_theme'];
        $touristicGame->total_players=$input['total_players'];
        $touristicGame->age=$input['age'];
        $touristicGame->tutorial_directory_link=$input['tutorial_directory_link'];
        $touristicGame->game_price=$input['game_price'];
        $touristicGame->mode_of_play=$input['mode_of_play'];
        $touristicGame->development_inspiration=$input['development_inspiration'];
        $input=$request->all();
        if ($request->hasFile('game_images') && is_array(['game_images']))
        {
            $imagePaths=[];
            foreach($input['game_images'] as $images)
            {
                $extension=$images->getClientOriginalExtension();
                $filename=time().'_'.uniqid().'.'.$extension;
                $images->move('public/touristicGames/',$filename);
                $imagePaths[]='/touristicGames/'.$filename;
            }
            $touristicGame->game_images=implode(',',$imagePaths);
        }
        $touristicGame->save();
        $touristicGame->updateTouristicGameComponents($input,$touristicGame);
    }
}
