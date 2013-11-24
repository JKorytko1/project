<?php
require 'connection.php';
$tmp=$_GET['info'];
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
	<?php 
	if (!empty($_SESSION['id'])){
	echo "<div class=\"search\">";
	echo "<center>";
	echo "<form action=\"search.php\" method=\"get\">";
	
	echo "<input name=\"search\" type=\"text\" id=\"search\" size=\"60\">";
	echo "<INPUT TYPE=\"hidden\" NAME=\"table\" VALUE=".$_GET['info'].">";
	echo "</form>";
	echo "</center>";
	echo "</div>";
	}
		?>
		<div>
		<?php
		
		if($tmp=='lectors')
		{
			include('lectors.php');
		}
		if($tmp=='subjects')
		{
			include('subjects.php');
		}
		if($tmp=='students')
		{
			include('students.php');
		}
		if($tmp=='groups')
		{
			include('groups.php');
		}
		?>
		</div>
</center>
</body>
</html>
</html>