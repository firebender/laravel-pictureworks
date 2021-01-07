<?php

namespace FireBender\Laravel\PictureWorks\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use FireBender\Laravel\PictureWorks\Providers\PackageServiceProvider;
use FireBender\Laravel\PictureWorks\Database\Seeders\UserSeeder;

class TestCase extends OrchestraTestCase

{
    /**
     * 
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /**
     * Loads service providers
     *
     * @return array An array of service provider classes
     */
    protected function getPackageProviders($app)
    {
        return [PackageServiceProvider::class];
    }

    /**
     * Seeds the database with UserSeeder
     */
    protected function userSeeder()
    {
        $this->seed(UserSeeder::class);
    }

    /**
     * Convenience test to avoid 'No tests found in class "FireBender\Laravel\PictureWorks\Tests\TestCase" error'
     *
     * @test
     */
    public function dummy()
    {
        $this->assertTrue(true);
    }    

}