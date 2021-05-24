<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\Entities;
use App\Models\Repositories;


class Guest extends BaseController
{
    public function index(){
        
        if(isset($_POST['id'])){
         $id = $_POST['id'];
         $task=$this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->find($id);
         $task->setPrioritet(-1);
         $this->doctrine->em->persist($task);
         $this->doctrine->em->flush();
         $_POST['id']=null;
//         echo "Hello";
             }
                     else{

                        echo view('pages/guestPage');
        
                     }
    }
    
    public function showPage($page){
        $data['controler'] = 'Guest';
         echo view("pages/$page");
    }
    
    public function signUp() {
        $this->showPage('SignUp');
    }
    
    public function signUpSubmit(){
        try{
            if(!$this->validate([
                'email'=>'required|valid_email',
                'password'=>'required|min_length[8]',
                'username'=>'required'
            ])){
               echo view("pages/SignUp", ['errors'=>$this->validator->getErrors()]); }
            $users= $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)
                    ->findByUserName($this->request->getVar('username'));
                if($users != null){
                   return view("pages/SignUp", ['poruka'=>'Korisnicko ime je zauzeto']);}
            $user = new \App\Models\Entities\Korisnik();
            $user->setIme($this->request->getVar('name'));
            $user->setPrezime($this->request->getVar('surname'));
            $user->setMail($this->request->getVar('email'));
            $user->setKorisnickoime($this->request->getVar('username'));
            $user->setSifra($this->request->getVar('password'));
            $user->setTip(1);
            
           $this->doctrine->em->persist($user);
            
            $this->doctrine->em->flush();
           
            
           $this->session->set('korisnik', $user->getIdkorisnik());
           echo $this->session->get('korisnik');
            return redirect()->to(site_url('User'));
             }catch(\Exception $e){
              
               echo $e;
           } 
    }
        public function logIn()
	{
            return view("pages/logIn");
	}
        
        public function viewPage($page, $data) {
            $data['controller']='Guest';
            echo view ("pages/$page", $data);
        }


        public function loginSubmit() {
            if(!$this->validate(['username'=>'required', 'pass'=>'required'])){
                return $this->viewPage('logIn', 
                    ['errors'=>$this->validator->getErrors()]);
            }
            
           $userName=$this->request->getVar('username');
           $user= $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)
                    ->findByUserName($userName);
         //  settype($user, "object");
            if($user==null){
                return $this->viewPage('logIn', 
                    ['poruka'=>"User does not exists in database"]);
            }
            else if($user[0]->getSifra() !=$this->request->getVar('pass')){
                $errors['pass'] = "Wrong password";
                return $this->viewPage('logIn', 
                    $errors);
            }
            $this->session->set('korisnik', $user[0]->getIdkorisnik());
            if($user[0]->getTip() == 1){
                return redirect()->to(site_url('User'));
            }
            else if($user[0]->getTip() == 0){
                return redirect()->to(site_url('Administrator'));
            }
        }
        
        
       
}