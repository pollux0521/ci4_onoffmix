<?php

namespace App\Controllers;

use App\Models\timeTest;
class TestDB extends BaseController
{
    public function index()
    {
        $testDB = new timeTest();
        $value = $testDB->where('t1 >', date('y/m/d h:i'))->findAll();
        echo date('y/m/d h:i');
        echo var_dump($value[0]["t1"]);
    }
}
