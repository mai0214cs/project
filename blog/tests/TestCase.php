<?php
use Illuminate\Support\Facades\Artisan;
class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://project.mdt.com';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        //putenv('DB_CONNECTION=mysql_test');
        
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
    /*public function setUp() {
        parent::setUp();
        Artisan::call('migrate');
    }
    public function tearDown() {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }*/
}
