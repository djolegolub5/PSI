<?php

namespace App\Controllers;

use App\Models\KorisnikModel;
use App\Models\FormaModel;
use App\Models\AnketaModel;
use App\Models\PitanjeModel;
use App\Models\PonudjenModel;
use App\Models\NaslovModel;
use App\Models\PosedujeModel;
use App\Models\KvizModel;
use App\Models\KorisnikKvizModel;
use App\Models\PretplataModel;
use App\Models\UplataModel;


/**
* Registrovan – klasa za operacije registrovanog korisnika
*
* @version 1.0 Autori: (Stefan Curović 2020/0068, Đorđe Golubović 2020/0112, Aleksa Trivić 2020/0198)
*/

class Registrovan extends BaseController
{
    /**
    * Funkcija koja prikazuje početnu stranicu za ulogovanog korisnika
    *
    * @param NasloviModel $naslovi naslovi
    *
    * @return void
    *
    *
    */
    
    public function pocetna($naslovi=null) {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        if ($naslovi==null) $naslovi=$this->dohvSveNaslove();
        
        $isteklaPretplata = "";
        if($korisnik->Status == "Kriticar") 
        {
            $pretplataModel = new PretplataModel();
            $pretplata = $pretplataModel->where('IDKor', $korisnik->ID)->orderBy('DatumDo', 'DESC')->first();
            
            if($pretplata && $pretplata->DatumDo <= date("Y-m-d h:i:s"))
            {
                $noviStatus = [
                    'Status' => 'Registrovan'
                ];
                
                $korisnikModel->update($korisnik->ID, $noviStatus);
                //$korisnik=$korisnikModel->find($this->session->get('idKor'));
                $isteklaPretplata = "Vaša pretplata za kritičara je istekla! Pretplatu možete obnoviti u bilo kom trenutku.";
            }
        }   
        
        $korisnikKvizModel = new KorisnikKvizModel();
        $obavesten = $korisnikKvizModel->where('IDKor', $korisnik->ID)->where('obavesten>', 0)->findAll();
        if($obavesten) {
            
            $noviObavesten = [
                'obavesten' => 0
            ];
            
            $kk = $korisnikKvizModel->where('IDKor', $korisnik->ID)->findAll();
            foreach ($kk as $deo) {
                $korisnikKvizModel->update($deo->ID, $noviObavesten);
            }
            
            return view('pocetna/pocetna_ulogovan.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
             'naslovi'=>$naslovi, 'controller' => $korisnik->Status, 'tekst'=>'Preporučujemo za vas', 'obavesten' => sizeof($obavesten), 'istekla' => $isteklaPretplata]);
        }
        
        return view('pocetna/pocetna_ulogovan.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
             'naslovi'=>$naslovi, 'controller' => $korisnik->Status, 'tekst'=>'Preporučujemo za vas', 'istekla' => $isteklaPretplata]);
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
        
        return view("ostalo/onama.php", ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime), 'controller' => $korisnik->Status]);
    }
   
    
    /**
    * Funkcija koja prikazuje formu za uplatu novca na nalog
    *
    * @param 
    *
    * @return void 
    *
    *
    */
    
    public function uplataNovca() {

        $korisnikModel = new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        return view("ostalo/uplata_novca.php", ['controller' => $korisnik->Status, 'ime' => ($korisnik->Ime . " " . $korisnik->Prezime), 'controller' => $korisnik->Status]);
        
    }


    /**
    * Funkcija koja vrši uplatu novca na nalog
    *
    * @param 
    *
    * @return void
    *
    *
    */  
    
    public function uplati() {

        $ime = $this->request->getVar('ImePrezime');
        $brKartice = $this->request->getVar('BrKartice');
        $vaziDo = $this->request->getVar('VaziDo');
        $cvv = $this->request->getVar('CVV');
        $drzava = $this->request->getVar('Drzava');
        $grad = $this->request->getVar('Grad');
        $suma = $this->request->getVar('Suma');
        switch($suma){
            case 1: $suma = 500; break;
            case 2: $suma = 1000; break;
            case 3: $suma = 1500; break;
            case 4: $suma = 2000; break;
        }

        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));

        $noviNovac = $korisnik->Novac + $suma;
        $data = [
            'Novac' => $noviNovac,
        ];

        $korisnikModel->update($korisnik->ID, $data);
        $idKor = $korisnik->ID;
        $datum = date("Y-m-d h:i:sa");

        $uplataModel = new UplataModel();

        $newRow = [
            'Suma'=> $suma,
            'Datum'=>$datum,
            'IDKor'=>$idKor,
            'BrKartice'=>$brKartice,
            'VaziDo'=>$vaziDo,
            'CVV'=>$cvv,
            'Drzava'=>$drzava,
            'Grad'=>$grad,            
        ];

        $uplataModel->save($newRow);

        return view("obavestenja/uspesna_transakcija.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'controller' => $korisnik->Status]);

    }
      
    
    /**
    * Funkcija koja se poziva kada korisnik želi da izvrši pretplatu za kritičara
    *
    * @param $poruka String poruka
    *
    * @return void
    *
    *
    */
    
    public function pretplata($poruka = null) {
        
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        return view("ostalo/pretplata.php", ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
            'poeni' => $korisnik->BrPoena, 'novac' => $korisnik->Novac, 'controller' => $korisnik->Status, 'poruka' => $poruka]);
    }
    
      
    /**
    * Funkcija koja se poziva kada korisnik odabere tip pretplate i način plaćanja
    *
    * @param $tip int Tip pretplate
    *
    * @return void
    *
    *
    */
    
    public function potvrdiPretplatu($tip) {
        
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
        $odabir = $this->request->getVar("opcija" . $tip);
        
        $cena = 299; $meseci = 1; $gratis = 0;
        if($odabir == 2) { $cena = 699; $meseci = 3; }
        else if($odabir == 3) { $cena = 1399; $meseci = 6; $gratis = 200; }
        else if($odabir == 4) { $cena = 2599; $meseci = 12; $gratis = 500; }
        
        if($tip == 1) {
            $ime = $this->request->getVar('ImePrezime');
            $brKartice = $this->request->getVar('BrKartice');
            $vaziDo = $this->request->getVar('VaziDo');
            $cvv = $this->request->getVar('CVV');
            $drzava = $this->request->getVar('Drzava');
            $grad = $this->request->getVar('Grad');

            $korisnikModel = new KorisnikModel();
            $korisnik = $korisnikModel->find($this->session->get('idKor'));

            $idKor = $korisnik->ID;
            $datum = date("Y-m-d h:i:s");

            $uplataModel = new UplataModel();

            $novaUplata = [
                'Suma'=> $cena,
                'Datum'=>$datum,
                'IDKor'=>$idKor,
                'BrKartice'=>$brKartice,
                'VaziDo'=>$vaziDo,
                'CVV'=>$cvv,
                'Drzava'=>$drzava,
                'Grad'=>$grad,            
            ];

            $uplataModel->insert($novaUplata);

            $pretplataModel = new PretplataModel();
            $datumDo = date("Y-m-d h:i:s", strtotime("+" . $meseci . "month", strtotime($datum)));
           
            $pretplata = [
                'DatumOd' => $datum,
                'DatumDo' => $datumDo,
                'IDKor' => $idKor
            ];
            
            $pretplataModel->insert($pretplata);

            $novoStanje = ['Status' => 'Kriticar', 'BrPoena' => $korisnik->BrPoena + $gratis];
            $korisnikModel->update($idKor, $novoStanje);
            $korisnik = $korisnikModel->find($this->session->get('idKor'));
            return view("obavestenja/uspesna_transakcija.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'controller' => $korisnik->Status]);
        }
        else if(($tip == 2 && $korisnik->Novac < $cena) || ($tip == 3 && $korisnik->BrPoena < $cena)) {
            return $this->pretplata('Nemate dovoljno sredstava za zeljenu transakciju!');
        }
        else {
            //transakcija        
            $datum = date("Y-m-d h:i:s");
            $idKor = $this->session->get('idKor');
            
            $pretplataModel = new PretplataModel();
            $datumDo = date("Y-m-d h:i:s", strtotime("+" . $meseci . "month", strtotime($datum)));
           
            $pretplata = [
                'DatumOd' => $datum,
                'DatumDo' => $datumDo,
                'IDKor' => $idKor
            ];
            
            $pretplataModel->insert($pretplata);

            if($tip == 2) $novoStanje = ['Novac' => $korisnik->Novac - $cena, 'Status' => 'Kriticar', 'BrPoena' => $korisnik->BrPoena + $gratis];
            else if($tip == 3) $novoStanje = ['BrPoena' => $korisnik->BrPoena - $cena + $gratis, 'Status' => 'Kriticar'];
            
            $korisnikModel->update($idKor, $novoStanje);
            $korisnik = $korisnikModel->find($this->session->get('idKor'));
            return view("obavestenja/uspesna_transakcija.php", ['ime' => $korisnik->Ime . " " . $korisnik->Prezime, 'controller' => $korisnik->Status]);
            
        }
        
    }  
    
  
    /**
    * Funkcija koja se poziva kada korisnik želi da popuni anketu
    *
    * @param
    *
    * @return 
    *
    *
    */
    
    public function anketa() {
        
       $korisnikModel=new KorisnikModel();
       $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
       $formaModel = new FormaModel();
       $anketaModel = new AnketaModel();
       $pitanjeModel = new PitanjeModel();
       $ponudjenModel = new PonudjenModel();
       
       
       $ankete=$anketaModel->findAll();
       if(empty($ankete)){
           $naslovi=$this->dohvSveNaslove();
           return view('pocetna/pocetna_ulogovan.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
           'naslovi'=>$naslovi,'controller'=>$korisnik->Status, 'tekst' => 'Rezultati pretrage: ']);
       }
       $rand_key = array_rand($ankete, 1);
       
       $anketa=$ankete[$rand_key];
       $pitanja=$pitanjeModel->dohvatiZaAnketu($anketa->ID);
       $forma=$formaModel->find($anketa->ID);
       $svi=[];
       foreach($pitanja as $pitanje){
           $svi[$pitanje->ID]=$ponudjenModel->pronadjiZaPitanje($pitanje->ID);
       }
       
        return view('anketa/anketa.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
            'pitanja'=>$pitanja,
            'odgovori'=>$svi,
            'forma'=>$forma,
            'controller' => $korisnik->Status
            ]); 
       
    }
    
    
    /**
    * Funkcija koja se poziva kada korisnik želi da pogleda sve naslove
    *
    * @param
    *
    * @return 
    *
    *
    */
    
    public function svi_naslovi() {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));       
        $posedujeModel= new PosedujeModel();
        $naslovModel=new NaslovModel();
        
        $posedovanja=$posedujeModel->pronadjiZaKorisnika($korisnik->ID);
        
        $danas=date("Y-m-d h:i:sa");
        $naslovi=[];

        foreach($posedovanja as $posedovanje){
            if ($posedovanje->DatumDo==null || $posedovanje->DatumDo>$danas){
                $naslovi[]=$naslovModel->find($posedovanje->IDNas);
            }
            
        }
        
        return view('ostalo/svi_naslovi.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
        'naslovi'=>$naslovi,'controller' => $korisnik->Status
            ]);         
    }
    
    
    /**
    * Funkcija koja se poziva kada korisnik želi da izabere kviz
    *
    * @param
    *
    * @return 
    *
    *
    */
    
    public function izaberiKviz() {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));       
        return view('kviz/izbor',['ime' => ($korisnik->Ime . " " . $korisnik->Prezime), 'controller' => $korisnik->Status]);
    }
    
    
    /** Funkcija koja se poziva kada korisnik izabere vrstu kviza
    *
    * @param String $vrsta Vrsta kviza (domaći ili strani)
    *
    * @return 
    *
    *
    */
    
    public function kviz($vrsta) {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));       
        $pitanjeModel=new PitanjeModel();
        $formaModel=new FormaModel();
        $kk=new KorisnikKvizModel();
        $kvizModel=new KvizModel();
        $kvizovi=$kvizModel->pronadjiZaVrstu($vrsta);
        $izbor=[];
        $datum=date("Y-m-d");
        
        foreach($kvizovi as $kviz){
            if ($formaModel->find($kviz->ID)->DatumDo>=$datum && $formaModel->find($kviz->ID)->BrPitanja>0){
                if ($kk->dohvatiZaKorisnikaKviz($korisnik->ID, $kviz->ID)==null){
                    $izbor[]=$kviz;
                }
            }
        }
       
        if (sizeof($izbor)==0){
            $naslovi=$this->dohvSveNaslove();
            return view('pocetna/pocetna_ulogovan.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
            'naslovi'=>$naslovi,'controller'=>$korisnik->Status, 'tekst' => 'Rezultati pretrage: ']);
        }
        $rand_key = array_rand($izbor, 1);
       
        $k=$izbor[$rand_key];
        return view('kviz/kviz_info.php',['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
            'kviz'=>$k,
            'brPitanja'=>sizeof($pitanjeModel->dohvatiZaAnketu($k->ID)),
            'controller' => $korisnik->Status
            ]);
        
    }
    
    
    /**
    * Funkcija koja se poziva kada se prikazuje kviz
    *
    * @param int $idKviza IdKviza
    *
    * @return void
    *
    *
    */   
    
    public function prikaz_kviza($idKviza) {
       $korisnikModel=new KorisnikModel();
       $korisnik=$korisnikModel->find($this->session->get('idKor'));       
        
       $formaModel = new FormaModel();
       $pitanjeModel = new PitanjeModel();
       $ponudjenModel = new PonudjenModel();
       $kvizModel = new KvizModel();

       
       $kviz=$kvizModel->find($idKviza);
       
       $pitanja=$pitanjeModel->dohvatiZaAnketu($kviz->ID);
       $forma=$formaModel->find($kviz->ID);
       
       $svi=[];
       foreach($pitanja as $pitanje){
           $svi[$pitanje->ID]=$ponudjenModel->pronadjiZaPitanje($pitanje->ID);
       }
       
        return view('kviz/kviz.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
            'pitanja'=>$pitanja,
            'odgovori'=>$svi,
            'forma'=>$forma,
            'controller' => $korisnik->Status
            ]);        
    }
    
    
    /**
    * Funkcija koja se poziva kada se popuni kviz
    *
    * @param int $idKviz IdKviza
    *
    * @return void
    *
    *
    */        
    
    public function popunjen_kviz($idKviz) {
       $b=0;
       $vremeSada=time();
       $vremePocetno=$this->request->getVar('vreme');
       
       $korisnikModel=new KorisnikModel();
       $korisnik=$korisnikModel->find($this->session->get('idKor'));       
        
       $kkModel=new KorisnikKvizModel();
       $formaModel = new FormaModel();
       $pitanjeModel = new PitanjeModel();
       $ponudjenModel = new PonudjenModel();
       $kvizModel = new KvizModel();

       $ukupno=0;
       $kviz=$kvizModel->find($idKviz);
       $pravila = explode(';', $kviz->Pravila);
       $bodovi = explode(',', $pravila[0]); 
       //$nagrade = explode(',', $pravila[1]);
       $pitanja=$pitanjeModel->dohvatiZaAnketu($kviz->ID);
       $i=0;
       foreach($pitanja as $pitanje){
           $ukupno+=$bodovi[$i];
           $odgovor=$this->request->getVar($pitanje->ID);
           $tacni=$ponudjenModel->pronadjiZaPitanjeTacne($pitanje->ID);
          
           if ($odgovor==null) {
               $i++;
               continue;
           }
  
           if ($pitanje->Tip=="CHECK"){
             $dodaj=true;
               foreach($tacni as $tacan){
                   foreach($odgovor as $odg){
                       if ($tacan->ID != $odg) {$dodaj=false;break;}
                   }
               }
               if ($dodaj) $b+=$bodovi[$i];
           }
           else if ($pitanje->Tip=="RADIO"){
               if ($tacni[0]->ID == $odgovor) $b+=$bodovi[$i];
           }
           else if ($pitanje->Tip=="SELECT"){
                if ($tacni[0]->ID == $odgovor) $b+=$bodovi[$i];

           }
           else{
               for($j = 0; $j < sizeof($tacni); $j++)
                if (strtolower($odgovor)==strtolower($tacni[$j]->Tekst)) {
                    $b+=$bodovi[$i];
                    break;
                }
           }
           
           $i++;
           
       }
       $data['IDKor']=$korisnik->ID;
       $data['IDKviz']=$kviz->ID;
       $data['BrBodova']=$b;
       $data['DatumZavrsetka']=date("Y-m-d h:i:sa");
       $data['VremeRada']=($vremeSada-$vremePocetno);
       $kkModel->save($data);
       $kvizModel->update($kviz->ID, ['BrUcesnika'=>$kviz->BrUcesnika+1]);
       
       
       return view("kviz/kviz_uspesan",[
           'ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
           'bodovi'=>$b,
           'ukupno'=>$ukupno, 'controller' => $korisnik->Status
           
       ]); 
    }
    
    
    /**
    * Funkcija koja se poziva kada korisnik želi da kupi/iznajmi neki naslov
    *
    * @param int $id ID naslova
    *
    * @return void
    *
    *
    */
    
    public function transakcija($id) {
        
        $naslovModel=new NaslovModel();
        $posedujeModel = new PosedujeModel();
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));       

        $naslov=$naslovModel->find($id);
        
        $cena=$naslov->Cena;
        $poeni=$naslov->BrPoena;
        
        $cenaIznajmi=$naslov->CenaIznajmljivanje;
        $poeniIznajmi=$naslov->PoeniIznajmljivanje;
           
        $novacKorisnika=$korisnik->Novac;
        $poeniKorisnika=$korisnik->BrPoena;
        
        $nacin=$this->request->getVar('placanje');
        $sta=$this->request->getVar('zelja');
        
        $data=[];
        $poseduje=[];
        
        if ($nacin=="novac" && $sta=="kupi"){
            if ($novacKorisnika-$cena<0) return view('obavestenja/neuspesna_transakcija.php',[
                'ime' => ($korisnik->Ime . " " . $korisnik->Prezime), 'controller' => $korisnik->Status
            ]);
            $data['Novac']=$novacKorisnika-$cena;
            $poseduje['DatumOd']=date("Y-m-d h:i:sa");
            //$poseduje['DatumDo']=date('d/m/Y h:i:sa', strtotime('+7 days'));
            $poseduje['IDKor']=$korisnik->ID;
            $poseduje['IDNas']=$id;
        }
        else if ($nacin=="novac" && $sta=="iznajmi"){
                if ($novacKorisnika-$cenaIznajmi<0) return view('obavestenja/neuspesna_transakcija.php',[
                'ime' => ($korisnik->Ime . " " . $korisnik->Prezime), 'controller' => $korisnik->Status
            ]);
            $data['Novac']=$novacKorisnika-$cenaIznajmi;

            $poseduje['DatumOd']=date("Y-m-d h:i:sa");
            $date = date('Y-m-d h:i:sa'); //today date

            for($i =1; $i <= 7; $i++){
            $date = date('Y-m-d h:i:sa', strtotime('+1 day', strtotime($date)));
 
            }
            $poseduje['DatumDo']=$date;

            $poseduje['IDKor']=$korisnik->ID;
            $poseduje['IDNas']=$id;
        }
        else if ($nacin=="poeni" && $sta=="kupi"){
            if ($poeniKorisnika-$poeni<0) return view('obavestenja/neuspesna_transakcija.php',[
                'ime' => ($korisnik->Ime . " " . $korisnik->Prezime), 'controller' => $korisnik->Status
            ]);
            $data['BrPoena']=$poeniKorisnika-$poeni;
            
            $poseduje['DatumOd']=date("Y-m-d h:i:sa");
            //$poseduje['DatumDo']=date('d/m/Y h:i:sa', strtotime('+7 days'));
            $poseduje['IDKor']=$korisnik->ID;
            $poseduje['IDNas']=$id;
        }
        else{
            if ($poeniKorisnika-$poeniIznajmi<0) return view('obavestenja/neuspesna_transakcija.php',[
                'ime' => ($korisnik->Ime . " " . $korisnik->Prezime), 'controller' => $korisnik->Status
            ]);
            $data['BrPoena']=$poeniKorisnika-$poeniIznajmi;
            $date = date('Y-m-d h:i:sa'); //today date

            for($i =1; $i <= 7; $i++){
            $date = date('Y-m-d h:i:sa', strtotime('+1 day', strtotime($date)));
 
          }
            
            $poseduje['DatumOd']=date("Y-m-d h:i:sa");
            $poseduje['DatumDo']=$date;
            $poseduje['IDKor']=$korisnik->ID;
            $poseduje['IDNas']=$id;
        }
        
        if ($sta=="kupi" && $nacin=="novac") {$data['BrPoena']=$korisnik->BrPoena+$naslov->NosiPoena;}
        else if ($sta=="kupi" && $nacin=="poeni"){
            $data['BrPoena']+=$naslov->NosiPoena;
        }
        
        $korisnikModel->update($korisnik->ID, $data);
        $posedujeModel->save($poseduje);    
        
        return view('obavestenja/uspesna_transakcija.php',[
                'ime' => ($korisnik->Ime . " " . $korisnik->Prezime), 'controller' => $korisnik->Status
            ]); 
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
    
    public function prikazPretrage($naslovi) {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));
        return view('pocetna/pocetna_ulogovan.php',['naslovi' => $naslovi, 'ime' => ($korisnik->Ime . " " . $korisnik->Prezime), 'controller' => $korisnik->Status, 'tekst'=>'Rezultati pretrage']);
    }
  
    
    /**
    * Funkcija koja se poziva kada se zavrsi anketa
    *
    * @param int $id idForme
    *
    * @return void
    *
    *
    */
    
    public function zavrsena_anketa($id) {
       $korisnikModel=new KorisnikModel();
       $korisnik=$korisnikModel->find($this->session->get('idKor'));
        
       $formaModel = new FormaModel();
       $forma=$formaModel->find($id);
       $data=[];
       $data['BrPoena']=$korisnik->BrPoena+$forma->BrPitanja;
       $korisnikModel->update($korisnik->ID,$data);
       return $this->pocetna();
    }
}
