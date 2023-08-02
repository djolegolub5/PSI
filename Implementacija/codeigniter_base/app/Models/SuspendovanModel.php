<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * SuspendovanModel - model za rad sa tabelom 'suspendovan' u bazi podataka
 * 
 * @version 1.0
 */
class SuspendovanModel extends Model
{
        protected $table      = 'suspendovan';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';

        protected $allowedFields = ['ID', 'Datum', 'Trajanje', 'Razlog', 'IDKor'];
}