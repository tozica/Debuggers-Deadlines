<?php

namespace App\Controllers;

class Guest extends BaseController
{
    public function index(){
        echo view('stranice/guestPage');
    }
}