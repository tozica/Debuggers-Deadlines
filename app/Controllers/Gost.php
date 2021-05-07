<?php

namespace App\Controllers;
use App\Models\KorisnikModel;
class Gost extends BaseController
{
	public function index()
	{
		echo view("SignUp.php",[]);
	}
        
        public function signUpSubmit(){
            
            if(!$this->validate([
                'email'=>'required|valid_email',
                'password'=>'required|min_length[8]',
                'username'=>'required'
            ])){
               echo view("SignUp.php", ['errors'=>$this->validator->getErrors()]); 
            }
           $userModel=new KorisnikModel();
            $korisnici=$userModel->getByUserName($this->request->getVar('username'));
                if($korisnici != null){
                   return view("SignUp.php", ['poruka'=>'Korisnicko ime je zauzeto']);
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

