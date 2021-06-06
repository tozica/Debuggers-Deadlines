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
class TaskRepository extends EntityRepository{
   
    public function findByDate($date){
        return $this->findBy(['datum'=>$date]);
    }
    
    public function findBySadrzaj($tekst){
        $dql="SELECT t FROM \App\Models\Entities\Task t ".
                " WHERE t.sadrzaj like :pretraga";
        return $this->getEntityManager()->createQuery($dql)
                ->setParameter('pretraga', '%'.$tekst.'%')
                ->getResult();
    }
}