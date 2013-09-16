<?php

// Соединяемся с сервером базы данных
require 'connection.php';

header("Content-Type: text/html; charset=utf-8"); // определяем кодировку выводимой информации с БД
?>
<!-- Ниже представлен код главной страници в HTML -->
<html>
<head>
<title>Progect I-20б and I-29вс</title>
  <link rel="stylesheet" type="text/css" href="css/index.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<a href="lectors.php" >Lectors</a>
</div>
<div class="links">
<a href="subjects.php">Subjects</a>
</div>
<div class="links">
<a href="students.php">Students</a>
</div>
<div class="links">
<a href="grades.php">Grades</a>
</div>
<div class="links">
<a href="index.php">Home</a>
</div>
</div>
<center>
</body>
</html>
</html>