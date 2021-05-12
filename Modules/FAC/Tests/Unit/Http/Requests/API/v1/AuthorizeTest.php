<?php

namespace Modules\FAC\Tests\Unit\Http\Requests\API\v1;

use Illuminate\Support\Facades\Validator;
use Modules\FAC\Http\Requests\API\v1\Authorize;
use Modules\FAC\Tests\Unit\UnitTestCase as TestCase;

class AuthorizeTest extends TestCase
{
    
	/**
     * test invalid validation 
     *
     * @return void
     */
    public function testInValidRequests()
    {
        $request = new Authorize();
    	$validator = Validator::make($this->getAuthorizeRequestData(), $request->rules());

    	$this->assertFalse($validator->passes());
    	$this->assertContains('card', $arr = $validator->errors()->keys(), "Card was not validated " . join("<br/>", $arr));
    	$this->assertContains('currency', $arr = $validator->errors()->keys(), "Currency was not validated " . join("<br/>", $arr) );
    }

	/**
     * test valid validation 
     *
     * @return void
     */
    public function testValidRequests()
    {
        $request = new Authorize();
    	$validator = Validator::make($this->getAuthorizeRequestData([
        	'currency' => 'TTD',
        	'card' => 12345678901234,
        	]), $request->rules());

    	$this->assertTrue($validator->passes(), "Validation failed " . print_r($validator->errors(), true ));
    }
}
