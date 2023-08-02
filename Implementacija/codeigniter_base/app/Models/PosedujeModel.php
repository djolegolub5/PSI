<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * PosedujeModel - model za rad sa tabelom 'poseduje' u bazi podataka
 * 
 * @version 1.0
 */
class PosedujeModel extends Model
{
        protected $table      = 'poseduje';
        protected $primaryKey = 'idPos';
        protected $returnType = 'object';
        
        protected $allowedFields = ['DatumOd', 'DatumDo', 'VremeOd','VremeDo','IDKor','IDNas'];

        
        /**
         * Funkcija za dohvatanje posedovanja datog naslova od strane datog korisnika
         * 
         * @param int $idN ID_naslova
         * @param int $idK ID_korisnika
         * @return PosedujeModel
         */
        public function pronadjiZaNaslovKorsinika($idN,$idK){
            return $this->where('IDKor',$idK)->where('IDNas',$idN)->findAll();
        }
        
        
        /**
         * Funkcija za dohvatanje svih posedovanja datog korisnika
         * 
         * @param int $idK ID_korisnika
         * @return type
         */
        public function pronadjiZaKorisnika($idK){
            return $this->where('IDKor',$idK)->findAll();
        } 
}