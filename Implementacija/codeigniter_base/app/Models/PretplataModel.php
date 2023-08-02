<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * PretplataModel - model za rad sa tabelom 'pretplata' u bazi podataka
 * 
 * @version 1.0
 */
class PretplataModel extends Model
{
        protected $table      = 'pretplata';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';
        
        protected $allowedFields = ['DatumOd', 'DatumDo', 'IDKor'];
}