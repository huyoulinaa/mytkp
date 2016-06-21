<?php
namespace Home\Model;
use Home\util\DButil;
class ClassModel{
    
    private $dbUtil;
    
    public function __construct(){
        $this->dbUtil =  new DButil();
    }
}

?>