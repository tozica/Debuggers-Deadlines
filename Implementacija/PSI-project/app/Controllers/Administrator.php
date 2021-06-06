<?php

/**

 * Administrator Kontroler - klasa odgovorna za akcije administratora
 * Uros Jovanovic 0412/18
 * 
 * @version 1.0
 * 
 *  */

namespace App\Controllers;

class Administrator extends BaseController {

    public function index() {
        $id = $this->session->get("korisnik");
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
        $data['username'] = $user->getKorisnickoime();
        $data['name'] = $user->getIme();
        $data['lastname'] = $user->getPrezime();
        $data['mail'] = $user->getMail();
        $data['korisnik'] = $user;
        $data['theme'] = $this->session->get("theme");
        $data['premiumRequests'] = $this->getNotificationsForAdministrator();
        return view('pages/Administration', $data);
    }

    /**

     * Metoda koja puni niz data sa podrazumevanim podacima potrebnim za Administratora
     * @param array data
     * @return void     
     */
    public function defaultParamets(&$data) {
        $id = $this->session->get("korisnik");
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
        $data['username'] = $user->getKorisnickoime();
        $data['name'] = $user->getIme();
        $data['lastname'] = $user->getPrezime();
        $data['mail'] = $user->getMail();
        $data['korisnik'] = $user;
        $data['theme'] = $this->session->get("theme");
        $data['premiumRequests'] = $this->getNotificationsForAdministrator();
    }

    /*
     * 
     * Metoda koja prikazuje zadatu stranicu sa zadatim podacima     
     * @param String page
     * @param array data
     */
    public function show($page, $data) {
        $this->defaultParamets($data);
        return view($page, $data);
    }

    /*
     * 
     * Metoda koja vraca sva obavestenja koja je administrator poslao
     * i koja su poslata administratoru     
     *  
     */

    public function allSentInfo() {
        try {
            $notifications = $this->doctrine->em->getRepository(\App\Models\Entities\Obavestenja::class)->findAll();

            return $this->show('pages/Administration', ['notifications' => $notifications, 'title' => 'Sent Informations']);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    /*
     * 
     * Metoda zaduzena za slanje obavestenja svim korisnicima od strane Administratora     
     *  
     */

    public function sendToAllUsers() {
        $message = $this->request->getVar('message');
        $title = $this->request->getVar('titleAdministrator');
        $notification = new \App\Models\Entities\Obavestenja();
        $notification->setSadrzaj($message);
        $notification->setIdkorisnik(null);
        $notification->setNaslov($title);
        $this->doctrine->em->persist($notification);
        $this->doctrine->em->flush();
        return $this->show('pages/Administration', []);
    }

    /*
     * 
     * Metoda za odjavljivanje korisnika    
     *  
     */

    public function logOut() {
        $this->session->destroy();
        return redirect()->to(site_url('Guest'));
    }

    /*
     * 
     * Metoda zaduzena za slanje obavestenja odredjenom korisniku     
     *  
     */

    public function sendToUser() {
        $message = $this->request->getVar('message');
        $title = $this->request->getVar('titleAdministrator');
        $username = $this->request->getVar('usernameAdministrator');
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findByUserName($username);
        if ($user == null) {
            return $this->show('pages/Administration', ['errorMessage' => 'User does not exists']);
        }
        $notification = new \App\Models\Entities\Obavestenja();
        $notification->setSadrzaj($message);
        $notification->setIdkorisnik($user[0]);
        $notification->setNaslov($title);
        $this->doctrine->em->persist($notification);
        $this->doctrine->em->flush();
        return $this->show('pages/Administration', []);
    }

    /*
     * 
     * Metoda zaduzena za postavljanje premiuma odredjenom korisniku   
     *  
     */

    public function setPremium() {
        try {
            $username = $this->request->getVar('usernamePremium');
            $premiumExpiration = $this->request->getVar('premiumExpiration');
            $datePremiumExpiration = new \DateTime($premiumExpiration);
            $cardNumber = $this->request->getVar('cardNumber');
            $cardExpiration = $this->request->getVar('cardExpiration');
            $dateCardExpiration = new \DateTime($cardExpiration);
            $cvc = $this->request->getVar('cvc');
            $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findByUserName($username);
            if ($user == null) {
                return $this->show('pages/Administration', ['errorMessage' => 'User does not exists']);
            }
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
            return $this->show('pages/Administration', []);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    /*
     * 
     * Metoda zaduzena za uklanjanje premiuma odredjenom korisniku   
     *  
     */

    public function removePremium() {
        try {
            $username = $this->request->getVar('usernameRemovePremium');
            $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findByUserName($username);
            if ($user == null) {
                return $this->show('pages/Administration', ['errorMessage' => 'User does not exists']);
            }
            $premium = $this->doctrine->em->getRepository(\App\Models\Entities\Premium::class)->findByUserId($user[0]);
            $user[0]->setTip(1);
            if ($premium != null) {
                $this->doctrine->em->remove($premium[0]);
            }
            $this->doctrine->em->persist($user[0]);
            $this->doctrine->em->flush();
            return $this->show('pages/Administration', []);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    /*
     * 
     * Metoda zaduzena za promenu teme  
     *  
     */

    public function changeTheme() {
        $theme = $this->request->getVar("changeTheme");
        $this->session->set("theme", $theme);
        return $this->show('pages/Administration', []);
    }

    /*
     * 
     * Metoda koja vraca sva obavestenja upucena administratoru  
     *  @return array
     */

    public function getNotificationsForAdministrator() {
        $notifications = $this->doctrine->em->getRepository(\App\Models\Entities\Obavestenja::class)->findAll();
        $notifications = array_reverse($notifications);
        $userId = $this->session->get("korisnik");
        $latestNotification = [];
        $i = 0;
        foreach ($notifications as $value) {
            if ($value->getIdkorisnik() != null && $value->getIdkorisnik()->getIdkorisnik() == $userId) {
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
     * Metoda zaduzena za prihvatanje zahteva za premium   
     *  
     */

    public function confirmPremium() {
        try {
            $username = $this->request->getVar('usernamePremium');
            $cardExpiration = $this->request->getVar('cardExpiration');
            $cardNumber = $this->request->getVar('cardNumber');
            $cvc = $this->request->getVar('cvc');
            $idNotification = $this->request->getVar('idNotification');

            $dateCardExpiration = new \DateTime($cardExpiration);
            $datePremiumExpiration = new \DateTime(date("Y-m-d", mktime(0, 0, 0, date("m") + 1, date("d"), date("Y"))));

            $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findByUserName($username);
            $premium = new \App\Models\Entities\Premium();
            $premium->setIdkorisnikPremium($user[0]);
            $premium->setBrojkartice($cardNumber);
            $premium->setCvc($cvc);
            $premium->setDatumisteka($datePremiumExpiration);
            $premium->setDatumistekakartice($dateCardExpiration);
            $user[0]->setTip(2);
            $notification = $this->doctrine->em->getRepository(\App\Models\Entities\Obavestenja::class)->find($idNotification);
            $this->doctrine->em->remove($notification);
            $this->doctrine->em->persist($user[0]);
            $this->doctrine->em->persist($premium);
            $this->doctrine->em->flush();
            return $this->show('pages/Administration', []);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    /*
     * 
     * Metoda zaduzena za odbijanje zahteva za premium 
     *  
     */

    public function declinePremium() {
        $idNotification = $this->request->getVar('idNotification');
        $notification = $this->doctrine->em->getRepository(\App\Models\Entities\Obavestenja::class)->find($idNotification);
        $this->doctrine->em->remove($notification);
        $this->doctrine->em->flush();
        return $this->show('pages/Administration', []);
    }

    /*
     * 
     * Metoda zaduzena za prikaz svih premium korisnika u sistemu 
     *  
     */

    public function seeAllPremiumUsers() {
        $premiums = $this->doctrine->em->getRepository(\App\Models\Entities\Premium::class)->findAll();
        return $this->show('pages/Administration', ['notifications' => $premiums, 'title' => 'All premium users']);
    }

}
