<?php

namespace Modules\FAC\Http\Requests\API\v1;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Modules\FAC\Http\Requests\API\v1\Authorize as FormRequest;

class Recurring extends FormRequest
{
    public function rules() : array
    {
    	 return array_merge( parent::rules(), [
        	'billing_date' => 'required|date|after_or_equal:today', 
         	'how_many_times' => 'required|numeric',
        	'billing_cycle' => ['required',"max:1","alpha", function ($attribute, $value, $fail) {
            	if (!in_array( strtoupper($value), ["D","W","F","M","E","Q","Y"] )) {
                	$fail($attribute.' is invalid.');
            	}
        	}]
        ]);
    }
}
