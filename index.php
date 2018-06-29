<?php
	require_once ("./mysql_conf.php");
	if(!$connect)echo 'mysql connect error'. mysqli_connect_error();
	mysqli_select_db($connect,'micf'); #选库
	mysqli_set_charset($connect,'utf8'); #设置字符
	/*
	分页公式：
	（当前页数 - 1 ）X 每页条数 ， 每页条数
	Select * from table limit ($Page- 1) * $PageSize, $PageSize
	*/
	
	#$do = isset($_GET["page"])?$_GET["page"]:"";   #isset($_GET["page"])为ture有值
	$do = isset($_GET["page"]);
	
	if($do){
		$page = $_GET["page"];
	}else{
		$_GET["page"]= '';
		$page = 1;
	}
	/*
	if(!$do==''){
		$page = $_GET["page"];
	}else{
		$page =1 ;
	}
	*/
	
	$pagesize = 5;
	#if($_GET['page'] == '')$page=1;
	$q = ($page- 1)*$pagesize;
	$next = $page+1;
	$prev = $page-1;
	if($prev <= 0)$prev = 1;

	

	$sql = "SELECT * FROM micf_user limit $q, $pagesize"; #sql语句

	$sql2 = "SELECT * FROM micf_user"; #sql语句
	
	$send_it = mysqli_query($connect,$sql); #发送语句
	$send_it2 = mysqli_query($connect,$sql2); #发送语句
	

	$page_num = mysqli_num_rows($send_it2); #总条数
	$page_last = $page_num/$pagesize;
	if($next>=$page_last)$next = $page_last;
	?>
	

		<head>
		</head>
		<body>
			<table width="500" >
			<tr>
			<td>id</td>
			<td>name</td>
			<td>sex</td>
			<td>age</td>
			<td>date</td>
			</tr>
			
		<?php 
		while ($row = mysqli_fetch_array($send_it)) {
			echo '<tr>';
			echo '<td>'.$row["micf_user_id"].'</td>';
			echo '<td>'.$row["micf_nickname"].'</td>';
			echo '<td>'.$sex=$row["micf_sex"]==1?'男':'女'.'</td>';
			echo '<td>'.$row["micf_age"].'</td>';
			echo '<td>'.$row["micf_user_date"].'</td>';
			echo '</tr>';
			}
		mysqli_close($connect);
		?>
		

			</table>
			
			
					<a href="?page=1">首页</a>&nbsp;&nbsp;&nbsp;<a href="?page=<?php echo $prev?>">上一页</a>&nbsp;&nbsp;&nbsp;<a href="?page=<?php echo$next ?>">下一页</a>&nbsp;&nbsp;&nbsp;<a href="?page=<?php echo$page_last?>">尾页</a>
		总共:<?php echo$page_num?>

		</body>
	