<?php

namespace App\Models\touristicGames\gameComponents;

use App\Models\BaseModel\BaseModel;
use App\Models\touristicGames\touristicGame;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class touristicGameComponent extends BaseModel
{
    use SoftDeletes;
    protected $table='touristic_game_components';
    protected $guarded=['uuid'];

    public function touristicGame()
    {
        return $this->belongsTo(touristicGame::class);
    }
}
