<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ConfirmAccountRequest;
use App\Jobs\Notifications\SendSms;
use App\Models\Auth\User;
use App\Models\Member\Company\Company;
use App\Notifications\Auth\SendConfirmationCode;
use App\Notifications\Auth\UserNeedsConfirmation;
use App\Repositories\Access\UserRepository;
use function Faker\Provider\pt_BR\check_digit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfirmAccountController extends Controller
{

    protected $user;

    /**
     * ConfirmAccountController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware('guest')->except('logout');
        $this->user = $user;
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function sendConfirmationEmail(User $user)
    {
        $user->notify(new UserNeedsConfirmation());
        return redirect()->back()->withFlashSuccess(trans('alert.auth.confirmation_sent'));
    }


    public function sendConfirmationSms(User $user)
    {
        $user->notify(new SendConfirmationCode());
        SendSms::dispatch($user->company()->first(), trans("strings.sms.confirmation_code").$user->confirmation_code);
        return redirect()->back()->withFlashSuccess(trans('alert.auth.confirmation_sms'));
    }


    /*Resend sms and email confirmation*/
    public function resendConfirmationNotifications(User $user)
    {
        /*resend email*/
        $user->notify(new UserNeedsConfirmation());
        /*Resend sms*/
        SendSms::dispatch($user, trans("strings.sms.registered").$user->confirmation_code);
        return redirect()->back()->withFlashSuccess(trans('alert.auth.resend_confirmation'));
    }


    /**
     * @param $token
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function confirm($token)
    {
        $this->user->confirmAccount($token);
        return redirect()->route('home')->withFlashSuccess(trans('exceptions.auth.confirmation.success'));
    }

    /*Confirm account registration using sms*/
    public  function smsConfirm(Request $request,User $user)
    {
        $code = $request->token;
        $token = $user->confirmation_code;
        if(strcmp($code,$token) == 0){
            $this->user->confirmAccount($token);
            return redirect()->route('home')->withFlashSuccess(__('exceptions.auth.confirmation.success'));
        }
        else{
            return redirect()->back()->withFlashDanger(trans('exceptions.auth.confirmation.mismatch'));
        }

    }
}
