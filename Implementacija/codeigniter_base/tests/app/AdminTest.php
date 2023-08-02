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
final class AdminTest extends CIUnitTestCase
{
    
    use ControllerTestTrait;
    use DatabaseTestTrait;

    public function testBrisanjeNaslova(){
        
        session_start();
        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pocetna');
        $this->assertTrue($results->see("Naslovi")); 
        $results=$this->controller(\App\Controllers\Admin::class)->execute('obrisiNaslov',['ime'=>'Eragon']);
        $this->assertTrue($results->see("Naslov je uspešno obrisan.")); 

    }
    
    public function testDodavanjeFilma() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pocetna');
        $this->assertTrue($results->see("Naslovi")); 
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodavanjeNaslova');
        $this->assertTrue($results->see("Dodavanje naslova"));
        
        
        $_REQUEST['naslov'] = "Novi film";
        $_REQUEST['godina'] = 2023;
        $_REQUEST['kategorija'] = "Film";
        $_REQUEST['trajanje'] = 135;
        $_REQUEST['zanr'] = ['Akcija', 'Drama'];
        $_REQUEST['cena'] = 1000;
        $_REQUEST['poeni'] = 1000;
        $_REQUEST['link'] = "pristupni_link.com";
        $_REQUEST['opis'] = "Neki glumac - actor;";
        $_REQUEST['poeniNakonKupovine'] = 10;
      
        
        $results = $this->controller(\App\Controllers\Admin::class)->execute('dodajNaslov');
        $this->assertTrue($results->see("Naslov je uspešno dodat."));
        //ne radi dodavanje naslova bez slike
    }
    
    public function testDodavanjeSerije() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pocetna');
        $this->assertTrue($results->see("Naslovi")); 
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodavanjeNaslova');
        $this->assertTrue($results->see("Dodavanje naslova"));
        
        
        $_REQUEST['naslov'] = "Nova serija";
        $_REQUEST['godina'] = 2023;
        $_REQUEST['kategorija'] = "Serija";
        $_REQUEST['BrSezona'] = 5;
        $_REQUEST['zanr'] = ['Akcija', 'Drama'];
        $_REQUEST['cena'] = 1000;
        $_REQUEST['poeni'] = 1000;
        $_REQUEST['link'] = "pristupni_link.com";
        $_REQUEST['opis'] = "Neki glumac - actor;";
        $_REQUEST['poeniNakonKupovine'] = 10;
      
        
        $results = $this->controller(\App\Controllers\Admin::class)->execute('dodajNaslov');
        $this->assertTrue($results->see("Naslov je uspešno dodat."));
        //ne radi dodavanje naslova bez slike
    }
    
    
    public function testDodavanjeIstiNaslov() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pocetna');
        $this->assertTrue($results->see("Naslovi")); 
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodavanjeNaslova');
        $this->assertTrue($results->see("Dodavanje naslova"));
        
        
        $_REQUEST['naslov'] = "Novi film 2";
        $_REQUEST['godina'] = 2023;
        $_REQUEST['kategorija'] = "Film";
        $_REQUEST['Trajanje'] = 135;
        $_REQUEST['zanr'] = ['Akcija', 'Drama'];
        $_REQUEST['cena'] = 1000;
        $_REQUEST['poeni'] = 1000;
        $_REQUEST['link'] = "pristupni_link.com";
        $_REQUEST['opis'] = "Neki glumac - actor;";
        $_REQUEST['poeniNakonKupovine'] = 10;
      
        
        $results = $this->controller(\App\Controllers\Admin::class)->execute('dodajNaslov');
        $this->assertTrue($results->see("Naslov je uspešno dodat."));
        
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pocetna');
        $this->assertTrue($results->see("Naslovi")); 
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodavanjeNaslova');
        $this->assertTrue($results->see("Dodavanje naslova"));
        
        
        $_REQUEST['naslov'] = "Novi film 2";
        $_REQUEST['godina'] = 2023;
        $_REQUEST['kategorija'] = "Film";
        $_REQUEST['Trajanje'] = 135;
        $_REQUEST['zanr'] = ['Akcija', 'Drama'];
        $_REQUEST['cena'] = 1000;
        $_REQUEST['poeni'] = 1000;
        $_REQUEST['link'] = "pristupni_link.com";
        $_REQUEST['opis'] = "Neki glumac - actor;";
        $_REQUEST['poeniNakonKupovine'] = 10;
      
        
        $results = $this->controller(\App\Controllers\Admin::class)->execute('dodajNaslov');
        $this->assertTrue($results->see("Naslov već postoji u bazi."));
    }
    
    
    public function testAutorizujNalog() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pocetna');
        $this->assertTrue($results->see("Naslovi")); 
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pregledajNaloge');
        $this->assertTrue($results->see("Registrovani nalozi"));
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('autorizujNalog', 5);
        $this->assertTrue($results->see("Suspenduj"));
    }
    
    public function testOdbijNalog() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pocetna');
        $this->assertTrue($results->see("Naslovi")); 
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pregledajNaloge');
        $this->assertTrue($results->see("Registrovani nalozi"));
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('odbijNalog', 6);
        $this->assertTrue($results->see("Registrovani nalozi"));
    }
    
    public function testSuspendujNalog() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pocetna');
        $this->assertTrue($results->see("Naslovi")); 
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pregledajNaloge');
        $this->assertTrue($results->see("Registrovani nalozi"));
        
        $_REQUEST['BrSati'] = 24;
        $_REQUEST['Razlog'] = "Provera suspenzije!";
        $results=$this->controller(\App\Controllers\Admin::class)->execute('suspendujNalog', 9);
        $this->assertTrue($results->see("Suspendovan"));
    }
    
    
    public function testBrisanjeKomentara() {
        if(session_status() != 2) session_start();
        session()->set('idKor', 2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('pocetna');
        $this->assertTrue($results->see("Naslovi")); 
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('naslov', 'Hobbit');
        $this->assertTrue($results->see("Hobbit"));
        
        $results=$this->controller(\App\Controllers\Admin::class)->execute('obrisiKomentar', 27);
        $this->assertTrue($results->see("Komentar je uspešno obrisan."));
    }
    
    public function testObjavaRezultata(){
        
        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('objavaRezultata');
        $this->assertTrue($results->see("Odaberite kategoriju kviza")); 



    }

    public function testOdabirKvizaAktivni(){

        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('aktivni');
        $this->assertTrue($results->see("Aktivni kvizovi")); 



    }

    public function testOdabirKvizaIstekli(){

        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('istekli');
        $this->assertTrue($results->see("Istekli kvizovi")); 
        


    }
    
    public function testOdabirKvizaZavrseni(){

        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('zavrseni');
        $this->assertTrue($results->see("Završeni kvizovi")); 
        


    }

    public function testObjaviIstekliKviz(){

        //setuje id istekle forme po potrebi
        $id  = 13;
        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('objaviIstekli', $id);
        $this->assertTrue($results->see("Uspešno ste objavili rang listu za izabrani kviz!")); 

    }

    public function testObjaviAktivanKviz(){
        //setuj id kviza po potrebi !
        $id  = 14;
        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('objaviAktivan', $id);
        $this->assertTrue($results->see("Molimo vas da rezultate kviza u buduće ne objavljujete pre isteka roka.")); 

    }


    public function testObjaviAktivanKvizSaRestrikcijom(){

        $id  = 15;
        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('objaviAktivan', ['id' => $id]);
        $this->assertTrue($results->see("Nažalost, još uvek ste suspendovani zbog prethodnog objavljivanja rezultata aktivnog kviza. Neuspešno objavljivanje rezultata kviza.")); 

    }

    public function testOdabirFormeKviz(){
        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodavanjeKviza');
        $this->assertTrue($results->see("Kreiranje novog kviza")); 
        $this->assertTrue($results->see("Naslov")); 
        $this->assertTrue($results->see("Pravila")); 
        $this->assertTrue($results->see("Sačuvaj")); 
        $this->assertTrue($results->see("Otkaži")); 


    }


    public function testOdabirFormeAnketa(){
        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodavanjeAnkete');
        $this->assertTrue($results->see("Kreiranje nove ankete")); 
        $this->assertTrue($results->see("Naslov")); 
        $this->assertTrue($results->see("Sačuvaj")); 
        $this->assertTrue($results->see("Otkaži")); 


    }


    //test objave forme
    public function testFormaRezime(){

        session()->set('idKor',2);
        $_REQUEST['tipForme']= 'Kviz';
        $_REQUEST['naslov']='Novak Djokovic';

        $pitanjaPodaci =  array(array(1, 3, 1));
        $_REQUEST['pitanjaPodaci']= json_encode($pitanjaPodaci);

        $_REQUEST['pitanje1']='Koliko je Novak Djokovic osvojio grend slemova ?';
        $_REQUEST['1,1']='20';
        $_REQUEST['1,2']='24';
        $_REQUEST['1,3']='23';
        $_REQUEST['1,3t']='on';
        $_REQUEST['tipKviza']='Domaci';

        
        $_REQUEST['poeni0']= '100';
        
        $_REQUEST['nagrade1']='100';
        $_REQUEST['nagrade2']='50';
        $_REQUEST['nagrade3']='10';

        $results=$this->controller(\App\Controllers\Admin::class)->execute('formaRezime');
        $this->assertTrue($results->see("Rezime")); 
        $this->assertTrue($results->see("Tip forme: Kviz")); 
        $this->assertTrue($results->see("Tip kviza: Domaci")); 
        $this->assertTrue($results->see("Ukupan broj pitanja: 1")); 
        $this->assertTrue($results->see("Autor forme: Admin Admin")); 
        $this->assertTrue($results->see("Objavi formu!")); 
        $this->assertTrue($results->see("Povratak na kreiranje forme")); 

        
    }


   
    public function testDodajFormu(){

        session()->set('idKor',2);
        $datumDo =  '2023-06-29';
        $tipForme = 'Kviz'; //za anketu se testira samo zamenom tipa forme $tipForme = 'Anketa'
        $pitanja = array(array("Koliko je Novak Djokovic osvojio grend slemova ?", 3, 1, [['20', 0],['22', 0], ['23', 1] ], "", ""));
        $_REQUEST['tipForme']= $tipForme;
        $_REQUEST['naslov']='Novak Djokovic';
        $_REQUEST['datumDo']= $datumDo; //bitno da bude azuran
        $_REQUEST['pitanja']= json_encode($pitanja);
        $_REQUEST['tipKviza']='Domaci';
        $_REQUEST['pravila']='100;100, 50, 10';
        $podaci =  array(array(1, 3, 1));
        $_REQUEST['podaci']= json_encode($podaci);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodajFormu');

        $this->assertTrue($results->see("Uspešno objavljena forma.")); 


    }


   

    public function testDodajFormuSaNevalidnimDatumom(){

        session()->set('idKor',2);
        $pitanja = array(array("Koliko je Novak Djokovic osvojio grend slemova ?", 3, 1, [['20', 0],['22', 0], ['23', 1] ], "", ""));
        $_REQUEST['tipForme']= 'Kviz';
        $_REQUEST['naslov']='Novak Djokovic';
        $_REQUEST['datumDo']='2023-06-14';
        $_REQUEST['pitanja']= json_encode($pitanja);
        $_REQUEST['tipKviza']='Domaci';
        $_REQUEST['pravila']='100';
        $podaci =  array(array(1, 3, 1));
        $_REQUEST['podaci']= json_encode($podaci);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodajFormu');

        $this->assertTrue($results->see("Morate uneti ispravnu vrednost datuma do kog forma važi!")); 
        $this->assertTrue($results->see("Rezime")); 
        $this->assertTrue($results->see("Objavi formu!")); 
    }
    
    public function testONama(){

        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('onama');

        $this->assertTrue($results->see("Povratak na početnu stranicu")); 

    }
    
    public function testNecijiProfilPregled(){

        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('prikaziProfil', 4);

        $this->assertTrue($results->see("Djordje Golubovic")); 

    }
    
    public function testObrisiNalogNeciji(){
        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('obrisiNalog', 25);
        
        $this->assertFalse($results->see("iksiks"));
        
        
    }
    
    public function testPrikazPretrageNaslovi(){
        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('prikazPretrage', null);
        
        $this->assertTrue($results->see("Rezultati pretrage"));
        
        
    }
    
    public function testOdjava(){
        session()->set('idKor',2);
        $results=$this->controller(\App\Controllers\Admin::class)->execute('odjava');
        
        $this->assertTrue($results->see("Preporučujemo za Vas"));
        
        
    }
    
    public function testOdabirFormeKviz1(){

        session()->set('idKor',2);

        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodavanjeKviza');

        $this->assertTrue($results->see("Kreiranje novog kviza"));

        $this->assertTrue($results->see("Naslov"));

        $this->assertTrue($results->see("Pravila"));

        $this->assertTrue($results->see("Sačuvaj"));

        $this->assertTrue($results->see("Otkaži"));





    }





    public function testOdabirFormeAnketa1(){

        session()->set('idKor',2);

        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodavanjeAnkete');

        $this->assertTrue($results->see("Kreiranje nove ankete"));

        $this->assertTrue($results->see("Naslov"));

        $this->assertTrue($results->see("Sačuvaj"));

        $this->assertTrue($results->see("Otkaži"));





    }





    //test objave forme

    public function testFormaRezimeKviz(){




        session()->set('idKor',2);

        $_REQUEST['tipForme']= 'Kviz';

        $_REQUEST['naslov']='Novak Djokovic';




        $pitanjaPodaci =  array(array(1, 3, 1));

        $_REQUEST['pitanjaPodaci']= json_encode($pitanjaPodaci);




        $_REQUEST['pitanje1']='Koliko je Novak Djokovic osvojio grend slemova ?';

        $_REQUEST['1,1']='20';

        $_REQUEST['1,2']='24';

        $_REQUEST['1,3']='23';

        $_REQUEST['1,3t']='on';

        $_REQUEST['tipKviza']='Domaci';




       

        $_REQUEST['poeni0']= '100';

       

        $_REQUEST['nagrade1']='100';

        $_REQUEST['nagrade2']='50';

        $_REQUEST['nagrade3']='10';




        $results=$this->controller(\App\Controllers\Admin::class)->execute('formaRezime');

        $this->assertTrue($results->see("Rezime"));

        $this->assertTrue($results->see("Tip forme: Kviz"));

        $this->assertTrue($results->see("Tip kviza: Domaci"));

        $this->assertTrue($results->see("Ukupan broj pitanja: 1"));

        $this->assertTrue($results->see("Autor forme: Admin Admin"));

        $this->assertTrue($results->see("Objavi formu!"));

        $this->assertTrue($results->see("Povratak na kreiranje forme"));




       

    }





    public function testFormaRezimeAnketa(){




        session()->set('idKor',2);

        $_REQUEST['tipForme']= 'Anketa';

        $_REQUEST['naslov']='Anketa';




        $pitanjaPodaci =  array(array(1, 3, 1));

        $_REQUEST['pitanjaPodaci']= json_encode($pitanjaPodaci);




        $_REQUEST['pitanje1']='Koliko je Novak Djokovic osvojio grend slemova ?';

        $_REQUEST['1,1']='20';

        $_REQUEST['1,2']='24';

        $_REQUEST['1,3']='23';

        $_REQUEST['1,3t']='on';

        $_REQUEST['tipAnkete']='Domaci';





        $results=$this->controller(\App\Controllers\Admin::class)->execute('formaRezime');

        $this->assertTrue($results->see("Rezime"));

        $this->assertTrue($results->see("Tip forme: Anketa"));

        $this->assertTrue($results->see("Ukupan broj pitanja: 1"));

        $this->assertTrue($results->see("Autor forme: Admin Admin"));

        $this->assertTrue($results->see("Objavi formu!"));

        $this->assertTrue($results->see("Povratak na kreiranje forme"));




       

    }





   

    public function testDodajFormuKviz(){




        session()->set('idKor',2);

        $datumDo =  '2023-06-29';

        $tipForme = 'Kviz'; //za anketu se testira samo zamenom tipa forme $tipForme = 'Anketa'

        $pitanja = array(array("Koliko je Novak Djokovic osvojio grend slemova ?", 3, 1, [['20', 0],['22', 0], ['23', 1] ], "", ""));

        $_REQUEST['tipForme']= $tipForme;

        $_REQUEST['naslov']='Novak Djokovic';

        $_REQUEST['datumDo']= $datumDo; //bitno da bude azuran

        $_REQUEST['pitanja']= json_encode($pitanja);

        $_REQUEST['tipKviza']='Domaci';

        $_REQUEST['pravila']='100;100, 50, 10';

        $podaci =  array(array(1, 3, 1));

        $_REQUEST['podaci']= json_encode($podaci);

        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodajFormu');




        $this->assertTrue($results->see("Uspešno objavljena forma."));





    }





    public function testDodajFormuAnketa(){




        session()->set('idKor',2);

        $datumDo =  '2023-06-29';

        $tipForme = 'Anketa'; //za anketu se testira samo zamenom tipa forme $tipForme = 'Anketa'

        $pitanja = array(array("Koliko je Novak Djokovic osvojio grend slemova ?", 3, 1, [['20', 0],['22', 0], ['23', 1] ], "", ""));

        $_REQUEST['tipForme']= $tipForme;

        $_REQUEST['naslov']='Novak Djokovic';

        $_REQUEST['datumDo']= $datumDo; //bitno da bude azuran

        $_REQUEST['pitanja']= json_encode($pitanja);

        $podaci =  array(array(1, 3, 1));

        $_REQUEST['podaci']= json_encode($podaci);

        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodajFormu');




        $this->assertTrue($results->see("Uspešno objavljena forma."));





    }





   




    public function testDodajFormuSaNevalidnimDatumomKviz(){




        session()->set('idKor',2);

        $pitanja = array(array("Koliko je Novak Djokovic osvojio grend slemova ?", 3, 1, [['20', 0],['22', 0], ['23', 1] ], "", ""));

        $_REQUEST['tipForme']= 'Kviz';

        $_REQUEST['naslov']='Novak Djokovic';

        $_REQUEST['datumDo']='2023-06-14';

        $_REQUEST['pitanja']= json_encode($pitanja);

        $_REQUEST['tipKviza']='Domaci';

        $_REQUEST['pravila']='100';

        $podaci =  array(array(1, 3, 1));

        $_REQUEST['podaci']= json_encode($podaci);

        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodajFormu');




        $this->assertTrue($results->see("Morate uneti ispravnu vrednost datuma do kog forma važi!"));

        $this->assertTrue($results->see("Rezime"));

        $this->assertTrue($results->see("Objavi formu!"));

    }





    public function testDodajFormuSaNevalidnimDatumomAnketa(){




        session()->set('idKor',2);

        $datumDo =  '2023-06-14';

        $tipForme = 'Anketa'; //za anketu se testira samo zamenom tipa forme $tipForme = 'Anketa'

        $pitanja = array(array("Koliko je Novak Djokovic osvojio grend slemova ?", 3, 1, [['20', 0],['22', 0], ['23', 1] ], "", ""));

        $_REQUEST['tipForme']= $tipForme;

        $_REQUEST['naslov']='Novak Djokovic';

        $_REQUEST['datumDo']= $datumDo; //bitno da bude azuran

        $_REQUEST['pitanja']= json_encode($pitanja);

        $podaci =  array(array(1, 3, 1));

        $_REQUEST['podaci']= json_encode($podaci);

        $results=$this->controller(\App\Controllers\Admin::class)->execute('dodajFormu');




        $this->assertTrue($results->see("Uneti datum mora biti veci od trenutnog!"));

        $this->assertTrue($results->see("Rezime"));

        $this->assertTrue($results->see("Objavi formu!"));

    }


public function testPregledPoNazivu() {

        if(session_status() != 2) session_start();

        session()->set('idKor', 2);

        $results = $this->controller(\App\Controllers\Admin::class)->execute('pocetna');

        $this->assertTrue($results->see("Naslovi"));


        $_REQUEST = [];

        $_REQUEST['search'] = "E.T.";


        $results=$this->controller(\App\Controllers\Registrovan::class)->execute('pregledPoNazivu');


        $this->assertTrue($results->see("Rezultati pretrage")); 

        $this->assertTrue($results->see("E.T.")); 


    }
}
