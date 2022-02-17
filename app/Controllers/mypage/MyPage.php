<?php

namespace App\Controllers\mypage;

use App\Models\MTModel;
use App\Models\MTGroupModel;
use App\Models\RequestMTModel;
use App\Models\userModel;

use App\Controllers\BaseController;
class MyPage extends BaseController
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
    public function cancel($rid){
        $session = session();
        if($session->get('is_login')){
            $requestMT = new RequestMTModel();
            $requestInfo = $requestMT->where('_rid', $rid)->where('_id', $session->get('_id'))->first();
            $requestMT->where('_rid', $rid)->where('_id', $session->get('_id'));
            if($requestMT->delete()){
                $mt = new MTModel();
                $group = new MTGroupModel();
                if($requestInfo['Approval'] == true){
                    $group->set('accessHead', 'accessHead-1', false)->where('_gid', $requestInfo['_gid'])->update();
                    $mt->set('requestCount', 'requestCount-1', false)->where('_mid', $requestInfo['_mid'])->update();
                }
                else{
                    $mt->set('requestCount', 'requestCount-1', false)->where('_mid', $requestInfo['_mid'])->update();
                }
                echo "<script>alert('취소하였습니다.'); window.location.href='/mypage';</script>";
            }
            else{
                echo "<script>alert('잠시후에 다시시도해주세요'); window.location.href='/mypage';</script>";
            }
        }
        else{
            return $this->response->redirect('/sign/SignIn');
        }
    }
}
