<?php

namespace App\Controllers\manage;

use App\Models\MTModel;
use App\Models\RequestMTModel;
use App\Models\userModel;
use App\Models\MTGroupModel;

use App\Controllers\BaseController;
class Group extends BaseController
{
    // [ GET ]
    public function index($gid){
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
                echo view('header', $data);
                echo view('/MyPage/group');
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
                echo view('header', $data);
                echo view('/MyPage/groupInfo');
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
                    return $this->response->redirect('/manage/group/'.$gid);
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
            return $this->response->redirect('/sign/SignIn');
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

                $MTGroup = new MTGroupModel();
                if($request['Approval'] == false){
                    $MTGroup->set('accessHead', 'accessHead-1', false);
                }
                else if($request['Approval'] == true){
                    $MTGroup->set('accessHead', 'accessHead+1', false);
                }
                $MTGroup->update();
                echo "<script>alert('변경하였습니다.'); window.location.href='/manage/group/'".$request['_gid']."';</script>";
                return $this->response->redirect('/manage/group/'.$request['_gid']);
            }
            else{
                echo "<script>alert('잘못된 접근입니다.'); window.location.href='/';</script>";
            }
        }
        else{
            return $this->response->redirect('/sign/SignIn');
        }
    }
}