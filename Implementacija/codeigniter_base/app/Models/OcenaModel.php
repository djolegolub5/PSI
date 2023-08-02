<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * OcenaModel - model za rad sa tabelom 'ocena' u bazi podataka
 * 
 * @version 1.0
 */
class OcenaModel extends Model
{
        protected $table      = 'ocena';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';
        
         protected $allowedFields = ['ID', 'Ocena', 'IDKor', 'IDNas'];
}