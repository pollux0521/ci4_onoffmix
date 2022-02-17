<?php

namespace App\Controllers\sign;
use App\Models\userModel;
use App\Models\MTModel;
use App\Models\MTGroupModel;

use App\Controllers\BaseController;
class SignUp extends BaseController
{
    // [ GET ]
    public function index()
    {
        $mtModel = new MTModel();
        $mtGroupModel = new MTGroupModel();

        $mtGroupModel->where('endMTTime >', );
        helper(['form']);
        $data = ['meta_title' => 'sign'];
        echo view('header', $data);
        echo view('Sign/signUp');
        echo view('footer');
    }

    // [ POST ]
    public function insert()
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
            echo "<script>alert('가입이 완료되었습니다'); window.location.href='/sign/signIn';</script>";
        }else{
            $data = [
                'meta_title' => 'sign',
                'validation' => $this->validator
            ];
            echo view('header', $data);
            echo view('Sign/signUp');
            echo view('footer');
        }
    }
}
