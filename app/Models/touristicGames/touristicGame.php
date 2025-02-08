<?php

namespace App\Models\touristicGames;

use App\Models\BaseModel\BaseModel;
use App\Models\touristicGames\gameComponents\touristicGameComponent;
use App\Repositories\touristicGames\gameComponents\touristicGameComponentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class touristicGame extends BaseModel
{
    use SoftDeletes;
    protected $table='touristic_game';
    protected $guarded=['uuid'];

    public function touristicGameComponent()
    {
        return $this->hasMany(touristicGameComponent::class);
    }
    public function saveTouristicGameComponents($input,$touristicGame)
    {
        $touristicGameComponentsRepo=new touristicGameComponentRepository();
        $touristicGameComponent=$touristicGameComponentsRepo->storeTouristicGameComponent($input,$touristicGame);
        return back()->with('touristicGameComponent',$touristicGameComponent);
    }
    public function updateTouristicGameComponents($input,$touristicGame)
    {
        $touristicGameComponentsRepo=new touristicGameComponentRepository();
        $touristicGameComponent=$touristicGameComponentsRepo->updateTouristicGameComponent($input,$touristicGame);
        return back()->with('touristicGameComponent',$touristicGameComponent);
    }
    public function getGameStatusLabelAttribute()
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
    public function getButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('touristicGame.view',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('touristicGame.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('touristicGame.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }

}
