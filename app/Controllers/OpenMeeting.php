<?php

namespace App\Controllers;

class OpenMeeting extends BaseController
{
    public function index()
    {
        echo view('header1');
        echo view('header2');
        echo view('openMeeting');
        echo view('footer');
    }
    public function oepnMeeting()
    {
        $session = session();
        
    }
}
