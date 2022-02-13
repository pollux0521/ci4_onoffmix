<?php 
namespace App\Models;
use CodeIgniter\Model;

class MTModel extends Model{
    protected $table = 'MT'; // 사용할 테이블
    protected $primaryKey = '_mid';  // 고유식별키
    protected $useAutoIncrement = true; 
    protected $returntype = 'array';  //
    protected $allowedFields = ['mtName','_id','viewCount','requestCount','groupCount','registTime'];
}