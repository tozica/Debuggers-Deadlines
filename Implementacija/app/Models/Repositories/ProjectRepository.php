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
class ProjectRepository extends EntityRepository{
    public function findByIdUSer($param) {
        return $this->findBy(['idkorisnik'=>$param]);
    }
    
}
