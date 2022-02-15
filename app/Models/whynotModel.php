<?php 
namespace App\Models;
use CodeIgniter\Model;

class whynotModel extends Model{

    protected $table = 'btest'; // 사용할 테이블
    protected $returntype = 'array';
    protected $allowedFields = ['b'];

}