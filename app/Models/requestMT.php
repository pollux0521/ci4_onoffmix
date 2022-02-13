<?php 
namespace App\Models;
use CodeIgniter\Model;

class requestMTModel extends Model{

    protected $table = 'requestMT'; // 사용할 테이블
    protected $primaryKey = '_rid';  // 고유식별키
    protected $useAutoIncrement = true; 
    protected $returntype = 'array';  //
    protected $allowedFields = ['_rid','_mid','_gid','id','reason','Approval'];

}