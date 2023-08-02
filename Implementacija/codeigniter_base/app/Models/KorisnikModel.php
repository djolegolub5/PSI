<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * KorisnikModel - model za rad sa tabelom 'korisnik' u bazi podataka
 * 
 * @version 1.0
 */
class KorisnikModel extends Model
{
        protected $table      = 'korisnik';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';
        
        protected $allowedFields = ['Ime', 'Prezime', 'Lozinka','Email','KorIme',
            'Novac','BrPoena','BrTel', 'DatReg', 'Status', 'DatRodjenja', 'Slika'];

       /**
        * 
        * Funkcija za dohvatanje svih korisnika koji nisu administratori
        * 
        * @param
        * @return KorisnikModel
        */
        public function dohvSveKorisnike(){

            $korisnici = $this->where('Status !=', "Admin")->findAll();
            return $korisnici;
        }
}