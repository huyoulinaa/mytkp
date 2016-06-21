<?php
return array(
	//'配置项'=>'配置值'
	//数据库配置
	"DSN"=>"mysql:host=localhost;dbname=sys",
    "DBUSER"=>"root",
    "DBPASS"=>"690520",
    "DBPORT"=>3306,
    "PDOOPTIONS"=>array(
        \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
    ),
    //分页查询相关配置
    "PAGE"=>"1",
    "PAGESIZE"=>"10",
    
    //控制器级别
    //"CONTROLLER_LELVEL"=>"2",
    //设置URL模式为重写模式
    //'URL_MODEL'=>2
    
    //开启模块路由
    'URL_ROUTER_ON'=>true,
//     'URL_ROUTE_RULES'=>array(
//         'ttt/:name/:uid'=>"Index/index",
//         'login'=>"User/login"
//     )
);