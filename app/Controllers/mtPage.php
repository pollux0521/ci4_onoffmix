<?php

namespace App\Controllers;

use App\Models\MTModel;
use App\Models\MTGroupModel;
class mtPage extends BaseController
{
    public function index($mtName)
    {
        $mtModel = new MTModel;
        $mtGroupModel = new MTGroupModel;
        $mt = $mtModel->where("mtName", $mtName)->findAll();
        $mtGroupList = $mtGroupModel->where("mtName", $mtName)->findAll();

        $data = [
            'meta_title'    => 'mtpage',
            'mt'            => $mt,
            'mtGroupList'   => $mtGroupList
        ];

        echo view("header1", $data);
        echo view("header2");
        echo view("mtPage");
        echo view("footer");
    }
    
    public function mtOf($MTModel){
        $mtModel = new MTModel;
        $mtGroupModel = new MTGroupModel;
        $mt = $mtModel->where("mtName", $mtName)->findAll();
        $mtGroupList = $mtGroupModel->where("mtName", $mtName)->findAll();

        $data = [
            'meta_title'    => 'mtpage',
            'mt'            => $mt,
            'mtGroupList'   => $mtGroupList
        ];

        echo view("header1", $data);
        echo view("header2");
        echo view("mtPage");
        echo view("footer");
    }
}
