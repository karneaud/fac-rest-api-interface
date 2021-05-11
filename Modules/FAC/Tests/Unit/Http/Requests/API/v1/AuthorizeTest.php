<?php

namespace Modules\FAC\Tests\Unit\Http\Requests\API\v1;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\FAC\Http\Requests\API\v1\Authorize;

class AuthorizeTest extends TestCase
{
    
	/**
     * A basic unit test example.
     *
     * @return void
     */
    public function testInValidRequests()
    {
        $request = new Authorize();
    	$validator = Validator::make([
        			'body' => "{ 'currency': '', 'card': '00' }",
    		], $request->rules());

    	$this->assertFalse($validator->passes());
    }
}
