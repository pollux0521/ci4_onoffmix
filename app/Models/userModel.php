<?php 
namespace App\Models;
use CodeIgniter\Model;

class userModel extends Model{
    protected $table = 'users'; // 사용할 테이블
    protected $primaryKey = '_id';  // 고유식별키
    protected $useAutoIncrement = true; 
    protected $returntype = 'array';  //
    protected $allowedFields = ['_id','username', 'email', 'pw'];


}