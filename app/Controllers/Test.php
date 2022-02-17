<?php

namespace App\Controllers;

use App\Models\MTModel;
use App\Models\MTGroupModel;
use App\Models\RequestMTModel;
use App\Models\UpModel;
class Test extends BaseController{
    public function index(){
        echo "<script>alert('h1'); window.location.href='/test/alertinfo';</script>";

        $MT = (new MTModel())->set('requestCount', 'requestCount-1', false)->where("_mid", $requestInfo["_mid"])->update();
        $MTGroup = (new MTGroupModel())->set('accessHead', 'accessHead-1', false)->where("_gid", $requestInfo["_gid"])->update();
    }
    
    public function alertinfo(){
        $up = (new UpModel())->where("c1", "teee");
        $t1 = $up->first();
        $up->where("c1", "teee");
        $up->delete();

        echo var_dump($t1);
    }
}