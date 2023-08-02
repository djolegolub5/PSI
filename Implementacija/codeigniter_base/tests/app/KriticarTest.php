<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use Config\App;
use Config\Services;
use Tests\Support\Libraries\ConfigReader;
use \App\Controllers\Kriticar;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\NaslovModel;

/**
 * @internal
 */
final class KriticarTest extends CIUnitTestCase
{
    
    use ControllerTestTrait;
    use DatabaseTestTrait;

    
    public function testKriticarPocetna(){
        session()->set('idKor',9);
        $results=$this->controller(\App\Controllers\Kriticar::class)->execute('pocetna');
        $this->assertTrue($results->see("Pretraga")); 
    }
    
    public function testKriticarPocetnaKriticarIstekao(){
        session()->set('idKor',24);
        $results=$this->controller(\App\Controllers\Kriticar::class)->execute('pocetna');
        $this->assertTrue($results->see("Pretraga")); 
    }

    
    public function testObjavaKomentara(){
        

        $ime = 'Avatar';
        $komentar = 'Djoletov komentar';
        $ocena = 7;
        $idNas = 2;

        session()->set('idKor',4); //korisnik Marija koja je kriticar..Moze i Djole on ima id = 4
        $results=$this->controller(\App\Controllers\Kriticar::class)->execute('naslov', ['ime'=>$ime]);
        $this->assertTrue($results->see("Pregled filma - ".$ime));

        
        $_REQUEST['komentar']= $komentar;
        $_REQUEST['zvezdice']= $ocena;
        

        
        $result=$this->controller(\App\Controllers\Kriticar::class)->execute('objavaKomentara',  $idNas);
        $results=$this->controller(\App\Controllers\Kriticar::class)->execute('naslov', ['ime'=>$ime]);
        $this->assertTrue($results->see($ime)); 
        $this->assertTrue($results->see($komentar)); 
        
    }


   
    


}
