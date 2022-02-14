<?php

namespace App\Controllers;
use App\Models\userModel;
use App\Models\MTModel;
use App\Models\MTGroupModel;

class SignUp extends BaseController
{
    // [ GET ]
    public function index()
    {
        $mtModel = new MTModel();
        $mtGroupModel = new MTGroupModel();

        $mtGroupModel->where('endMTTime >', );
        helper(['form']);
        $data = ['meta_title' => 'Sign Up'];
        echo view('header1', $data);
        echo view('Sign/signUp');
        echo view('footer');
    }

    //[ POST ] # try to AJAX?
    public function signup()
    {
        helper(['form']);
        $rules = [
            'username'  =>  'required|is_unique[users.username]',
            'email'     =>  'required|valid_email|is_unique[users.email]',
            'pw'        =>  'required',
            'confpw'    =>  'required|matches[pw]'
        ];
        if($this->validate($rules))
        {
            $model = new userModel();
            $data = [
                'username'  => $_POST['username'],
                'email'     => $_POST['email'],
                'pw'        => password_hash($_POST['pw'], PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return $this->response->redirect('/SignIn');
        }else{
            $data = [
                'meta_title' => 'Sign Up',
                'validation' => $this->validator
            ];
            echo view('header1', $data);
            echo view('Sign/signUp');
            echo view('footer');
        }
    }

}
