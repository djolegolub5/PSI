<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * PitanjeModel - model za rad sa tabelom 'pitanje' u bazi podataka
 * 
 * @version 1.0
 */
class PitanjeModel extends Model
{
        protected $table      = 'pitanje';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';
        
        protected $allowedFields = ['Tip', 'Tekst', 'DrugiTekst', 'Slika', 'BrPonudjenih', 'IDFor'];
        
        
        /**
         * Funckija za dohvatanje svih pitanja date forme
         * 
         * @param int $idA ID_ankete
         * @return PitanjeModel
         */
        public function dohvatiZaAnketu($idA){
            return $this->where("IDFor",$idA)->findAll();
        }
}