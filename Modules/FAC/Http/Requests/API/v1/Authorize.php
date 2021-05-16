<?php

namespace Modules\FAC\Http\Requests\API\v1;

use Modules\FAC\Http\Requests\AbstractFormRequest as FormRequest;
/**
 * Class Authorize
 *
 * @OA\Schema(
 * 	   schema="PurchaseRequest",
 *     title="Purchase Request",
 * 	   required={"order_id,currency,amount,cvv,card"},
 *	   type="object",
 *     description="POST request parameters and validation constraints",
 * 	   @OA\Property(
 * 			property="order_id",
 * 			type="string",
 *     		format="string",
 *     		title="Order Id",
 *     		description="The order id of the purchase transaction"
 * 	   ),
 * 	   @OA\Property(
 * 			property="currency",
 * 			type="string",
 * 			format="string",
 *     		pattern="\w{3}",
 *     		title="Currency",
 *     		description="The 3 letter ISO country currency code for the amount"
 * 	   ),
 * 	   @OA\Property(
 * 			property="amount",
 * 			type="number",
 * 			format="float",
 *     		title="Amount",
 *     		description="The amount total of the order"
 * 	   ),
 * 	   @OA\Property(
 * 			property="card",
 * 			type="string",
 * 			format="string",
 *     		pattern="\d{13,18}",
 *     		title="Card Number",
 *     		description="The credit card # to use to process payment"
 * 	   ),
 * 	   @OA\Property(
 * 			property="cvv",
 * 			type="integer",
 * 			format="integer",
 *     		pattern="\d{3}",
 *     		title="CCV",
 *     		description="The 3 digit security code for the credit card"
 * 	   ),
 * 	   @OA\Property(
 * 			property="expiry_month",
 * 			type="integer",
 * 			format="integer",
 *     		pattern="\d{1,2}",
 *     		title="Expiry Month",
 *     		description="The expiration month on the credit card"
 * 	   ),
 * 	   @OA\Property(
 * 			property="expiry_year",
 * 			type="integer",
 * 			format="integer",
 *     		pattern="\d{4}",
 *     		title="Expiry Year",
 *     		description="The expiration year on the credit card"
 * 	   )
 * )
 */
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
            	if (!in_array( $value, ['TTD', 'USD', 'BBD', 'JMD' ] )) {
                	$fail($attribute.' is invalid.');
            	}
        	}],
        	'card' => 'required|numeric|digits_between:13,18',
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
