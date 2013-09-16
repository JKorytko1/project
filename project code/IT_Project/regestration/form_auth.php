<?php
// Соединяемся с сервером базы данных
require '..config.php';
if (isset($_POST['login'])) 
{
				$login = $_POST['login']; 
				if ($login == '') {
				unset($login);
				exit ("Введите логин");
				} 
			}
			if (isset($_POST['password'])) {
				$password=$_POST['password']; 
				if ($password =='') {
					unset($password);
					exit ("Введите пароль");
				}
			}
			$user = mysql_query("SELECT * FROM lectors WHERE lector_login='$login' AND lector_password='$password'");
			$id_user = mysql_fetch_array($user);
			if (!empty($id_user['lector_id'])) //РАСПРЕДЕЛЕНИЕ ПРАВ ДОСТУПА
			{
				session_start();
				$_SESSION['password']=$password; 
				$_SESSION['login']=$login; 
				$_SESSION['id']=$id_user['lector_id'];
				exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=../index.php'></head></html>");

			}
	  
?>
