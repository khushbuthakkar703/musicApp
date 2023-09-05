<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRegisterRequest extends FormRequest
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
            'fname' => 'required',
            'lname' => 'required',
            'campaignname' => 'required',
            'city' => 'required',
            'username' => 'required',
            'password' => 'required',
            'street' => 'required',
            'zipcode' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'First name is required!',
            'lname.required' => 'Last Name is required!',
            'campaignname.required' => 'campaignname is required!'
        ];
    }
}
