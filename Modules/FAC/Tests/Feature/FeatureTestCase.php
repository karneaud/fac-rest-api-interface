<?php

namespace Modules\FAC\Tests\Feature;

use Laravel\Lumen\Testing\TestCase;

class FeatureTestCase extends TestCase {
	/**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../../../../bootstrap/app.php';
    }
}