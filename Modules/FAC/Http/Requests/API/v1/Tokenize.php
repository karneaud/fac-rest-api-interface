<?php

namespace Modules\FAC\Http\Requests\API\v1;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Modules\FAC\Http\Requests\AbstractFormRequest as FormRequest;

class Tokenize extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
    
    	return [
            'card' => 'numeric|digits_between:13,18',
        	'cvv' => 'required|digits:3', 
        	'expiry_month' => 'required|integer|digits_between:1,2', 
        	'expiry_year' => 'required|numeric|digits:4',
        	'card_holder'=> ['required','min:5',function ($attribute, $value, $fail) {
            	if (!((bool) preg_match('/[a-zA-z\-\ ]/', $value, $match))) {
                	$fail($attribute.' is invalid.');
            	}
        	}]
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
