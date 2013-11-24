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
<form action="search.php" method="get">
<input name="search" type="text" id="search" size="60">
<INPUT TYPE="hidden" NAME="table" VALUE="<? echo $_GET['table']; ?>">
</form>
</center>
</div>
		<div>
<?php 
include("connection.php");
   mysql_query('SET NAMES utf8');
$search = $_GET['search'];
$search = addslashes($search);
$search = htmlspecialchars($search);
$search = stripslashes($search);
$len=strlen($search);
	if(($search == '') OR ($len<'3')){
		exit;
	}
	$table=$_GET['table'];
	
	if ($table=='groups')
	{
	$query_1 = mysql_query("SELECT * FROM groups WHERE group_name LIKE '%$search%'");
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Группа</TH></TR>";
	 while($row_1=mysql_fetch_array($query_1))
	 {
			echo "<tr><td><a href=\"groups_details.php?groupId=".$row_1['group_id']."\">".$row_1['group_name']."</td></tr>";
	}
		echo "</table>";
	}
	if ($table=='students')
	{
	$query_1 = mysql_query("SELECT * FROM students WHERE student_name LIKE '%$search%'");
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TR><TH>Cтудент</TH></TR>";
	 while($row_1=mysql_fetch_array($query_1))
	 {
			echo "<tr><td><a href=\"recordbook.php?studentId=".$row_1['student_id']."&groupId=".$row_1['group_id']."\">".$row_1['student_name']."</td></tr>";
	}
		echo "</table>";
	}
	if ($table=='lectors')
	{
	$query_1 = mysql_query("SELECT * FROM lectors WHERE lector_name LIKE '%$search%'");
	
			echo"<table border=2 cellpadding=0 cellspacing=0 >";
			echo"<TR><TH>Преподаватель</TH></TR>";
	 while($row_1=mysql_fetch_array($query_1)){
			echo"<tr><td><a href=\"lectors_details.php?lectorId=".$row_1['lector_id']."\">".$row_1['lector_name']."</td></tr>";
	}
		echo "</table>";
	}
	if ($table=='subjects')
	{
	$query_1 = mysql_query("SELECT * FROM subjects WHERE subject_title LIKE '%$search%'");
	
			echo"<table border=2 cellpadding=0 cellspacing=0 >";
			echo"<TR><TH>Предмет</TH></TR>";
	 while($row_1=mysql_fetch_array($query_1)){
			echo"<tr><td><a href=\"subjects_details.php?subjectId=".$row_1['subject_id']."\">".$row_1['subject_title']."</td></tr>";
	}
		echo "</table>";
	}
	
	
?>      	

		</div>
</center>
</body>
</html>
</html>
