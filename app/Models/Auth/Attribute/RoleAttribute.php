<?php

namespace App\Models\Auth\Attribute;

/**
 * Class RoleAttribute
 * @package App\Models\Access\Attribute
 */
trait RoleAttribute
{

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }




    /*Get Is Administrative label*/
    public function getIsAdminLabelAttribute()
    {
        if ($this->isAdmin()){
            return __('label.yes');
        }else {
            return  __('label.no');
        }
    }

    /*check if is administrative */
    public function isAdmin()
    {
        return $this->isadmin == 1;
    }

    /*Edit Button*/
    public function getEditButtonAttribute() {
        return '<a href="' . route('access.role.edit', $this->id) . '"  class="btn btn-xs btn-primary" ><i class="icon fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i>'.' '. trans('buttons.general.crud.edit').'</a> ';

    }

}