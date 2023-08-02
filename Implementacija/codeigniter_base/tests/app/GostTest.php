<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use Config\App;
use Config\Services;
use Tests\Support\Libraries\ConfigReader;
use \App\Controllers\Gost;
use CodeIgniter\Test\DatabaseTestTrait;

/**
 * @internal
 */
final class GostTest extends CIUnitTestCase
{
    
    use ControllerTestTrait;
    use DatabaseTestTrait;

    public function testGostPocetna(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('pocetna');
        $this->assertTrue($results->see("Morate biti ulogovani za detaljniji pregled naslova.")); 
    }
    
    public function testGostLogInKorisnikNePostoji(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('prijava');
        $this->assertTrue($results->see("Logovanje")); 

        $_REQUEST['username']='admin1234';
        $_REQUEST['password']='admin1234';
        $results=$this->controller(\App\Controllers\Gost::class)->execute('loginProvera');    
        //echo $_REQUEST['username'];
        $this->assertTrue($results->see("Korisnik ne postoji!")); 
    }
    
    public function testGostLogInPogresnaLozinka(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('prijava');
        $this->assertTrue($results->see("Logovanje")); 
        
        $_REQUEST['username']='admin';
        $_REQUEST['password']='admin1234';
        $results=$this->controller(\App\Controllers\Gost::class)->execute('loginProvera');
        //echo $results;
        //echo $_POST['username'];
        $this->assertTrue($results->see("Pogrešna lozinka!")); 

       

    }
    
    
    public function testGostLogInSuspendovan(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('prijava');
        $this->assertTrue($results->see("Logovanje")); 
        
        $_REQUEST['username']='makii<3';
        $_REQUEST['password']='makii123';
        $results=$this->controller(\App\Controllers\Gost::class)->execute('loginProvera');
        //echo $results;
        //echo $_POST['username'];
        $this->assertTrue($results->see("Nalog je suspendovan! Moći ćete da se ulogujete kad istekne period suspenzije...")); 

       

    }
    
    public function testGostLogInNeAutorizovan(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('prijava');
        $this->assertTrue($results->see("Logovanje")); 
        
        $_REQUEST['username']='lukalu';
        $_REQUEST['password']='luklu123';
        $results=$this->controller(\App\Controllers\Gost::class)->execute('loginProvera');
        //echo $results;
        //echo $_POST['username'];
        $this->assertTrue($results->see("Nalog jos uvek nije autorizovan!")); 

      
    }
    
    public function provide_login_data(){
        return [['admin','admin123'],['djole','djole123'],['akicar','akicar123']];
    }
    

    
    /**
     * 
     * @dataProvider provide_login_data
     */
    
    public function testGostLogIn($username,$password){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('prijava');
        $this->assertTrue($results->see("Logovanje")); 
        
        $_REQUEST['username']=$username;
        $_REQUEST['password']=$password;
        $results=$this->controller(\App\Controllers\Gost::class)->execute('loginProvera');

        $this->assertFalse($results->see("Logovanje")); 

      
    }
    
    public function provide_registration_data(){
        return [['djole','korime123','Kor','Ime','korime@etf.rs','+38163271688',date()],
            ['korime','','Kor','Ime','korime@etf.rs','+38163271688',date()],
            ['korime','korime123','','Ime','korime@etf.rs','+38163271688',date()],
            ['korime','korime123','Kor','','korime@etf.rs','+38163271688',date()],
            ['korime','korime123','Kor','Ime','','+38163271688',date()],
            ['korime','korime123','Kor','Ime','korime@etf.rs','',date()],
            ['korime','korime123','Kor','Ime','korime@etf.rs','+38163271688',]];
    }
    
    

    
    public function testRegistracijaUsernamePostoji(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('registracija');
        $this->assertTrue($results->see("Registracija"));
        
        $_REQUEST['username']='djole';
        $_REQUEST['lozinka']='djole123';
        $_REQUEST['ime']='Djordje';
        $_REQUEST['prezime']='Golubovic';
        $_REQUEST['mejl']='djg@etf.rs';
        $_REQUEST['telefon']='+38163271688';
        $_REQUEST['datum']=date('Y-m-d h:i:s a');
        
        $results=$this->controller(\App\Controllers\Gost::class)->execute('dodajNalog');
        $this->assertTrue($results->see("Korisničko ime već postoji!"));
        
       
        
    }
    
    public function testRegistracijaEmailPostoji(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('registracija');
        $this->assertTrue($results->see("Registracija"));
        
        $_REQUEST['username']='djole123';
        $_REQUEST['lozinka']='djole123';
        $_REQUEST['ime']='Djordje';
        $_REQUEST['prezime']='Golubovic';
        $_REQUEST['mejl']='djole@etf.bg.ac.rs';
        $_REQUEST['telefon']='+38163271688';
        $_REQUEST['datum']=date('Y-m-d h:i:s a');
        
        $results=$this->controller(\App\Controllers\Gost::class)->execute('dodajNalog');
        $this->assertTrue($results->see("Postoji korisnik sa datim mejlom!"));
        
       
        
    }
    
    public function testRegistracijaLozinkaNeispravanFormat(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('registracija');
        $this->assertTrue($results->see("Registracija"));
        
        $_REQUEST['username']='djole123';
        $_REQUEST['lozinka']='djole';
        $_REQUEST['ime']='Djordje';
        $_REQUEST['prezime']='Golubovic';
        $_REQUEST['mejl']='djole@etf.bg.ac';
        $_REQUEST['telefon']='+38163271688';
        $_REQUEST['datum']=date('Y-m-d h:i:s a');
        
        $results=$this->controller(\App\Controllers\Gost::class)->execute('dodajNalog');
        $this->assertTrue($results->see("Lozinka nije u ispravnom formatu!"));
        
       
        
    }
    
    public function testRegistracijaEmailNeispravanFormat(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('registracija');
        $this->assertTrue($results->see("Registracija"));
        
        $_REQUEST['username']='djole123';
        $_REQUEST['lozinka']='djole123';
        $_REQUEST['ime']='Djordje';
        $_REQUEST['prezime']='Golubovic';
        $_REQUEST['mejl']='djole';
        $_REQUEST['telefon']='+38163271688';
        $_REQUEST['datum']=date('Y-m-d h:i:s a');
        
        $results=$this->controller(\App\Controllers\Gost::class)->execute('dodajNalog');
        $this->assertTrue($results->see("Email nije u ispravnom formatu!"));
        
       
        
    }
    
        
    public function testRegistracijaTelefonNeispravanFormat(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('registracija');
        $this->assertTrue($results->see("Registracija"));
        
        $_REQUEST['username']='djole123';
        $_REQUEST['lozinka']='djole123';
        $_REQUEST['ime']='Djordje';
        $_REQUEST['prezime']='Golubovic';
        $_REQUEST['mejl']='djole@etf.bg.ac';
        $_REQUEST['telefon']='271688';
        $_REQUEST['datum']=date('Y-m-d h:i:s a');
        
        $results=$this->controller(\App\Controllers\Gost::class)->execute('dodajNalog');
        $this->assertTrue($results->see("Broj telefona nije u ispravnom formatu!"));
        
       
        
    }
    
    public function testRegistracija(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('registracija');
        $this->assertTrue($results->see("Registracija"));
        
        $_REQUEST['username']='djole12345';
        $_REQUEST['lozinka']='djole123';
        $_REQUEST['ime']='Djordje';
        $_REQUEST['prezime']='Golubovic';
        $_REQUEST['mejl']='djole@etf.bg.ac';
        $_REQUEST['telefon']='+381271688';
        $_REQUEST['datum']=date('Y-m-d h:i:s a');
        $_REQUEST['slika']='';
        
        $results=$this->controller(\App\Controllers\Gost::class)->execute('dodajNalog');
        $this->assertTrue($results->see("Uspesno ste se registrovali."));
    }
    
    public function testSuspenzijaIstekla(){
        $results=$this->controller(\App\Controllers\Gost::class)->execute('prijava');
        $this->assertTrue($results->see("Logovanje")); 
        
        $_REQUEST['username']= 'istekao';
        $_REQUEST['password']= 'sifra123';
        $results=$this->controller(\App\Controllers\Gost::class)->execute('loginProvera');

        $this->assertFalse($results->see("Logovanje"));
        
    }
    
    public function testOnama(){
        $results = $this->controller(\App\Controllers\Gost::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za Vas"));
        $results = $this->controller(\App\Controllers\Gost::class)->execute('onama');
        $this->assertTrue($results->see("Aleksa Trivić, 2020/0198"));
    }

}
