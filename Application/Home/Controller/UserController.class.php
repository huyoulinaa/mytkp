<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
use Home\Model\MenuModel;
use Think\Model;
class UserController extends Controller{
    
    private $userModel;
    
    private $menuModel;
    
    private $userModelThink;
    public function __construct(){
        parent::__construct();
        $this->userModel = new UserModel();
        $this->menuModel = new MenuModel();
        $this->userModelThink = new Model("tb_user");
    }
    
    public function login(){
        $userName = $_POST["userName"];
        $userPass = $_POST["userPass"];
        $i = $this->userModel->login($userName,$userPass);
        if($i ==1){
            //登录成功 加载当前用户对象
            $user = $this->userModel->loadUserByName($userName);
            $_SESSION["loginUser"] = $user;
            $uid = $_SESSION["loginUser"][0];
            
            $MenuModel= new MenuModel();
            $secondMenu = $this->menuModel->loadTreeMenu($uid);
            
            $_SESSION["secondMenu"] = $secondMenu;
            header("location:http://localhost:8000/mytkp/welcome.php");
        }elseif($i == 2){
            //用户名不存在
            $_SESSION["loginError"] = "用户不存在";
            header("location:http://localhost:8000/mytkp/login.php");
        }else {
            //密码错误
            $_SESSION["loginError"] = "密码错误";
            header("location:http://localhost:8000/mytkp/login.php");
        }
    }
    
    public function loadHeader(){
        $options = array(array("uid"=>-1,"truename"=>"请选择合并后的班主任"));
        $data = $this->userModelThink->field("uid,trueName")->where("rid = 3")->select();
        foreach ($data as $a){
            array_push($options,$a);
        }
        $this->ajaxReturn($options);
    }
    
    public function loadManager(){
        $options = array(array("uid"=>-1,"truename"=>"请选择合并后的项目经理"));
        $data = $this->userModelThink->field("uid,trueName")->where("rid = 2")->select();
        foreach ($data as $a){
            array_push($options,$a);
        }
        $this->ajaxReturn($options);
    }
}
?>