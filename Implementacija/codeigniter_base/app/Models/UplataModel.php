<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * UplataModel - model za rad sa tabelom 'uplata' u bazi podataka
 * 
 * @version 1.0
 */
class UplataModel extends Model
{
        protected $table      = 'uplata';
        protected $primaryKey = 'ID';
        protected $returnType = 'object';

        protected $allowedFields = ['ID', 'Suma', 'Datum', 'IDKor', 'BrKartice', 'VaziDo', 'CVV', 'Drzava', 'Grad'];
}