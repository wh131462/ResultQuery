<?php 
// 存放数据库的增删查改功能  所有成功 除返回数据外 都会返回success
// connect($host,$username,$password,$database) 登录mysql $database可为空
// createDatabase($database)					创建数据库
// createTable($database,$table,$array) 		创建表
// addData($database,$table,$data)  			为表添加数据
// deleteDatabase($database)  					删除数据库
// deleteTable($database,$table)  				删除表
// deleteData($database,$table,$key,$value) 	删除表中数据
// findData($database,$table,$key,$value)  		查找数据
// findAllData($database,$table,$key,$value) 	获取key所对的所有数据
// getAll($database,$table)						获取所有数据
// update($database,$table,$key,$value,$dataArr)更新数据
// close()										关闭数据库
// class _mysql{
	// 登录数据库
	function connect($host,$username,$password,$database=""){
		global $conn;
		$conn=$database==""?new mysqli($host,$username,$password):new mysqli($host,$username,$password,$database);
		mysqli_set_charset($conn,"utf8");
		if($conn->connect_error){
			die("连接失败".$conn->connect_error);
		}
		else{
			//登陆成功
		}
	}
	// 创建数据库
	function createDatabase($database){
		global $conn;
		if ($conn->query("CREATE DATABASE ".$database." DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;")=== TRUE) {
		    return "success";
		} else {
		    return "Error creating database: " . $conn->error;
		}
		
	}
	//创建表
	function createTable($database,$table,$array){
		//表的元素名称和属性从数组中获取  模板建表
		// "CREATE TABLE IP(
		// id INT(12) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		// website VARCHAR(30) NOT NULL,
		// IP VARCHAR(50) NOT NULL,
		// timestamp TIMESTAMP
		// )";
		if(is_array($array)){
			$str="";
			foreach($array as $key=>$value){
				$str.="`".$key."`"." ".$value.",";
				}
			$str=substr($str,0,-1);//去最后逗号
		}else{
			return false;
		}
		global $conn;
		if($conn->query("use ".$database.";")=== TRUE){
			if($conn->query("CREATE TABLE ".$table." (".$str.")ENGINE=InnoDB DEFAULT CHARSET=utf8;")===TRUE){
				return "success";
			}else{
				return "未能创建表".$table." error:". $conn->error;
			}
		}
		else{
			// 使用数据库失败
			return "无此数据库";
		}
	}
	// 插入 数据 数据是数组类型 
	function addData($database,$table,$data){
		if($data!=null){
			$keys="";
			$values="";
			foreach($data as $key=>$value){
				$keys.="`".$key."`,";
				$values.="\"".$value."\",";
			}
			$keys=substr($keys,0,-1);//去最后逗号
			$values=substr($values,0,-1);//去最后逗号
		}
		$sql="INSERT INTO ".$table." (".$keys.") VALUES (".$values.")";
		global $conn;
		if($conn->query("use ".$database.";")=== TRUE){
			
			if($conn->query($sql)===TRUE){
				return "success";
			}else{
				return "插入失败"." error:". $conn->error;
			}
		}
	}
	// 删除数据库
	function deleteDatabase($database){
		global $conn;
		if($conn->query("drop database ".$database.";")=== TRUE){
			return "success";
		}else{
			return "删除数据库".$database."失败,error:".$conn->error;
		}
	}
	// 删除表格
	function deleteTable($database,$table){
		global $conn;
		if($conn->query("use ".$database.";")=== TRUE){
			if($conn->query("drop table ".$table.";")=== TRUE){
				return "success";
			}else{
				return "删除表".$table."失败,error:".$conn->error;
			}
		}
	
	}
	// 删除某一行
	function deleteData($database,$table,$key,$value){
		global $conn;
		if($conn->query("use ".$database.";")=== TRUE){
			if($conn->query("DELETE FROM ".$table."
WHERE ".$key." = \"".$value."\";")===TRUE){
				return "success";
			}else{
				return "删除".$key."=".$value." 所在行数据失败"."error:". $conn->error;
			}
		}
		
	}
	// 查找数据 只获取一行
	function findData($database,$table,$key,$value){
		global $conn;
		if($conn->query("use ".$database.";")=== TRUE){
					$result=mysqli_query($conn,"select * FROM ".$table." WHERE `".$key."` = \"".$value."\";");
					if($result){
						$result=mysqli_fetch_array($result,MYSQLI_ASSOC);
						return $result;
					}else{
						return "查找失败"."err:". $conn->error;
					}
				}
	}
	// 获取等于key的所有值
	function findAllData($database,$table,$key,$value){
		global $conn;
		if($conn->query("use ".$database.";")=== TRUE){
					$result=mysqli_query($conn,"select * FROM ".$table." WHERE `".$key."` = \"".$value."\";");
					if($result){
						$result=mysqli_fetch_all($result,MYSQLI_ASSOC);
						return $result;
					}else{
						return "查找失败"."err:". $conn->error;
					}
				}
	}
	//获取表中所有数据
	function getAll($database,$table){
		global $conn;
		if($conn->query("use ".$database.";")=== TRUE){
					$result=mysqli_query($conn,"select * FROM ".$table.";");
					if($result){
						$result=mysqli_fetch_all($result,1);
						return $result;
					}else{
						return "查找失败"."err:". $conn->error;
					}
				}
	}
	// 更新数据
	function update($database,$table,$KEY,$VALUE,$dataArr){
		global $conn;
		if($conn->query("use ".$database.";")=== TRUE){
					$update="";
					foreach($dataArr as $key=>$value){
						$update.="`".$key."`=\"".$value."\",";
					}
					$update=substr($update,0,-1);
					$sql="UPDATE ".$table." SET ".$update." WHERE ".$KEY."=\"".$VALUE."\";";
					if($conn->query($sql)===TRUE){
						return "success";
					}else{
						return "更新内容失败 "."err:". $conn->error;
					}
				}
	}
	// 关闭数据库
	function close(){
		global $conn;
		$conn->close();
	}
// }
?>