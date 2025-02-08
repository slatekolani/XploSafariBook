<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 5/4/19
 * Time: 11:12 AM
 */

namespace App\Models\BaseModel;


use App\Models\BaseModel\Traits\Attribute\BaseModelAttribute;
use App\Models\BaseModel\Traits\Relationship\BaseModelRelationship;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use Webpatser\Uuid\Uuid;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class BaseModel extends Model implements AuditableContract
{
    use BaseModelAttribute, BaseModelRelationship, Auditable;
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected $auditableEvents = [
        'deleted',
        'updated',
        'restored',
        'created'
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


}
