<?php

namespace Modules\FAC\Tests\Unit\Http\Controllers\API\v1;

use Http\Mock\Client;
use Modules\FAC\Http\Requests\API\v1\Authorize;
use Modules\FAC\Tests\Unit\UnitTestCase as TestCase;
use Modules\FAC\Http\Controllers\API\v1\FACController;

class FACControllerTest extends TestCase
{
    /**
     * Test valideRequest method ValidationException
     * @return void
     */
    public function testAuthorizeRequestValidateException()
    {
    	$this->expectException(\Illuminate\Validation\ValidationException::class);
    
        $mock = $this->getMockBuilder(FACController::class)
        				->setMethods(['validateRequest'])
        				->getMock();
    	$mock->expects($this->once())
                 ->method('validateRequest')
        		 ->will($this->throwException(new \Illuminate\Validation\ValidationException('Validation Exception') ));
    
    	$mock->purchase( new \Illuminate\Http\Request( $this->getAuthorizeRequestData() ), new Authorize);
    }
}
