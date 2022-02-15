<?php

namespace App\Controllers;

class Tt extends BaseController{
    public function index(){
        $session = session();
        if($session->get('is_login')){

            $data = [
                'is_login'      => $session->get('is_login'),
                'username'      => $session->get('username'),
                'meta_title'    => 'openMeeting'
            ];
            echo view('header1', $data);
            echo view('header2');
            echo view('myPage');
            echo view('footer');
        }
        else{
            return $this->response->redirect('/SignIn');
        }
    }
}