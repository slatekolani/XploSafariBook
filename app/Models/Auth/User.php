<?php

namespace App\Models\Auth;

use App\Models\Auth\Attribute\UserAttribute;
use App\Models\Auth\Relationship\UserRelationship;
use App\Models\System\Relationship\GeneralDocumentRelationship;
use App\Models\TourOperator\customTourBookings\customTourBookings;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Webpatser\Uuid\Uuid;

/**
 * @property mixed confirmation_code
 */
class User extends Authenticatable implements  AuditableContract
{
    use Notifiable, UserAttribute, UserRelationship, Auditable, SoftDeletes , MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['uuid'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * @var array
     */
    protected $auditableEvents = [
        'deleted',
        'updated',
        'restored',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

    public function Role()
    {
        return $this->belongsToMany(Role::class);
    }

    public function customTourBookings()
    {
        return $this->hasMany(customTourBookings::class);
    }
    
    public function tourOperator()
    {
        return $this->hasMany(tourOperator::class);
    }
    public function TourPackages()
    {
        return $this->hasMany(TourPackages::class);
    }
    public function localTourPackageBookings()
    {
        return $this->hasMany(localTourPackageBookings::class);
    }
    
    public function sendEmailVerificationNotification()
    {
        $confirmationCode = $this->confirmation_code; 
        $username=$this->username;
        $this->notify(new \App\Notifications\Auth\SendConfirmationCode($confirmationCode,$username));
    }
    

    public function getUserRoleLabelAttribute()
    {
        $role=$this->role;
        switch($role)
        {
            case 1:
                return '<span class="badge badge-success">System Admin</span>';
                break;
                case 2:
                    return '<span class="badge badge-info">Tour Operator</span>';
                    break;
                    case 3:
                        return '<span class="badge badge-warning">Tourist</span>';
                        break;

        }
    }
    public function getUserStatusLabelAttribute()
    {
        if ($this->status == 1) {
            return "<span class='badge badge-pill badge-success' data-toggle='tooltip' data-html='true' title='" . trans('label.active') . "'>" . trans('label.active') . "</span>";
        } else {
            return "<span class='badge badge-pill badge-warning' data-toggle='tooltip' data-html='true' title='" . trans('label.inactive') . "'>" . trans('label.inactive') . "</span>";
        }
    }
    public function getUserActionButtonsLabelAttribute()
    {
        $btn='<a href="'.route('admin.user_manage.edit_system_user',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        return $btn;
    }
}
