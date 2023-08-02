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
final class RegistrovanTest extends CIUnitTestCase
{
    
    use ControllerTestTrait;
    use DatabaseTestTrait;

    public function testAnketa(){
      
        session()->set('idKor', 10);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('anketa');
        $this->assertTrue($results->see("Popuni anketu."));
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('zavrsena_anketa', 10);
        $this->assertTrue($results->see("Preporučujemo za vas"));
    }
    
    public function testKvizUspesno(){
        //session_start();
        session()->set('idKor', 10);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('izaberiKviz');
        $this->assertTrue($results->see("Izaberite kviz"));
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('kviz', ['vrsta' => 'Domaci']);
        $this->assertTrue($results->see("Informacije o kvizu:"));
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('prikaz_kviza', 11);
        $this->assertTrue($results->see("Domaća kinematografija"));
        $_REQUEST['28']='51';
        $_REQUEST['29']=['54'];
        $_REQUEST['30']='58';
        $_REQUEST['31']='59';
        $_REQUEST['32']='60';
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('popunjen_kviz', 11);
        $this->assertTrue($results->see("Broj bodova:"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
    }
    
    public function testKvizNeuspesno(){
        //session_start();
        session()->set('idKor', 10);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('izaberiKviz');
        $this->assertTrue($results->see("Izaberite kviz"));
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('kviz', ['vrsta' => 'Strani']);
        $this->assertTrue($results->see("Rezultati pretrage:"));
    }
    
    public function testKupovinaNaslova1(){
        session()->set('idKor', 10);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('naslov', ['ime' => 'Ceca show']);
        $this->assertTrue($results->see("Ceca show (2022)"));
        $_REQUEST['zelja']='kupi';
        $_REQUEST['placanje']='novac';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('transakcija', 5);
        $this->assertTrue($results->see("Transakcija je obavljena uspešno."));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
    }
    
    public function testKupovinaNaslova2(){
        session()->set('idKor', 10);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('naslov', ['ime' => 'Jaws']);
        $this->assertTrue($results->see("Jaws"));
        $_REQUEST['zelja']='kupi';
        $_REQUEST['placanje']='poeni';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('transakcija', 6);
        $this->assertTrue($results->see("Transakcija je obavljena uspešno."));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
    }
    
    public function testIznajmljivanjeNaslova1(){
        session()->set('idKor', 10);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('naslov', ['ime' => 'Friends']);
        $this->assertTrue($results->see("Friends"));
        $_REQUEST['zelja']='iznajmi';
        $_REQUEST['placanje']='novac';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('transakcija', 7);
        $this->assertTrue($results->see("Transakcija je obavljena uspešno."));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
    }
    
    public function testIznajmljivanjeNaslova2(){
        session()->set('idKor', 10);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('naslov', ['ime' => 'Avatar']);
        $this->assertTrue($results->see("Avatar"));
        $_REQUEST['zelja']='iznajmi';
        $_REQUEST['placanje']='poeni';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('transakcija', 2);
        $this->assertTrue($results->see("Transakcija je obavljena uspešno."));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
    }
    
    public function testKupovinaPostojecegNaslova(){
        session()->set('idKor', 10);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('naslov', ['ime' => 'Ceca show']);
        $this->assertFalse($results->see("Kupi"));
    }
    
    public function testKupovinaNaslovaNeuspesna1(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('naslov', ['ime' => 'Avatar']);
        $this->assertTrue($results->see("Avatar"));
        $_REQUEST['zelja']='kupi';
        $_REQUEST['placanje']='novac';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('transakcija', 2);
        $this->assertTrue($results->see("Neuspešna transakcija. Nemate dovoljno sredstava na računu."));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
    }
    
    public function testKupovinaNaslovaNeuspesna2(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('naslov', ['ime' => 'Avatar']);
        $this->assertTrue($results->see("Avatar"));
        $_REQUEST['zelja']='kupi';
        $_REQUEST['placanje']='poeni';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('transakcija', 2);
        $this->assertTrue($results->see("Neuspešna transakcija. Nemate dovoljno sredstava na računu."));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
    }
    
    public function testIznajmljivanjeNaslovaNeuspesno1(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('naslov', ['ime' => 'Avatar']);
        $this->assertTrue($results->see("Avatar"));
        $_REQUEST['zelja']='iznajmi';
        $_REQUEST['placanje']='novac';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('transakcija', 2);
        $this->assertTrue($results->see("Neuspešna transakcija. Nemate dovoljno sredstava na računu."));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
    }
    
    public function testIznajmljivanjeNaslovaNeuspesno2(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('naslov', ['ime' => 'Avatar']);
        $this->assertTrue($results->see("Avatar"));
        $_REQUEST['zelja']='iznajmi';
        $_REQUEST['placanje']='poeni';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('transakcija', 2);
        $this->assertTrue($results->see("Neuspešna transakcija. Nemate dovoljno sredstava na računu."));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
    }
    
    public function testIzmenaProfilaObicniPodaci(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
        $_REQUEST['ime']='Stefi';
        $_REQUEST['prezime']='Curovic';
        $_REQUEST['email']='stefic@etf.rs';
        $_REQUEST['telefon']='+381632584791';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('promena');
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
    }
    
    public function testIzmenaProfilaUsernameUspesno(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
        $_REQUEST['username']='stefi';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('promena');
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("stefi"));
    }
    
    public function testIzmenaProfilaUsernameNeuspesno(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
        $_REQUEST['username']='akicar';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('promena');
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("stefi"));
    }
    
    // stara, nova, ponovo
    public function testIzmenaProfilaLozinkaNeuspesno1(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
        $_REQUEST['username']= null;
        $_REQUEST['stara']='stefan123';
        $_REQUEST['nova']='stef123';
        $_REQUEST['ponovo']='stef123';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('promena');
        $this->assertTrue($results->see("Nova lozinka nije u odgovarajućem formatu!"));
    }
    
    public function testIzmenaProfilaLozinkaNeuspesno2(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
        $_REQUEST['username']= null;
        $_REQUEST['stara']='stefan123';
        $_REQUEST['nova']='steficar';
        $_REQUEST['ponovo']='steficar';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('promena');
        $this->assertTrue($results->see("Nova lozinka nije u odgovarajućem formatu!"));
    }
    
    public function testIzmenaProfilaLozinkaNeuspesno3(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
        $_REQUEST['username']= null;
        $_REQUEST['stara']='stefan123';
        $_REQUEST['nova']='12345678';
        $_REQUEST['ponovo']='12345678';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('promena');
        $this->assertTrue($results->see("Nova lozinka nije u odgovarajućem formatu!"));
    }
    
    public function testIzmenaProfilaLozinkaNeuspesno4(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
        $_REQUEST['username']= null;
        $_REQUEST['stara']='stefan123';
        $_REQUEST['nova']='stefi123';
        $_REQUEST['ponovo']='stefx123';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('promena');
        $this->assertTrue($results->see("Ponovljena lozinka nije ista kao nova!"));
    }
    
    public function testIzmenaProfilaLozinkaUspesno(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
        $_REQUEST['username']= null;
        $_REQUEST['stara']='stefan123';
        $_REQUEST['nova']='stefi123';
        $_REQUEST['ponovo']='stefi123';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('promena');

        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
    }
    
    public function testIzmenaProfilaLozinkaNeuspesno5(){
        session()->set('idKor', 13);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
        $_REQUEST['username']= null;
        $_REQUEST['stara']='stefa123';
        $_REQUEST['nova']='stefi123';
        $_REQUEST['ponovo']='stefi123';
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('promena');
        $this->assertTrue($results->see("Stara lozinka nije dobro uneta!"));
    }
    
    public function testBrisanjeProfila(){
        session()->set('idKor', 18);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('podesavanja');
        $this->assertTrue($results->see("Podešavanja"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('brisanje');
        $this->assertTrue($results->see("Profil je uspešno obrisan."));
    }
    
    public function testPregledNaslovaKat() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 4);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');

 

        $this->assertTrue($results->see("Preporučujemo za vas"));

        $_REQUEST['kategorija'] = ['Film'];

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('pregled');

        $this->assertTrue($results->see("Rezultati pretrage"));   
    }

    public function testPregledOcena() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 4);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');

 

        $this->assertTrue($results->see("Preporučujemo za vas"));

        $_REQUEST = [];
        $_REQUEST['ocena'] = 9;

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('pregled');

        $this->assertTrue($results->see("Rezultati pretrage"));   
    }

    public function testPregledZanr() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 4);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');

 

        $this->assertTrue($results->see("Preporučujemo za vas"));

        $_REQUEST = [];
        $_REQUEST['zanr'] = ['Akcija', 'Avantura'];

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('pregled');

        $this->assertTrue($results->see("Rezultati pretrage"));   
    }

    public function testPregledKatOcena() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 4);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');

 

        $this->assertTrue($results->see("Preporučujemo za vas"));

        $_REQUEST = [];
        $_REQUEST['kategorija'] = ['Film'];
        $_REQUEST['ocena'] = 8;

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('pregled');

        $this->assertTrue($results->see("Rezultati pretrage"));   
    }

     public function testPregledKatZanr() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 4);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');

 

        $this->assertTrue($results->see("Preporučujemo za vas"));

        $_REQUEST = [];
        $_REQUEST['kategorija'] = ['Film', 'Serija'];
        $_REQUEST['zanr'] = ['Akcija', 'Avantura'];

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('pregled');

        $this->assertTrue($results->see("Rezultati pretrage"));   
    }

     public function testPregledOcenaZanr() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 4);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');

 

        $this->assertTrue($results->see("Preporučujemo za vas"));

        $_REQUEST = [];
        $_REQUEST['ocena'] = 8;
        $_REQUEST['zanr'] = ['Akcija', 'Avantura'];

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('pregled');

        $this->assertTrue($results->see("Rezultati pretrage"));   
    }

    public function testPregledBezParametara() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 4);

        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));

        $_REQUEST = [];

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('pregled');

        $this->assertTrue($results->see("Rezultati pretrage"));
    }
    
    
    public function testPregledPoNazivu() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 4);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        
        $_REQUEST['search'] = "E.T.";
        
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('pregledPoNazivu');
        
        $this->assertTrue($results->see("Rezultati pretrage")); 
        $this->assertTrue($results->see("E.T.")); 
        
        
        
    }
    
    public function testAjaxPregledPoNazivu() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 4);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        
        
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('ajaxPregledPoNazivu', 'E.T.');
        
        $this->assertTrue($results->see("E.T. (1982)")); 
   
    }
    
    
    public function testUplataNovca() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 4);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('profil');
        $this->assertTrue($results->see("Uplati novac"));
        
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('uplataNovca');
        $this->assertTrue($results->see("Uplata novca"));
        
        
        $_REQUEST['ImePrezime'] = "Test Testic";
        $_REQUEST['BrKartice'] = "1234567812345678";
        $_REQUEST['VaziDo'] = "12/2025";
        $_REQUEST['CVV'] = "123";
        $_REQUEST['Drzava'] = "Srbija";
        $_REQUEST['Grad'] = "Beograd";
        $_REQUEST['Suma'] = 3;
        
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('uplati');
        $this->assertTrue($results->see("Transakcija je obavljena uspešno."));
        
        
    }
    
    public function testPretplata(){
        
        $idKor = 3;
        session()->set('idKor',$idKor);
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('pretplata');
        $this->assertTrue($results->see("Pretplata za kritičara")); 
        

    }

    
    public function testPotvrdiPretplatuNaLicuMesta(){

        session()->set('idKor', 19);
        $tip = 1;

        $_REQUEST['opcija1']= 1;
        $_REQUEST['ImePrezime']='Teodora Ristovic';
        $_REQUEST['BrKartice']='1234567';
        $_REQUEST['VaziDo']='05/2025';
        $_REQUEST['CVV']='123456542';
        $_REQUEST['Drzava']='Srbija';
        $_REQUEST['Grad']='Beograd';

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('potvrdiPretplatu', $tip);
        $this->assertTrue($results->see("Transakcija je obavljena uspešno.")); 

    }


    public function testPotvrdiPretplatuNovcemSaNaloga(){

        session()->set('idKor',20);
        $tip = 2;

        $_REQUEST['opcija1']= 1;

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('potvrdiPretplatu', $tip);
        $this->assertTrue($results->see("Transakcija je obavljena uspešno.")); 
        
    }


    public function testPotvrdiPretplatuPoenimaSaNaloga(){

        session()->set('idKor',21);
        $tip = 3;

        $_REQUEST['opcija1']= 1;

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('potvrdiPretplatu', $tip);
        $this->assertTrue($results->see("Transakcija je obavljena uspešno.")); 


    }

    

    public function testNeuspesnaPretplataNemaNovca(){

        session()->set('idKor',16);
        $tip = 2;

        $_REQUEST['opcija1']= 1;

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('potvrdiPretplatu', $tip);
        $this->assertTrue($results->see("Nemate dovoljno sredstava za zeljenu transakciju!")); 



    }
    
    public function testNeuspesnaPretplataNemaPoena(){

        session()->set('idKor',16);
        $tip = 3;

        $_REQUEST['opcija1']= 1;

        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('potvrdiPretplatu', $tip);
        $this->assertTrue($results->see("Nemate dovoljno sredstava za zeljenu transakciju!")); 


    }
    
    public function testajaxUTrendu(){

        if(session_status() != 2) session_start();
        session()->set('idKor', 4);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        
        
        
        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('ajaxUTrendu');
        
        $this->assertTrue($results->see("Novi")); 

    }
    
    public function testOnama(){
        session()->set('idKor', 10);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('onama');
        $this->assertTrue($results->see("Aleksa Trivić, 2020/0198"));
    }
    
    public function testSviNasloviKorisnika(){
        session()->set('idKor', 10);
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');
        $this->assertTrue($results->see("Preporučujemo za vas"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('profil');
        $this->assertTrue($results->see("Aleksa Trivic"));
        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('svi_naslovi');
        $this->assertTrue($results->see("Ceca show"));
    }
    
    public function testPrijemNagrade(){

       

        $id  = 16;

        session()->set('idKor',2);

        $results=$this->controller(\App\Controllers\Admin::class)->execute('objaviIstekli', $id);

        //$this->assertTrue($results->see("Molimo vas da rezultate kviza u buduće ne objavljujete pre isteka roka."));




        session()->set('idKor', 9);

        $results = $this->controller(\App\Controllers\Registrovan::class)->execute('pocetna');

        //ne moze da vidi sta localhost ispisuje

        //$this->assertTrue($results->see("Čestitamo! Stigli su rezultati i osvojili ste nagrade na 1 kvizu/a!\nPogledajte svoje poene!"));

        $this->assertTrue($results->see("Preporučujemo za vas"));

       

    }

}
