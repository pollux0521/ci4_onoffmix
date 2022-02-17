<?php

namespace App\Controllers\mypage;

use App\Models\MTModel;
use App\Models\RequestMTModel;
use App\Models\userModel;
use App\Controllers\BaseController;
class Revise extends BaseController
{
    // [ GET ]
    public function index()
    {
        $session = session();
        if($session->get('is_login'))
        {

            $mt = new MTModel();
            $user = (new userModel())->where('_id',$session->get('_id'))->findAll();
            $requestMT = new RequestMTModel();
            $mts = $mt->where('_id', $session->get('_id'))->findAll();
            $requests = $requestMT->select('requestMT._rid, requestMT.reason, requestMT.Approval, MTGroup.mtName, MTGroup.groupname, MTGroup.startMTTime, MTGroup.endMTTime')
            ->join('MTGroup', 'requestMT._gid = MTGroup._gid', 'inner')
            ->where('_id', $session->get('_id'))
            ->findAll();

            $data = [
                'mts'           => $mts,
                'user'          => $user,
                'requests'      => $requests,
                'is_login'      => $session->get('is_login'),
                'username'      => $session->get('username'),
                'meta_title'    => 'MyPage'
            ];
            echo view('header', $data);
            echo view('/MyPage/myPage');
            echo view('footer');
        }
        else{
            return $this->response->redirect('/sign/SignIn');
        }
    }

    // [ GET ]
    public function reviseUser()
    {
        $session = session();
        if($session->get('is_login')){
            $user = (new userModel())->where('_id',$session->get('_id'))->first();
            $data = [
                'user'          => $user,
                'is_login'      => $session->get('is_login'),
                'username'      => $session->get('username'),
                'meta_title'    => 'reviseUser'
            ];
            echo view('header', $data);
            echo view('/MyPage/reviseUser');
            echo view('footer');
        }
        else{
            return $this->response->redirect('/sign/SignIn');
        }
    }
    
    // [ POST ]
    public function reviseRequest()
    {
        helper(['form']);
        $rules = [
            'email' => 'valid_email|is_unique[users.email]'
        ];
        $session = session();
        
        if($session->get('is_login')){
            if($this->validate($rules)){
                $user = new userModel();
                if(strlen($_POST['username']))
                    $user->set('username', $_POST['username']);
                if(strlen($_POST['email']))
                    $user->set('email', $_POST['email']);
                
                if($user->update()){
                    return $this->response->redirect('/mypage/MyPage');
                }
                else{
                    //알수없는오류
                }
            }
            else{
                echo "not email";
            }
            
        }
        else{
            return $this->response->redirect('/sign/SignIn');
        }
    }
    
    // [ GET ]
    public function changePW()
    {
        $session = session();
        if($session->get('is_login')){
            $data = [
                'is_login'      => $session->get('is_login'),
                'username'      => $session->get('username'),
                'meta_title'    => 'changePW'
            ];
            echo view('header', $data);
            echo view('/MyPage/changePW');
            echo view('footer');
        }
        else{
            return $this->response->redirect('/sign/SignIn');
        }
    }
    
    // [ POST ]
    public function changePWRequest()
    {
        helper(['form']);
        $session = session();
        if($session->get('is_login')){
            $rules = [
                'newPW'     =>  'required',
                'confpw'    =>  'required|matches[newPW]'
            ];
            if($this->validate($rules)){
                
                $user = (new userModel())->where('_id', $session->get('_id'))
                ->first();
                $verified = password_verify($_POST['currentPW'],$user['pw']);
                if($verified){
                    // 패스워드가 맞지 않음
                    $changePW = (new userModel())->set('pw',password_hash($_POST['currentPW'], PASSWORD_DEFAULT))
                    ->where('_id', $session->get('_id')->update());
                    echo "success";

                }
                else if($verified == 0){
                    echo "no password";
                }
                else{
                    // 예기치 않은 오류
                    echo "unexpected err";
                }
            }
            else{
                //새로운 패스워드가 맞지 않는다.
                echo "unsame";
            }
        }
        else{
            return $this->response->redirect('/sign/SignIn');
        }
    }
}
