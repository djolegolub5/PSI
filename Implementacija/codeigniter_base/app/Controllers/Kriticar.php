<?php

namespace App\Controllers;
use App\Models\KorisnikModel;
use App\Models\KomentarModel;
use App\Models\OcenaModel;
use App\Models\NaslovModel;
use App\Controllers\Registrovan;


/**
* Kritičar – klasa za operacije kritičara
*
* @version 1.0 Autor: (Stefan Curović 2020/0068)
*/

class Kriticar extends Registrovan
{
       
    /**
    * Funkcija koja se poziva za objavu komentara na izabrani naslov
    *
    * @param int $idNas ID Naslova
    *
    * @return void
    *
    *
    */  
    
    public function objavaKomentara($idNas) {
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($this->session->get('idKor'));
        $komentar = $this->request->getVar("komentar");
        $idKor = $this->session->get('idKor');
        $zvezdice = $this->request->getVar("zvezdice");
        
        $komentarModel = new KomentarModel();
        $mojKomentar = $komentarModel->where('IDNas', $idNas)->where('IDKor', $idKor)->orderBy('Datum', 'DESC')->first();
        
        $naslovModel = new NaslovModel();
        $imeNaslova = $naslovModel->find($idNas)->Ime;
       
        
        if($mojKomentar != null && abs(strtotime($mojKomentar->Datum) - strtotime(date("Y-m-d h:i:s"))) < 60) {
           return redirect()->to(site_url("Registrovan/naslov/{$imeNaslova}/Prebrzo"));
        }
        else {
            $noviKomentar = [
                'Komentar' => $komentar,
                'Datum' => date("Y-m-d h:i:s"),
                'IDKor' => $idKor,
                'IDNas' => $idNas
            ];
            
            $komentarModel->insert($noviKomentar);
            
            if($zvezdice > 0) {
               $ocenaModel = new OcenaModel();
               $ocene = $ocenaModel->where('IDKor', $idKor)->where('IDNas', $idNas)->findAll();

               if($ocene == null) {
                    $novaOcena = [
                        'Ocena' => $zvezdice,
                        'IDKor' => $idKor,
                        'IDNas' => $idNas
                    ];

                    $ocenaModel->insert($novaOcena);

                    //prosecna sa IMDB-a + sve korisnicke do sad = sve korisnicke do sad + nova ocena = brojOcena
                    $brojOcena = sizeof($ocenaModel->where('IDNas', $idNas)->findAll());
                    $naslov = $naslovModel->find($idNas);
                    $novaProsecna = ['ProsOcena' => (( $naslov->ProsOcena * $brojOcena + $zvezdice ) / ($brojOcena + 1.0))];
                    $naslovModel->update($idNas, $novaProsecna);
               }
            }
            
            return redirect()->to(site_url("Registrovan/naslov/{$imeNaslova}"));
        }    
    }
}
