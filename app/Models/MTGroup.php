<?php 
namespace App\Models;
use CodeIgniter\Model;

class MTGroupModel extends Model{

    protected $table = 'MTGroup'; // 사용할 테이블
    protected $primaryKey = '_gid';  // 고유식별키
    protected $useAutoIncrement = true; 
    protected $returntype = 'array';  //
    protected $allowedFields = ['_gid','_mid','groupname','limitHead','accessHead','startAccessTime','endAccessTime','startMTTime','endMTTime'];

}