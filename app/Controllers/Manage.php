<?php

namespace App\Controllers;

use App\Models\MTModel;
use App\Models\RequestMTModel;
use App\Models\userModel;
use App\Models\MTGroupModel;
class Manage extends BaseController
{
    public function index(){

    }
    // [ GET ]
    public function mgOf($mtName){
        $mt = (new MTModel())->where('mtName',$mtName)->first();
        $session = session();
        if($session->get('is_login')){
            if($session->get('_id') == $mt['_id']){
                $groups = (new MTGroupModel())->where('mtName', $mtName)->findAll();
                $data = [
                    'mt'            => $mt,
                    'groups'        => $groups,
                    'is_login'      => $session->get('is_login'),
                    'username'      => $session->get('username'),
                    'meta_title'    => 'Manage'
                ];
                echo view('header1', $data);
                echo view('header2');
                echo view('/MyPage/manage');
                echo view('footer');
            }
            else{
                echo "잘못된 접근, 관리자가 아님.";
            }
        }
        else{
            return $this->response->redirect('/SignIn');
        }
    }
    // [ GET ]
    public function reviseMT($mtName){
        $mt = (new MTModel())->where('mtName',$mtName)->first();
        $session = session();
        if($session->get('is_login')){
            if($session->get('_id') == $mt['_id']){
                $data = [
                    'mt'            => $mt,
                    'is_login'      => $session->get('is_login'),
                    'username'      => $session->get('username'),
                    'meta_title'    => 'Manage'
                ];
                echo view('header1', $data);
                echo view('header2');
                echo view('/MyPage/reviseMT');
                echo view('footer');
            }
            else{
                echo "잘못된 접근, 관리자가 아님.";
            }
        }
        else{
            return $this->response->redirect('/SignIn');
        }
    }    
    // [ POST ]
    public function revise($mtName){
        $mt = (new MTModel())->where('mtName',$mtName)->first();
        $session = session();
        if($session->get('is_login')){
            if($session->get('_id') == $mt['_id']){
                $reviseMT = new MTModel();
                if(strlen($_POST['mtName']))
                    $reviseMT->set('mtName', $_POST['mtName']);
                
                $reviseMT->where('mtName', $mtName);
                if($reviseMT->update()){
                    //성공
                    echo "success";
                }
                else{
                    //알수없는오류
                    echo "fail";

                }
            }
            else{
                echo "잘못된 접근, 관리자가 아님.";
            }
        }
        else{
            return $this->response->redirect('/SignIn');
        }
    }
    // [ GET ]
    public function group($gid){
        $group = (new MTGroupModel())->where('_gid',$gid)->first();
        $mt = (new MTModel())->where('_mid',$group['_mid'])->first();
        $session = session();
        if($session->get('is_login')){
            if($session->get('_id') == $mt['_id']){
                
                $requests = (new RequestMTModel())->select('requestMT.reason, requestMT.Approval, requestMT._rid, users.username')
                ->join('users', 'requestMT._id = users._id', 'inner')
                ->where('_gid', $group['_gid'])
                ->findAll();
                $data = [
                    'group'         => $group,
                    'requests'      => $requests,
                    'is_login'      => $session->get('is_login'),
                    'username'      => $session->get('username'),
                    'meta_title'    => 'group'
                ];
                echo view('header1', $data);
                echo view('header2');
                echo view('/MyPage/group');
                echo view('footer');
            }
            else{
                echo "잘못된 접근, 관리자가 아님.";
            }
        }
        else{
            return $this->response->redirect('/SignIn');
        }
    }
    // [ GET ]
    public function groupinfo($gid){
        $group = (new MTGroupModel())->where('_gid',$gid)->first();
        $mt = (new MTModel())->where('_mid',$group['_mid'])->first();
        $session = session();
        if($session->get('is_login')){
            if($session->get('_id') == $mt['_id']){
            
                $data = [
                    'group'         => $group,
                    'is_login'      => $session->get('is_login'),
                    'username'      => $session->get('username'),
                    'meta_title'    => 'groupInfo'
                ];
                echo view('header1', $data);
                echo view('header2');
                echo view('/MyPage/groupInfo');
                echo view('footer');
            }
            else{
                echo "잘못된 접근, 관리자가 아님.";
            }
        }
        else{
            return $this->response->redirect('/SignIn');
        }
    }
    public function reviseGroup($gid){
        $group = (new MTGroupModel())->where('_gid',$gid)->first();
        $mt = (new MTModel())->where('_mid',$group['_mid'])->first();
        $session = session();
        if($session->get('is_login')){
            if($session->get('_id') == $mt['_id']){
                $reviseGroup = new MTGroupModel();
                if(strlen($_POST['groupname']))
                    $reviseGroup->set('groupname', $_POST['groupname']);

                if(strlen($_POST['']))
                    $reviseGroup->set('', $_POST['']);
                    $reviseGroup->set('', $_POST['']);

                if(strlen($_POST[''])){
                    $reviseGroup->set('', $_POST['']);
                    $reviseGroup->set('', $_POST['']);
                }    

                if(isset($_POST['approvalType']))
                    $reviseGroup->set('approvalType', $_POST['approvalType']);

                if(strlen($_POST['accessHead']))
                    $reviseGroup->set('accessHead', $_POST['accessHead']);
                
            }
            else{
                echo "잘못된 접근, 관리자가 아님.";
            }
        }
        else{
            return $this->response->redirect('/SignIn');
        }
    }

    // [ GET .. ? ]
    public function approval($mtName, $rid){
        $mt = (new MTModel())->where('mtName',$mtName)->first();
        $session = session();
        if($session->get('is_login')){
            if($session->get('_id') == $mt['_id']){
                $approval = (new RequestMTModel())
                ->set('Approval', 'NOT Approval', false)
                ->where('_rid',$rid)
                ->update();
                $request = (new RequestMTModel())->where('_rid', $rid)->first();
                return $this->response->redirect('/Manage/group/'.$request['_gid']);
            }
            else{
                echo "잘못된 접근, 관리자가 아님.";
            }
        }
        else{
            return $this->response->redirect('/SignIn');
        }
    }

}