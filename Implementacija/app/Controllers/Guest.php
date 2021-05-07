<?php

namespace App\Controllers;
use App\Models\KorisnikModel;

class Guest extends BaseController
{
    public function index(){
        echo view('stranice/guestPage');
    }
    
    public function showPage($page){
        $data['controler'] = 'Guest';
         echo view("stranice/$page");
    }
    
    public function signUp() {
        $this->showPage('SignUp');
    }
    
    public function signUpSubmit(){
            
            if(!$this->validate([
                'email'=>'required',
                'password'=>'required|min_length[8]',
                'username'=>'required'
            ])){
               echo view("stranice/SignUp", ['errors'=>$this->validator->getErrors()]); 
            }
           $userModel=new KorisnikModel();
            $korisnici=$userModel->getByUserName($this->request->getVar('username'));
                if($korisnici != null){
                   return view("stranice/SignUp", ['poruka'=>'Korisnicko ime je zauzeto']);
                }
           $userModel->save([
                "mail"=>$this->request->getVar('email'),
                "ime"=>$this->request->getVar('name'),
                "prezime"=>$this->request->getVar('surname'),
                "korisnickoIme"=>$this->request->getVar('username'),
                "sifra"=>$this->request->getVar('password'),
                "tip"=>"1"
            ]);
        }
}