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
        $mtGroupList = $mtGroupModel->where("mtName", $mtName)->findAll();
        
        $data = [
            'is_login'  => $session->get('is_login'),
            'username'  => $session->get('username'),
            'meta_title'    => 'mtpage',
            'mt'            => $mt[0],
            'mtGroupList'   => $mtGroupList
        ];

        echo view("header1", $data);
        echo view("header2");
        echo view("mtPage");
        echo view("footer");
    }

    public function request($mtName, $groupname)
    {
        helper(['form']);
        $session = session();
        if($session->get('is_login')){
            $mtModel = new MTModel();
            $mtGroupModel = new MTGroupModel();
    
            $mt = $mtModel->where("mtName", $mtName)->findAll();
            $mtGroup = $mtGroupModel->where("groupname", $groupname)->findAll();
    
            $data = [
                'is_login'  => $session->get('is_login'),
                'username'  => $session->get('username'),
                'meta_title'    => 'mtpage',
                'mt'            => $mt[0],
                'mtGroup'       => $mtGroup[0]
            ];
            echo view('header1', $data);
            echo view('header2');
            echo view('request');
            echo view('footer');
        }
        else{
            return $this->response->redirect('/SignIn');
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
                return $this->response->redirect("/MTPage/mtOf/".$mtName);
            }else{
                echo print_r($result);
                return $this->response->redirect("/request"."/".$mtName."/".$groupname);
            }   
        }else{
            return $this->response->redirect('/SignIn');
        }
    }
}
