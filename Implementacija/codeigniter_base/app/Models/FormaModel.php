<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * FormaModel - model za rad sa tabelom 'forma' u bazi podataka
 * 
 * @version 1.0
 */
class FormaModel extends Model
{
        protected $table      = 'forma';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';
        
        protected $allowedFields = ['Naslov', 'KratakOpis', 'BrPitanja', 'DatumOd', 'DatumDo', 'IDAut'];
}