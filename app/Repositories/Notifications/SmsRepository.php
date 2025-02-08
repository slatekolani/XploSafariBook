<?php

namespace App\Repositories\Notifications;

use App\Models\Notifications\Sms;
use App\Repositories\BaseRepository;

class SmsRepository extends BaseRepository
{
    const MODEL = Sms::class;
}
