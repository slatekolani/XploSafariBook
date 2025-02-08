<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
        return [
            'username' => 'required|string|max:191|min:2',
            'phone' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'captcha' => 'required|captcha',
            'role'=>'required',
            'term_check' => 'required',
        ];

        //return array_merge($check_identity,$basic);

    }

    /**
     * @return array
     */
    public function sanitize()
{
    $input = $this->all();

    // Check if 'email' exists before trying to access it
    if (isset($input['email'])) {
        $input['email'] = strtolower(trim($input['email']));
    }

    // Remove extra whitespace
    $this->replace($input);
    return $this->all();
}


}
