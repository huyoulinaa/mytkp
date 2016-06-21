<?php
namespace Home\Model;
use Home\util\DButil;
class RoleModel{
    private $dbUtil;
    
    public function __construct(){
        $this->dbUtil =  new DButil();
    }
    
    public function loadRole(){
        $sql = "select * from role";
        $datas = $this->dbUtil->executeQuery($sql);
        return $datas;
    }
    
    public function loadRoleMenu($rid){
        $sql = "select m.menuid,m.name,(select 1 from rolemenu rm where rm.menuid=m.menuid and rid=?) from menu m";
        return $this->dbUtil->executeQuery($sql,array($rid));
    }
    
    public function modifyRoleMenu($rid,$menuids){
        $pdo = $this->dbUtil->getPdo();
        try {
            $pdo->setAttribute(\PDO::ATTR_AUTOCOMMIT, 0);
            $pdo->beginTransaction();
            $sql = "delete from rolemenu where rid = ?";
            $ps = $pdo->prepare($sql);
            $ps->execute(array($rid));
            
            $sql = "insert into rolemenu(rid,menuid) values(?,?)";
            foreach ($menuids as $mid){
                $ps = $pdo->prepare($sql);
                $ps->execute(array($rid,$mid));
            }
            
            $pdo->commit();
            $pdo->setAttribute(\PDO::ATTR_AUTOCOMMIT, 1);
        } catch (\PDOException $e) {
            $pdo->rollBack();
        }
    }
}

?>