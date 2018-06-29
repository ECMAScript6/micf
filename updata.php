<?php

	
	$micf_nickname = $_GET["micf_nickname"];
	$micf_sex = $_GET["micf_sex"];
	$micf_age = $_GET["micf_age"];
	$now_time = date("Y-m-d");
	
	require_once ("./mysql_conf.php");
	if(!$connect){
		echo 'mysql connect error'. mysqli_connect_error();
	}else{
		echo 'success';
	}
	
	mysqli_select_db($connect,'micf'); #选库
	mysqli_set_charset($connect,'utf8'); #设置字符

	$sql = "INSERT INTO micf_user(micf_nickname, micf_sex, micf_age, micf_user_date)VALUE('".$micf_nickname."', '".$micf_sex."', '".$micf_age."', '".$now_time."')";
	
	$send_it = mysqli_query($connect,$sql);
	if(!$send_it){
		echo '添加失败';
		echo $sql;
	}else{
		echo '添加成功';
	}
	mysqli_close($connect); 
	?>
	<html>
		<head>
		<meta charset='utf-8'>
		</head>
		<body>
		<form action="updata.php" method="get">
		nickname:<input type ='text' name='micf_nickname' value=''><br />
		sex:<input type ='radio' name='micf_sex' value='1'><input type ='radio' name='micf_sex' value='0'><br />
		age:<input type ='text' name='micf_age' value=''><br />
		<input type="submit" value="添加">
		</form>
		</body>
	</html>