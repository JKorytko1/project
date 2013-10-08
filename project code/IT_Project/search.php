<?php
require 'connection.php';
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
<form action="search.php" method="post">
<input name="search" type="text" id="search" size="60">
</form>
</center>
</div>
		<div>
<?php 
include("connection.php");
   mysql_query('SET NAMES utf8');
$search = $_POST['search'];
$search = addslashes($search);
$search = htmlspecialchars($search);
$search = stripslashes($search);
$len=strlen($search);
	if(($search == '') OR ($len<'3')){
		exit;
	}
	if ($table='groups')
	{
	$query_1 = mysql_query("SELECT * FROM groups WHERE group_name LIKE '%$search%'");
	 while($row_1=mysql_fetch_array($query_1))
	 {
			echo "<div>".$row_1['group_name']."</div>";
	}
	}
	if ($table='students')
	{
	$query_1 = mysql_query("SELECT * FROM students WHERE student_name LIKE '%$search%'");
	 while($row_1=mysql_fetch_array($query_1))
	 {
			echo "<div>".$row_1['student_name']."</div>";
	}
	}
	if ($table='lectors')
	{
	$query_1 = mysql_query("SELECT * FROM lectors WHERE lector_name LIKE '%$search%'");
	 while($row_1=mysql_fetch_array($query_1))
	 {
			echo"<tr><td>".$row_1['lector_id']."</td><td><a href=\"lectors_details.php?lectorId=".$row_1['lector_id']."\">".$row_1['lector_name']."</td><td>".$row_1['lector_position']."</td><td>".$row_1['lector_email']."</td>
		<td>".$row_1['lector_login']."</td><td>".$row_1['lector_password']."</td></tr>";
	}

	}
	
?>      	

		</div>
</center>
</body>
</html>
</html>
