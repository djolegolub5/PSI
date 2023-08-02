<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * KorisnikKviz - model za rad sa tabelom 'korisnikkviz' u bazi podataka
 * 
 * @version 1.0
 */
class KorisnikKvizModel extends Model
{
        protected $table      = 'korisnikkviz';
        protected $returnType = 'object';
        
        protected $allowedFields = ['IDKor', 'IDKviz', 'BrBodova', 'VremeRada', 'DatumZavrsetka', 'ID', 'obavesten'];
        
        /**
         * Funkcija za dohvatanje svih rezultata datog korisnika na datom kvizu
         * 
         * @param int $idKor ID_korisnika int $idKviz ID_kviza
         * @return KorisnikKvizModel
         */
        public function dohvatiZaKorisnikaKviz($idKor,$idKviz){
            return $this->where("IDKor",$idKor)->where("IDKviz",$idKviz)->findAll();
        }

    
}