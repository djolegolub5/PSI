<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * NaslovModel - model za rad sa tabelom 'naslov' u bazi podataka
 * 
 * @version 1.0
 */
class NaslovModel extends Model
{
        protected $table      = 'naslov';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';

        protected $allowedFields = ['Ime', 'Godina', 'Zanr', 'Opis', 'Link', 'BrPoena','Slika', 'ProsOcena','BrSezona', 'Trajanje', 'NosiPoena', 'CenaIznajmljivanje', 'PoeniIznajmljivanje', 'Kategorija'];

        
        /**
         * Funkcija za proveru da li već postoji naslov sa datim imenom
         * 
         * @param string $naslov naslov
         * @return int
         */
        public function vecPostojiNaslov($naslov) {
            $naslovi =  $this->where('Ime', $naslov)->findAll();
            if ($naslovi == null) return 0;
            else return 1;      
        }
        
        
        /**
         * Funckija za dohvatanje naslova sa datim imenom
         * 
         * @param string $naslov naslov
         * @return NaslovModel
         */
        public function pronadjiZaNaslov($naslov){
            $naslov =  $this->where('Ime', $naslov)->first();
            return $naslov;
        }
        
        
        /**
         * Funkcija za dohvatanje naslova datih žanrova
         * 
         * @param array $zanr žanrovi
         * @return array
         */
        public function dohvPoZanru($zanr){
                $zanrovi = ["Akcija", "Triler", "Drama", "Horor", "Komedija", "Naučna fantastika", "Avantura", "Romansa", "Fantastika", "Drugi"];
                $naslovi =  $this->findAll();

                $rez = [];
                foreach($naslovi as $naslov){

                        $zanr_naslov = explode(', ', $naslov->Zanr);
                        if(!empty(array_intersect($zanr, $zanr_naslov))){
                                array_push($rez, $naslov);
                                
                        }else if (in_array("Drugi", $zanr) && array_intersect($zanr_naslov, $zanrovi)!=$zanr_naslov){
                                array_push($rez, $naslov);
                        }  
                }
                if(empty($rez)) return null;
                return $rez;
        }

        
        /**
         * Funkcija za dohvatanje naslova date kategorije (film ili serija)
         * 
         * @param string $kat kategorija
         * @return NaslovModel
         */
        public function dohvPoKat($kat){
            $naslovi = $this->like('Kategorija', $kat)->findAll();
            return $naslovi;
        }
        
        
        /**
         * Funkcija za dohvatanje naslova sa minimalnom datom prosečnom ocenom
         * 
         * @param int $ocena ocena
         * @return NaslovModel
         */
        public function dohvPoOceni($ocena){
            $naslovi = $this->where('ProsOcena >=', $ocena)->findAll();
            return $naslovi;
        }
        
        
        /**
         * Funkcija za dohvatanje naslova koji u svom imenu sadrže dati tekst
         * 
         * @param string $tekst tekst
         * @return NaslovModel
         */
        public function dohvPoNazivu($tekst){
            return $this->like('Ime', $tekst)->findAll();
        }
        
        
        /**
         * Funkcija za dohvatanje naslova koji su "u trendu"
         * 
         * @param
         * @return NaslovModel
         */
        public function dohvUTrendu() {
            return $this->where('Godina', 2023)->where('ProsOcena >=', 9)->findAll();
        }
}