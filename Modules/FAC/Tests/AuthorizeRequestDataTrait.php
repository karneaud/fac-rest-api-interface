<?php

namespace Modules\FAC\Tests;

trait AuthorizeRequestDataTrait {
	
	protected function getAuthorizeRequestData($data = null ) {
    	$defaults = ['order_id' => 1, 
            			'amount' => 10.00, 
        				'currency' => "AUD",
        				'card' => 'A12901290',
        				'cvv' => 123, 
        				'expiry_month' => 2, 
        				'expiry_year' => 2024
                      ];
    	if(!is_null($data)) $defaults = array_merge($defaults, $data ); 
    
    	return $defaults;
    }
}