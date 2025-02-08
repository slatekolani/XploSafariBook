<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Propaganistas\LaravelPhone\PhoneNumber;

class RegisterSystemUserRequest extends Request
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


        $basic = [
            'username' => 'required|string|max:191|unique:users',
            'phone' => 'required|unique:users|phone:TZ'  ,
            'email' => 'required|string|email|max:191|unique:users',
            'role_id' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ];



        return array_merge( $basic, $optional);
    }

    /**
     * @return array
     */
    public function sanitize()
    {
    // Start exceptions on trim
    $role = '';
    if (array_key_exists('role_id', request()->input())) {
        $role = trim(request()->input('role_id'));
    }

    // Trim with exception
    $input = array_map('trim', $this->except('role_id'));
    // Merge with exception
    $input['role_id'] = $role;
    // Lowercase the email
    if (isset($input['email'])) {
        $input['email'] = strtolower(trim($input['email']));
    }

    // Remove extra whitespace (if necessary for phone)
    // $input['phone'] = PhoneNumber::make($input['phone'], $input['country'])->formatE164();
    // Replace the input
    $this->replace($input);
    return $this->all();
}


}
