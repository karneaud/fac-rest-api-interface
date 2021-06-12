<?php

namespace Modules\FAC\Services\API\v1;

use Omnipay\Omnipay;
use Omnipay\Common\Exception\InvalidResponseException;

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
    	return $this->__getResponse($this->gateway->purchase($params));
    }
	/**
	 * Sends authorize requests to FAC SOAP
	 * @method authorize
	 * @param array $params the necessary parameters to authorize credit card 
	 * @return array An array response or error description
	 */
	public function authorize(array $params) {
    	return $this->__getResponse($this->gateway->authorize($params));
    }                        
    /**
	 * Sends capture requests of previous authorized request to FAC SOAP
	 * @method capture
	 * @param array $params the necessary parameters to process order transaction of previous authorized request 
	 * @return array An array response or error description
	 */                       
    public function capture(array $params) {
    	return $this->__getResponse($this->gateway->capture($params));
    }  
    /**
	 * Sends authorize and then capture requests to FAC SOAP
	 * @method authorizeThenCapture
	 * @param array $params the necessary parameters to authorize credit card and then process order transaction
	 * @return array An array response or error description
	 */
    public function authorizeThenCapture(array $params) {
    	$response = $this->authorize($params);
    	if(!$response['success']) return $response;
    
       	$response = array_merge($response, $this->capture(array_only($params, ['amount','transactionId'])));
    	return $response;
    }                    
	/**
	 * Sends refund requests to FAC SOAP
	 * @method refund
	 * @param array $params the necessary parameters to refund a previous capture transaction 
	 * @return array An array response or error description
	 */
	public function refund(array $params) {
    	return $this->__getResponse($this->gateway->refund($params));
    }                        
	/**
	 * sends FAC request and parses response
	 * @method __getResponse
	 * @param Omnipay\Common\Message\MessageInterface $request Request class object to perform transactional request
	 * @return array Array Parsed response parameters
	 */ 
	protected function __getResponse($request) : array {
    	try {
        	$response = $request->send();
        	if(!$response->isSuccessful()) throw new InvalidResponseException("Invalid purchase {$response->getMessage()}", $response->getReasonCode());
        	
        	$response= [ 
            		  'success' => true,
                      'order_id' => $response->getTransactionId(),
                      'transaction_id' => $response->getTransactionReference(),
                      'token' => $response->getCardReference(),
            		  'code' => $response->getCode(),
            		  'message' => $response->getMessage()
                    ];
        } catch(\Exception $e) {
        	 $response =  
            	    [ 'success' => false,
                      'message' => $e->getMessage(),
                      'code' => $e->getCode(),
					  'order_id' => $request->getTransactionId(),
                      'transaction_id' =>  isset( $response )? $response->getTransactionReference() : null
                    ];
        }
    
    	return $response;
    }
}
