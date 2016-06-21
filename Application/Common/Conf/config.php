<?php
return array(
	//'配置项'=>'配置值'
    //开启全局路由
    'URL_ROUTER_ON'=>true,
    'URL_ROUTE_RULES'=>array(
        'ttt/:name/:uid' => "Home/Index/index",//静态的规则路由
        'tttt/:userName/:userPass' => "Home/Index/index",//静态和动态相结合
        'login'                   => "Home/User/login",
        'aaa'                     => array("http://www.baidu.com",302)
    ),
    'URL_MAP_RULES' => "Home/Index/index",
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'sys',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '690520',          // 密码
    'DB_PORT'               =>  3306,        // 端口
    'DB_PARAMS'          	=>  array(
        \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
    ), // 数据库连接参数
    
    //修改默认的模版目录结构为控制器名称_操作方法名.html
//     'TMPL_FILE_DEPR'=>'_',
);