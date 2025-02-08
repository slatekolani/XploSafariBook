<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Models\Auth\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function username()
    {
        return 'email';
    }

    protected function guard()
    {
        return Auth::guard('web');
    }


    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param $user
     * @return bool|null
     * @throws GeneralException
     */
    protected function authenticated(Request $request, $user)
    {
        if (! $user->isConfirmed())  {

            access()->logout();
            return redirect()->route('auth.verification', $user->uuid)->withFlashWarning(__('alert.auth.not_confirmed'));
        } 
        elseif (! $user->status == 1) {
            access()->logout();
            throw new GeneralException(__('exceptions.auth.deactivated'));
        }
        Auth::logoutOtherDevices($request->input('password'));
    }

    public function verification(User $user)
    {
        return view("auth/registered")
            ->with("user", $user);
    }

    public function showLoginForm()
    {
        return view('auth/login');
    }

}
