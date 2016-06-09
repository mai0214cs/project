<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApplicationTest extends TestCase
{
    public function testFormExample()
    {
        //$this->withoutMiddleware();
        $this->visit('/example')
                ->check('Checkdata')
                ->type('Tieu de','title')
                ->press('Nut Xac nhan');   
                //->press(Xactrans('admin.buttonAdd'));
        /*    ->type('', 'title')
            ->select(0,'id_page')  
            ->type('','description')
            ->press('Add');*/
            //->seePageIs('/dashboard');
    }
    
    public function testJSONData(){
        $this->visit('/example/create')>seeJsonStructure([
                 'name',
                 'age'
             ]);
    }
    
}
