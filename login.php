<?php 
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta content="IE=11.0000" http-equiv="X-Ua-Compatible">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title>教学管理系统</title> 
		<script src="Public/js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<link type="text/css" rel="stylesheet" href="Public/css/login.css">
		<script type="text/javascript" src="Public/js/login.js"></script>
		<meta name="GENERATOR" content="MShtml 11.00.9600.17496">
	</head>
	<body>
		<div class="top_div"></div>
		<div style="background: rgb(255, 255, 255); margin: -100px auto auto; border: 1px solid rgb(231, 231, 231); border-image: none; width: 400px; height: 200px; text-align: center;">
			<div style="width: 165px; height: 96px; position: absolute;">
				<div class="tou"></div>
				<div class="initial_left_hand" id="left_hand"></div>
				<div class="initial_right_hand" id="right_hand"></div>
			</div>
			<form action="http://localhost:8000/mytkp/index.php/login" method="post" id="form">
				<input type="hidden" name="controller" value="UserController">
				<input type="hidden" name="methodName" value="login">
				<P style="padding: 30px 0px 10px; position: relative;">
					<span class="u_logo"></span> 
					<input class="ipt" type="text" placeholder="请输入用户名或邮箱" name="userName">
				</P>
				<P style="position: relative;">
					<span class="p_logo"></span> 
					<input class="ipt" id="password" type="password" placeholder="请输入密码" name="userPass">
				</P>
				<p>
				<?php 
				    if (array_key_exists("loginError", $_SESSION)){
				        echo $_SESSION["loginError"];
// 				        session_destroy();
                        session_unset();
				    }
				?>
				</p>
				<div style="height: 50px; line-height: 50px; margin-top: 30px; border-top-color: rgb(231, 231, 231); border-top-width: 1px; border-top-style: solid;">
					<P style="margin: 0px 35px 20px 45px;">
						<span style="float: left;">
							<a style="color: rgb(204, 204, 204);" href="#">忘记密码?</a>
						</span>
						<span style="float: right;">
						 	<a style="color: rgb(204, 204, 204); margin-right: 10px;" href="#">注册</a>
							<a id="submit" style="background: rgb(0, 142, 173); padding: 7px 10px; border-radius: 4px; border: 1px solid rgb(26, 117, 152); border-image: none; color: rgb(255, 255, 255); font-weight: bold;" href="javascript:void(0);">登录</a>
						</span>
					</P>
				</div>
			</form>
		</div>
	</body>
</html>


