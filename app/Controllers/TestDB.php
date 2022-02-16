<?php

namespace App\Controllers;

use App\Models\UpModel;
use App\Models\whynotModel;
class TestDB extends BaseController
{
    public function index()
    {
        return view('index');
    }
    public function test(){
        $result = $_POST['sign_time'];
        echo var_dump($result);
    }
}
