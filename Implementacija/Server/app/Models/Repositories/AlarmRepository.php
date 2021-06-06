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
 * 
 */
use \Doctrine\ORM\EntityRepository;
class AlarmRepository extends EntityRepository{
    public function findByIdTask($param) {
        return $this->findBy(['idtask'=>$param]);
    }
}