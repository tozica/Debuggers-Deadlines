<?php

namespace App\Controllers;

class Administrator extends BaseController
{
     public function index()
    {
        $id=$this->session->get("korisnik");
        $user=$this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
        $data['username'] = $user->getKorisnickoime();
        $data['name'] = $user->getIme();
        $data['lastname'] = $user->getPrezime();
        $data['mail'] = $user->getMail();
        $data['korisnik']=$user;
        return view('pages/Administration',$data);
    }
    
    public function defaultParamets(&$data){
        $id=$this->session->get("korisnik");
        $user=$this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
        $data['username'] = $user->getKorisnickoime();
        $data['name'] = $user->getIme();
        $data['lastname'] = $user->getPrezime();
        $data['mail'] = $user->getMail();
        $data['korisnik']=$user;
    }
    public function show($page,$data){
        $this->defaultParamets($data);
        return view($page,$data);
    }
   
    
    public function allSentInfo(){
        try {
            $notifications = $this->doctrine->em->getRepository(\App\Models\Entities\Obavestenja::class)->findAll();
            return $this->show('pages/Administration', ['notifications'=>$notifications, 'title'=>'Sent Informations']);
        } catch (Exception $ex) {
            echo $ex;
        }
    }
    
    public function sendToAllUsers(){
        $message = $this->request->getVar('message');
        $title = $this->request->getVar('titleAdministrator');
        $notification = new \App\Models\Entities\Obavestenja();
        $notification->setSadrzaj($message);
        $notification->setIdkorisnik(null);
        $notification->setNaslov($title);
        $this->doctrine->em->persist($notification);
        $this->doctrine->em->flush();
        return $this->show('pages/Administration',[]);
    }
    
    public function logOut(){
        $this->session->destroy();
        return redirect()->to(site_url('Guest'));
    }
    
    public function sendToUser(){
        $message = $this->request->getVar('message');
        $title = $this->request->getVar('titleAdministrator');
        $username = $this->request->getVar('usernameAdministrator');
        $user=$this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findByUserName($username);
        $notification = new \App\Models\Entities\Obavestenja();
        $notification->setSadrzaj($message);
        $notification->setIdkorisnik($user[0]);
        $notification->setNaslov($title);
        $this->doctrine->em->persist($notification);
        $this->doctrine->em->flush();
        return $this->show('pages/Administration',[]);
    }
    
    public function setPremium(){
        try {
            $username = $this->request->getVar('usernamePremium');
            $premiumExpiration = $this->request->getVar('premiumExpiration');
            $datePremiumExpiration = new \DateTime($premiumExpiration);
            $cardNumber = $this->request->getVar('cardNumber');
            $cardExpiration = $this->request->getVar('cardExpiration');
            $dateCardExpiration = new \DateTime($cardExpiration);
            $cvc = $this->request->getVar('cvc');
            $user=$this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findByUserName($username);
            $premium = new \App\Models\Entities\Premium();
            $premium->setIdkorisnikPremium($user[0]);
            $premium->setBrojkartice($cardNumber);
            $premium->setCvc($cvc);
            $premium->setDatumisteka($datePremiumExpiration);
            $premium->setDatumistekakartice($dateCardExpiration);
            $user[0]->setTip(2);
            $this->doctrine->em->persist($user[0]);
            $this->doctrine->em->persist($premium);
            $this->doctrine->em->flush();
            return $this->show('pages/Administration',[]);
        } catch (Exception $ex) {
            echo $ex;
        }
    }
    
    public function removePremium(){
        try {
            $username = $this->request->getVar('usernameRemovePremium');
            $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findByUserName($username);
            $premium = $this->doctrine->em->getRepository(\App\Models\Entities\Premium::class)->findByUserId($user[0]);
            $user[0]->setTip(1);
            if($premium != null){
                $this->doctrine->em->remove($premium[0]);
            }
            $this->doctrine->em->persist($user[0]);
            $this->doctrine->em->flush();
            return $this->show('pages/Administration',[]);
        } catch (Exception $ex) {
            echo $ex;
        }
    }
}
