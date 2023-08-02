<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\NaslovModel;
use App\Models\KorisnikModel;
use App\Models\KomentarModel;
use App\Models\PosedujeModel;


/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */


/**
* BaseController – klasa za opšte operacije
*
* @version 1.0 Autori: (Teodora Ristović 2020/0566, Stefan Curović 2020/0068, Đorđe Golubović 2020/0112, Aleksa Trivić 2020/0198)
*/

abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Kreiranje nove instance
     * 
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();
        
    }

      
    /**
    * Funkcija koja se poziva zarad dohvatanja svih postojećih naslova
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function dohvSveNaslove() {
        $naslovModel = new NaslovModel();
        return $naslovModel->findAll();
    }

    
    /**
    * Funkcija koja se poziva zarad dohvatanja svih postojećih naslova koji pripadaju datoj kategoriji
    *
    * @param String $kat kategorija
    *
    * @return void
    *
    *
    */
    
    public function dohvPoKat($kat) {

        $naslovModel = new NaslovModel();
        $naslovi = $naslovModel->dohvPoKat($kat);
       
        return $naslovi;
    }

     
    /**
    * Funkcija koja se poziva zarad dohvatanja svih postojećih naslova sa minimalnom datom prosečnom ocenom
    *
    * @param double $ocena ocena
    *
    * @return void
    *
    *
    */
    
    public function dohvPoOceni($ocena) {
        $naslovModel = new NaslovModel();
        $naslovi = $naslovModel->dohvPoOceni($ocena);
        return $naslovi;
    }

    
    /**
    * Funkcija koja se poziva zarad dohvatanja svih postojećih naslova datog žanra
    *
    * @param String $zanr zanr
    *
    * @return void
    *
    *
    */
    
    public function dohvPoZanru($zanr) {
        $naslovModel = new NaslovModel();
        $naslovi = $naslovModel->dohvPoZanru($zanr);
        return $naslovi;
    }

    
    /**
    * Funkcija koja se poziva zarad dohvatanja svih postojećih naslova sa prosleđenim kriterijumima
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function pregled() {

        $ocena = $this->request->getVar('ocena');
        $kategorija = $this->request->getVar('kategorija[]');
        $zanr = $this->request->getVar('zanr[]');

        //echo var_dump($kategorija); exit();

 

        //dohvatamo, ako je moguce, sve naslove trazene kategorije
        if($kategorija != null && sizeof($kategorija) != 0) {
            $nPoKat = $this->dohvPoKat($kategorija[0]);
            if(count($kategorija) == 2) {
                $nPoKat = array_merge($nPoKat, $this->dohvPoKat($kategorija[1]));
            }
            if ($ocena == null && $zanr== null) return $this->prikazPretrage($nPoKat);
            if ($nPoKat== null) $nPoKat = [];
        }

 

        //dohvatamo, ako je moguce, sve naslove sa trazenom ocenom
        if ($ocena != null) {
            $nPoOceni = $this->dohvPoOceni($ocena);
            if ($kategorija == null && $zanr == null) return $this->prikazPretrage($nPoOceni);
            if ($nPoOceni== null) $nPoOceni = [];
        }

 

        //dohvatamo, ako je moguce, sve naslove sa trazenim zanrom
        if ($zanr != null && sizeof($zanr) != 0) {
            $nPoZanru = $this->dohvPoZanru($zanr);
            if ($kategorija == null && $ocena == null) return $this->prikazPretrage($nPoZanru);
            if ($nPoZanru== null) $nPoZanru = [];
        }

 

        $rezultat = [];
        if ($kategorija != null && $ocena != null && $zanr != null && sizeof($kategorija) != 0 && sizeof($zanr) != 0){
            foreach($nPoKat as $ni){
                if(in_array($ni, $nPoOceni) && in_array($ni, $nPoZanru) && !in_array($ni, $rezultat)) array_push($rezultat, $ni);
            }
            return $this->prikazPretrage($rezultat);
        }

 

        if($kategorija != null && $ocena!= null && sizeof($kategorija) != 0){
            foreach($nPoKat as $ni){
                if(in_array($ni, $nPoOceni) && !in_array($ni, $rezultat)) array_push($rezultat, $ni);
            }
            return $this->prikazPretrage($rezultat);
        }

 

        if($kategorija != null && $zanr!= null && sizeof($kategorija) != 0 && sizeof($zanr) != 0){
            foreach($nPoKat as $ni){
                if(in_array($ni, $nPoZanru) && !in_array($ni, $rezultat)) array_push($rezultat, $ni);
            }
            return $this->prikazPretrage($rezultat);
        }

 

        if($ocena != null && $zanr!= null && sizeof($zanr) != 0){
            foreach($nPoZanru as $ni){
                if(in_array($ni, $nPoOceni) && !in_array($ni, $rezultat)) array_push($rezultat, $ni);
            }
            return $this->prikazPretrage($rezultat);
        }

 

        return $this->prikazPretrage($this->dohvSveNaslove());
    }

   
    /**
    * Funkcija koja se poziva kada korisnik želi da se odjavi
    *
    * @param
    *
    * @return 
    *
    *
    */
    
    public function odjava() {
        $this->session->destroy();
        $naslovi = $this->dohvSveNaslove();
        return view("pocetna/index.php", ['naslovi' => $naslovi]);
    }
    
    
    /**
    * Funkcija koja se poziva kada korisnik izabere neki naslov
    *
    * @param String $ime ime, String $greska greška
    *
    * @return void
    *
    *
    */
    
    public function naslov($ime, $greska=null) {
        
        $naslovModel=new NaslovModel();
        $komentarModel=new KomentarModel();
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor'));       
        $posedujeModel = new PosedujeModel();
        
        $naslov=$naslovModel->pronadjiZaNaslov($ime);
        $komentari=$komentarModel->pronadjiZaNaslov($naslov->ID);
        $korisnici=[];
        foreach($komentari as $komentar){
            $korisnici[$komentar->ID]=$korisnikModel->find($komentar->IDKor);
        }
        
        
        
        $posedovanja=$posedujeModel->pronadjiZaNaslovKorsinika($naslov->ID, $korisnik->ID);
        
        $ima=false;
        $danas=date("Y-m-d h:i:sa");
        foreach($posedovanja as $posedovanje){
            if ($posedovanje->DatumDo==null || $posedovanje->DatumDo>$danas){
                $ima=true;
                break;
            }
        }
        
        if($greska != null) $greska = "Komentare na naslove mozete objavljivati jednom u minutu.";
        
        if($korisnik->Status == "Registrovan" || $korisnik->Status == "Kriticar") { 
            return view('naslov/naslov.php',
                    ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
                      'korisnik'=>$korisnik,
                        'komentari'=>$komentari,
                        'korisnici'=>$korisnici,
                        'naslov'=>$naslov,
                        'ima'=>$ima,
                        'status' => $korisnik->Status,
                        'greska' => $greska,
                        'slikaK' => $korisnik->Slika,
                        'controller'=>$korisnik->Status
                    ]);
        }
        
        /*else if($korisnik->Status == "Kriticar") { 
             return view('naslov/naslov.php',
                    ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
                      'korisnik'=>$korisnik,
                        'komentari'=>$komentari,
                        'korisnici'=>$korisnici,
                        'naslov'=>$naslov,
                        'ima'=>$ima,
                        'status' => 'Kriticar',
                        'greska' => $greska,
                        'slikaK' => $korisnik->Slika,
                        'controller'=>$korisnik->Status
                     ]);
        }*/
        else if($korisnik->Status == "Admin") { 
            return view('naslov/naslov_administrator.php',
                    ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
                      'korisnik'=>$korisnik,
                        'komentari'=>$komentari,
                        'korisnici'=>$korisnici,
                        'naslov'=>$naslov,
                        'ima'=>$ima,
                        'status' => 'Admin',
                        'greska' => $greska,
                        'slikaK' => $korisnik->Slika,
                        'controller'=>$korisnik->Status
                    ]);
        }
        else { return redirect()->to(site_url('Suspendovan')); }    
    }
    
    
    /**
    * Funkcija koja se poziva kada korisnik želi da pogleda svoj
    *
    * @param
    *
    * @return 
    *
    *
    */
    
    public function profil() {
        
        if(empty($this->session->get('idKor'))) return redirect()->to(site_url("Gost/pocetna"));
        
        $korisnikModel=new KorisnikModel();
        $sad=$korisnikModel->find($this->session->get('idKor')); //promenio Aleksa
        $posedujeModel= new PosedujeModel();
        $naslovModel=new NaslovModel();
        
        $posedovanja=$posedujeModel->pronadjiZaKorisnika($sad->ID);
        
        $danas=date("Y-m-d h:i:sa");
        $naslovi=[];

        foreach($posedovanja as $posedovanje){
            if ($posedovanje->DatumDo==null || $posedovanje->DatumDo>$danas){
                $naslovi[]=$naslovModel->find($posedovanje->IDNas);
            }
            
        }
        
        
        
        $brojFilmova=sizeof($naslovi);
        return view('ostalo/profil.php', ['ime' => ($sad->Ime . " " . $sad->Prezime),
        'username'=>$sad->KorIme,
        'poeni'=>$sad->BrPoena,
        'novac'=>$sad->Novac,
        'slika'=>$sad->Slika,
        'broj_filmova'=>$brojFilmova,
        'naslovi'=>$naslovi, 'controller' => $sad->Status
            ]); 
    }
    
    
    /**
    * Funkcija koja se poziva kada korisnik želi da promeni svoje podatke
    *
    * @param 
    *
    * @return void
    *
    *
    */
    
    public function promena() {
        
        if(empty($this->session->get('idKor'))) return redirect()->to(site_url("Gost/pocetna"));
        
        $korisnikModel=new KorisnikModel();
        $sad=$korisnikModel->find($this->session->get('idKor'));
        
        $username = $this->request->getVar('username');
        $stara=$this->request->getVar('stara');
        $nova=$this->request->getVar('nova'); 
        $ime=$this->request->getVar('ime');
        $prezime=$this->request->getVar('prezime');
        $email=$this->request->getVar('email');
        $telefon=$this->request->getVar('telefon');

        if ($username!=null){
            $korisnik = $korisnikModel->where('KorIme', $username)->first();
            if ($korisnik!=null){
                 return view('ostalo/podesavanja.php', ['ime' => ($sad->Ime . " " . $sad->Prezime),
                'username'=>$sad->KorIme,
                'email'=>$sad->Email,
                'telefon'=>$sad->BrTel,
                'prezime'=>$sad->Prezime,
                'korisnicko'=>"Username već postoji!", 'controller' => $sad->Status,
                     'slika'=>$sad->Slika,
            ]); 
            }
            
        }
        if ($stara!=null){
            if ($sad->Lozinka!=$stara){
                return view('ostalo/podesavanja.php', ['ime' => ($sad->Ime . " " . $sad->Prezime),
                'username'=>$sad->KorIme,
                'email'=>$sad->Email,
                'telefon'=>$sad->BrTel,
                'prezime'=>$sad->Prezime,
                'stara'=>"Stara lozinka nije dobro uneta!", 'controller' => $sad->Status,'slika'=>$sad->Slika]
                        );
            }
            else{
                $ponovo=$this->request->getVar('ponovo');
                
                $re = "/^(?=.*[a-z])(?=.*\\d).{8,}$/i"; 
                
                if ($nova==null || (!preg_match($re, $nova))) {
                return view('ostalo/podesavanja.php', ['ime' => ($sad->Ime . " " . $sad->Prezime),
                'username'=>$sad->KorIme,
                'email'=>$sad->Email,
                'telefon'=>$sad->BrTel,
                'prezime'=>$sad->Prezime,'slika'=>$sad->Slika,
                'nova'=>"Nova lozinka nije u odgovarajućem formatu!", 'controller' => $sad->Status]);
                }
                else{
                    if ($ponovo==null || $ponovo!=$nova){
                     return view('ostalo/podesavanja.php', ['ime' => ($sad->Ime . " " . $sad->Prezime),
                    'username'=>$sad->KorIme,
                    'email'=>$sad->Email,
                    'telefon'=>$sad->BrTel,
                    'prezime'=>$sad->Prezime,'slika'=>$sad->Slika,
                    'ponovo'=>"Ponovljena lozinka nije ista kao nova!", 'controller' => $sad->Status]);
                    }
                }
            }
        }
        
        $data=[];
        if ($ime!=null){
            $data['Ime']=$ime;
        }
        if ($prezime!=null){
            $data['Prezime']=$prezime;
        }
        if ($username!=null){
            $data['KorIme']=$username;
        }
        if ($stara!=null){
            $data['Lozinka']=$nova;

        }
        if ($email!=null){
            $data['Email']=$email;
        }
        if ($telefon!=null){
            $data['BrTel']=$telefon;
        }
        
        if (sizeof($data)>0)$korisnikModel->update($sad->ID, $data);
              
        if($sad->Status == "Registrovan" || $sad->Status=="Kriticar") { return redirect()->to(site_url('Registrovan/pocetna')); }
        else if($sad->Status == "Admin") { return redirect()->to(site_url ('Admin/pocetna')); }
        else { return redirect()->to(site_url('Suspendovan')); }
              
    }
    
    
    /**
    * Funkcija koja se poziva kada korisnik želi da obriše profil
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function brisanje() {
        
        if(empty($this->session->get('idKor'))) return redirect()->to(site_url("Gost/pocetna"));
        
        $korisnikModel=new KorisnikModel();
        $sad=$korisnikModel->find($this->session->get('idKor'));
        $korisnikModel->delete($sad->ID);
        return view("obavestenja/uspesno_brisanje_profila.php");
    }
    
    
    /**
    * Funkcija koja se poziva kada korisnik želi da pretraži neki naslov na osnovu naziva
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function pregledPoNazivu() {
        
        if(empty($this->session->get('idKor'))) return redirect()->to(site_url("Gost/pocetna"));
        
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));
        $naslovModel=new NaslovModel();
        $naslovi=$naslovModel->dohvPoNazivu($this->request->getVar("search"));
        $tekst = "Rezultati pretrage: ";
        
        if($korisnik->Status == "Admin") {
            return view('pocetna/pocetna_administrator.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
            'naslovi'=>$naslovi, 'controller' => $korisnik->Status, 'tekst' => $tekst]);
        }
        else {
             return view('pocetna/pocetna_ulogovan.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
            'naslovi'=>$naslovi, 'controller' => $korisnik->Status, 'tekst' => $tekst]);
        }
    }
    
    
    /**
    * Funkcija koja se poziva kada korisnik želi da pretraži neki naslov na osnovu naziva, sa asinhronim odgovorom
    *
    * @param String $search pretraga
    *
    * @return void
    *
    *
    */
    
    public function ajaxPregledPoNazivu($search = null) {
        if(empty($this->session->get('idKor'))) return redirect()->to(site_url("Gost/pocetna"));
        if(!$search) return;
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));
        $naslovModel=new NaslovModel();
        $naslovi=$naslovModel->dohvPoNazivu($search);
        
        $i = 0;
        foreach ($naslovi as $naslov) {
            echo "<hr><a style = 'color: black;' class='nav-item nav-link' href = '" . site_url("{$korisnik->Status}/naslov/" . $naslov->Ime) . "'><div>" . $naslov->Ime . " (" . $naslov->Godina . ")</div></a>";
            $i++;
            if($i == 10) break;
        }
    }
    
    
    /**
    * Funkcija koja se poziva kada korisnik želi da pretraži naslove u trendu, sa asinhronim odgovorom
    *
    * @param
    *
    * @return void
    *
    *
    */
    
    public function ajaxUTrendu() {
        if(empty($this->session->get('idKor'))) return redirect()->to(site_url("Gost/pocetna"));
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));
        $naslovModel=new NaslovModel();
        $naslovi=$naslovModel->dohvUTrendu();
       
        if($naslovi == null) echo "Ne postoje naslovi koji zadovoljavaju zahteve";
        else {
            $i = 0;
            $n = sizeof($naslovi);
            for($j = 0; $j < $n; $j++) {
                $k = rand(0, $n - 1);
                $pom = $naslovi[$j];
                $naslovi[$j] = $naslovi[$k];
                $naslovi[$k] = $pom;
            }
            foreach ($naslovi as $naslov) {
                if ($i>=12) break;
                $slika = $naslov->Slika;
                $putanja;
                if(empty($slika)) { 
                  $putanja = "'". base_url() . "assets/no_image.png'";
                }
                else {
                  $putanja = "'". base_url() . "/assets/" . $slika ."'";
                  header("Content-Type: image/jpg");
                }
                $where=site_url("{$korisnik->Status}/naslov/$naslov->Ime");
                if($naslov->Zanr == "0") $naslov->Zanr = "";
                echo 
                "<div class=\"col mb-5\">
                    <div class=\"card h-100\">
                        <!-- Product image-->
                        <img class=\"card-img-top\" src=$putanja alt=SLIKA>
                        <!-- Product details-->
                        <div class=\"card-body p-4\">
                            <div class=\"text-center\">
                                <!-- Product name-->
                                <h5 class=\"fw-bolder\">{$naslov->Ime}</h5>
                                <!-- Product price-->
                                {$naslov->Zanr}<br>";
                                if($naslov->Kategorija=="Film"){
                                  if($naslov->Trajanje == "0") echo "</div>"; else 
                                  echo "{$naslov->Trajanje}min
                              </div>";
                                }else {
                                  if($naslov->BrSezona == "0") echo "</div>"; else 
                                  echo "{$naslov->BrSezona} sezona
                                  </div>";
                                }

                            echo "
                        </div>
                        <!-- Product actions-->
                        <div class=\"card-footer p-4 pt-0 border-top-0 bg-transparent\">
                            <div class=\"text-center\"><a class=\"btn btn-outline-dark mt-auto\" href=$where>Izaberi</a></div>
                        </div>
                    </div>
                </div>";
                $i++;
                }
          }
    }
    
    
    /**
    * Funkcija koja prikazuje stranicu sa podešavanjima za korisnika
    *
    * @param 
    *
    * @return void
    *
    *
    */
     
    public function podesavanja() {
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($this->session->get('idKor')); //promenio Aleksa
        return view('ostalo/podesavanja.php', ['ime' => ($korisnik->Ime . " " . $korisnik->Prezime),
                'username'=>$korisnik->KorIme,
                'email'=>$korisnik->Email,
                'telefon'=>$korisnik->BrTel,
                'prezime'=>$korisnik->Prezime,
                'slika'=>$korisnik->Slika, 'controller' => $korisnik->Status
            ]);   
    }
}
