<?php 
namespace App\Models;
use CodeIgniter\Model;

class UpModel extends Model{

    protected $table = 'uptest'; // 사용할 테이블
    protected $returntype = 'array';
    protected $allowedFields = ['i1', 'c1'];

}