<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * KvizModel - model za rad sa tabelom 'kviz' u bazi podataka
 * 
 * @version 1.0
 */
class KvizModel extends Model
{
        protected $table      = 'kviz';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';
        
        protected $allowedFields = ['Vrsta', 'Pravila', 'DatObj', 'BrUcesnika', 'ID'];
        
        /**
         * Funkcija za dohvatanje svih kvizova date vrste (domaći ili strani)
         * 
         * @param string $vrsta vrsta
         * @return type
         */
        public function pronadjiZaVrstu($vrsta){
            return $this->where('vrsta',$vrsta)->findAll();
        }

    
}