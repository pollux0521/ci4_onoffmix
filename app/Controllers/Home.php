<?php

namespace App\Controllers;

use App\Models\MTModel;
use App\Models\MTGroupModel;
class Home extends BaseController
{
    public function index()
    {
        $mtModel = new MTModel;
        $mtGroupModel = new MTGroupModel;
        $MTList = $mtGroupModel->distinct()->select("mtName")->where('endMTTime > ',  date('y/m/d h:i'))->findAll(20);
        
        $session = session();
        $data = [
            'meta_title'=> 'home',
            'is_login'  => $session->get('is_login'),
            'username'  => $session->get('username'),
            'MTList'    => $MTList
        ];
        
        echo view("header", $data);
        echo view("home");
        echo view("footer");
    }
    public function SignOut()
    {
        $session = session();
        $session->destroy();
        return $this->response->redirect('/');
    }
}
