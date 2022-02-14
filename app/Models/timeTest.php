<?php 
namespace App\Models;
use CodeIgniter\Model;

class timeTest extends Model{

    protected $table = 'timetest'; // 사용할 테이블
    protected $returntype = 'array';
    protected $allowedFields = ['t1'];

}