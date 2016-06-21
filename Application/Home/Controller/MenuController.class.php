<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\MenuModel;

class MenuController extends Controller{
    
    private $menuModel;
    
    public function __construct(){
        parent::__construct();
        $this->menuModel = new MenuModel();
    }
    
    public function menuManage(){
        $this->display();
    }
    
    public function loadTableMenu($pageNo=1,$pageSize=10){
        $datas = $this->menuModel->loadTableMenu($pageNo, $pageSize);
        $this->ajaxReturn($datas);
    }
    
    public function load12Menu(){
        $fsmenu = $this->menuModel->load12Menu();
        $this->ajaxReturn($fsmenu);
    }
    
    public function loadMenuById($menuid){
        $data = $this->menuModel->loadMenuById($menuid);
        $this->ajaxReturn($data);
    }
    
    public function saveOrUpdateMenu($name, $url, $parentid, $isshow,$menuid){
        if ($menuid == ""){
            $result = $this->menuModel->saveMenu($name, $url, $parentid, $isshow);
        }else {
            $result = $this->menuModel->updateMenu($name, $url, $parentid, $isshow,$menuid);
        }
        $this->ajaxReturn($result,"eval");
    }
    
    public function deleteMenu($menuids){
        $datas = $this->menuModel->deleteMenu($menuids);
        $this->ajaxReturn($datas);
    }
}

?>