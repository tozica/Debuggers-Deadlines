<?php

namespace App\Controllers;

class User extends BaseController
{
	public function index()
	{   
            try{
                             
                $id=$this->session->get("korisnik");
                  $projects = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                        findByIdUSer($id);
                $user=$this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
                $data['projects'] = $projects;
                $data['username'] = $user->getKorisnickoime();
                $data['name'] = $user->getIme();
                $data['lastname'] = $user->getPrezime();
                $data['mail'] = $user->getMail();
                $data['korisnik']=$user;
                $data['tasks']=$user->getMyTasks();
                $alarms = $this->doctrine->em->getRepository(\App\Models\Entities\Alarm::class)
                    ->findAll();
                $data['alarms']=$alarms;
		return view('pages/Tasks',$data);
        
                 }catch(\Exception $e){
         
               echo $e;

        }
	}
         public function showSettings() {
             $projects = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                        findByIdUSer($this->session->get('korisnik'));
                $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("korisnik"));
                $data['projects'] = $projects;
                $data['username'] = $user->getKorisnickoime();
                $data['name'] = $user->getIme();
                $data['lastname'] = $user->getPrezime();
                $data['mail'] = $user->getMail();
                $data['newUserName']="";
                 $data['newPassword']="";
		return view('pages/settingsView', $data);
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
        
        public function newTask(){
            try{
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

                $this->doctrine->em->flush();

                 return redirect()->to(site_url("User"));
           }catch(\Exception $e){
               echo $e;
           }         
       }
        public function editTask(){
        try{
            $newName=$this->request->getVar('newName');
            $newDate=$this->request->getVar('newDate');
            $labelName = $this->request->getVar('newLabel');
            $id=$this->request->getVar('id');
            $alarmChange = $this->request->getVar('alarmChange');
            $newAlarm = null;
            
            $newPriority=$this->request->getVar('newPriority');
            $task=$this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->find($id);
            if($newDate!=""){
                $newAlarm = new \DateTime($newDate);
            }else{
                $newAlarm= $task->getDatum();
            }
            if($alarmChange == "1"){
                $Alarm=new \App\Models\Entities\Alarm();              
                if($newAlarm==null){
                    return redirect()->to(site_url("User"));
                }
                $Alarm->setDatum($newAlarm);
                $Alarm->setIdtask($task);
                $this->doctrine->em->persist($Alarm);
            }else if($alarmChange=="0"){
               $idTask = $task->getIdtask();
               $alarms = $this->doctrine->em->getRepository(\App\Models\Entities\Alarm::class)
                    ->findAll();
               $alarm = null;
                foreach ($alarms as $value) {
                    if($value->getIdtask()->getIdtask() == $idTask){
                        $alarm = $value;
                        break;
                    }
                }
                
                if($alarm != null)
                    $this->doctrine->em->remove($alarm);
            }
            
            if($newName!=null)
                $task->setSadrzaj($newName);
            if($newDate!=null)
                $task->setDatum($newDate);
            if($newPriority!=null)
                $task->setPrioritet($newPriority);
            $this->addLabel($labelName, $task);
            $this->doctrine->em->persist($task);
            $this->doctrine->em->flush();
            return redirect()->to(site_url("User"));
        }catch(\Exception $e){
           echo $e;
        }
    }
    public function addProject(){

            $myProject = new \App\Models\Entities\Projekat();
            $myProject->setIme($this->request->getVar('nameOfProject'));
            $myProject->setTip(0);
            $myProject->setArhiviran(0);
            $user= $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)
                    ->find($this->session->get('korisnik'));
            if($this->request->getVar('hiddenForType') == "list"){
                $myProject->setTip(0);
            }else{
                $myProject->setTip(1);
            }
            $myProject->setIdkorisnik($user);
            $this->doctrine->em->persist($myProject);
            $this->doctrine->em->flush();
            
            return redirect()->to(site_url('User'));
        }
        public function changeProject() {
            $myProject = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->findByName($this->request->getVar('nameHidden'));
            $project = $myProject[0];
            if($this->request->getVar('resultRadio') == "rename"){
                $project->setIme($this->request->getVar('renameField'));
                $this->doctrine->em->flush();
            } else if ($this->request->getVar('resultRadio') == "archive"){
                $project->setArhiviran(1);
                $this->doctrine->em->flush();
            } else if ($this->request->getVar('resultRadio') == "delete"){
                $myUser = $project->getIdkorisnik();
                $myUser->removeMyProject($project);
                $this->doctrine->em->remove($project);
                $this->doctrine->em->flush();
            }
            return redirect()->to(site_url('User'));  
        }
        
        public function changeProjectArchived() {
            $myProject = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->findByName($this->request->getVar('nameHiddenArchived'));
            $project = $myProject[0];
            if($this->request->getVar('resultRadioArchived') == "rename"){
                $project->setIme($this->request->getVar('renameFieldArchived'));
                $this->doctrine->em->flush();
            } else if ($this->request->getVar('resultRadioArchived') == "unarchive"){
                $project->setArhiviran(0);
                $this->doctrine->em->flush();
            } else if ($this->request->getVar('resultRadioArchived') == "delete"){
                $myUser = $project->getIdkorisnik();
                $myUser->removeMyProject($project);
                $this->doctrine->em->remove($project);
                $this->doctrine->em->flush();
            }
           return redirect()->to(site_url('User'));
        }
          
        public function writeErrorSettings($param){
            
        }
        
        public function projectClicked() {
            return redirect()->to(site_url('ProjectController'));
        }
        
        public function settingsChange() {

            
            $b = true;
            $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("korisnik"));
            $newUserName = $this->request->getVar('userNameField');
            $newName = $this->request->getVar('nameField');
            $lastName = $this->request->getVar('LastNameField');
            $newPass = $this->request->getVar('passField');
            $newEmail = $this->request->getVar('emailField');
            if($newUserName != ""){
                if($this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findByUserName($newUserName) == null){
                    $user->setKorisnickoime($newUserName);
                    $this->doctrine->em->flush();
                }
                else{
                    $data['newUserName'] = "Username already exists!";
                    $b = false;
                    
                }
            }
            if($newName != ""){
                $user->setIme($newName);
                $this->doctrine->em->flush();
            }
            if($lastName != ""){
                $user->setPrezime($lastName);
                $this->doctrine->em->flush();
            }
            if($newPass != ""){
                if(strlen($newPass) >= 8){
                    $user->setSifra($newPass);
                    $this->doctrine->em->flush();
                }else{
                    $data['newPassword']="Password must be minimun 8 characters long!";
                    $b = false;
                }
               }
            if($newEmail != ""){
                $user->setMail($newEmail);
                $this->doctrine->em->flush();
            }
            if($b){
                return redirect()->to(site_url('User'));  
            }
            else{
//                $this->writeErrorSettings(null);
                $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("korisnik"));
                $data['username'] = $user->getKorisnickoime();
                $data['name'] = $user->getIme();
                $data['lastname'] = $user->getPrezime();
                $data['mail'] = $user->getMail();
             echo view ("pages/settingsView", $data);
            }
               
            }
}
