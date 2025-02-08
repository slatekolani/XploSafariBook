<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 5/18/19
 * Time: 3:21 PM
 */

namespace App\Models\BaseModel\Traits\Attribute;


use Carbon\Carbon;

trait BaseModelAttribute
{
    public function getCreatedAtFormattedAttribute()
    {
        return short_date_format($this->created_at);
    }
}