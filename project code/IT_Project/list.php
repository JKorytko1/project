<?php
session_start();
require 'connection.php';
		$tmp=$_GET['info'];
		$_SESSION['search']=$tmp;
		
?>
<html>
<head>
<title>Project I-20б and I-29вс</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <style>
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
		<?

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