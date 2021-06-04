<?php

namespace Modules\FAC\Http\Requests\API\v1;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Modules\FAC\Http\Requests\AbstractFormRequest as FormRequest;

class Authorize extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
    
    	Validator::extend('card_number', function ($attribute, $value, $parameters, $validator) {
           		if(! array_key_exists('tokenized', $validator->getData()) && ((Validator::make([
                    'card_number' => $value
                    ],['card_number' => 'numeric|digits_between:13,18']))->fails() ) )
                    return false;
        
                return true;
        });
    
        return [
            'order_id' => "required", 
            'amount' => 'required|numeric', 
        	'currency' => ['required', function ($attribute, $value, $fail) {
            	if (!in_array( $value, ['TTD', 'USD', 'BBD', 'JMD' ] )) {
                	$fail($attribute.' is invalid.');
            	}
        	}],
        	'card' => 'required|card_number',
        	'tokenized' => 'boolean',
        	'cvv' => 'required|digits:3', 
        	'expiry_month' => 'required|integer|digits_between:1,2', 
        	'expiry_year' => 'required|numeric|digits:4'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }
}
