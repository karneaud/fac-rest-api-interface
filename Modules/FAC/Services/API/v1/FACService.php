<?php

namespace Modules\FAC\Services\API\v1;

use Omnipay\Omnipay;
/**
 * Class FACService
 *
 * @OA\Schema(
 *     title="Successful Purchase Response",
 * 	   type="object",
 * 	   schema="SuccessPurchaseResponse",
 *     description="Formatted success response from FAC",
 * 	   @OA\Property(
 * 			property="order_id",
 * 			type="string",
 *     		format="string",
 *     		title="Order Id",
 *     		description="The order id of the purchase transaction"
 * 	   ),
 * 	   @OA\Property(
 * 			property="trasnsaction_id",
 * 			type="string",
 * 			format="string",
 *     		title="Transaction ID",
 *     		description="FAC Reference id of the transaction IF successful"
 * 	   ),
 * 	   @OA\Property(
 * 			property="success",
 * 			type="boolean",
 * 			format="boolean",
 *     		title="Success indicator",
 *     		description="True if the process was successful"
 * 	   ),
 * 	   @OA\Property(
 * 			property="token",
 * 			type="string",
 * 			format="string",
 *     		title="token PAN",
 *     		description="FAC credit card token PAN IF process was successful"
 * 	   )
 * )
 * @OA\Schema(
 *     title="Failed Purchase Response",
 * 	   type="object",
 * 	   schema="FailPurchaseResponse",
 *     description="Formatted error response from FAC",
 * 	   @OA\Property(
 * 			property="order_id",
 * 			type="string",
 *     		format="string",
 *     		title="Order Id",
 *     		description="The order id of the purchase transaction"
 * 	   ),
 * 	   @OA\Property(
 * 			property="trasnsaction_id",
 * 			type="string",
 * 			format="string",
 *     		title="Transaction ID",
 *     		description="Reference id of the transaction IF successful"
 * 	   ),
 * 	   @OA\Property(
 * 			property="error",
 * 			type="boolean",
 * 			format="boolean",
 *     		title="Error indicator",
 *     		description="True if the process was unsuccessful"
 * 	   ),
 * 	   @OA\Property(
 * 			property="message",
 * 			type="string",
 * 			format="string",
 *     		title="Error Message",
 *     		description="FAC reason message if the process was unsuccessful"
 * 	   ),
 * 	   @OA\Property(
 * 			property="code",
 * 			type="integer",
 * 			format="integer",
 *     		title="Error Code",
 *     		description="FAC Error reason code if the process was unsuccessful"
 * 	   )
 * )
 */
class FACService {
	
	protected $gateway;

	public function __construct(string $id, string $pwd, bool $avs = false, bool $test = false) {
    	$this->gateway = Omnipay::create('FirstAtlanticCommerce')->initialize([
        	'merchantId' => $id,
        	'merchantPassword' => $pwd,
        	'testMode' => $test,
        	'requireAvsCheck' => $avs
        ]);
    }
	/**
	 * Sends purchase requests to FAC SOAP
	 * @method purchase
	 * @param array $params the necessary parameters to make purchase 
	 * @return array An array response or error description
	 */
	public function purchase(array $params) {
    	$response = $this->gateway->purchase($params)->send();
    	if(!$response->isSuccessful()) 
           $response =  
            	    [ 'success' => false,
                      'message' => $response->getMessage(),
                      'code' => $response->getReasonCode(),
					  'order_id' => $response->getTransactionId(),
                      'transaction_id' => $response->getTransactionReference(),
                    ];
       else $response= [ 
            		  'success' => true,
                      'order_id' => $response->getTransactionId(),
                      'transaction_id' => $response->getTransactionReference(),
                      'token' => $response->getCardReference()
                    ];
    
    	return $response;
    }

	public function refund(Request $request) {
    	
    }
}
