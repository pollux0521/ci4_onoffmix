<?php

namespace App\Controllers;
use App\Models\MTModel;
use App\Models\MTGroupModel;
class OpenMeeting extends BaseController
{
    public function index()
    {
        helper(['form']);
        $session = session();
        if($session->get('is_login')){
            $data = ['meta_title' => 'openMeeting'];
            echo view('header1', $data);
            echo view('header2');
            echo view('openMeeting');
            echo view('footer');
        }
        else{
            return $this->response->redirect('/SignIn');
        }
    }
    public function open()
    {
        $session = session();
        helper(['form']);
        $rule1 = [
            'mtName'        => 'required|is_unique[MT.mtName]'
        ];
        $rule2 = [
            'groupname'         => 'required',
            'sign_time'         => 'required',
            'meeting_time'      => 'required',
            'limitHead'         => 'required',
        ];
        if($this->validate($rule1)){
            if($this->validate($rule2)){
                $mtName = $_POST['mtName'];
                $mt = new MTModel();
                $mtData = [
                    'mtName'    => $mtName,
                    '_id'       => $session->get('_id'),
                    'groupCount'=> count($_POST['groupname'])
                ];
                $mt->save($mtData);
                $mid =  $mt->where(['mtName'=>$mtName])->first()['_mid'];
                
                $mtGroup = new MTGroupModel();      
                $sign = $_POST['groupname'];
                $mtGroupData = [];
                foreach($sign as $groupname){
                    $num = array_search($groupname, $_POST['groupname']);
                    $accessTime = explode("-", $_POST['sign_time'][$num]);
                    $MTTime = explode("-", $_POST['meeting_time'][$num]);
                    $approvalType = "approvalType".($num + 1);
                    $mtGroupData = [
                        '_mid'              => $mid,
                        'groupname'         => $groupname,
                        'limitHead'         => $_POST['limitHead'],
                        'startAccessTime'   => date('y/m/d H:i', strtotime($accessTime[0])),
                        'endAccessTime'     => date('y/m/d H:i', strtotime($accessTime[1])),
                        'startMTTime'       => date('y/m/d H:i', strtotime($MTTime[0])),
                        'endMTTime'         => date('y/m/d H:i', strtotime($MTTime[1])),
                        'approvalType'      => $_POST[$approvalType],
                        'mtName'            => $mtName
                    ];
                    $result = $mtGroup->save($mtGroupData);
                }
                if($result == 1){
                    return $this->response->redirect('/');
                }
                else{
                    return $this->response->redirect('/OpenMeeting');
                }
            }else{
                $data = [
                    'meta_title' => 'openMeeting',
                    'validation' => $this->validator
                ];

                echo view('header1', $data);
                echo view('openMeeting');
                echo view('footer');
            }
        }else{
            $data = [
                'meta_title' => 'openMeeting',
                'validation' => $this->validator
            ];
            echo view('header1', $data);
            echo view('openMeeting');
            echo view('footer');
        }
    }
}
