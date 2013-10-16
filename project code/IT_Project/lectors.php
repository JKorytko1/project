<?

  include('connection.php');
 
	  $query="Select * from lectors";
		$result=mysql_query($query);
		if ($_POST['login']==$_SESSION['login'] && $_SESSION['password']==$_POST['password']){ //Проверяем есть ли такой пользователь 
		echo"<table border=2 cellpadding=0 cellspacing=0 >";
		echo"<TR><TH>Преподаватель</TH><TH>Ученая степень</TH></TR>";
		while($row=mysql_fetch_array($result))//берем результаты из каждой строки
		{
		echo"<tr><td><a href=\"lectors_details.php?lectorId=".$row['lector_id']."\">".$row['lector_name']."</td><td>".$row['lector_position']."</td>
		</tr>";
		}
		echo"</table>";
		}
		else{
		echo"<table border=2 cellpadding=0 cellspacing=0 >";
		echo"<TR><TH>Идентификатор</TH><TH>Преподаватель</TH><TH>Ученая степень</TH><TH>Электронная почта</TH><TH>Логин</TH><TH>Пароль</TH></TR>";
		while($row=mysql_fetch_array($result))//берем результаты из каждой строки
		{
		echo"<tr><td>".$row['lector_id']."</td><td><a href=\"lectors_details.php?lectorId=".$row['lector_id']."\">".$row['lector_name']."</td><td>".$row['lector_position']."</td><td>".$row['lector_email']."</td>
		<td>".$row['lector_login']."</td><td>".$row['lector_password']."</td></tr>";
		}
		echo"</table>";
		}
	

?>