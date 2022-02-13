<?php

namespace App\Controllers;

use App\Models\userModel;
class TestDB extends BaseController
{

    public function index()
    {
        $std = new userModel();
        
        $result = $std->where(['email' => 'test1@test.com', 'pw' => 'test'])->findAll();
        if($result){
            foreach($result as $row){
                print_r($row);
                echo $row['username'];
            }
        }
        else{
            echo "NULL";
        }
        
    }
}
