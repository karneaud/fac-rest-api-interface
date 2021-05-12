<?php

namespace Modules\FAC\Tests\Unit\Http\Requests\API\v1;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\FAC\Http\Requests\API\v1\Authorize;

class AuthorizeTest extends TestCase
{
    protected $data = ['order_id' => 1, 
            			'amount' => 10.00, 
        				'currency' => "AUD",
        				'card' => 'A12901290',
        					'cvv' => 123, 
        				'expiry_month' => '02', 
        				'expiry_year' => '02'
                      ];
	/**
     * test invalid validation 
     *
     * @return void
     */
    public function testInValidRequests()
    {
        $request = new Authorize();
    	$validator = Validator::make($this->data, $request->rules());

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
    	$validator = Validator::make(array_merge($this->data, [
        	'currency' => 'TTD',
        	'card' => 12345678901234,
        	]), $request->rules());

    	$this->assertTrue($validator->passes(), "Validation failed " . print_r($validator->errors(), true ));
    }
}
