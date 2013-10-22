<?php
require 'connection.php';
session_start();
?>
<html>
<head>
<title>Project I-20б and I-29вс</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <style>
body {
font: 11px Tahoma, "Trebuchet MS", Tahoma, sans-serif; line-height: 1.6em; color: #222;
 }
.search
{
margin-top:110px;
}
.search input
{
border-radius:5px;
}
</style>
</head>
<body>
<center>
<div class="all">
<div class ="auth">
		<?
		session_start();
		if (!empty($_SESSION['id']))
		{
				echo '<div>';
				echo '<label>логин </label>';
			print_r ($_SESSION['login']);
			echo '</div>';
			echo '<a href="registration/logout.php">Завершить сеанс</a>';
			
		}
		else
		{
		echo '<form action="registration/form_auth.php" METHOD="POST">
			<div>
				<label>логин</label>
				<input name="login" type="text" />
			</div>
			<div>
				<label>пароль</label>
				<input name="password" type="password" />
			</div>
			<div>
				<input value="Войти" type="submit" />
				</div>
		</form>' ;
		}
		
		?>
</div>
<div class="links">
<a href="list.php?info=lectors">Lectors</a>
</div>
<div class="links">
<a href="list.php?info=subjects">Subjects</a>
</div>
<div class="links">
<a href="list.php?info=students">Students</a>
</div>
<div class="links">
<a href="list.php?info=groups">Groups</a>
</div>
<div class="links">
<a href="index.php">Home</a>
</div>
<div class="search">
	<center>
<form action="search.php" method="GET">
<input name="search" type="text" id="search" size="60">
</form>
</center>
</div>
		<div>
<?php 
include("connection.php");
   mysql_query('SET NAMES utf8');
$search = $_GET['search'];
$table = $_SESSION['search'];
$search = addslashes($search);
$search = htmlspecialchars($search);
$search = stripslashes($search);
$len=strlen($search);
	if(($search == '') OR ($len<'2')){
		exit;
	}
	else
	{
	if ($table=='groups')
	{
	 echo"<table border=2 cellpadding=0 cellspacing=0>";
    echo"<TR><TH>Идентификатор</TH><TH>Группа</TH></TR>";
	$query_1 = mysql_query("SELECT * FROM groups WHERE group_name LIKE '%$search%'");
	 while($row_1=mysql_fetch_array($query_1))
	 {
			  echo"<tr><td>".$row_1['group_id']."</td><td><a href=\"groups_details.php?groupId=".$row_1['group_id']."\"> ".$row_1['group_name']."</td></tr>";
	}
	echo"</table>";  
	}
	if ($table=='students')
	{
	echo"<table border=2 cellpadding=0 cellspacing=0>";
    echo"<TR><TH>Идентификатор</TH><TH>Cтудент</TH><TH>Заметки</TH><TH>Электронная почта</TH><TH>Группа</TH></TR>";
	$query_1 = mysql_query("SELECT * FROM students WHERE student_name LIKE '%$search%'");
	 while($row_1=mysql_fetch_array($query_1))
	 {
			 $query2="select group_name from groups where group_id=".$row_1['group_id'];
			$resultgroups=mysql_query($query2);
			$rowgroup=mysql_fetch_array($resultgroups);
			  echo"<tr><td>".$row_1['student_id']."</td><td><a href=\"student_detail.php?studentId=".$row_1['student_id']."\">".$row_1['student_name']."</a></td><td>".$row_1['student_notes']."</td><td>".$row_1['student_email']."</td><td>".$rowgroup['group_name']."</td>";
		}
		echo"</table>";  
	}
	if ($table=='lectors')
	{
	echo"<table border=2 cellpadding=0 cellspacing=0 >";
		echo"<TR><TH>Идентификатор</TH><TH>Преподаватель</TH><TH>Ученая степень</TH><TH>Электронная почта</TH><TH>Логин</TH><TH>Пароль</TH></TR>";
	$query_1 = mysql_query("SELECT * FROM lectors WHERE lector_name LIKE '%$search%'");
	 while($row_1=mysql_fetch_array($query_1))
	 {
	echo"<tr><td>".$row_1['lector_id']."</td><td><a href=\"lectors_details.php?lectorId=".$row_1['lector_id']."\">".$row_1['lector_name']."</td><td>".$row_1['lector_position']."</td><td>".$row_1['lector_email']."</td>
		<td>".$row_1['lector_login']."</td><td>".$row_1['lector_password']."</td></tr>";
	}
	echo"</table>";
	}
	}
?>      	

		</div>
</center>
</body>
</html>
</html>
