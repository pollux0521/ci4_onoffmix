<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        $data = [
            'meta_title'=> 'home',
            'is_login'  => $session->get('is_login'),
            'username'  => $session->get('username')
        ];
        echo view("header1", $data);
        echo view("header2");
        echo view("footer");
    }
    
    public function SignOut()
    {
        $session = session();
        $session->destroy();
        return $this->response->redirect('/');
    }
}
