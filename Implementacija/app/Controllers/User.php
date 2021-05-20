<?php

namespace App\Controllers;
use App\Models\Entities\Projekat;
//use App\Models\Repositories;

class User extends BaseController
{
	public function index()
	{
                $projects = $this->doctrine->em->getRepository(Projekat::class)->
                        findByIdUSer($this->session->get('userId'));
                $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("userId"));
                $data['projects'] = $projects;
                $data['username'] = $user->getKorisnickoime();
                $data['name'] = $user->getIme();
                $data['lastname'] = $user->getPrezime();
                $data['mail'] = $user->getMail();
		return view('pages/userView', $data);
	}
        public function showSettings() {
             $projects = $this->doctrine->em->getRepository(Projekat::class)->
                        findByIdUSer($this->session->get('userId'));
                $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("userId"));
                $data['projects'] = $projects;
                $data['username'] = $user->getKorisnickoime();
                $data['name'] = $user->getIme();
                $data['lastname'] = $user->getPrezime();
                $data['mail'] = $user->getMail();
		return view('pages/settingsView', $data);
        }
        public function addProject(){

            $myProject = new Projekat();
            $myProject->setIme($this->request->getVar('nameOfProject'));
            $myProject->setTip(0);
            $myProject->setArhiviran(0);
            $user= $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)
                    ->find($this->session->get('userId'));
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
            $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("userId"));
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
                $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get("userId"));
                $data['username'] = $user->getKorisnickoime();
                $data['name'] = $user->getIme();
                $data['lastname'] = $user->getPrezime();
                $data['mail'] = $user->getMail();
             echo view ("pages/settingsView", $data);
            }
               
            }
    }

