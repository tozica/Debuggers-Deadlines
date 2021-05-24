<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Repositories;

/**
 * Description of LabelTaskRepository
 *
 * @author urosu
 */
use \Doctrine\ORM\EntityRepository;
class LabelTaskRepository extends EntityRepository {
    public function findAllLabelTask() {
        return $this->findAll();
    }
    
    public function findByIdTask($param) {
       return $this->findBy(['idtaskk'=>$param]);
    }
    
    public function findByLabelId($param){
        return $this->findBy(['idlabela'=>$param]);
    }
}