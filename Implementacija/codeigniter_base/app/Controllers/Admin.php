<?php

namespace App\Controllers;

use App\Models\NaslovModel;
use App\Models\FormaModel;
use App\Models\AnketaModel;
use App\Models\PitanjeModel;
use App\Models\PonudjenModel;
use App\Models\KvizModel;
use App\Models\KorisnikModel;
use App\Models\PosedujeModel;
use App\Models\SuspendovanModel;
use App\Models\KorisnikKvizModel;
use App\Models\KomentarModel;
use App\Models\OcenaModel;


/**
* Admin – klasa za operacije administratora
*
* @version 1.0  Autori: (Teodora Ristović 2020/0566, Stefan Curović 2020/0068, Đorđe Golubović 2020/0112, Aleksa Trivić 2020/0198)
*/

class Admin extends BaseController
{   
    
    /**
    * Funkcija koja se poziva kada se prikazuje početna stranica za administratora
    *
    * @param NaslovModel $naslovi Naslovi
    *
    * @return void
    *
    *
    */     
    
    public function pocetna($naslovi=null) {

        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
              
        if ($naslovi==null) $naslovi=$this->dohvSveNaslove ();
        return view('pocetna/pocetna_administrator.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
            'naslovi'=>$naslovi, 'controller' => 'Admin', 'tekst'=>'Naslovi']);
    }

        
    /**
    * Funkcija koja prikazuje formu za dodavanje novog naslova
    *
    * @param 
    *
    * @return void
    *
    *
    */     
        
    public function dodavanjeNaslova() {
        
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));

        return view("naslov/dodavanje_naslova.php", ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime)]);
    }

    
    /**
    * Funkcija koja se poziva za prikaz stranice 'O nama'
    *
    * @param 
    *
    * @return void
    *
    *
    */  
    
    public function onama() {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        return view("ostalo/onama.php", ['controller' => $korisnik->Status, 'ime' => ($korisnik->Ime . " " . $korisnik->Prezime)]);
    }

    
    /**
    * Funkcija koja se poziva za proveru i dodavanje novog naslova
    *
    * @param 
    *
    * @return void
    *
    *
    */  
    
    public function dodajNaslov() {
  
        $naslovModel = new NaslovModel();
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));

        $naslov = $this->request->getVar('naslov');
        $trajanje = null;
        $brSezona = null;

        if ($naslovModel->vecPostojiNaslov($naslov)) {
            return view("obavestenja/neuspesno_dodavanje_naslova_vec_postoji.php",['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'controller' => $korisnik->Status]);   
        }
        
        $godina = $this->request->getVar('godina');
        $kategorija = $this->request->getVar('kategorija');
        if($kategorija == "Film"){
            $trajanje = $this->request->getVar('Trajanje');
        }else{
            $brSezona = $this->request->getVar('BrSezona');
        }
        $zanr = $this->request->getVar('zanr[]');
        $zanrS = implode(", ", $zanr);


        $cena = $this->request->getVar('cena');
        $poeni = $this->request->getVar('poeni');
        $link = $this->request->getVar('link');
        $opis = $this->request->getVar('opis');
        $nosiPoena = $this->request->getVar('poeniNakonKupovine');
        $cenaI = round($cena/2);
        $poeniI = round($poeni/2);
        
        $ocena = 7; //npr za sada...
        $newName= null;
        $slika = $this->request->getFile('slika');
        if($slika != ''){
            $extension = $slika->getClientExtension();
            $newName = uniqid() . '.' . $extension;
            $slika->move('C:\\wamp64\\www\\codeigniter_base\\public\\assets', $newName);
        }
        $data = [
            'Ime'=>$naslov,
            'Godina'=>$godina,
            'Zanr'=>$zanrS,
            'Cena'=>$cena,
            'Link'=>$link,
            'Opis'=>$opis,
            'BrPoena'=>$poeni,
            'Slika'=>$newName,
            'ProsOcena'=>$ocena,
            'Kategorija'=>$kategorija,
            'Trajanje'=>$trajanje,
            'BrSezona'=>$brSezona,
            'NosiPoena'=>$nosiPoena,
            'CenaIznajmljivanje'=>$cenaI,
            'PoeniIznajmljivanje'=>$poeniI,
        ];

        $naslovModel->save($data);
        

        return view("obavestenja/uspesno_dodavanje_naslova.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'controller' => $korisnik->Status]);   

    }
    
    
    /**
    * Funkcija koja se poziva za brisanje naslova
    *
    * @param 
    *
    * @return void
    *
    *
    */  
    
    public function obrisiNaslov($ime) {
        
        $naslovModel = new NaslovModel();
        
        $naslov = $naslovModel->pronadjiZaNaslov($ime);
        
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));
        
        if($naslov != null){
            $id = $naslov->ID;
            $naslovModel->delete($id);
            return view("obavestenja/uspesno_brisanje_naslova.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime]);
        }
    }

    
    /**
    * Funkcija koja administratoru izlistava tekuće naloge iz baze
    *
    * @param 
    *
    * @return void
    *
    *
    */  
    
    public function pregledajNaloge() {
        $korisnikModel = new KorisnikModel();
        //$korisnici = $korisnikModel->findAll();
        $korisnici = $korisnikModel->dohvSveKorisnike();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));
        return view("ostalo/pregledaj_naloge.php", ['korisnici'=>$korisnici, 'ime'=>$korisnik->Ime. " ".$korisnik->Prezime ]);
    }

    
    /**
    * Funkcija koja se poziva za prikaz korisničkog profila sa prosledjenim id-jem
    *
    * @param int $id
    *
    * @return void
    *
    *
    */  
    
    public function prikaziProfil($id) {

        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($id); //promenio Aleksa
        $posedujeModel= new PosedujeModel();
        $naslovModel=new NaslovModel();
        $posedovanja=$posedujeModel->pronadjiZaKorisnika($korisnik->ID);
        $danas=date("Y-m-d h:i:sa");
        $naslovi=[];
        
        
        $admin=$korisnikModel->find($this->session->get('idKor'));
        

        foreach($posedovanja as $posedovanje){
            if ($posedovanje->DatumDo==null || $posedovanje->DatumDo>$danas){
                $naslovi[]=$naslovModel->find($posedovanje->IDNas);
            }
            
        }
        $brojFilmova=sizeof($naslovi);
        return view('ostalo/profil_admin.php', ['admin'=> ($admin->Ime . " " . $admin->Prezime) ,'ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
        'id'=>$korisnik->ID,
        'username'=>$korisnik->KorIme,
        'poeni'=>$korisnik->BrPoena,
        'novac'=>$korisnik->Novac,
        'broj_filmova'=>$brojFilmova,
        'slika'=>$korisnik->Slika,
        'naslovi'=>$naslovi
        ]); 
    }

    
    /**
    * Funkcija koja se poziva za suspendovanje korisnika koji je određen sa prosleđenim id-em
    *
    * @param int $id
    *
    * @return void
    *
    *
    */  
    
    public function suspendujNalog($id) {

        $korisnikModel = new KorisnikModel();
        $suspendovanModel = new SuspendovanModel();
        $brSati = $this->request->getVar('BrSati');
        $razlog = $this->request->getVar('Razlog');

        if($brSati != null && $razlog != null){
            $dataK = [
                'Status' => 'Suspendovan',
            ];
    
            $korisnikModel->update($id, $dataK);
    
            $datum=date("Y-m-d h:i:sa");
    
            $dataS = [
                'Datum'=>$datum,
                'Trajanje'=>$brSati,
                'Razlog'=>$razlog,
                'IDKor'=>$id,
            ];
    
            $suspendovanModel->insert($dataS);
        }

        $korisnici = $korisnikModel->findAll();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));
        return view("ostalo/pregledaj_naloge.php", ['korisnici'=>$korisnici, 'ime'=>$korisnik->Ime. " ".$korisnik->Prezime ]);

    }

    
    /**
    * Funkcija koja se poziva za autorizovanje korisnika koji je određen prosleđenim id-em
    *
    * @param int $id
    *
    * @return void
    *
    *
    */  
    
    public function autorizujNalog($id) {

        $korisnikModel = new KorisnikModel();
        $data = [
            'Status' => 'Registrovan',
        ];

        $korisnikModel->update($id, $data);

        $korisnici = $korisnikModel->dohvSveKorisnike();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));
        return view("ostalo/pregledaj_naloge.php", ['korisnici'=>$korisnici, 'ime'=>$korisnik->Ime. " ".$korisnik->Prezime ]);

    }

    
    /**
    * 
    * Funkcija koja se poziva za odbijanje zahteva za registraciju korisnika koji je određen prosleđenim id-em
    *
    * @param int $id
    *
    * @return void
    *
    *
    */  
    
    public function odbijNalog($id){

        $korisnikModel = new KorisnikModel();
        $korisnikModel->delete($id);

        $korisnici = $korisnikModel->dohvSveKorisnike();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));
        return view("ostalo/pregledaj_naloge.php", ['korisnici'=>$korisnici, 'ime'=>$korisnik->Ime. " ".$korisnik->Prezime ]);

    }


    /**
    * Funkcija koja briše postojeći nalog iz baze
    *
    * @param int $id
    *
    * @return void
    *
    *
    */  
    
    public function obrisiNalog($id) {

        $korisnikModel = new KorisnikModel();
        $korisnikModel->delete($id);

        $korisnici = $korisnikModel->dohvSveKorisnike();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));
        return view("ostalo/pregledaj_naloge.php", ['korisnici'=>$korisnici, 'ime'=>$korisnik->Ime. " ".$korisnik->Prezime ]);

    }
    
    
    /**
    * Funkcija koja se poziva za prikaz pretrage
    *
    * @param NasloviModel $naslovi naslovi
    *
    * @return void
    *
    *
    */  
    
    public function prikazPretrage($naslovi)
    {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        return view('pocetna/pocetna_administrator.php',['naslovi' => $naslovi, 'ime' => ($korisnik->Ime . " " . $korisnik->Prezime), 'tekst'=>'Rezultati pretrage']);
    }

    
    /**
    * Funkcija koja se poziva kada administrator želi da doda anketu
    *
    * @param 
    *
    * @return void
    *
    *
    */  
    
    public function dodavanjeAnkete() {

        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        return view("anketa/kreiranje_ankete.php", ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime)]);
    }
    
    
    /**
    * Funkcija koja se poziva kada administrator želi da doda kviz
    *
    * @param 
    *
    * @return void
    *
    *
    */  
    
    public function dodavanjeKviza() {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        return view("kviz/kreiranje_kviza.php", ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime)]);
    }
    
    
    /**
    * Funkcija koja se poziva kada se dodaje forma, za rezime i detalje
    *
    * @param 
    *
    * @return void
    *
    *
    */  
    
    public function formaRezime() {
        $tipForme = $this->request->getVar("tipForme");
    
        $stringPodaci = $this->request->getVar("pitanjaPodaci");
        $podaci = json_decode($this->request->getVar("pitanjaPodaci"));
        $pitanja = [];
        
        $i = 1;
        foreach ($podaci as $podatak) {
            $pitanje = $this->request->getVar("pitanje" . $i);
            $brPonudjenih = $podatak[1];
            $tip = $podatak[2];

            $drugiTekst = ""; $newName = "";
            if($tip == 4) $drugiTekst = $this->request->getVar("dopunad" . $i);
            else if($tip == 5) { 
                $slika = $this->request->getFile("slika" . $i);
                //echo "slika" . $i; exit();
                
                $extension = $slika->getClientExtension();
                $newName = uniqid() . '.' . $extension;

                $slika->move('C:\\wamp64\\www\\codeigniter_base\\public\\assets', $newName);
            }
            
            array_push($pitanja, [$pitanje, $brPonudjenih, $tip, [], $drugiTekst, $newName]);

            for($j = 0; $j < $brPonudjenih; $j++) {
                $ponudjen = $this->request->getVar($i . "," . ($j + 1));
                if(!empty($this->request->getVar($i . "," . ($j + 1) . "t"))) 
                        $tacno = [$ponudjen, 1];
                else $tacno = [$ponudjen, 0];
                
                
                if($tip == 4 || $tip == 5) { $ponudjen = $this->request->getVar($i . "," . ($j + 1) . "t"); $tacno = [$ponudjen, 1]; }
                
                array_push($pitanja[$i-1][3], $tacno);

            }
            echo "<br>";

            $i++;
        }

        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));

        if($tipForme == "Kviz") {
            $pravila = "";
            for($i = 0; $i < sizeof($podaci); $i++) {
                $pravila .= $this->request->getVar("poeni" . $i);
                if($i != sizeof($podaci) - 1) $pravila .= ",";
            }
           
            $pravila .= ";";
            for($i = 0; $i < 3; $i++) {
                $pravila .= $this->request->getVar("nagrade" . ($i + 1));
                if($i != 2) $pravila .= ",";
            }
            
            return view("ostalo/forma_rezime.php", ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
                                                    'tip' => $tipForme,
                                                    'tipKviza' => $this->request->getVar("tipKviza"),
                                                    'naslov' => $this->request->getVar("naslov"),
                                                    'brojPitanja' => sizeof($podaci),
                                                    'podaci' => $stringPodaci,
                                                    'pitanja' => htmlspecialchars(json_encode($pitanja)),
                                                    'pravila' => $pravila]);
        }
        else {
            return view("ostalo/forma_rezime.php", ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
                                                    'tip' => $tipForme,
                                                    'naslov' => $this->request->getVar("naslov"),
                                                    'brojPitanja' => sizeof($podaci),
                                                    'podaci' => $stringPodaci,
                                                    'pitanja' => htmlspecialchars(json_encode($pitanja))]);
        }

    }
    
    
    /**
    * Funkcija koja se poziva za proveru i dodavanje nove forme
    *
    * @param 
    *
    * @return void
    *
    *
    */  
    
    public function dodajFormu() { 
	
       $korisnikModel=new KorisnikModel();
       $korisnik=$korisnikModel->find($this->session->get('idKor'));
	
       $datum = $this->request->getVar("datumDo");
       $naslov = $this->request->getVar("naslov");
       $tipForme = $this->request->getVar("tipForme");
       $stringPodaci = $this->request->getVar("podaci");
       $podaci = json_decode($this->request->getVar("podaci"));
       $pitanja = json_decode($this->request->getVar("pitanja"));
       
       
       if($datum < date("Y-m-d")) {

            if($tipForme == "Kviz") {
            return view("ostalo/forma_rezime.php", ['poruka' => 'Morate uneti ispravnu vrednost datuma do kog forma važi!',
                                                    'ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
                                                    'tip' => $tipForme,
                                                    'tipKviza' => $this->request->getVar("tipKviza"),
                                                    'naslov' => $naslov,
                                                    'brojPitanja' => sizeof($podaci),
                                                    'podaci' => $stringPodaci,
                                                    'pitanja' => htmlspecialchars(json_encode($pitanja)),
                                                    'pravila' => $this->request->getVar("pravila")]);
            }
            else {
                return view("ostalo/forma_rezime.php", ['poruka' => 'Uneti datum mora biti veci od trenutnog!',
                                                        'ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
                                                        'tip' => $tipForme,
                                                        'naslov' => $this->request->getVar("naslov"),
                                                        'brojPitanja' => sizeof($podaci),
                                                        'podaci' => $stringPodaci,
                                                        'pitanja' => htmlspecialchars(json_encode($pitanja))]);
            }
     }
       
       $formaModel = new FormaModel();
       $anketaModel = new AnketaModel();
       $kvizModel = new KvizModel();
       $pitanjeModel = new PitanjeModel();
       $ponudjenModel = new PonudjenModel();
       
       $IDAutora = $this->session->get('idKor');
       
       $forma = [
           'Naslov' => $naslov,
           'BrPitanja' => sizeof($pitanja),
           'DatumOd' => date('Y-m-d h:i:sa'),
           'DatumDo' => $datum,
           'IDAut' => $IDAutora
       ]; 
       
       $formaModel->insert($forma);
       $IDForme = $formaModel->selectMax('ID')->first()->ID;
       
       
       if($tipForme == "Anketa") {
           $anketa = [
             'ID' => $IDForme
           ];
           $anketaModel->insert($anketa);
       }
       else {
           
           $tipKviza = $this->request->getVar("tipKviza");
           $pravila = $this->request->getVar("pravila");
           
           $kviz = [
               'ID' => $IDForme,
               'Vrsta' => $tipKviza,
               'Pravila' => $pravila,
               'DatObj' => date('Y-m-d h:i:sa'),
               'BrUcesnika' => 0
           ];
           $kvizModel->insert($kviz);
       }
       
       foreach ($pitanja as $pitanje) {
           
           switch($pitanje[2]){
               case 1: $tip = "RADIO"; break;
               case 2: $tip = "CHECK"; break;
               case 3: $tip = "SELECT"; break;
               case 4: $tip = "TEKST"; break;
               case 5: $tip = "SLIKA"; break;
               default: break;
           }
           
           $pitanjeUnos = [
               'Tip' => $tip,
               'Tekst' => $pitanje[0],
               'DrugiTekst' => $pitanje[4],
               'Slika' => $pitanje[5],
               'BrPonudjenih' => $pitanje[1],
               'IDFor' => $IDForme
            ];
          
           $pitanjeModel->insert($pitanjeUnos);
           $IDPitanja = $pitanjeModel->selectMax('ID')->first()->ID;
           foreach ($pitanje[3] as $tacno) {
               if($tacno[1] == 1) { $tacan = 1; }
               else $tacan = 0;
               
               $ponudjen = $tacno[0];
               
               $ponudjenUnos = [
                   'Tekst' => $ponudjen,
                   'Tacan' => $tacan,
                   'IDPit' => $IDPitanja
               ];
               $ponudjenModel->insert($ponudjenUnos);
           }
       }
       
       echo view("obavestenja/uspesno_objavljivanje_forme.php", ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime)]);
    }
    
    
    /**
    * Funkcija koja se poziva kada administrator želi da odabere kategoriju već postojećih kvizova
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function objavaRezultata() {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        return view("kviz/objava_rezultata.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime]);
    }
    
    
    /**
    * Funkcija koja se poziva kada se prikazuju svi aktivni kvizovi
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function aktivni() {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        $formaModel = new FormaModel();
        $kvizModel = new KvizModel();
        $sviKvizovi = $kvizModel->findAll();
        
        $aktivni = [];
        $topTri = [];
        $nagrade = [];
        
        foreach ($sviKvizovi as $kviz) {
            $forma = $formaModel->find($kviz->ID);
            if($forma->DatumDo >= date("Y-m-d") && $forma->BrPitanja > 0) {
               $forma->DatumDo = date("Y-m-d", strtotime("+1 days", strtotime($forma->DatumDo)));
               array_push($aktivni, $forma);
               array_push($nagrade, explode(';', $kviz->Pravila)[1]);
               $kkModel = new KorisnikKvizModel();
               
               $najbolji = $kkModel->where('IDKviz', $kviz->ID)->orderBy('BrBodova', 'DESC')->limit(3)->findAll();
               
               for($i = 0; $i < sizeof($najbolji); $i++) {
                   $najbolji[$i]->IDKor = $korisnikModel->find($najbolji[$i]->IDKor)->KorIme;
               }
               
               array_push($topTri, $najbolji);
               
            }
        }
        
        return view("kviz/aktivni.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'aktivni' => $aktivni, 'topTri' => $topTri, 'nagrade' => $nagrade]);
    }
    
    
    /**
    * Funkcija koja se poziva kada se prikazuju svi istekli kvizovi
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function istekli() {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        $formaModel = new FormaModel();
        $kvizModel = new KvizModel();
        $sviKvizovi = $kvizModel->findAll();
        
        $istekli = [];
        $topTri = [];
        $nagrade = [];
        
        foreach ($sviKvizovi as $kviz) {
            $forma = $formaModel->find($kviz->ID);
            if($forma->DatumDo < date("Y-m-d") && $forma->BrPitanja > 0) {
               $forma->DatumDo = date("Y-m-d", strtotime("+1 days", strtotime($forma->DatumDo)));
               array_push($istekli, $forma);
               array_push($nagrade, explode(';', $kviz->Pravila)[1]);
               $kkModel = new KorisnikKvizModel();
               
               $najbolji = $kkModel->where('IDKviz', $kviz->ID)->orderBy('BrBodova', 'DESC')->limit(3)->findAll();
               
               for($i = 0; $i < sizeof($najbolji); $i++) {
                   $najbolji[$i]->IDKor = $korisnikModel->find($najbolji[$i]->IDKor)->KorIme;
               }
               
               array_push($topTri, $najbolji);
               
            }
        }
        
        return view("kviz/istekli.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'istekli' => $istekli, 'topTri' => $topTri, 'nagrade' => $nagrade]);
    }
    
    
    /**
    * Funkcija koja se poziva kada se prikazuju svi završeni kvizovi
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function zavrseni() {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        $formaModel = new FormaModel();
        $kvizModel = new KvizModel();
        $sviKvizovi = $kvizModel->findAll();
        
        $zavrseni = [];
        
        foreach ($sviKvizovi as $kviz) {
            $forma = $formaModel->find($kviz->ID);
            if($forma->BrPitanja < 0) {
               array_push($zavrseni, $forma); 
            }
        }
        
        return view("kviz/zavrseni.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'zavrseni' => $zavrseni]);
    }
    
    
    /**
    * Funkcija koja se poziva kada aministrator želi da objavi rezultate aktivnog kviza
    *
    * @param int $id idKviza
    *
    * @return void
    *
    *
    */
    
    public function objaviAktivan($id) {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        if($this->vecSuspendovan()) {
            return view("obavestenja/uspesno_objavljivanje_rezultata.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'poruka' => 'Nažalost, još uvek ste suspendovani zbog prethodnog objavljivanja rezultata aktivnog kviza. Neuspešno objavljivanje rezultata kviza.']);
        }
        
        $formaModel = new FormaModel();
        $kvizModel = new KvizModel();
        
        $forma = $formaModel->find($id);
        $kviz = $kvizModel->find($id);   
        
        $zavrsen = [
            'BrPitanja' => -1
        ];
        
        $kkModel = new KorisnikKvizModel();
        $najbolji = $kkModel->where('IDKviz', $id)->orderBy('BrBodova', 'DESC')->findAll();
        $nagrade = explode(',', explode(';', $kviz->Pravila)[1]);
        
        $n = sizeof($najbolji) > 3?3:sizeof($najbolji);
        
        for($i = 0; $i < $n; $i++) {
           $kkModel->update($najbolji[$i]->ID, ['obavesten' => $id*10 + $i + 1]);
           $stariPoeni = $korisnikModel->find($najbolji[$i]->IDKor)->BrPoena;
           $korisnikModel->update($najbolji[$i]->IDKor, ['BrPoena' => $stariPoeni + $nagrade[$i]]);
        }
        
        $formaModel->update($id, $zavrsen);
        
        $razlika = strtotime($forma->DatumDo) - strtotime(date("Y-m-d"));
        
        $podaci = [
            'Datum' => date("Y-m-d h:i:s"),
            'Trajanje' => $razlika/3600,
            'Razlog' => 'Objava aktivnog kviza',
            'IDKor' => $korisnik->ID
        ];
        
        $suspendovanModel = new SuspendovanModel();
        $suspendovanModel->insert($podaci);
        
        return view("obavestenja/uspesno_objavljivanje_rezultata.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'poruka' => '<span style = "color: red">Molimo vas da rezultate kviza u buduće ne objavljujete pre isteka roka.</span><br>Uspešno ste objavili rezultate kviza.']);         
    }
    
    
    /**
    * Funkcija koja se poziva kada aministrator želi da objavi rezultate isteklog kviza
    *
    * @param int $it idKviza
    *
    * @return void
    *
    *
    */
    
    public function objaviIstekli($id) {
        
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        if($this->vecSuspendovan()) {
            return view("obavestenja/uspesno_objavljivanje_rezultata.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'poruka' => 'Nažalost, još uvek ste suspendovani zbog prethodnog objavljivanja rezultata aktivnog kviza. Neuspešno objavljivanje rezultata kviza.']);
        }
        
        
        $formaModel = new FormaModel();
        $kvizModel = new KvizModel();
        
        $kviz = $kvizModel->find($id);
        
        $zavrsen = [
            'BrPitanja' => -1
        ];
        
        $kkModel = new KorisnikKvizModel();
        $najbolji = $kkModel->where('IDKviz', $id)->orderBy('BrBodova', 'DESC')->findAll();
        $nagrade = explode(',', explode(';', $kviz->Pravila)[1]);
        
        $n = sizeof($najbolji);
        if($n > 3) $n = 3;
        
        
        for($i = 0; $i < $n; $i++) {
           $kkModel->update($najbolji[$i]->ID, ['obavesten' => $id*10 + $i + 1]);
           $stariPoeni = $korisnikModel->find($najbolji[$i]->IDKor)->BrPoena;
           $korisnikModel->update($najbolji[$i]->IDKor, ['BrPoena' => $stariPoeni + $nagrade[$i]]);
        }
        
        $formaModel->update($id, $zavrsen);
        
        return view("obavestenja/uspesno_objavljivanje_rezultata.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'poruka' => 'Uspešno ste objavili rang listu za izabrani kviz!']);         
    }
    
    
    /**
    * Funkcija koja se poziva kada se proverava da li je administratoru dozvoljeno objavljivanje rezultata kvizova
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function vecSuspendovan() {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        $suspendovanModel = new SuspendovanModel();
        $suspendovan = $suspendovanModel->where('IDKor', $korisnik->ID)->findAll();
        
        if($suspendovan != null) return true;
        return false;
    }
    
    
    /**
    * Funkcija koja se poziva kada aministrator želi da obriše komentar kritičara sa naslova
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function obrisiKomentar($id) {
        
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        $komentarModel = new KomentarModel();
        $komentar = $komentarModel->find($id);
       
        $ocenaModel = new OcenaModel();
        $naslovModel = new NaslovModel();
        
        $naslov = $naslovModel->find($komentar->IDNas);
        $kor = $korisnikModel->find($komentar->IDKor);
        
        $ocena = $ocenaModel->where('IDKor', $kor->ID)->where('IDNas', $naslov->ID)->first();
        
        if($ocena != null) {
            $brojOcena = sizeof($ocenaModel->where('IDNas', $naslov->ID)->findAll());
            //echo (( $naslov->ProsOcena * ($brojOcena + 1) - $ocena->Ocena ) / $brojOcena); exit();
            $novaProsecna = ['ProsOcena' => (( $naslov->ProsOcena * ($brojOcena + 1) - $ocena->Ocena ) / $brojOcena)];
            $naslovModel->update($naslov->ID, $novaProsecna);
            $ocenaModel->where('ID', $ocena->ID)->delete();
        }
        $komentarModel->where('ID', $id)->delete();
        return view("obavestenja/uspesno_brisanje_komentara", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime]);
    }
}