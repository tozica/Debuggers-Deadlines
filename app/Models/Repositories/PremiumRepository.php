<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Repositories;

/**
 * Description of PremiumRepository
 *
 * @author urosu
 */

use \Doctrine\ORM\EntityRepository;
class PremiumRepository  extends EntityRepository {
    public function findByUserId($param) {
        return $this->findBy(['idkorisnikPremium'=>$param]);
    }
}
