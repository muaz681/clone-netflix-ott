<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
        $rules =  [
            'payment_type' => ['required'],
            'i_agree' => ['required']
        ];

        return $rules;
    }


    public function messages()
    {

        return [
            'payment_type.required' => 'Please select a payment type',
            'i_agree.required' => 'You have  to agree to our Terms and Conditions, Privacy Policy, Return & Refund.',

        ];
    }
}
