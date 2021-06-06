<?php
/**

 * Gust Kontroler - klasa odgovorna za akcije gosta
 * Janko Biorac 0251/18
 * Uros Jovanovic 0412/18
 * 
 * @version 1.0
 * 
 *  */
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Entities;
use App\Models\Repositories;

class Guest extends BaseController {

    public function index() {

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $task = $this->doctrine->em->getRepository(\App\Models\Entities\Task::class)->find($id);
            $task->setPrioritet(-1);
            $this->doctrine->em->persist($task);
            $this->doctrine->em->flush();
            $_POST['id'] = null;
            if($this->session->get('controller') == true)
                echo 'true';
            else
                echo 'false';
//         echo "Hello";
        } else {

            echo view('pages/guestPage');
        }
    }

    public function showPage($page) {
        $data['controler'] = 'Guest';
        echo view("pages/$page");
    }

    public function signUp() {
        $this->showPage('SignUp');
    }
/**
* SignUp funkcija koja koristi email adresu, lozinku, ime, prezime, korisnicko ime
*
* 
*
* @return View
*
*
*/
    public function signUpSubmit() {
        try {
            if (!$this->validate([
                        'email' => 'valid_email',
                        'password' => 'min_length[8]',
                    ])) {
               return view("pages/SignUp", ['errors' => $this->validator->getErrors()]);
            }
            $users = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)
                    ->findByUserName($this->request->getVar('username'));
            if ($users != null) {
                return view("pages/SignUp", ['poruka' => 'Korisnicko ime je zauzeto']);
            }
            $users = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)
                    ->findByEmail($this->request->getVar('email'));
            if ($users != null) {
                $data['errorEmail'] = 'Email je zauzet';
                return view("pages/SignUp", $data);
            }
            $user = new \App\Models\Entities\Korisnik();
            $user->setIme($this->request->getVar('name'));
            $user->setPrezime($this->request->getVar('surname'));
            $user->setMail($this->request->getVar('email'));
            $user->setKorisnickoime($this->request->getVar('username'));
            $user->setSifra($this->request->getVar('password'));
            $user->setTip(1);

            $this->doctrine->em->persist($user);

            $this->doctrine->em->flush();

            $this->session->set('theme', 'light');
            $this->session->set('korisnik', $user->getIdkorisnik());
            echo $this->session->get('korisnik');
            return redirect()->to(site_url('User'));
        } catch (\Exception $e) {

            echo $e;
        }
    }
    /* 
     * 
     * Prikazivanje logIn forme 
     *  @return View
     */
    public function logIn() {
        return view("pages/logIn");
    }

    public function viewPage($page, $data) {
        $data['controller'] = 'Guest';
        echo view("pages/$page", $data);
    }

    
    /* 
     * 
     * Metoda zaduzena za logovanje korisnika 
     *  @return View
     */
    public function loginSubmit() {
        if (!$this->validate(['username' => 'required', 'pass' => 'required'])) {
            return $this->viewPage('logIn',
                            ['errors' => $this->validator->getErrors()]);
        }

        $userName = $this->request->getVar('username');
        $user = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)
                ->findByUserName($userName);
        //  settype($user, "object");
        if ($user == null) {
            return $this->viewPage('logIn',
                            ['poruka' => "User does not exists in database"]);
        } else if ($user[0]->getSifra() != $this->request->getVar('pass')) {

            return $this->viewPage('logIn', ['poruka' => "Wrong password"]);
        }
        $this->session->set('korisnik', $user[0]->getIdkorisnik());
        $this->session->set('theme', 'light');
        if ($user[0]->getTip() == 0) {
            return redirect()->to(site_url('Administrator'));
        } else {
            return redirect()->to(site_url('User'));
        }
        $this->session->set('korisnik', $user[0]->getIdkorisnik());
        $id = $this->session->get("korisnik");

        $projects = $this->doctrine->em->getRepository(\App\Models\Entities\Projekat::class)
                ->findByIdUSer($id);

        $data['projects'] = $projects;
        $data['username'] = $user[0]->getKorisnickoime();
        $data['name'] = $user[0]->getIme();
        $data['lastname'] = $user[0]->getPrezime();
        $data['mail'] = $user[0]->getMail();
        $data['korisnik'] = $user[0];
        $tasks = $user[0]->getMyTasks();
        $data['tasks'] = $tasks;
        $alarms = $this->doctrine->em->getRepository(\App\Models\Entities\Alarm::class)
                ->findAll();
        $data['alarms'] = $alarms;
        $this->session->set('data', $data);
        $this->session->set('direction', 'pages/Tasks');
    }

}
