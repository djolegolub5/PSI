<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * KomentarModel - model za rad sa tabelom 'komentar' u bazi podataka
 * 
 * @version 1.0
 */
class KomentarModel extends Model
{
        protected $table      = 'komentar';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';
        
        protected $allowedFields = ['Komentar', 'Datum', 'Vreme', 'IDKor', 'DatumDo', 'IDNas'];
        
        /**
         * Funkcija za dohvatanje svih komentara u okviru datog naslova
         * 
         * @param int $id ID naslova
         * @return KomentarModel
         */
        public function pronadjiZaNaslov($id){
            return $this->where('IDNas',$id)->findAll();
        }
  
}