<?php
namespace App\Controllers;


use App\Models\KorisnikModel;
use App\Models\NaslovModel;
use App\Models\SuspendovanModel;
use CodeIgniter\Files\File;

/**
* Gost – klasa za operacije registrovanog korisnika
*
* @version 1.0   Autori: (Stefan Curović 2020/0068, Đorđe Golubović 2020/0112, Aleksa Trivić 2020/0198, Teodora Ristović 2020/0566)
*/

class Gost extends BaseController
{
    /**
    * Funkcija koja prikazuje početnu stranicu za neulogovanog korisnika
    *
    * @param 
    *
    * @return void
    *
    *
    */
    
    public function pocetna() {

        return view('pocetna/index.php',['naslovi' => $this->dohvSveNaslove()]);
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
        return view("ostalo/onama.php", ['controller' => 'Gost']);
    }
    
    
    /**
    * Funkcija koja prikazuje stranicu za prijavu
    *
    * @param String $poruka poruka
    *
    * @return void
    *
    *
    */
    
    public function prijava($poruka = null) {
        return view("ostalo/prijava.php", ['controller' => 'Gost', 'poruka' => $poruka]);   
    }
    
    
    /**
    * Funkcija koja prikazuje stranicu za registraciju
    *
    * @param String $poruka poruka
    *
    * @return void
    *
    *
    */
    
    public function registracija($poruka = null) {
        return view("ostalo/registracija.php", ['controller' => 'Gost', 'poruka' => $poruka]);
    }
    
    
    /**
    * Funkcija koja dodaje novokreirani nalog u bazu
    *
    * @param 
    *
    * @return void
    *
    *
    */
    
    public function dodajNalog() {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('lozinka');
        $ime = $this->request->getVar('ime');
        $prezime = $this->request->getVar('prezime');
        $mejl = $this->request->getVar('mejl');
        $telefon = $this->request->getVar('telefon');
        $datum = $this->request->getVar('datum');
        $novac = 0;
        $poeni = 0;
        $datumReg = date('Y-m-d h:i:s a', time());
        $status = "Neautorizovan";
        
        $korisnikModel = new KorisnikModel();
        
        $korisnik = $korisnikModel->where('KorIme', $username)->first();
        if($korisnik != null){
            return $this->registracija('Korisničko ime već postoji!');
        }
        
        $korisnik = $korisnikModel->where('Email', $mejl)->first();
        if($korisnik != null){
            return $this->registracija('Postoji korisnik sa datim mejlom!');
        }
        
        $re = "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";
        if (!preg_match($re, $password)){
            return $this->registracija('Lozinka nije u ispravnom formatu!');
        }
        
        $re = "/^\\S+@\\S+\\.\\S+$/";
        if (!preg_match($re, $mejl)){
            return $this->registracija('Email nije u ispravnom formatu!');
        }
        
        $re = "/^\\+?[1-9][0-9]{7,14}$/";
        if (!preg_match($re, $telefon)){
            return $this->registracija('Broj telefona nije u ispravnom formatu!');
        }
        
        $slika = $this->request->getFile('slika');
        $newName=null;

        if ($slika!=''){
        
        $extension = $slika->getClientExtension();
        $newName = uniqid() . '.' . $extension;
           
        $slika->move('C:\\wamp64\\www\\codeigniter_base\\public\\assets', $newName);
        }
        
        $data = [
            'Ime'=>$ime,
            'Prezime'=>$prezime,
            'KorIme'=>$username,
            'Lozinka'=>$password,
            'DatRodjenja'=>$datum,
            'Email'=>$mejl,
            'BrTel'=>$telefon,
            'Slika'=>$newName,
            'BrPoena'=>$poeni,
            'Novac'=>$novac,
            'DatReg'=>$datumReg,
            'Status'=>$status
        ];
        
        $korisnikModel->save($data);
        
         return view("obavestenja/uspesna_registracija.php"); 
    }
    
    
    /**
    * Funkcija koja obrađuje zahtev za Login
    *
    * @param 
    *
    * @return void
    *
    *
    */
    
    public function loginProvera() {
              
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->where('KorIme', $username)->first();
        
        if($korisnik==null) {
            return $this->prijava('Korisnik ne postoji!');
        }
        if($korisnik->Lozinka != $password) {
            return $this->prijava('Pogrešna lozinka!');
        }
        
        $this->session->set('idKor', $korisnik->ID);
       
        if($korisnik->Status == "Registrovan") { return redirect()->to(site_url('Registrovan/pocetna')); }
        else if($korisnik->Status == "Kriticar") { return redirect()->to(site_url('Kriticar/pocetna')); }
        else if($korisnik->Status == "Admin") { $this->proveraSuspenzije($korisnik->ID); return redirect()->to(site_url ('Admin/pocetna')); }
        else if ($korisnik->Status=="Suspendovan") {
            if($this->proveraSuspenzije($korisnik->ID)) 
                return $this->prijava('Nalog je suspendovan! Moći ćete da se ulogujete kad istekne period suspenzije...');
            else return redirect()->to(site_url('Registrovan/pocetna'));
        }else{
            return $this->prijava('Nalog jos uvek nije autorizovan!');
        }
    }
    
    
    /**
    * Funkcija koja proverava da li je korisnik suspendovan
    *
    * @param int $id id
    *
    * @return 
    *
    *
    */
    
    public function proveraSuspenzije($id) {
        $suspendovanModel = new SuspendovanModel();
        
        $suspendovan = $suspendovanModel->where('IDKor', $id)->orderBy('Datum', 'DESC')->first();
        
        if($suspendovan) {
            if(date("Y-m-d h:i:sa", strtotime('+' . $suspendovan->Trajanje . 'hours', strtotime($suspendovan->Datum))) <= date("Y-m-d h:i:sa")) {
                $noviStatus = [
                    'Status' => 'Admin'
                ];
                
                $korisnikModel = new KorisnikModel();
                if($korisnikModel->find($id)->Status != "Admin")
                     $noviStatus = [
                    'Status' => 'Registrovan'
                ];
                
                $korisnikModel->update($id, $noviStatus);
                return false;
            }
            else return true;
        }
       return false;
    }
}
