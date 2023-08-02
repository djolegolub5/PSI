<?php namespace App\Models;

use CodeIgniter\Model;


/**
 * AnketaModel - model za rad sa tabelom 'anketa' u bazi podataka
 * 
 * @version 1.0
 */
class AnketaModel extends Model
{
        protected $table      = 'anketa';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';
        
        protected $allowedFields = ['ID'];   
}