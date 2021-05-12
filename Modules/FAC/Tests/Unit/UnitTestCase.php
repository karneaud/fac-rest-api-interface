<?php

namespace Modules\FAC\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class UnitTestCase extends TestCase {

	protected function getAuthorizeRequestData($data = null ) {
    	$defaults = ['order_id' => 1, 
            			'amount' => 10.00, 
        				'currency' => "AUD",
        				'card' => 'A12901290',
        				'cvv' => 123, 
        				'expiry_month' => '02', 
        				'expiry_year' => '02'
                      ];
    	if(!is_null($data)) $defaults = array_merge($defaults, $data ); 
    
    	return $defaults;
    }
}