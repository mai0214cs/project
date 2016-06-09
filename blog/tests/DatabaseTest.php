<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DatabaseTest extends TestCase
{
    
    
    
    public function testExample()
    {
        $this->seeInDatabase('users', ['email'=>'mai0214cs@gmail.com']);
        //$this->assertTrue(true);
    }
}
