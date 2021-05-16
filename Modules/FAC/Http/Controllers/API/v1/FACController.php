<?php
/**
 * @OA\Info(
 *     version="1.0",
 *     title="FAC Interface Platform endpoints"
 * )
 */
namespace Modules\FAC\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Modules\FAC\Services\API\v1\FACService;
use Modules\FAC\Http\Requests\API\v1\Authorize;
use Modules\FAC\Http\Controllers\Controller as BaseController;

class FACController extends BaseController
{
	protected $service;

	public function __construct() {
    	$this->service = new FACService(
        				env('FAC_MERCHANT_ID','123456789'), 
        				env('FAC_MERCHANT_PASSWD','abc123'), 
        				false,
        				env('FAC_TEST_MODE', false));
    }
	/**
 	 * @OA\Post(
	 *     path="/fac/api/v1/purchase",
	 *     description="make a purchase request",
     *     operationId="purchase",
 	 *	   @OA\RequestBody(
     *		   description="post request parameters for purchase",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/PurchaseRequest")
     *         )
     *     ),
	 *     @OA\Response(
	 * 		response="200",
	 * 		description="Successful purchase",
	 * 		@OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/SuccessPurchaseResponse")
	 * 		)
	 *    ),
	 *     @OA\Response(
	 * 		response="503",
	 * 		description="Unsuccessful purchase",
	 * 		@OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/FailPurchaseResponse")
	 * 		)
	 *    ),
	 *     @OA\Response(
	 * 		response="422",
	 * 		description="Validation Error Response",
	 * 		@OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     * 					type="object",
     * 					title="Validation Error Response Object",
     * 					@OA\Property( property="error", type="string", format="string", description="validation error message")
     * 				)
	 * 		)
	 *    )
	 * )
 	 */
	/** 
	 * Sends a one pass transaction request to FAC
	 * @method purchase
	 * @params Illuminate\Http\Request $request POST request inputs
	 * @return Illuminate\Http\JsonResponse $response response content as application/json
	 * @throws Illuminate\Validation\ValidationException
	 */ 
	public function purchase(Request $request) {
    	
    	$this->validateRequest($request, new Authorize);
    	return $this->returnResponse(
        	$response = ($this->service->purchase(
            	array_merge(
                	$request->only('card','amount','currency'), 
                	['transactionId' => $request->input('order_id'),
                     	'card' => [
        					'number' => $request->input('card'), 
        					'expiryMonth' => $request->input('expiry_month'), 
        					'expiryYear' => $request->input('expiry_year'),
        					'cvv' => $request->input('cvv'),
        				]
                   	]
                		)
            	)),
        	array_key_exists('error', $response)? 503 : 200
        );
    }
}