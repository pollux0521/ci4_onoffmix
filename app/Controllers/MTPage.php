<?php

namespace App\Controllers;

use App\Models\MTModel;
use App\Models\MTGroupModel;
use App\Models\RequestMTModel;
class MTPage extends BaseController
{
    public function index($mtName)
    {
    }
    
    public function mtOf($mtName)
    {
        $session = session();
        $mtModel = new MTModel();
        $mtGroupModel = new MTGroupModel();
        $mt = $mtModel->where("mtName", $mtName)->findAll();
        $mtModel->set("viewCount", "viewCount+1", false)->where("mtName",$mtName)->update();
        $mtGroupList = $mtGroupModel->where("mtName", $mtName)->findAll();
        $data = [
            'is_login'  => $session->get('is_login'),
            'username'  => $session->get('username'),
            'meta_title'    => 'mtpage',
            'mt'            => $mt[0],
            'mtGroupList'   => $mtGroupList
        ];

        echo view("header", $data);
        echo view("mtPage");
        echo view("footer");
    }

    public function request($gid)
    {
        helper(['form']);
        $session = session();
        if($session->get('is_login')){
            $mtModel = new MTModel();
            $mtGroupModel = new MTGroupModel();
    
            $mtGroup = $mtGroupModel->where("_gid", $gid)->first();
            $mt = $mtModel->where("_mid", $mtGroup['_mid'])->first();

            $data = [
                'is_login'  => $session->get('is_login'),
                'username'  => $session->get('username'),
                'meta_title'    => 'mtpage',
                'mt'            => $mt,
                'mtGroup'       => $mtGroup
            ];
            echo view('header', $data);
            echo view('request');
            echo view('footer');
        }
        else{
            return $this->response->redirect('/sign/SignIn');
        }
        
    }

    public function attend($mtName, $groupname)
    {
        $session = session();
        if($session->get('is_login')){
            $mtGroupModel = new MTGroupModel();
            $requestMTModel = new RequestMTModel();
            $mtGroup = $mtGroupModel->where("groupname", $groupname)->where("mtName", $mtName)->findAll()[0];
            $data = [
                'is_login'  => $session->get('is_login'),
                'username'  => $session->get('username'),
                "_mid"      => $mtGroup['_mid'],
                "_gid"      => $mtGroup['_gid'],
                "_id"       => $_SESSION['_id'],
                "reason"    => $_POST['reason'],
                "Approval"  => $mtGroup['approvalType']
            ];
            $result = $requestMTModel->save($data);
            if($result == 1){
                $MT = (new MTModel())
                ->set('requestCount', 'requestCount+1', false)
                ->where('_mid',$mtGroup['_mid'])
                ->update();
                if($mtGroup['approvalType'] == true){
                    (new MTGroupModel())
                    ->set('accessHead', 'accessHead+1', false)
                    ->where('_gid',$mtGroup['_gid'])
                    ->update();
                }
                echo "<script>alert('신청이 완료되었습니다.'); window.location.href='/MTPage/mtOf/".$mtName."';</script>";
            }else{
                echo "<script>alert('잠시후에 다시 시도해주세요'); window.location.href='/MTPage/request/".$mtName."/".$groupname."';</script>";
            }   
        }else{
            return $this->response->redirect('/sign/SignIn');
        }
    }
}
