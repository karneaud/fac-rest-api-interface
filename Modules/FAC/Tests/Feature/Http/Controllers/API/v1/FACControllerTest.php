<?php

namespace Modules\FAC\Tests\Feature\Http\Controllers\API\v1;

use Modules\FAC\Tests\AuthorizeRequestDataTrait;
use Modules\FAC\Tests\Feature\FeatureTestCase as TestCase;

class FACControllerTest extends TestCase
{
	use AuthorizeRequestDataTrait;

	public function setUp(): void {
    	parent::setUp();
    	$this->app->instance('middleware.disable', true);
    }
    /**
     * A basic feature test example.
     * 
     * @return void
     */
    public function testPurchase()
    {
    	
		 $this->json('POST', '/fac/api/v1/purchase', $this->getAuthorizeRequestData(
         												[ 'order_id' => $order_id = uniqid() ,'currency' => 'TTD', 'card' => '4111111111111111']))
             ->seeJson([
                'order_id' => $order_id,
             	'success' => true
             ]);
    }

	
}
