<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\PhoneNumber;

class UpdateSystemUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();
        $basic  = [];
        $optional = [];// Fields which exist
        $array = [];
        $user_id = $input['user_id'];
        $country = 'TZ';

        $basic = [
            'username' => ['required', 'string','max:191',
                Rule::unique('users')->where(function ($query) use($user_id)  {
                    $query->where('id','<>', $user_id);
                })
            ],
            'phone' => ['required', 'phone:' . $country,
                Rule::unique('users')->where(function ($query) use($user_id)  {
                    $query->where('id','<>', $user_id);
                })
            ],
            'email' => ['required','email', 'string','max:191',
                Rule::unique('users')->where(function ($query) use($user_id)  {
                    $query->where('id','<>', $user_id);
                })
            ],
            'role_id' => 'required',
        ];



        return array_merge( $basic, $optional);
    }

    /**
     * @return array
     */
    public function sanitize()
    {

        /*start exceptions on trim*/
        /*roles*/
        $roles = [];
        if(array_key_exists('roles', request()->input())){
            $roles = [ 'roles' => request()->input('roles')];
        }
        /*trim with exception*/
        $input = array_map('trim', $this->except( 'roles'));
        /*merge with exception*/
        $input= array_merge($roles,$input);
        /*end exception*/
        $input['email'] = strtolower(trim($input['email']));

//        $input['phone'] = PhoneNumber::make($input['phone'], $input['country'])->formatE164();
        $this->replace($input);
        return $this->all();

    }

    // Array of roles
//     public function sanitize()
// {
//     /* Start exceptions on trim */
//     /* roles */
//     $roles = [];
//     if (array_key_exists('roles', request()->input())) {
//         $roles = ['roles' => request()->input('roles')];
//     }

//     /* Trim with exception */
//     $input = $this->except('roles');
//     $input = array_map(function ($value) {
//         return is_string($value) ? trim($value) : $value;
//     }, $input);

//     /* Merge with exception */
//     $input = array_merge($roles, $input);

//     /* End exception */
//     if (isset($input['email'])) {
//         $input['email'] = strtolower(trim($input['email']));
//     }

//     // $input['phone'] = PhoneNumber::make($input['phone'], $input['country'])->formatE164();
//     $this->replace($input);
//     return $this->all();
// }

}
