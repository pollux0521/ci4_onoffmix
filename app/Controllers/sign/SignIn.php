<?php

namespace App\Controllers\sign;
use App\Models\userModel;
use App\Controllers\BaseController;

class SignIn extends BaseController
{
    // [ GET ]
    public function index()
    {
        $session = session();
        $data = [
            'is_login'  => $session->get('is_login'),
            'username'  => $session->get('username'),
            'meta_title' => 'sign'
        ];
        echo view('header', $data);
        echo view('Sign/signIn');
        echo view('footer');
    }

    // [ POST ] # try to AJAX?
    public function verify()
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
                return $this->response->redirect('/sign/signIn');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return $this->response->redirect('/sign/signIn');
        }
    }
}
