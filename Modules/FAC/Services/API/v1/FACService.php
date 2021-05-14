<?php

namespace Modules\FAC\Services\API\v1;

use Omnipay\Omnipay;

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
