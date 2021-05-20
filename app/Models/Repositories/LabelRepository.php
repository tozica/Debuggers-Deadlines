<?php namespace App\Models\Repositories;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userRepository
 *
 * @author Toza
 */
use \Doctrine\ORM\EntityRepository;
class LabelRepository extends EntityRepository{
    public function findByName($param) {
        return $this->findBy(['ime'=>$param]);
    }
}
