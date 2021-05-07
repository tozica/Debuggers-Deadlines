<?php

namespace App\Models;

use CodeIgniter\Model;

class KorisnikModel extends Model
{
    protected $table      = 'korisnik';
    protected $primaryKey = 'idkorisnik';

    protected $returnType     = 'object';

    protected $allowedFields = ['ime','prezime','sifra','tip', 'mail', 'korisnickoIme','idkorisnik'];
    
    public function getByUserName($username) {
        
       return $this->like('korisnickoIme', $username)->findAll();
    }
}