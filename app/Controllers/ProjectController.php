<?php

namespace App\Controllers;

class ProjectController extends BaseController
{
	public function index()
	{
                $id=$this->session->get("korisnik");
                $head = $this->request->getVar('nameForProjectHidden');
                if($head == ""){
                    $head = $this->session->get('projectName');
                }else{
                    $this->session->set('projectName', $head);
                }
                
                  $projects = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                        findByIdUSer($id);
                  $project = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                          findByName($head)[0];
                $user=$this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
                $data['projects'] = $projects;
                $data['username'] = $user->getKorisnickoime();
                $data['name'] = $user->getIme();
                $data['lastname'] = $user->getPrezime();
                $data['mail'] = $user->getMail();
                $data['korisnik']=$user;
                //get tasks for specific 
                $tmp = $this->findTasksForProject($project->getIme());
                $data['tasks']= $tmp;
 
                $alarms = $this->doctrine->em->getRepository(\App\Models\Entities\Alarm::class)
                    ->findAll();
                $data['alarms']=$alarms;
                $data['head'] = $head;
                return view('pages/projectTaskView', $data);
	
        }
        public function addLabel($labelName,$task){
            $label=null;
            if($labelName!=""){
                $label=$this->doctrine->em->getRepository(\App\Models\Entities\Labela::class)->findByName($labelName);
                $label=$label[0];
            }
            if($label==null && $labelName!=""){
               $label = new \App\Models\Entities\Labela();
               $label->setIme($labelName);
            }
            if($label!=null){
                $labelTask = new \App\Models\Entities\LabelaTask();
                $this->doctrine->em->persist($label);
                $labelTask->setIdlabela($label);
                $labelTask->setIdtaskk($task);
                
                $this->doctrine->em->persist($labelTask);
            }
            return;
        }
        public function newProjectTask(){
                $taskName= $this->request->getVar('taskName');
                $alarm=$this->request->getVar('alarm');
                $priority=$this->request->getVar('priority');
                $labelName = $this->request->getVar('labelaModal');
                $date=$this->request->getVar('date');
                $task=new \App\Models\Entities\Task();
                $datum=new \DateTime($date);
                $task->setDatum($datum);
                $task->setPrioritet($priority);
                $task->setSadrzaj($taskName);
                $idUser= $this->session->get('korisnik');
                $user=$this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($idUser);
                if($alarm=="1"){
                     $Alarm=new \App\Models\Entities\Alarm();
                     $Alarm->setDatum($datum);
                     $Alarm->setIdtask($task);
                     $this->doctrine->em->persist($Alarm);
                }
                $task->setIdkorisnik($user);
                $this->addLabel($labelName,$task);
                $this->doctrine->em->persist($task);
                $head = $this->request->getVar("projectName");
                echo $head;
                $project =  $project = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                          findByName($head)[0];
                 $this->session->set('projectName', $head);
                $projectTask = new \App\Models\Entities\ProjekatTask();
              
                $projectTask->setIdpro($project);
//                $project->getIme();
                $projectTask->setIdtaskpro($task);
                $this->doctrine->em->persist($projectTask);
                $this->doctrine->em->flush();
        
                $id=$this->session->get("korisnik");

                echo 'kraj funkcije';
                return redirect()->to(site_url('ProjectController'));

                
        }
        public function findTasksForProject($projectName) {
            
            try{
             $arrOfTasks = [];
            $taskPro = $this->doctrine->em->getRepository(\App\Models\Entities\ProjekatTask::class)->findAll();
            foreach($taskPro as $tmp){
                
                if($tmp->getIdpro()->getIme() == $projectName){
                    array_push($arrOfTasks, $tmp->getIdtaskpro());
                }
            }
            } catch (\Exception $e){
                echo $e;
            }
           return $arrOfTasks;
}
}
