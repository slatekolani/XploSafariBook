<?php

namespace App\Http\Requests\Auth;

use function Faker\Provider\pt_BR\check_digit;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed confirmation_code
 */
class ConfirmAccountRequest extends FormRequest
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
            'confirmation_code' => 'required|min:6',
        ];
    }

    /**
     * @param $validator
     */
//    public function withValidator($validator)
//    {
//        $validator->after( function ($validator){
//
//            if (strcmp($this->confirmation_code , $this->user()->confrimation_code) != 0){
//                $validator->errors()->add('confirmation_code', 'The Confirmation Code you entered is not correct');
//            }
//
//        });
//        return;
//    }
}
