<?php

namespace App\Controllers\manage;

use App\Models\MTModel;
use App\Models\RequestMTModel;
use App\Models\userModel;
use App\Models\MTGroupModel;

use App\Controllers\BaseController;
class MT extends BaseController
{
    public function index($mtName){
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
                echo view('header', $data);
                echo view('/MyPage/manage');
                echo view('footer');
            }
            else{
                echo "잘못된 접근, 관리자가 아님.";
            }
        }
        else{
            return $this->response->redirect('/sign/SignIn');
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
                echo view('header', $data);
                echo view('/MyPage/reviseMT');
                echo view('footer');
            }
            else{
                echo "<script>alert('잘못된 접근입니다.'); window.location.href='/';</script>";
            }
        }
        else{
            return $this->response->redirect('/sign/SignIn');
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
                    echo "<script>alert('수정되었습니다.'); window.location.href='/manage/MT/".$mtName."';</script>";
                    
                }
                else{
                    echo "<script>alert('잠시후에 다시시도해주세요'); window.location.href='/mypage';</script>";

                }
            }
            else{
                echo "<script>alert('잘못된 접근입니다.'); window.location.href='/';</script>";
            }
        }
        else{
            return $this->response->redirect('/sign/SignIn');
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
                echo view('header', $data);
                echo view('/MyPage/addGroup');
                echo view('footer');
            }
            else{
                echo "<script>alert('잘못된 접근입니다.'); window.location.href='/';</script>";
            }
        }
        else{
            return $this->response->redirect('/sign/ignIn');
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
                        echo "<script>alert('그룹이 추가되었습니다.'); window.location.href='/manage/mt/".$mt['mtName']."';</script>";
                    }
                }
                else{
                    echo "<script>alert('잘못된 접근입니다.'); window.location.href='/';</script>";
                }
            }
            else{
                return $this->response->redirect('/sign/SignIn');
            }
        }
        else{
            $data = [
                'is_login'  => $session->get('is_login'),
                'username'  => $session->get('username'),
                'meta_title' => 'addGroup',
                'validation' => $this->validator
            ];

            echo view('header', $data);
            echo view('openMeeting');
            echo view('footer');
        }
    
    }
}