<?php
namespace Home\Model;
// require_once '../autoload.php';

use Home\util\DButil;
/**
 * 专注于访问tb_user表
 * @author j
 *
 */
class UserModel{
    private $dbUtil;
    
    public function __construct(){
        $this->dbUtil =  new DButil();
    }
    
    /**
     * 登錄驗證
     * @param unknown $userName
     * @param unknown $userPass
     * @return 1表示登錄成功   2表示用戶不存在  3表示密碼錯
     */
    public function login($userName,$userPass){
        $sql = "select * from tb_user where userName=?";
        $datas= $this->dbUtil->executeQuery($sql,array($userName));
        if (count($datas) > 0){
            //用戶存在
            if ($userPass == $datas[0][2]){
                //用戶名密碼正確
                return 1;
            }else {
                //密碼錯誤
                return 3;
            }
        }else{
            //用戶名不存在
            return 2;
        }
    }
    
    /**
     * 通过用户名加载用户数据数组
     * @param unknown $userName
     * @return 查询成功就返回该用户的整行数据组成的数组 否则返回null
     */
    public function loadUserByName($userName){
        $sql = "select * from tb_user where userName=?";
        $datas= $this->dbUtil->executeQuery($sql,array($userName));
        if (count($datas) == 1){
            return $datas[0];
        }else{
            return null;
        }
    }
    public function loadUser($pageNo, $pageSize){
        $sql = "select * from tb_user limit ?,?";
//         \PDO::FETCH_OBJ,'Home\entity\User'
        $datas= $this->dbUtil->executePageQuery($sql, $pageNo, $pageSize,array(),\PDO::FETCH_OBJ,'Home\entity\User');
        return $datas;
    }
    public function saveUser($userName,$userPass,$rid,$staid,$sexid,$birthday,$school,$phone,$eid,$trueName,$pid,$cid,$workYear,$regTime,$address){
        $sql = "insert into tb_user(userName,userPass,rid,staid,sexid,birthday,school,phone,eid,trueName,pid,cid,workYear,regTime,address) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        if ($this->dbUtil->executeDML($sql,array($userName,$userPass,$rid,$staid,$sexid,$birthday,$school,$phone,$eid,$trueName,$pid,$cid,$workYear,$regTime,$address))){
            return "insertOK";
        }else {
            return "NO";
        }
    }
    
    public function updateUser($userName,$userPass,$rid,$staid,$sexid,$birthday,$school,$phone,$eid,$uid,$trueName,$pid,$cid,$workYear,$address){
        $sql = "update tb_user set userName=?,userPass=?,rid=?,staid=?,sexid=?,birthday=?,school=?,phone=?,eid=?,trueName=?,pid=?,cid=?,workYear=?,address=? where uid=?";
        if ($this->dbUtil->executeDML($sql,array($userName,$userPass,$rid,$staid,$sexid,$birthday,$school,$phone,$eid,$trueName,$pid,$cid,$workYear,$address,$uid))){
            return "updateOK";
        }else {
            return "NO";
        }
    }
   
    public function loadUserById($uid){
    
        $sql = "select * from tb_user where uid=?";
        $e = $this->dbUtil->executeQuery($sql,array($uid),\PDO::FETCH_OBJ,'entity\User');
        return $e[0];
    
    }
    
    public function deleteUser($uids){
    
        $sql = "delete from tb_user where uid in ($uids)";
        $this->dbUtil->executeDML($sql);
    
    }
    
    public function loadRole(){
        $sql = "select * from role";
        $data = $this->dbUtil->executeQuery($sql);
        return $data;
    }
    
    
    public function loadStatus(){
        $sql = "select * from status";
        $data = $this->dbUtil->executeQuery($sql);
        return $data;
    }
    
    
    public function loadSex(){
        $sql = "select * from sex";
        $data = $this->dbUtil->executeQuery($sql);
        return $data;
    }
    
    public function loadEducation(){
        $sql = "select * from education";
        $data = $this->dbUtil->executeQuery($sql);
        return $data;
    }
    
    public function loadProvince(){
        $sql = "select * from province";
        $data = $this->dbUtil->executeQuery($sql);
        return $data;
    }
    
    
    public function loadCity($pid){
        $sql = "select * from city where pid=?";
        $data = $this->dbUtil->executeQuery($sql,array($pid));
        return $data;
    }
    
}

?>