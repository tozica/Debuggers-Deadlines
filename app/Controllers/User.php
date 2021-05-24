<?php

namespace App\Controllers;

class User extends BaseController
{   public $ime="";
    public static $sort=0;
	public function index()
	{   
            try{ 
                $id=$this->session->get("korisnik");
                 $projects = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                     findByIdUSer($id);
                 $user=$this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id); 
                
                if ($this->session->get('flag')==0){
                   $tasks=$user->getMyTasks();
                         foreach ($tasks as $task) {
                             $task->setVidljivost(1);
                              $this->doctrine->em->persist($task);
                             }
                         $this->doctrine->em->flush();
                         $data['flag']=0;
                }
                else  if ($this->session->get('flag')==1){
                    $data['flag']=1;
                    $data['search']=$this->session->get("search");
                }
                else if($this->session->get('flag')==2){ 
                    $data['flag']=2;
                }else{
                     $data['flag']=3;
                     $data['labela']=$this->session->get("label");
                }
                $tasks=$user->getMyTasks();
                $tasks= $this->sortTasks($tasks);
                
                
                $data['tasks']=$tasks;
                $data['labels']=$this->getLabelTasks();
                $data['projects'] = $projects;
                $data['notifications']=$this->getLatestNotifications();
                $data['username'] = $user->getKorisnickoime();
                $data['name'] = $user->getIme();
                $data['lastname'] = $user->getPrezime();
                $data['mail'] = $user->getMail();
                $data['korisnik']=$user;
                $alarms = $this->doctrine->em->getRepository(\App\Models\Entities\Alarm::class)
                    ->findAll();
                $data['alarms']=$alarms;
                return view('pages/Tasks',$data);
                
        
            }catch(\Exception $e){
         
               echo $e;

        }
	}
        public function sortTasks($tasks){
            if($this->session->get('sort')==0){
                 
                }
                else
                if($this->session->get('sort')==1){
                    $array = $tasks->getValues();
               usort($array, function($a, $b){
                    return ($a->getSadrzaj() < $b->getSadrzaj()) ? -1 : 1 ;
               });

                $tasks->clear();
                foreach ($array as $item) {
                    $tasks->add($item);
                }
                }
               
                else
                if($this->session->get('sort')==2){
                   $array = $tasks->getValues();
                usort($array, function($a, $b){
                    return ($a->getSadrzaj() > $b->getSadrzaj()) ? -1 : 1 ;
              });

               $tasks->clear();
                foreach ($array as $item) {
                   $tasks->add($item);
                }
                }
                else
                
                
                if($this->session->get('sort')==3){
                     $array = $tasks->getValues();
                usort($array, function($a, $b){
                    return ($a->getPrioritet() < $b->getPrioritet()) ? -1 : 1 ;
                });

                $tasks->clear();
                foreach ($array as $item) {
                    $tasks->add($item);
                }
            }
                
               else 
                if($this->session->get('sort')==4){
                    $array = $tasks->getValues();
                    usort($array, function($a, $b){
                       return ($a->getPrioritet() > $b->getPrioritet()) ? -1 : 1 ;
           });

                   $tasks->clear();
                   foreach ($array as $item) {
                   $tasks->add($item);
                   }
                }
            return $tasks;
        }
        public function search(){
            $AllTasks=$this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
                 foreach ($AllTasks as $task) {
                             $task->setVidljivost(0);
                              $this->doctrine->em->persist($task);
                             }
                         $this->doctrine->em->flush(); 
                 $id=$this->session->get("korisnik");
                 $projects = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                     findByIdUSer($id);
                 $user=$this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id); 
                     $search=$this->request->getVar('search');
                     $tasksAll=$this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findBySadrzaj($search);
                         foreach ($tasksAll as $task) {
                             $task->setVidljivost(1);
                              $this->doctrine->em->persist($task);
                             }
                         $this->doctrine->em->flush(); 
                       $this->session->set('search', $search);
                        $this->session->set('flag',1); 
                        return redirect()->to(site_url('User'));
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
                $task->setVidljivost(0);
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
                $method=$this->request->getVar('method');
                if($method=="search"){
                    return $this->search();
                }
                else if($method=="today"){
                    return $this->today();
                }
                else if($method=="label"){
                    $this->ime=$this->request->getVar('labelName');
                    return $this->label();
                }
                
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
            public function today(){
                try{
                $this->session->set('flag',2);
                $AllTasks=$this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
                 foreach ($AllTasks as $task) {
                             $task->setVidljivost(0);
                              $this->doctrine->em->persist($task);
                             }
                         $this->doctrine->em->flush(); 
                $date = date("Y-m-d");
                $AllTasks=$this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
                foreach($AllTasks as $task){
                    if($task->getDatum()->format("Y-m-d")==$date){
                             $task->setVidljivost(1);
                              $this->doctrine->em->persist($task);
                             }
                         $this->doctrine->em->flush();
                    
                }
                
                return redirect()->to(site_url('User'));
                 }catch(\Exception $e){
               echo $e;
           }
            }
            public function inbox(){
                $this->session->set('flag',0);
                 return redirect()->to(site_url('User'));
                
            }
            public function logOut(){
                $this->session->destroy();
                return redirect()->to(site_url('Guest'));
            }
            public function getLabelTasks(){
                try{
                    $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("korisnik"));
                    $tasks = $user->getMyTasks();
                    $userLabels = [];
                    $labelTasks = $this->doctrine->em->getRepository(\App\Models\Entities\LabelaTask::class)->findAll();
                  
                    foreach($tasks as $task){
                       
                        $idTask = $task->getIdtask();
                       // echo $idTask;
                        foreach($labelTasks as $value){
                           // echo $value->getIdtaskk()->getIdtask();
                             
                            if($value->getIdtaskk()->getIdtask() == $idTask){
                                
                                array_push($userLabels,$value);
                                break;
                           }
                       }
                    }
                    return $userLabels;
                } catch (\Exception $e){
                    echo $e;

                }
    }
        public function label(){
        try{
            $AllTasks=$this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
                 foreach ($AllTasks as $task) {
                             $task->setVidljivost(0);
                              $this->doctrine->em->persist($task);
                             }
                         $this->doctrine->em->flush(); 
                         if($this->ime==""){
                            $this->ime = $this->request->getVar('labelaTask');
                            $flag=true;
                         }
              
            $labelTasks = $this->doctrine->em->getRepository(\App\Models\Entities\LabelaTask::class)->findAllLabelTask();
            foreach ($labelTasks as $lt){
                if($lt->getIdlabela()->getIme()== $this->ime){
                    $lt->getIdtaskk()->setVidljivost(1);
                     $this->doctrine->em->persist($lt->getIdtaskk());
                    
                }
                  $this->doctrine->em->flush();
            }
            $this->session->set("label", $this->ime);
            $this->session->set('flag',3);
            if($flag==true) $this->ime="";
            return redirect()->to(site_url('User'));
        } catch (\Exception $e){
            echo $e;
            
        }
    }
    
    public function SortAlphabeticalA(){
        $this->session->set('sort', 1);
        return redirect()->to(site_url('User'));
    }
     public function SortAlphabeticalD(){
         $this->session->set('sort', 2);
        return redirect()->to(site_url('User'));
    }
     public function SortPriorityA(){
         $this->session->set('sort', 3);
        return redirect()->to(site_url('User'));
    }
     public function SortPriorityD(){
        $this->session->set('sort', 4);
        return redirect()->to(site_url('User'));
    }
    public function DateAdded(){
         $this->session->set('sort', 0);
        return redirect()->to(site_url('User'));
    }
     public function getLatestNotifications(){
        $notifications = $this->doctrine->em->getRepository(\App\Models\Entities\Obavestenja::class)->findAll();
        $notifications = array_reverse($notifications);
        $userId = $this->session->get("korisnik");
        $latestNotification = [];
        $i = 0;
        foreach($notifications as $value){
            if($value->getIdkorisnik()==null || $value->getIdkorisnik()->getIdkorisnik()==$userId){
                array_push($latestNotification,$value);
                $i++;
                if($i == 5){
                    break;
                }
            }
        }
        return $latestNotification;
    }
}
