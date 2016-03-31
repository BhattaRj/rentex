<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResetPasswordRequest extends Request
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
          'data.password'        => 'required|alpha_num|min:8|max:15|same:confirmPassword',
          'data.confirmPassword' => 'required|alpha_num|min:8|max:15|same:password',
        ];
    }
}
