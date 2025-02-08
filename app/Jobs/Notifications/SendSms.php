<?php

namespace App\Jobs\Notifications;

use App\Repositories\Notifications\SmsRepository;
use App\Services\Notifications\Sms;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    protected $user;

    /**
     * @var
     */
    protected $text;

    /**
     * Create a new job instance.
     *
     * SendSms constructor.
     * @param $user
     * @param $text
     */
    public function __construct($user, $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     *
     * @return void
     */
    public function handle()
    {
        $phone = str_replace("+", "", $this->user->phone);

        if (env("SEND_SMS", 0) == 1) {
            $sms = new Sms($phone, $this->text);
            $response = $sms->send();
            $text = new SmsRepository();
            $data = [
                'user_id' => $this->user->id,
                'msisdn' => $phone,
                'message' => $this->text,
                'status' => $response
            ];
            $text->query()->create($data);
        }
    }
}
