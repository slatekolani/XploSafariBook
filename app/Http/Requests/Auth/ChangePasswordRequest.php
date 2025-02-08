<?php

namespace App\Http\Requests\Auth;

use App\Exceptions\GeneralException;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ChangePasswordRequest extends Request
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
     * @throws GeneralException
     */
    public function rules()
    {
        $input = request()->all();
        $user = access()->user();
        $password_encrypted = $user->password;
        $old_password = $input['old_password'];

        if (Hash::check($old_password, $password_encrypted))
        {
            //pass match
        }else{
            throw new GeneralException(__('exceptions.auth.password.change_mismatch'));
        }

        /*new password mismatch confirmed*/
        if($input['password'] != $input['password_confirmation']){
            throw new GeneralException(__('exceptions.auth.password.new_mismatch'));
        }

        return [
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:8|confirmed',
        ];
    }


}
