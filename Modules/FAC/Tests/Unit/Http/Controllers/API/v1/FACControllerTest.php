<?php

namespace Modules\FAC\Tests\Unit\Http\Controllers\API\v1;

use Modules\FAC\Tests\Unit\UnitTestCase as TestCase;
use Modules\FAC\Http\Controllers\API\v1\FACController;

class FACControllerTest extends TestCase
{
	protected $request;
	protected function setUp() :void {
    	$this->request = new \Illuminate\Http\Request($this->getAuthorizeRequestData());
    }
    /**
     * Test sendAuthorizeRequest method validation
     * @return void
     */
    public function testSendAuthorizeRequestValidateException()
    {
    	$this->expectException(\Illuminate\Validation\ValidationException::class);
    
        $mock = $this->getMockBuilder(FACController::class)
        				->setMethods(['validateRequest'])
        				->getMock();
    	$mock->expects($this->once())
                 ->method('validateRequest')
        		 ->will($this->throwException(new \Illuminate\Validation\ValidationException('Validation Exception') ));
    
    	$mock->sendAuthorizeRequest($this->request);
    }

	/**
     * Test sendAuthorizeRequest method validation
     * @return void
     */
    public function testSendAuthorizeRequestValidate()
    {
    	$controller = new FACController;
    	$this->assertTrue($controller->sendAuthorizeRequest( new \Illuminate\Http\Request($this->getAuthorizeRequestData(['currency' => 'USD', 'card' => '123456789098765' ])) ));
    	
    }
}
