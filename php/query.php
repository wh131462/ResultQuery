<?php 
header("Content-type:text/html;charset=utf-8"); 
header('Access-Control-Allow-Origin:*'); // *代表允许任何网址请求
header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE'); // 允许请求的类型
header('Access-Control-Allow-Credentials: true'); // 设置是否允许发送 cookies
header('Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding,X-Requested-with, Origin'); // 设置允许自定义请求头的字段
include_once("mysql.php");
include_once("sql.php");
$database="Result";
$tbpass="User";
$tbcj="CJ20211";// CJ20211  目前存储策略是按照成绩的学年来建表 每一个学期都是不一样的 20211 20212
if($_SERVER["REQUEST_METHOD"]=="POST"){
	// 返回数组
	$return=[];
	//连接数据库
	connect($host,$sql_username,$sql_password);
	//根据提交请求的不同 切换不同的表  空的话就用默认的
	$tbcj=$_POST["xq"]!=null?$_POST["xq"]:$tbcj;
	$case=$_POST["case"];
	switch($case){
		case "login":
		$res=findData($database,$tbpass,"xh",$_POST["username"]);
		if(is_array($res)){
			//如果密码匹配 返回1 不匹配返回0
			if($_POST["password"]==$res["password"]){
				$return["code"]=1;
			}else{
				$return["code"]=0;
			}
		}else{
			$return["code"]=0;
			$return["errMes"]="failed:".$res;
		}
		break;
		case "query":
		$res=findAllData($database,$tbcj,"xh",$_POST["username"]);
		if(is_array($res)){
			$return["code"]=1;
			$return["data"]=$res;
			$return["xq"]=$tbcj;//学期数获得
		}else{
			$return["code"]=0;
			$return["errMes"]="failed:".$res;
		}
		break;
	}
	$json=json_encode($return);
	echo $json;
}else{
	echo "<center><h1>404 Not Found</h1></center>
	<hr><center>nginx/1.10.3 (Ubuntu)</center>";
}
?>