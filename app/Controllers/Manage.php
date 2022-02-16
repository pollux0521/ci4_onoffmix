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

                if(strlen($_POST['sign_time'])){
                    $accessTime = explode("-", $_POST['sign_time']);
                    $reviseGroup->set('startAccessTime', date('y/m/d H:i', strtotime($accessTime[0])));
                    $reviseGroup->set('endAccessTime', date('y/m/d H:i', strtotime($accessTime[1])));
                }

                if(strlen($_POST['meeting_time'])){
                    $MTTime = explode("-", $_POST['meeting_time']);
                    $reviseGroup->set('startMTTime', date('y/m/d H:i', strtotime($MTTime[0])));
                    $reviseGroup->set('endMTTime', date('y/m/d H:i', strtotime($MTTime[1])));
                }    

                if(isset($_POST['approvalType']))
                    $reviseGroup->set('approvalType', $_POST['approvalType']);

                if(strlen($_POST['limitHead']))
                    $reviseGroup->set('limitHead', $_POST['limitHead']);
                
                $reviseGroup->where('_gid', $gid);
                if($reviseGroup->update()){
                    return $this->response->redirect('/Manage/group/'.$gid);
                }
                else{
                    echo "알수없는오류";
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

    // [ GET ]
    public function addGroup($mid){
        $mt = (new MTModel())->where('_mid',$mid)->first();
        $session = session();
        if($session->get('is_login')){
            if($session->get('_id') == $mt['_id']){
                
                $data = [
                    'mt'            => $mt,
                    'is_login'      => $session->get('is_login'),
                    'username'      => $session->get('username'),
                    'meta_title'    => 'groupInfo'
                ];
                echo view('header1', $data);
                echo view('header2');
                echo view('/MyPage/addGroup');
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
    public function addGroupInfo($mid)
    {
        helper(['form']);
        $rule = [
            'groupname'         => 'required',
            'sign_time'         => 'required',
            'meeting_time'      => 'required',
            'limitHead'         => 'required',
        ];;
        $mt = (new MTModel())->where('_mid',$mid)->first();
        $session = session();
        if($this->validate($rule)){
            if($session->get('is_login')){
                if($session->get('_id') == $mt['_id']){
                    $accessTime = explode("-", $_POST['sign_time']);
                    $MTTime = explode("-", $_POST['meeting_time']);
                    $mtGroupData = [
                        '_mid'              => $mid,
                        'groupname'         => $_POST['groupname'],
                        'limitHead'         => $_POST['limitHead'],
                        'startAccessTime'   => date('y/m/d H:i', strtotime($accessTime[0])),
                        'endAccessTime'     => date('y/m/d H:i', strtotime($accessTime[1])),
                        'startMTTime'       => date('y/m/d H:i', strtotime($MTTime[0])),
                        'endMTTime'         => date('y/m/d H:i', strtotime($MTTime[1])),
                        'approvalType'      => $_POST["approvalType"],
                        'mtName'            => $mt['mtName']
                    ];
                    $group = (new MTGroupModel())->save($mtGroupData);
                    if($group == 1){
                        return $this->response->redirect('/Manage/mgOf/'.$mt['mtName']);
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
        else{
            $data = [
                'is_login'  => $session->get('is_login'),
                'username'  => $session->get('username'),
                'meta_title' => 'addGroup',
                'validation' => $this->validator
            ];

            echo view('header1', $data);
            echo view('openMeeting');
            echo view('footer');
        }
    
    }
}