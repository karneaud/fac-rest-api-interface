<?php

$auth = require config_path('auth.php');

return array_merge($auth['guards'], ['key' => 
                                     	[
                                        	'driver' => 'token',
                                        	'provider' => 'users',
                                        	'input_key' => null,
                                        	'storage_key' => 'api_key',
                                        	'hash' => false
                                        ]
                                    ]);