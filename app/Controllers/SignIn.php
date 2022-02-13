<?php

namespace App\Controllers;
use App\Models\userModel;

class SignIn extends BaseController
{
    // [ GET ]
    public function index()
    {
        $data = ['meta_title' => 'login'];
        echo view('header1', $data);
        echo view('Sign/signIn');
        echo view('footer');
    }

    // [ POST ] # try to AJAX?
    public function signin()
    {
        $session = session();
        $users = new userModel();
        $userInfo = $users->where(['email' => $_POST['email']])->first();

        if($userInfo){
            $verified = password_verify($_POST['pw'],$userInfo['pw']);
            //  REDIRECT MAIN PAGE WITH SESSION INFO
            if($verified){
                $session_data = [
                    'username'  => $userInfo['username'],
                    '_id'       => $userInfo['_id'],
                    'is_login'  => TRUE
                ];
                $session->set($session_data);
                return $this->response->redirect('/');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return $this->response->redirect('/SignIn');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return $this->response->redirect('/SignIn');
        }
    }
}
