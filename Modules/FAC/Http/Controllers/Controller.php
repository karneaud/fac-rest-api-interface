<?php

namespace Modules\FAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller as BaseController;
use Modules\FAC\Http\Requests\AbstractFormRequest as FormRequest;

class Controller extends BaseController
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
    	
    }
	/**
	 * Global function to authorize/ validate request inputs using FormRequest
	 * @param Illuminate\Http\Request $request Request input
	 * @param Modules\FAC\Http\Requests\AbstractFormRequest $rules Rules and authorization checks
	 * @throws Illuminate\Validation\ValidationException
     */
	protected function validateRequest(Request $request, FormRequest $rules ) {
    	$this->validate($request, $rules->rules());
    }
	/**
	 * Global response function that returns response json
	 * @param array $payload data to return as json
	 * @return \Illuminate\Http\JsonResponse
	 */ 
	protected function returnResponse(array $payload ) : \Illuminate\Http\JsonResponse {
    	return response()->json($payload);
    }
}
