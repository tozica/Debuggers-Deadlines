<?php
/**

 * User Kontroler - klasa odgovorna za akcije korisnika
 * Svetozar Jovanovic 0466/18
 * Janko Biorac 0251/18
 * Uros Jovanovic 0412/18
 * 
 * @version 1.0
 * 
 *  */
namespace App\Controllers;

class User extends BaseController {

    public $ime = "";
    public static $sort = 0;
    public $dateUp;

    public function index() {
        try {
            // echo date("Y-m-d");
            $id = $this->session->get("korisnik");
            $controller = false;
            $this->session->set('controller', $controller);
            $projects = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                    findByIdUSer($id);
            $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);

            if ($this->session->get('flag') == 0) {
                $tasks = $user->getMyTasks();

                foreach ($tasks as $task) {
                    $task->setVidljivost(1);
                    $this->doctrine->em->persist($task);
                }
                $this->doctrine->em->flush();
                $data['flag'] = 0;
            } else if ($this->session->get('flag') == 1) {
                $data['flag'] = 1;
                $data['search'] = $this->session->get("search");
            } else if ($this->session->get('flag') == 2) {
                $data['flag'] = 2;
            } else if ($this->session->get('flag') == 3) {
                $data['flag'] = 3;
                $data['labela'] = $this->session->get("label");
            } else {
                $data['flag'] = 4;
                //   $tomorrowUnix = strtotime("+1 day");
                //$today  = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
                $dates = [];
                $days = [];

                for ($x = 0; $x < 7; $x++) {
//                    echo "Janko";
                    $day_of_week = date("l", mktime(0, 0, 0, date("m"), date("d") + $x, date("Y")));
                    array_push($days, $day_of_week);
                    $today = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + $x, date("Y")));
                    array_push($dates, $today);
                }
                $data['dates'] = $dates;
                $data['days'] = $days;
//                    
            }
            $tasks = $user->getMyTasks();
            $todayTasks = $tasks;
            $today = 0;
            $done = 0;
            $date = date("Y-m-d");
            foreach ($todayTasks as $task) {
                if ($task->getDatum()->format("Y-m-d") == $date) {
                    if ($task->getPrioritet() == -1)
                        $done++;
                    $today++;
                }
            }
            if ($today != 0) {
                $progress = $done / $today * 100;
                $progress = round($progress, 2);
            } else {
                $progress = 100;
            }
            $tasks = $this->sortTasks($tasks);

            $data['flagUnigue'] = $this->session->get('flagUnigue');
            $data['errorUnigue'] = $this->session->get('errorUnigue');
            $data['progress'] = $progress;
            $data['tasks'] = $tasks;
            $data['labels'] = $this->getLabelTasks();
            $data['projects'] = $projects;
            $data['notifications'] = $this->getLatestNotifications();
            $data['username'] = $user->getKorisnickoime();
            $data['name'] = $user->getIme();
            $data['lastname'] = $user->getPrezime();
            $data['mail'] = $user->getMail();
            $data['theme'] = $this->session->get("theme");
            $data['korisnik'] = $user;
            $data['tip'] = $user->getTip();
            $alarms = $this->doctrine->em->getRepository(\App\Models\Entities\Alarm::class)
                    ->findAll();
            $data['alarms'] = $alarms;
            return view('pages/Tasks', $data);
        } catch (\Exception $e) {

            echo $e;
        }
    }

    /**
     * Upcoming funkcija koja filtrira koji taskovi treba da budu vidljivi u zavisnosti od izabranog
     * datuma
     *
     *

     *
     */
    public function upcomingDays() {

        $date = $this->request->getVar('day');
        if ($date == "")
            $date = $this->session->get('date');
        else
            $this->session->set('date', $date);
        $AllTasks = $this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
        foreach ($AllTasks as $task) {
            $task->setVidljivost(0);
            $this->doctrine->em->persist($task);
        }
        $this->doctrine->em->flush();
        $id = $this->session->get("korisnik");
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
        $tasks = $user->getMyTasks();
        foreach ($tasks as $task) {
            if ($task->getDatum()->format("Y-m-d") == $date) {
                $task->setVidljivost(1);
                $this->doctrine->em->persist($task);
            }
            $this->doctrine->em->flush();
        }
        return redirect()->to(site_url('User'));
    }

    /**
     * Sort funkcija koja u zavisnosti od izabranog kriterijuma sortira taskove
     *
     * @param Task $tasks Task
     *
     *
     */
    public function sortTasks($tasks) {
        if ($this->session->get('sort') == 0) {
            
        } else
        if ($this->session->get('sort') == 1) {
            $array = $tasks->getValues();
            usort($array, function($a, $b) {
                return (strtolower($a->getSadrzaj()) < strtolower($b->getSadrzaj())) ? -1 : 1;
            });

            $tasks->clear();
            foreach ($array as $item) {
                $tasks->add($item);
            }
        } else
        if ($this->session->get('sort') == 2) {
            $array = $tasks->getValues();
            usort($array, function($a, $b) {
                return (strtolower($a->getSadrzaj()) > strtolower($b->getSadrzaj())) ? -1 : 1;
            });

            $tasks->clear();
            foreach ($array as $item) {
                $tasks->add($item);
            }
        } else


        if ($this->session->get('sort') == 3) {
            $array = $tasks->getValues();
            usort($array, function($a, $b) {
                return ($a->getPrioritet() < $b->getPrioritet()) ? -1 : 1;
            });

            $tasks->clear();
            foreach ($array as $item) {
                $tasks->add($item);
            }
        } else
        if ($this->session->get('sort') == 4) {
            $array = $tasks->getValues();
            usort($array, function($a, $b) {
                return ($a->getPrioritet() > $b->getPrioritet()) ? -1 : 1;
            });

            $tasks->clear();
            foreach ($array as $item) {
                $tasks->add($item);
            }
        }
        return $tasks;
    }

    /**
     * Search funkcija koja na osnovu kljucne reci vrsi pretragu
     *
     * 
     *
     */
    public function search() {
        $AllTasks = $this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
        foreach ($AllTasks as $task) {
            $task->setVidljivost(0);
            $this->doctrine->em->persist($task);
        }
        $this->doctrine->em->flush();
        $id = $this->session->get("korisnik");
        $projects = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                findByIdUSer($id);
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
        $search = $this->request->getVar('search');
        $tasksAll = $this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findBySadrzaj($search);
        foreach ($tasksAll as $task) {
            $task->setVidljivost(1);
            $this->doctrine->em->persist($task);
        }
        $this->doctrine->em->flush();
        $this->session->set('search', $search);
        $this->session->set('flag', 1);
        return redirect()->to(site_url('User'));
    }

    /**
     * Funkcija koja postavlja potrbene podatke za prikazivanje strane podesavanja
     *
     */
    public function showSettings() {
        $projects = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                findByIdUSer($this->session->get('korisnik'));
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("korisnik"));
        $data['projects'] = $projects;
        $data['username'] = $user->getKorisnickoime();
        $data['name'] = $user->getIme();
        $data['lastname'] = $user->getPrezime();
        $data['mail'] = $user->getMail();
        $data['newUserName'] = "";
        $data['newPassword'] = "";
        return view('pages/settingsView', $data);
    }

    public function go() {
        if ($this->session->get('controller') == true)
            return redirect()->to(site_url('ProjectController'));
        else
            return redirect()->to(site_url('User'));
    }

    /**
     * Premium funkcija koja priprema podatke za prikaz u premium formi
     *
     */
    public function premium() {
        $id = $this->session->get("korisnik");
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
        $data['name'] = $user->getIme();
        $data['lastname'] = $user->getPrezime();
        $data['notifications'] = $this->getLatestNotifications();
        $data['theme'] = $this->session->get("theme");
        $data['email'] = $user->getMail();
        $data['tip'] = $user->getTip();
        $tasks = $user->getMyTasks();
        $todayTasks = $tasks;
        $today = 0;
        $done = 0;
        $date = date("Y-m-d");
        foreach ($todayTasks as $task) {
            if ($task->getDatum()->format("Y-m-d") == $date) {
                if ($task->getPrioritet() == -1)
                    $done++;
                $today++;
            }
        }

        if ($today != 0) {
            $progress = $done / $today * 100;
            $progress = round($progress, 2);
        } else {
            $progress = 100;
        }


        $data['progress'] = $progress;
        return view('pages/premium', $data);
    }

    /* 
     * 
     * Metoda koja vrsi insert u tabelu LabelaTask 
     * Dodaje labelu na odredjeni task  
     *  @param String labelName
     *  @param Task task
     */
    public function addLabel($labelName, $task) {

        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get('korisnik'));
        if ($user->getTip() != 2)
            return;
        $label = null;
        if ($labelName != "") {
            $label = $this->doctrine->em->getRepository(\App\Models\Entities\Labela::class)->findByName($labelName);
            $label = $label[0];
        }
        if ($label == null && $labelName != "") {
            $label = new \App\Models\Entities\Labela();
            $label->setIme($labelName);
        }
        if ($label != null) {
            $labelTask = new \App\Models\Entities\LabelaTask();
            $this->doctrine->em->persist($label);
            $labelTask->setIdlabela($label);
            $labelTask->setIdtaskk($task);

            $this->doctrine->em->persist($labelTask);
        }
        return;
    }

    /**
     * newTask funkcija koja pravi novi task u bazi za odredjenog korisnika
     *
     * 
     *
     */
    public function newTask() {
        try {
            $taskName = $this->request->getVar('taskName');
            $alarm = $this->request->getVar('alarm');
            $priority = $this->request->getVar('priority');
            $labelName = $this->request->getVar('labelaModal');
            $date = $this->request->getVar('date');
            $task = new \App\Models\Entities\Task();
            $datum = new \DateTime($date);
            $task->setDatum($datum);
            $task->setPrioritet($priority);
            $task->setSadrzaj($taskName);
            $task->setVidljivost(0);
            $idUser = $this->session->get('korisnik');
            $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($idUser);
            if ($alarm == "1") {
                $Alarm = new \App\Models\Entities\Alarm();
                $vreme = $this->request->getVar('timeAlarm');
                $d = strtotime($vreme . ' ' . $date);
                $dateTime = new \DateTime(date("h:i Y-m-d", $d));
                $Alarm->setDatum($dateTime);
                $Alarm->setIdtask($task);
                $this->doctrine->em->persist($Alarm);
            }
            $task->setIdkorisnik($user);
            $this->addLabel($labelName, $task);
            $this->doctrine->em->persist($task);

            $this->doctrine->em->flush();
            $method = $this->request->getVar('method');
            if ($method == "search") {
                return $this->search();
            } else if ($method == "today") {
                return $this->today();
            } else if ($method == "label") {
                $this->ime = $this->request->getVar('labelName');
                return $this->label();
            } else if ($method = "upcoming") {
                return $this->upcomingDays();
            }

            return redirect()->to(site_url("User"));
        } catch (\Exception $e) {
            echo $e;
        }
    }

    /* 
     * 
     * Metoda koja vrsi update nad tabelom Task
     * Menja task na zahtev korisnika   
     *  
     */
    public function editTask() {
        try {
            $newName = $this->request->getVar('newName');
            $newDate = $this->request->getVar('newDate');
            $labelName = $this->request->getVar('newLabel');
            $id = $this->request->getVar('id');
            $alarmChange = $this->request->getVar('alarmChange');
            $newAlarm = null;
            $dateTime = null;
            $newPriority = $this->request->getVar('newPriority');
            $task = $this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->find($id);
            if ($newDate != "") {
                $newAlarm = new \DateTime($newDate);
            } else {
                $newAlarm = $task->getDatum();
            }
            if ($alarmChange == "1") {
                $Alarm = new \App\Models\Entities\Alarm();
                $vreme = $this->request->getVar('timeAlarm');
                $d = strtotime($vreme . ' ' . $newDate);
                $dateTime = new \DateTime(date("h:i Y-m-d", $d));
                $Alarm->setDatum($dateTime);
                $Alarm->setIdtask($task);
                $this->doctrine->em->persist($Alarm);
            } else if ($alarmChange == "0") {
                $idTask = $task->getIdtask();
                $alarms = $this->doctrine->em->getRepository(\App\Models\Entities\Alarm::class)
                        ->findAll();
                $alarm = null;
                foreach ($alarms as $value) {
                    if ($value->getIdtask()->getIdtask() == $idTask) {
                        $alarm = $value;
                        break;
                    }
                }

                if ($alarm != null)
                    $this->doctrine->em->remove($alarm);
            }

            if ($newName != null)
                $task->setSadrzaj($newName);
            if ($dateTime != null)
                $task->setDatum($dateTime);
            if ($newPriority != null)
                $task->setPrioritet($newPriority);
            $this->addLabel($labelName, $task);
            $this->doctrine->em->persist($task);
            $this->doctrine->em->flush();
            if ($this->session->get('controller') == true) {
                return redirect()->to(site_url("ProjectController"));
            } else {
                return redirect()->to(site_url("User"));
            }
        } catch (\Exception $e) {
            echo $e;
        }
    }

    /**
     * Funkcija koja kupi podatke iz forme potrebne da se napravi projekat, pravi projekat i persitira ga u bazi
     *
     *
     */
    public function addProject() {
        $id = $this->session->get('korisnik');
        $myProject = new \App\Models\Entities\Projekat();
        $nameProject = $this->request->getVar('nameOfProject');
        $projectsByName = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                findByName($nameProject);
        $tmp = $this->getProjectForUser($id, $projectsByName);
        if ($tmp != null) {
            $this->session->set('flagUnigue', true);
            $this->session->set('errorUnigue', 'Project with that name already exists!');
            return redirect()->to(site_url('User'));
        }
        $this->session->set('flagUnigue', false);
        $myProject->setIme($nameProject);
        $myProject->setTip(0);
        $myProject->setArhiviran(0);
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)
                ->find($this->session->get('korisnik'));
        if ($this->request->getVar('hiddenForType') == "list") {
            $myProject->setTip(0);
        } else {
            $myProject->setTip(1);
        }
        $myProject->setIdkorisnik($user);
        $this->doctrine->em->persist($myProject);
        $this->doctrine->em->flush();

        return redirect()->to(site_url('User'));
    }

    /**
     * Brise red iz tabele ProjectTask koji ima projekat sa imenom projectName
     *
     * @param String $projectName 
     *
     *
     */
    public function deleteFromProjectTask($projectName) {

        try {
            $taskPro = $this->doctrine->em->getRepository(\App\Models\Entities\ProjekatTask::class)->findAll();

            foreach ($taskPro as $tmp) {
                $tmp->getIdpro()->getIme();
                if ($tmp->getIdpro()->getIme() == $projectName) {
                    $alarms = $this->doctrine->em->getRepository(\App\Models\Entities\Alarm::class)->findAll();

                    foreach ($alarms as $alarm) {

                        if ($alarm->getIdtask()->getIdtask() == $tmp->getIdtaskpro()->getIdtask()) {
                            $this->doctrine->em->remove($alarm);
                        }
                    }
                    $this->doctrine->em->remove($tmp);
                }
            }
            if ($taskPro != null)
                $this->doctrine->em->flush();
        } catch (\Exception $e) {
            echo $e;
        }
    }

    /**
     * Brise redove iz tabele LabelaTask za sve taskove koji pripadaju projektu sa zadatim indetifikatorom
     *
     * @param int $id
     *
     */
    public function deleteFromLabelTask($id) {
        $tasks = [];
        $allTasks = $this->doctrine->em->getRepository(\App\Models\Entities\ProjekatTask::class)->findAll();
        foreach ($allTasks as $tmp) {
            if ($tmp->getIdpro()->getIdprojekat() == $id) {
                array_push($tasks, $tmp->getIdtaskpro());
            }
        }
        $labelatasks = $this->doctrine->em->getRepository(\App\Models\Entities\LabelaTask::class)->findAll();
        foreach ($tasks as $task) {
            foreach ($labelatasks as $lt) {
                if ($task->getIdtask() == $lt->getIdtaskk()->getIdtask()) {
                    $this->doctrine->em->remove($lt);
                }
            }
        }

        $this->doctrine->em->flush();
    }

    /**
     * Funkcija vraca prvi projekat za zadatkog korisnika
     *
     * @param Projekat $projects[], int $idKor
     *
     * @return Projekat|null
     *
     */
    public function getProjectForUser($idKor, $projects) {

        foreach ($projects as $project) {
            if ($project->getIdkorisnik()->getIdkorisnik() == $idKor) {
                return $project;
            }
        }
        return null;
    }

    /**
     * Vrsi promene nad projektom (rename, archive, delete)
     *
     *
     */
    public function changeProject() {
        $id = $this->session->get("korisnik");
        $head = $this->request->getVar('nameHidden');
        $projectsByName = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                findByName($head);
        $project = $this->getProjectForUser($id, $projectsByName);
        if ($this->request->getVar('resultRadio') == "rename") {
            $nameProject = $this->request->getVar('renameField');
            $projectsByName = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                    findByName($nameProject);
            $tmp = $this->getProjectForUser($id, $projectsByName);
            if ($tmp != null) {
                $this->session->set('flagUnigue', true);
                $this->session->set('errorUnigue', 'Project with that name already exists!');
                return redirect()->to(site_url('User'));
            }
            $this->session->set('flagUnigue', false);
            $project->setIme($nameProject);
            $this->doctrine->em->flush();
        } else if ($this->request->getVar('resultRadio') == "archive") {
            $project->setArhiviran(1);
            $this->doctrine->em->flush();
        } else if ($this->request->getVar('resultRadio') == "delete") {
            $myUser = $project->getIdkorisnik();
            $this->deleteFromLabelTask($project->getIdprojekat());
            $this->deleteFromProjectTask($project->getIme());
            $myUser->removeMyProject($project);

            if ($project->getTip() == 1) {
                $sections = $project->getMySections();
                foreach ($sections as $tmp) {


                    $myTasks = $tmp->getMyTasks();
                    foreach ($myTasks as $tmp1) {

                        //$tmp->setPrioritet(-1);
                        $tmp1->setIdsekcija(null);
                        $this->doctrine->em->persist($tmp1);
                    }
                    $tmp->setMyTasks(null);
                    $project->removeMySection($tmp);
                }
            }

            $this->doctrine->em->remove($project);
            try {
                $this->doctrine->em->flush();
            } catch (\Exception $ex) {
                echo $ex;
            }
            return redirect()->to(site_url('User'));
        }
        if ($this->session->get('controller') == true) {
            return redirect()->to(site_url("ProjectController"));
        } else {
            return redirect()->to(site_url("User"));
        }
    }

    /**
     * Vrsi promene nad projektima koji su arhivirani (rename, unarchive, delete)
     *
     */
    public function changeProjectArchived() {
        $id = $this->session->get("korisnik");

        $head = $this->request->getVar('nameHiddenArchived');
        $projectsByName = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                findByName($head);
        $project = $this->getProjectForUser($id, $projectsByName);
        if ($this->request->getVar('resultRadioArchived') == "rename") {
            $nameProject = $this->request->getVar('renameFieldArchived');
            $projectsByName = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                    findByName($nameProject);
            $tmp = $this->getProjectForUser($id, $projectsByName);
            if ($tmp != null) {
                $this->session->set('flagUnigue', true);
                $this->session->set('errorUnigue', 'Project with that name already exists!');
                return redirect()->to(site_url('User'));
            }
            $this->session->set('flagUnigue', false);
            $project->setIme($nameProject);
            $this->doctrine->em->flush();
        } else if ($this->request->getVar('resultRadioArchived') == "unarchive") {
            $project->setArhiviran(0);
            $this->doctrine->em->flush();
        } else if ($this->request->getVar('resultRadioArchived') == "delete") {
            $myUser = $project->getIdkorisnik();
            $this->deleteFromLabelTask($project->getIdprojekat());
            $this->deleteFromProjectTask($project->getIme());
            $myUser->removeMyProject($project);

            if ($project->getTip() == 1) {
                $sections = $project->getMySections();
                foreach ($sections as $tmp) {


                    $myTasks = $tmp->getMyTasks();
                    foreach ($myTasks as $tmp1) {

                        //$tmp->setPrioritet(-1);
                        $tmp1->setIdsekcija(null);
                        $this->doctrine->em->persist($tmp1);
                    }
                    $tmp->setMyTasks(null);
                    $project->removeMySection($tmp);
                }
            }

            $this->doctrine->em->remove($project);
            try {
                $this->doctrine->em->flush();
            } catch (\Exception $ex) {
                echo $ex;
            }
            return redirect()->to(site_url("User"));
        }
        if ($this->session->get('controller') == true) {
            return redirect()->to(site_url("ProjectController"));
        } else {
            return redirect()->to(site_url("User"));
        }
    }

    /**
     * Vrsi promene nad korisnikom(promene: ime, prezime, korisnicko ime, email i sifra)
     *
     */
    public function settingsChange() {

        $b = true;
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("korisnik"));
        $newUserName = $this->request->getVar('userNameField');
        $newName = $this->request->getVar('nameField');
        $lastName = $this->request->getVar('LastNameField');
        $newPass = $this->request->getVar('passField');
        $newEmail = $this->request->getVar('emailField');

        if ($newUserName != "") {
            if ($this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findByUserName($newUserName) == null) {
                $user->setKorisnickoime($newUserName);
                $this->doctrine->em->flush();
            } else {
                $data['newUserName'] = "Username already exists!";
                $b = false;
            }
        }
        if ($newName != "") {
            $user->setIme($newName);
            $this->doctrine->em->flush();
        }
        if ($lastName != "") {
            $user->setPrezime($lastName);
            $this->doctrine->em->flush();
        }
        if ($newPass != "") {
            if (strlen($newPass) >= 8) {
                $user->setSifra($newPass);
                $this->doctrine->em->flush();
            } else {
                $data['newPassword'] = "Password must be minimun 8 characters long!";
                $b = false;
            }
        }
        if ($newEmail != "") {
            $users = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findByEmail($newEmail);
            if (!$this->validate([
                        'emailField' => 'valid_email',
                    ])) {
                $data['emailError'] = "Email bad format!";
                $b = false;
            } else {
                if ($users != null) {
                    $data['emailError'] = "Email already exists!";
                    $b = false;
                } else {
                    $user->setMail($newEmail);
                    $this->doctrine->em->flush();
                }
            }
        }
        if ($b) {
            if ($user->getTip() == 0) {
                return redirect()->to(site_url('Administrator'));
            } else {
                return redirect()->to(site_url('User'));
            }
        } else {
//                $this->writeErrorSettings(null);
            $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("korisnik"));
            $data['username'] = $user->getKorisnickoime();
            $data['name'] = $user->getIme();
            $data['lastname'] = $user->getPrezime();
            $data['mail'] = $user->getMail();
            echo view("pages/settingsView", $data);
        }
    }

    /**
     * Today funkcija koja filtrira taskove, koji su predvidjeni za danasnji dan
     *
     * 
     */
    public function today() {
        try {
            $this->session->set('flag', 2);
            $AllTasks = $this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
            foreach ($AllTasks as $task) {
                $task->setVidljivost(0);
                $this->doctrine->em->persist($task);
            }
            $this->doctrine->em->flush();
            $date = date("Y-m-d");
            $AllTasks = $this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
            foreach ($AllTasks as $task) {
                if ($task->getDatum()->format("Y-m-d") == $date) {
                    $task->setVidljivost(1);
                    $this->doctrine->em->persist($task);
                }
                $this->doctrine->em->flush();
            }

            return redirect()->to(site_url('User'));
        } catch (\Exception $e) {
            echo $e;
        }
    }

    public function inbox() {
        $this->session->set('flag', 0);
        return redirect()->to(site_url('User'));
    }

    /**
     * upcoming funkcija koja postavlja odgovarajuce flegove, kako bi se odgovarajuci pogled prikazivao
     *
     *
     */
    public function upcoming() {
        $this->session->set('flag', 4);
        $this->session->set('date', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y"))));
        $AllTasks = $this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
        foreach ($AllTasks as $task) {
            $task->setVidljivost(0);
            $this->doctrine->em->persist($task);
        }
        $this->doctrine->em->flush();
        $date = date("Y-m-d");
        $AllTasks = $this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
        foreach ($AllTasks as $task) {
            if ($task->getDatum()->format("Y-m-d") == $date) {
                $task->setVidljivost(1);
                $this->doctrine->em->persist($task);
            }
            $this->doctrine->em->flush();
        }
        return redirect()->to(site_url('User'));
    }

    /**
     * LogOut funkcija koja unistava sesiju, i izloguje korisnika
     *
     * @
     */
    public function logOut() {
        $this->session->destroy();
        return redirect()->to(site_url('Guest'));
    }

    /* 
     * 
     * Metoda koja vraca sve labele za neki task  
     *  @return array userLabels
     */
    public function getLabelTasks() {
        try {
            $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("korisnik"));
            $tasks = $user->getMyTasks();
            $userLabels = [];
            $labelTasks = $this->doctrine->em->getRepository(\App\Models\Entities\LabelaTask::class)->findAll();

            foreach ($tasks as $task) {

                $idTask = $task->getIdtask();
                // echo $idTask;
                foreach ($labelTasks as $value) {
                    // echo $value->getIdtaskk()->getIdtask();

                    if ($value->getIdtaskk()->getIdtask() == $idTask) {

                        array_push($userLabels, $value);
                        break;
                    }
                }
            }
            return $userLabels;
        } catch (\Exception $e) {
            echo $e;
        }
    }

    /* 
     * 
     * Metoda zaduzena za brisanje i prikazivanje svih labela korisnika   
     *  
     */
    public function label() {
        try {
            $flagDelete = $this->request->getVar('deleteFlag');
            if ($flagDelete == 'true') {
                $labelName = $this->request->getVar('labelaTask');
                $label = $this->doctrine->em->getRepository(\App\Models\Entities\Labela::class)->findByName($labelName)[0];
                $labelTasks = $this->doctrine->em->getRepository(\App\Models\Entities\LabelaTask::class)->findAllLabelTask();
                foreach ($labelTasks as $lt) {
                    if ($lt->getIdlabela()->getIme() == $labelName) {
                        $this->doctrine->em->remove($lt);
                    }
                }
                $this->doctrine->em->remove($label);
                $this->doctrine->em->flush();
                return $this->inbox();
            } else {
                $AllTasks = $this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->findAll();
                foreach ($AllTasks as $task) {
                    $task->setVidljivost(0);
                    $this->doctrine->em->persist($task);
                }
                $this->doctrine->em->flush();
                if ($this->ime == "") {
                    $this->ime = $this->request->getVar('labelaTask');
                    $flag = true;
                }

                $labelTasks = $this->doctrine->em->getRepository(\App\Models\Entities\LabelaTask::class)->findAllLabelTask();
                foreach ($labelTasks as $lt) {
                    if ($lt->getIdlabela()->getIme() == $this->ime) {
                        $lt->getIdtaskk()->setVidljivost(1);
                        $this->doctrine->em->persist($lt->getIdtaskk());
                    }
                    $this->doctrine->em->flush();
                }
                $this->session->set("label", $this->ime);
                $this->session->set('flag', 3);
                if ($flag == true)
                    $this->ime = "";
                return redirect()->to(site_url('User'));
            }
        } catch (\Exception $e) {
            echo $e;
        }
    }

    /**
     * Funkcija koja setuje fleg obavestavajuci sve poglede u kom poretku treba da sortiraju taskove 
     * koje prikazuju
     *
     *
     */
    public function SortAlphabeticalA() {
        $this->session->set('sort', 1);
        return redirect()->to(site_url('User'));
    }

    /**
     * Funkcija koja setuje fleg obavestavajuci sve poglede u kom poretku treba da sortiraju taskove 
     * koje prikazuju
     *
     *
     */
    public function SortAlphabeticalD() {
        $this->session->set('sort', 2);
        return redirect()->to(site_url('User'));
    }

    /**
     * Funkcija koja setuje fleg obavestavajuci sve poglede u kom poretku treba da sortiraju taskove 
     * koje prikazuju
     *
     *
     */
    public function SortPriorityA() {
        $this->session->set('sort', 3);
        return redirect()->to(site_url('User'));
    }

    /**
     * Funkcija koja setuje fleg obavestavajuci sve poglede u kom poretku treba da sortiraju taskove 
     * koje prikazuju
     *
     *
     */
    public function SortPriorityD() {
        $this->session->set('sort', 4);
        return redirect()->to(site_url('User'));
    }

    /**
     * Funkcija koja setuje fleg obavestavajuci sve poglede u kom poretku treba da sortiraju taskove 
     * koje prikazuju
     *
     *
     */
    public function DateAdded() {
        $this->session->set('sort', 0);
        return redirect()->to(site_url('User'));
    }
    /* 
     * 
     * Metoda zaduzena za vracanje pet poslednjih obavestenja za odredjenog korisnika   
     *  @return array latestNotification
     */
    public function getLatestNotifications() {
        $notifications = $this->doctrine->em->getRepository(\App\Models\Entities\Obavestenja::class)->findAll();
        $notifications = array_reverse($notifications);
        $userId = $this->session->get("korisnik");
        $latestNotification = [];
        $i = 0;
        foreach ($notifications as $value) {
            if ($value->getIdkorisnik() == null || $value->getIdkorisnik()->getIdkorisnik() == $userId) {
                array_push($latestNotification, $value);
                $i++;
                if ($i == 5) {
                    break;
                }
            }
        }
        return $latestNotification;
    }
/* 
     * 
     * Metoda zaduzena za promenu teme   
     *  
     */
    public function changeTheme() {
        $theme = $this->request->getVar("changeTheme");
        $this->session->set("theme", $theme);
        if ($this->session->get('controller') == true) {
            return redirect()->to(site_url('ProjectController'));
        } else {
            return redirect()->to(site_url('User'));
        }
    }
    /* 
     * 
     * Metoda zaduzena za informisanje administratora da korisnik zeli da postane premium korisnik
     * Slanje zahteva administratoru
     *  
     */
    public function informAdministrator() {
        $firstNameAndLastName = $this->request->getVar("firstAndLastName");
        $separator = " ";
        $firstAndLastName = explode($separator, $firstNameAndLastName);
        $firstName = $firstAndLastName[0];
        $lastName = $firstAndLastName[1];
        $cardNumber = $this->request->getVar("cardNumber");
        $month = $this->request->getVar("month");
        $year = $this->request->getVar("year");
        $cvc = $this->request->getVar("cvc");
        $userId = $this->session->get("korisnik");
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($userId);
        $username = $user->getKorisnickoime();
        $title = "Premium request";
        $message = "First And Last Name: " . $firstName . " " . $lastName
                . "Card number: " . $cardNumber
                . "Month: " . $month
                . "Year: " . $year
                . "CVC: " . $cvc
                . "Username: " . $username;

        $administrators = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findAdministrator();
        $notification = new \App\Models\Entities\Obavestenja();
        $notification->setSadrzaj($message);
        $notification->setIdkorisnik($administrators[0]);
        $notification->setNaslov($title);
        $this->doctrine->em->persist($notification);
        $this->doctrine->em->flush();
        return redirect()->to(site_url('User'));
    }

}
