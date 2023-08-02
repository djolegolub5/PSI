<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * PonudjenModel - model za rad sa tabelom 'ponudjen' u bazi podataka
 * 
 * @version 1.0
 */
class PonudjenModel extends Model
{
        protected $table      = 'ponudjen';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';
        
        protected $allowedFields = ['Tekst', 'Tacan', 'IDPit'];
        
        /**
         * Funckija za dohvatanje svih ponuđenih odgovora datog pitanja
         * 
         * @param int $idP ID_pitanja
         * @return PonudjenModel
         */
        public function pronadjiZaPitanje($idP){
            return $this->where("IDPit",$idP)->findAll();
        }
        
        
        /**
         * Funckija za dohvatanje svih tačnih ponuđenih odgovora datog pitanja
         * 
         * @param int $idP ID_pitanja
         * @return PonudjenModel
         */
        public function pronadjiZaPitanjeTacne($idP){
            return $this->where("IDPit",$idP)->where('Tacan',1)->findAll();
        }
}