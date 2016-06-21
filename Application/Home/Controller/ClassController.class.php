<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class ClassController extends Controller{
    
       private $classModel;
       
       const DB_DSN = "mysql://root:690520@localhost:3306/sys#utf8";
       
       public function __construct(){
           parent::__construct();
           $this->classModel = new Model("class","",self::DB_DSN);
       }
       
       public function loadClassMenu($pageNo=1,$pageSize=10,$className=null,$regtime1=null,
           $regtime2=null,$starttime1=null,$starttime2=null,$endtime1=null,$endtime2=null,$status=-1,
           $headerName=null,$managerName=null){
           
           $sql = " from class c,tb_user u1,tb_user u2,status s,type t where c.headerId = u1.uid and c.managerId = u2.uid and c.staid = s.staid and c.tid = t.tid";
           
           if(null != $className){
               $sql .= " and c.name like '%$className%'"; 
           }
           
           if(null != $regtime1){
               $sql .= " and c.regTime >= '$regtime1'";
           }
           if(null != $regtime2){
               $sql .= " and c.regTime <= '$regtime2'";
           }
           
           if(null != $starttime1){
               $sql .= " and c.startTime >= '$starttime1'";
           }
           if(null != $starttime2){
               $sql .= " and c.startTime <= '$starttime2'";
           }
           
           if(null != $endtime1){
               $sql .= " and c.endTime >= '$endtime1'";
           }
           if(null != $endtime2){
               $sql .= " and c.endTime <= '$endtime2'";
           }
           
           if(null != $headerName){
               $sql .= " and u1.trueName like '%$headerName%'"; 
           }
           
           if(null != $managerName){
               $sql .= " and u2.trueName like '%$managerName%'";
           }
           if($status > 0){
               $sql .= " and c.staid = $status";
           }
           $count = $this->classModel->query("select count(*) as cc".$sql);
           $page["total"] = $count[0]["cc"];
           $begin = ($pageNo-1)*$pageSize;
           $rows = $this->classModel->query("select c.classid,s.name status,c.name,t.name classtype,u1.trueName header,u2.trueName manager,c.pno,c.regTime,c.startTime,c.endTime,c.mark".$sql." limit $begin,$pageSize");
            
           $page["rows"] = $rows;
           $this->ajaxReturn($page);
           
//            $count = $this->ClassModel->query("select count(*) as cc".$sql);
//            $page["total"] = $count[0]["cc"];
//            $begin = ($pageNo-1)*$pageSize;
//            $rows = $this->ClassModel->query("select c.cid,ct.name classtype,c.name,cs.name status,u1.trueName header,u2.trueName manager,c.stucount,c.createTime,c.openTime,c.endTime,c.remark".$sql." limit $begin,$pageSize");
//            $page["rows"] = $rows;
//            $this->ajaxReturn($page);
       }
       /**
        * 检查所选班级是否有考试
        * @param unknown $cids  参数绑定格式为1,2,3
        */
       public function checkExamToday($cids = null){
           $d = date("Y-m-d");
           $db = $d." 00:00:00";
           $de = $d." 23:59:59";
           $data = $this->classModel->table("exam")->where("classid in($cids) and beginTime between '$db' and '$de'")->select();
           //$sql = "select * from exam where cid in(cids) and beginTime between $db and $de";
           if(count($data) > 0){
               //获取到今天又考试的班级id用于提示哪些班级今天有考试
               $classids = array();
               foreach ($data as $exam){
                   array_push($classids, $exam["classid"]);
               }
               $str = implode(",", $classids);
               //查询今天又考试的班级名称
               $cnames = $this->classModel->field("name")->where("cid in($str)")->select();
               //存放今天有考试的班级名称的数组
               $names = array();
               foreach($cnames as $n){
                   array_push($names, $n["name"]);
               }
               $this->ajaxReturn("对不起,".implode(",", $names)."今天有考试哦，不能参与合并");
           }else{
               $this->ajaxReturn("OK","EVAL"); 
           }
       }
       
       /**
        * 
        * @param unknown $cid  要合并的班级id
        * @param unknown $combineClassid 合并后的班级id
        * @param unknown $combineHeaderid合并后的班主任id
        * @param unknown $combineManagerid合并后的项目经理id
        */
       public function hebingClasses($classids=null,$combineClassid=-1,$combineHeaderid=-1,$combineManagerid=-1){
           try{
               $this->classModel->startTrans();//开启事务
               $this->classModel->setProperty(\PDO::ATTR_AUTOCOMMIT, false);
               //判断选中的班级是否是合并后显示的班级
               $classes = $this->classModel->table("class")->where("classid in($classids)")->select();
               $totalCount = 0;
               foreach ($classes as $c){
                   if($c["classid"] == $combineClassid){
                       
                   }else{
//                        echo $c["name"].'人数为：'.$c["pno"]."<br/>";
//                        $c["pno"] = 0;
//                        echo $c["name"].'人数为：'.$c["pno"]."<br/>";
                       //不被保留的班级
                       $totalCount += $c["pno"];
                       $c["pno"] = 0;
                       $c["staid"] = 3;//合并后状态为 3
                       $this->classModel->save($c);
                       $sql = "update tb_user set classid = %d where classid = %d";
                       $this->classModel->table("tb_user")->execute($sql,$combineClassid,$c["classid"]);
                   }
               }
               //查询合并后要保留的班级信息
               $combineClass = $this->classModel->table("class")->where("classid = $combineClassid")->find();
               $combineClass["headerId"] = $combineHeaderid;
               $combineClass["managerId"] = $combineManagerid;
               $combineClass["pno"] += $totalCount;
//                print_r($combineClass);
               $this->classModel->save($combineClass);
               
               $this->classModel->commit();//提交事务
               $this->classModel->setProperty(\PDO::ATTR_AUTOCOMMIT, true);
           }catch(\Exception $e){
               $this->classModel->rollback();//事务回滚
           }
           $this->loadClassMenu();
       }
       
       public function classManage(){
           $this->display();
       }
       
       public function reg(){
           
           //保存一个对象
           $sql = "select c.* ,cs.name csname,ct.name ctname from class c,type ct,status cs where c.staid = cs.staid and c.tid = ct.tid";
           $data = $this->classModel->query($sql);
           $this->assign("data",$data);
//            print_r($data);
           $this->assign("msg","<a style='color:red;'>对不起，没有找到你想要的数据<a>");
           $this->assign("arraylength",count($data));
           
           //演示模版中使用函数
           $this->assign("str","abcdefg");
           
           //演示模版中使用运算符
           $this->assign(i,2);
           $this->assign(j,3);
           
           //保存一个数组
           $arr = array("11","22","33");
           $this->assign(arr,$arr);
           
           $this->assign("aaa","中国你好");
           $this->display();//查找默认的模版进行展示
//            $this->display("index");//查找另一个模版进行展示
//            $this->display("User/user");//跨目录查找另一个模版进行展示
       }
}

?>