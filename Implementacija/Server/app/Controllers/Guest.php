<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Entities;
use App\Models\Repositories;
use CodeIgniter\I18n\Time;

date_default_timezone_set('Europe/Belgrade');
/**
 * Guest Kontroler - mali odvojeni projekat koji koristimo za proveru alarma i slanje mejlova
 * Svetozar Jovanovic 0466/18
 * 
 * @version 1.0
 * 
 *  */
class Guest extends BaseController {

    public function index() {
        try {
            while (true) {
                $alarms = $this->doctrine->em->getRepository(\App\Models\Entities\Alarm::class)
                        ->findAll();
                foreach ($alarms as $alarm) {
                    $date = $alarm->getDatum()->format("h:i Y-m-d");
                    $today = (new \DateTime())->format("h:i Y-m-d");
                    $miliDate = strtotime($date);
                    $miliToday = strtotime($today);
                    $diff = $miliToday - $miliDate;

                    if ($diff <= 0 && $diff >= -1800) {
                        $task = $alarm->getIdtask();
                        $user = $task->getIdkorisnik();
                        $to = $user->getMail();
                        $subject = 'Task remainder';
                        $message = 'You set remainder for this task: ' . $task->getSadrzaj();
                        $headers = 'From: tozica99@gmail.com' . "\r\n" .
                                'X-Mailer: PHP/' . phpversion();
                        mail($to, $subject, $message, $headers);
                        $this->doctrine->em->remove($alarm);
                    }
                }
                $this->doctrine->em->flush();
                sleep(15);
            }
        } catch (\Exception $ex) {
            echo $ex;
        }
    }

}
