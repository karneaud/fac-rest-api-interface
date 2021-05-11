<?php

namespace Modules\FAC\Http\Requests\API\v1;

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
        return [
            'order_id' => "required", 
            'amount' => 'required|numeric', 
        	'currency' => ['required', function ($attribute, $value, $fail) {
            	if (!in_array( $value, ['TT', 'US', 'BB', 'JM' ] )) {
                	$fail($attribute.' is invalid.');
            	}
        	}],
        	'card' => 'required|numeric|min:13|max:18',
        	'cvv' => 'required|digits:3', 
        	'expiry_month' => 'required|digits:2', 
        	'expiry_year' => 'required|digits:2'
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
