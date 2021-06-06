<?php
/**
 * ProjectController Kontroler - klasa odgovorna za akcije vezane za projekat
 * Svetozar Jovanovic 0466/18
 * 
 * @version 1.0
 * 
 *  */
namespace App\Controllers;

class ProjectController extends BaseController {

    public function index() {

        $controller = true;
        $this->session->set('controller', $controller);
        $id = $this->session->get("korisnik");
        $head = $this->request->getVar('nameForProjectHidden');
        if ($head == "") {
            $head = $this->request->getVar('nameForProjectArchivedHidden');
        }
        if ($head == "") {
            $head = $this->session->get('projectName');
        } else {
            $this->session->set('projectName', $head);
        }


        $projects = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                findByIdUSer($id);
        try {
            $projectsByName = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                    findByName($head);
            $project = $this->getProjectForUser($id, $projectsByName);
        } catch (\Exception $ex) {
            echo $ex;
        }
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
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
        $data['projects'] = $projects;
        $data['username'] = $user->getKorisnickoime();
        $data['name'] = $user->getIme();
        $data['lastname'] = $user->getPrezime();
        $data['mail'] = $user->getMail();
        $data['korisnik'] = $user;
        $data['labels'] = $this->getLabelTasks();
        $data['theme'] = $this->session->get("theme");
        $data['notifications'] = $this->getLatestNotifications();
        $data['flagUnigue'] = $this->session->get('flagUnigue');
        $data['errorUnigue'] = $this->session->get('errorUnigue');
        //get tasks for specific 
        $tmp = $this->findTasksForProject($project->getIme(), $id);
        $tmp = $this->sortTasks($tmp);
        $data['tasks'] = $tmp;

        $alarms = $this->doctrine->em->getRepository(\App\Models\Entities\Alarm::class)
                ->findAll();
        $data['alarms'] = $alarms;
        $data['head'] = $head;
        $data['tip'] = $user->getTip();
        $type = $project->getTip();
        if ($type == 1) {
            $data['existSection'] = true;
            $data['sections'] = $project->getMySections();
//                    
//
        } else {
            $data['existSection'] = false;
        }
        return view('pages/projectTaskView', $data);
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
    }
    /**
     * Funkcija vraca prvu sekciju za zadatkog korisnika
     *
     * @param Section sections[], int $idKor
     *
     * @return Projekat|null
     *
     */
    public function findSectionProject($idKor, $sections) {
        foreach ($sections as $section) {
            if ($idKor == $section->getIdprosekcija()->getIdkorisnik()->getIdkorisnik()) {
                return $section;
            }
        }
        return null;
    }
    /**
     * Funkcija dodaje novu sekciju sa svim potrebnim parametrima, dodeljuje je projektu i persistira u bazi
     *
     *
     */
    public function addSection() {
        $id = $this->session->get("korisnik");
        $choice = $this->request->getVar('optionRadio');
        $projectName = $this->request->getVar('projectHidden');
        $sectionName = $this->request->getVar('sectionName');
        $projectsByName = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                findByName($projectName);
        $project = $this->getProjectForUser($id, $projectsByName);
        $this->session->set('projectName', $project->getIme());
        if ($choice == 'add') {
            $mySections = $this->doctrine->em->getRepository(\App\Models\Entities\Sekcija::class)->findByName($sectionName);
            $mySection = $this->findSectionProject($id, $mySections);
            if ($mySection != null) {
                $this->session->set('flagUnigue', true);
                $this->session->set('errorUnigue', 'Section with that name already exists!');
                return redirect()->to(site_url('ProjectController'));
            }
            $section = new \App\Models\Entities\Sekcija();
            $section->setIdprosekcija($project);
            $section->setIme($sectionName);

            $this->doctrine->em->persist($section);
            $this->doctrine->em->flush();
        } else {

            $mySections = $this->doctrine->em->getRepository(\App\Models\Entities\Sekcija::class)->findByName($sectionName);
            $mySection = $this->findSectionProject($id, $mySections);
            if ($mySection == null) {
                $this->session->set('flagUnigue', true);
                $this->session->set('errorUnigue', 'Section with that name does not exist!');
                return redirect()->to(site_url('ProjectController'));
            }
            $myTasks = $mySection->getMyTasks();


            $this->deleteFromProjectTask($projectName, $sectionName);
            $this->deleteFromLabelTask($myTasks);
            foreach ($myTasks as $tmp) {
                //$tmp->setPrioritet(-1);
                $tmp->setIdsekcija(null);
                $this->doctrine->em->persist($tmp);
            }
            $mySection->setMyTasks(null);
            $this->doctrine->em->remove($mySection);
            try {
                $this->doctrine->em->flush();
            } catch (\Exception $ex) {
                echo $ex;
            }
        }
        // 

        return redirect()->to(site_url('ProjectController'));
    }

    public function deleteFromLabelTask($tasks) {
        try {
            $taskLabela = $this->doctrine->em->getRepository(\App\Models\Entities\LabelaTask::class)->findAll();
            foreach ($tasks as $task) {
                foreach ($taskLabela as $tl) {
                    if ($task->getIdtask() == $tl->getIdtaskk()->getIdtask()) {
                        $this->doctrine->em->remove($tl);
                    }
                }
            }
            $this->doctrine->em->flush();
        } catch (\Exception $ex) {
            echo $ex;
        }
    }
    /**
     * Brise red iz tabele ProjectTask koji ima projekat sa imenom projectName
     *
     * @param String $projectName 
     *
     *
     */
    public function deleteFromProjectTask($projectName, $sectionName) {

        try {
            $taskPro = $this->doctrine->em->getRepository(\App\Models\Entities\ProjekatTask::class)->findAll();
            foreach ($taskPro as $tmp) {
                if ($tmp->getIdpro()->getIme() == $projectName) {
                    if ($tmp->getIdtaskpro()->getIdsekcija() != null) {
                        if ($tmp->getIdtaskpro()->getIdsekcija()->getIme() == $sectionName) {
                            $this->doctrine->em->remove($tmp);
                        }
                    }
                }
            }
            $this->doctrine->em->flush();
        } catch (\Exception $e) {
            echo $e;
        }
    }

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

    public function addLabel($labelName, $task) {
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
     * Pravi novi task sa parametrima iz forme, persitira ga u bazi i dodeljuje projektu
     *
     *
     *
     */
    public function newProjectTask() {
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
            $head = $this->request->getVar("projectName");
            $projectsByName = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                    findByName($head);
            $project = $this->getProjectForUser($idUser, $projectsByName);
            $this->session->set('projectName', $head);
            $projectTask = new \App\Models\Entities\ProjekatTask();

            $projectTask->setIdpro($project);
//                $project->getIme();
            $projectTask->setIdtaskpro($task);
            $this->doctrine->em->persist($projectTask);
            try {
                $this->doctrine->em->flush();
            } catch (\Exception $ex) {
                echo $ex;
            }

            $id = $this->session->get("korisnik");
        } catch (\Exception $ex) {
            echo $ex;
        }
        return redirect()->to(site_url('ProjectController'));
    }
    /**
     * PRavi novi task sa potrebnim parametrima iz forme, persitira ga u bazi i dodeljuje sekciji
     *
     *
     *
     */
    public function addNewTaskSection() {
        $sectionName = $this->request->getVar('sectionName');
        $mySections = $this->doctrine->em->getRepository(\App\Models\Entities\Sekcija::class)->findByName($sectionName);
        $tmp = $this->findSectionProject($this->session->get('korisnik'), $mySections);
        if ($tmp == null) {
            $this->session->set('flagUnigue', true);
            $this->session->set('errorUnigue', 'Section with that name does not exist!');
            return redirect()->to(site_url('ProjectController'));
        }
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
        $head = $this->request->getVar("projectName");

        $projectsByName = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)->
                findByName($head);
        $project = $this->getProjectForUser($idUser, $projectsByName);
        $this->session->set('projectName', $head);
        $projectTask = new \App\Models\Entities\ProjekatTask();

        $projectTask->setIdpro($project);
//                $project->getIme();
        $projectTask->setIdtaskpro($task);
        $this->doctrine->em->persist($projectTask);
        $mySections = $this->doctrine->em->getRepository(\App\Models\Entities\Sekcija::class)->findByName($sectionName);
        $mySection = $this->findSectionProject($idUser, $mySections);
        try {
            $mySection->addMyTask($task);
        } catch (\Exception $ex) {
            echo $ex;
        }
        $this->doctrine->em->persist($mySection);
        $this->doctrine->em->flush();
        return redirect()->to(site_url('ProjectController'));
    }
    /**
     * Nalazi sve taskove za projekat sa zadatim imenom i korisnikom sa zadatim id-em
     *
     * @param String $projectName, int $id
     *
     *
     */
    public function findTasksForProject($projectName, $id) {

        try {
            $arrOfTasks = [];
            $taskPro = $this->doctrine->em->getRepository(\App\Models\Entities\ProjekatTask::class)->findAll();
            foreach ($taskPro as $tmp) {
//                echo $tmp->getIdpro()->getIme().' = '.$projectName.' '.$tmp->getIdtaskpro()->getIdkorisnik()->.' = '.$id;
                if ($tmp->getIdpro()->getIme() == $projectName && $tmp->getIdtaskpro()->getIdkorisnik()->getIdkorisnik() == $id) {
                    array_push($arrOfTasks, $tmp->getIdtaskpro());
                }
            }
        } catch (\Exception $e) {
            echo $e;
        }
        return $arrOfTasks;
    }

    public function sortTasks($tasks) {
        if ($this->session->get('sort') == "") {
            
        } else
        if ($this->session->get('sort') == 0) {
            
        } else
        if ($this->session->get('sort') == 1) {

            usort($tasks, function($a, $b) {
                return ($a->getSadrzaj() < $b->getSadrzaj()) ? -1 : 1;
            });
        } else
        if ($this->session->get('sort') == 2) {
            usort($tasks, function($a, $b) {
                return ($a->getSadrzaj() > $b->getSadrzaj()) ? -1 : 1;
            });
        } else
        if ($this->session->get('sort') == 3) {
            usort($tasks, function($a, $b) {
                return ($a->getPrioritet() < $b->getPrioritet()) ? -1 : 1;
            });
        } else
        if ($this->session->get('sort') == 4) {
            usort($tasks, function($a, $b) {
                return ($a->getPrioritet() > $b->getPrioritet()) ? -1 : 1;
            });
        }
        return $tasks;
    }

    public function SortAlphabeticalA() {
        $this->session->set('sort', 1);
        return redirect()->to(site_url('ProjectController'));
    }

    public function SortAlphabeticalD() {
        $this->session->set('sort', 2);
        return redirect()->to(site_url('ProjectController'));
    }

    public function SortPriorityA() {
        $this->session->set('sort', 3);
        return redirect()->to(site_url('ProjectController'));
    }

    public function SortPriorityD() {
        $this->session->set('sort', 4);
        return redirect()->to(site_url('ProjectController'));
    }

    public function DateAdded() {
        $this->session->set('sort', 0);
        return redirect()->to(site_url('ProjectController'));
    }

    public function backToUser() {
        return redirect()->to(site_url('ProjectController'));
    }

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

}
