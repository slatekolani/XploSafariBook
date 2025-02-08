<?php

namespace App\Models\platformFaq;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class platformFaq extends BaseModel
{
    use SoftDeletes;
    protected $table='platform_faq';
    protected $guarded=['uuid'];

    public function getQuestionStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-info">Inactive</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Active</span>';
                break;
            default:
                return '<span class="badge badge-info">Inactive</span>';
                break;
        }
    }
    public function getButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('platformFaq.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('platformFaq.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
