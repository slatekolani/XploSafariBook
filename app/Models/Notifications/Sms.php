<?php

namespace App\Models\Notifications;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sms';

    protected $guarded = [];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
