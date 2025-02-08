<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Member\Company\CompanyRegistrationRequest;
use App\Http\Requests\Request;
use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Models\Member\Company\Company;
use App\Repositories\Access\UserRepository;
use App\Repositories\System\DocumentRepository;
use App\Rules\Member\Company\UniqueMobileNumber;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = '/';

    protected $user;


    /**
     * Create a new controller instance.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware('guest');
        $this->user = $user;
    }

    /**
     * Create a new user instance after a valid registration.
     * @param array $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    protected function create(array $data)
    {
        return User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

    }

//    /**
//     * Show the application registration form.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function showRegistrationForm()
//    {
//        $document_repo = new DocumentRepository();
//        $company_documents = $document_repo->getDocumentsByGroupFilter([1]);
//        $director_documents = $document_repo->getDocumentsByGroupFilter([5]);
//        return view('auth.register',compact('company_documents','director_documents'));
//    }


    /**
     * Registering Contact Person
     * @param CompanyRegistrationRequest $request
     * @return
     * @throws \App\Exceptions\GeneralException
     */

    protected function register(RegisterRequest $request)
    {
        $user = $this->user->create($request->all());
        if ($user->role==2)
        {
            $user->role()->sync([2]);
        }
        else if ($user->role==3)
        {
            $user->role()->sync([3]);
        }
        $user->sendEmailVerificationNotification();
        return redirect()->route('auth.registered', $user->uuid)->withFlashSuccess(__('We sent a verification link to your email. Please check it out!'));

    }

    /**
     * Show the application registered form.
     *
     * @param User $user
     * @param Company $company
     * @return $this
     */

    public function showRegisteredForm(User $user)
    {
        return view("auth/registered")
            ->with("user", $user);
    }



    public function userAgreement()
    {
        return view('stakeholder.user_agreement');
    }



}
