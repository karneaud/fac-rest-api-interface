<?php
namespace Modules\FAC\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Modules\FAC\Services\API\v1\FACService;
use Modules\FAC\Http\Requests\API\v1\Tokenize;
use Modules\FAC\Http\Requests\API\v1\Authorize;
use Modules\FAC\Http\Requests\API\v1\Recurring;
use Modules\FAC\Http\Controllers\Controller as BaseController;

class FACController extends BaseController
{
	/**
	 * @var Modules\FAC\Services\API\v1\FACService $service The FAC service class
	 */
	protected $service;

	public function __construct() {
    	$this->service = new FACService(
        				env('FAC_MERCHANT_ID','123456789'), 
        				env('FAC_MERCHANT_PASSWD','abc123'), 
        				false,
        				env('FAC_TEST_MODE', false));
    }
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
        				],
                     	'createCard' => $request->has('tokenize'),
                     	'cardReference' => $request->has('tokenized')? $request->input('card') : false
                   	])
            	)),
        	
        	!$response['success']? 400 : 200
        );
    }
	
	/** 
	 * Sends a authorize only request to FAC
	 * @method authorizeFAC
	 * @params Illuminate\Http\Request $request POST request inputs
	 * @return Illuminate\Http\JsonResponse $response response content as application/json
	 * @throws Illuminate\Validation\ValidationException
	 */ 
	public function authorizeFAC(Request $request) {
    	
    	$this->validateRequest($request, new Authorize);
    	return $this->returnResponse(
        	$response = ($this->service->authorize(
            	array_merge(
                	$request->only('card','amount','currency'), 
                	['transactionId' => $request->input('order_id'),
                     	'card' => [
        					'number' => $request->input('card'), 
        					'expiryMonth' => $request->input('expiry_month'), 
        					'expiryYear' => $request->input('expiry_year'),
        					'cvv' => $request->input('cvv'),
        				],
                     	'createCard' => $request->has('tokenize'),
                     	'cardReference' => $request->has('tokenized')? $request->input('card') : false
                   	]
                		)
            	)),
        	!$response['success']? 400 : 200
        );
    }
	/** 
	 * Sends a authorize recurring payment request to FAC
	 * @method recurring
	 * @params Illuminate\Http\Request $request POST request inputs
	 * @return Illuminate\Http\JsonResponse $response response content as application/json
	 * @throws Illuminate\Validation\ValidationException
	 */ 
	public function recurring(Request $request) {
    	
    	$this->validateRequest($request, new Recurring);
    	
    	switch(true)
        {
        	case $request->has('is_trial') :
        		$recurring_type = ['isFreeTrial' => true ]; break;
        	case $request->has('is_subsequent') :
        		$recurring_type = ['isSubsequentRecurring' => true ]; break;
        	default : $recurring_type = []; break;
        }
    
    	return $this->returnResponse(
        	$response = ($this->service->authorize(
            	array_merge(
                	$recurring_type,
                	$request->only('card','amount','currency'), 
                	['transactionId' => $request->input('order_id'),
                     	'card' => [
        					'number' => $request->input('card'), 
        					'expiryMonth' => $request->input('expiry_month'), 
        					'expiryYear' => $request->input('expiry_year'),
        					'cvv' => $request->input('cvv'),
        				],
                     	'executionDate' => $request->input('billing_date'),
                     	'isRecurring' => true,
                     	'frequency' => $request->input('billing_cycle'),
                     	'numberOfRecurrences' => $request->input('how_many_times'),
                     	'createCard' => $request->has('tokenize'),
                     	'cardReference' => $request->has('tokenized')? $request->input('card') : false
                   	])
            	)),
        	!$response['success']? 400 : 200
        );
    }
	/** 
	 * Sends a tokenize only request to FAC
	 * @method tokenize
	 * @params Illuminate\Http\Request $request POST request inputs
	 * @return Illuminate\Http\JsonResponse $response response content as application/json
	 * @throws Illuminate\Validation\ValidationException
	 */ 
	public function tokenize(Request $request) {
    	
    	$this->validateRequest($request, new Tokenize);
    	return $this->returnResponse(
        	$response = ($this->service->tokenize(
            	array_merge(
                		['customerReference' => $request->input('card_holder') ], 
                		['card' => [
        					'number' => $request->input('card'), 
        					'expiryMonth' => $request->input('expiry_month'), 
        					'expiryYear' => $request->input('expiry_year'),
        					'cvv' => $request->input('cvv')
        					]
                   		]
                		)
            	)),
        	!$response['success']? 400 : 200
        );
    }
	
	/** 
	 * Sends a refund request to FAC
	 * @method refund
	 * @params Illuminate\Http\Request $request POST request inputs
	 * @return Illuminate\Http\JsonResponse $response response content as application/json
	 * @throws Illuminate\Validation\ValidationException
	 */ 
	public function refund(Request $request) {
    	$this->validate($request, [
        	'order_id' => 'required|string',
        	'amount' => 'required|numeric'
        ]);
    
    	return $this->returnResponse(
        	$response = $this->service->refund(
                	[
                      'transactionId' => $request->input('order_id'),
                      'amount' => $request->input('amount') 	
                   	]
            	),
        	!$response['success']? 400 : 200
        );
    }

	/** 
	 * Sends a capture request to FAC
	 * @method capture
	 * @params Illuminate\Http\Request $request POST request inputs
	 * @return Illuminate\Http\JsonResponse $response response content as application/json
	 * @throws Illuminate\Validation\ValidationException
	 */ 
	public function capture(Request $request) {
    	$this->validate($request, [
        	'order_id' => 'required|string',
        	'amount' => 'required|numeric'
        ]);
    
    	return $this->returnResponse(
        	$response = $this->service->capture(
                	[
                      'transactionId' => $request->input('order_id'),
                      'amount' => $request->input('amount') 	
                   	]
            	),
        	!$response['success']? 400 : 200
        );
    }
	
}