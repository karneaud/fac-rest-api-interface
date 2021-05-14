<?php

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
	 * Will handle authorize/ capture scenarios
	 * @method purchase
	 * @param Illuminate\Http\Request $request the request parameters input
	 * @return \Illuminate\Http\JsonResponse
	 */ 
	public function purchase(Request $request) {
    	
    	$this->validateRequest($request, new Authorize);
    	return $this->returnResponse(
        	$this->service->purchase(
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
            	)
        );
    }
}