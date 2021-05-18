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
                $data['projects'] = $projects;
		return view('pages/userView', $data);
	}
        public function addProject(){
//            $user = new \App\Models\Entities\Korisnik();
//            $user->setIme($this->request->getVar('name'));
//            $user->setPrezime($this->request->getVar('surname'));
//            $user->setMail($this->request->getVar('email'));
//            $user->setKorisnickoime($this->request->getVar('username'));
//            $user->setSifra($this->request->getVar('password'));
//            $user->setTip(1);
//            $this->doctrine->em->persist($user);
//            $this->doctrine->em->flush();
            $myProject = new Projekat();
            $myProject->setIme($this->request->getVar('nameOfProject'));
            $myProject->setTip(0);
            $myProject->setArhiviran(1);
            $user= $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)
                    ->find($this->session->get('userId'));
            
            $myProject->setIdkorisnik($user);
            
            
            $this->doctrine->em->persist($myProject);

            $this->doctrine->em->flush();
            
            return $this->index();
        }
            
    }

