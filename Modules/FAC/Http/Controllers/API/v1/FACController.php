<?php

namespace Modules\FAC\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Modules\FAC\Http\Requests\API\v1\Authorize;
use Modules\FAC\Http\Controllers\Controller as BaseController;

class FACController extends BaseController
{

	/**
	 * Sends authourization requests to FAC Authorize operation
	 * @method sendAuthorizeRequest
	 * @param Illuminate\Http\Request $request Request input 
	 */
	public function sendAuthorizeRequest(Request $request) {
    	return $this->validateRequest($request, new Authorize );
    }

	public function capture(Request $request) {
    	
    }

	public function authorizeCapture(Request $request) {
    	
    }

	public function refund(Request $request) {
    
    }
}
