<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Company\ChangePasswordRequest;
use App\Models\Auth\User;
use App\Notifications\Auth\ResetPasswordNotification;
use App\Notifications\Auth\UserNeedsPasswordReset;
use App\Repositories\Access\UserRepository;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

    }

    protected function redirectTo()
    {
        return '/';
    }

    protected function guard()
    {
        return Auth::guard('web');
    }


//    public function showResetForm()
//    {
//        return view('auth.passwords.email');
//    }

//    protected function rules()
//    {
//
//        return [
//            'email' => 'required|email:unique',
//        ];
//    }

//    public function resetForm($token)
//    {
//        $user = $this->user->getOneByUuid($token);
//        return view('auth.passwords.reset', [$token])->with('user', $user);
//    }



}
