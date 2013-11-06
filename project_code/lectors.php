<?php
	include('connection.php');
 
		$query="Select * from lectors";
		$result=mysql_query($query);
		
		$query1="(SELECT l.role FROM lectors l WHERE lector_login='".$_SESSION['login']."') UNION 
			 (SELECT s.role FROM students s WHERE student_email='".$_SESSION['login']."' OR parent_email='".$_SESSION['login']."')"; //Определяем роль		 
	
		$acess_result=mysql_query($query1);
		$acess= mysql_fetch_array($acess_result);
		$role=$acess['role'];
		if (!empty($_SESSION['login']) && $role== 1){ //Преподаватель
			echo"<table border=2 cellpadding=0 cellspacing=0 >";
			echo"<TR><TH>Преподаватель</TH><TH>Ученая степень</TH><TH>Электронная почта</TH></TR>";
			while($row=mysql_fetch_array($result)){
				echo"<tr><td><a href=\"lectors_details.php?lectorId=".$row['lector_id']."\">".$row['lector_name']."</td><td>".$row['lector_position']."</td><td>".$row['lector_email']."</td>
					</tr>";
			}
			echo"</table>";
		} elseif(!empty($_SESSION['login']) && $role==2){//Админ
			echo"<table border=2 cellpadding=0 cellspacing=0 >";
			echo"<TR><TH>Преподаватель</TH><TH>Ученая степень</TH><TH>Электронная почта</TH><TH>Логин</TH><TH>Пароль</TH></TR>";
			while($row=mysql_fetch_array($result)){
				echo"<tr><td><a href=\"lectors_details.php?lectorId=".$row['lector_id']."\">".$row['lector_name']."</td><td>".$row['lector_position']."</td><td>".$row['lector_email']."</td>
						<td>".$row['lector_login']."</td><td>".$row['lector_password']."</td></tr>";
			}
			echo"</table>";
		} elseif(!empty($_SESSION['login']) && $role==3){//СТудент и родители
			echo"<table border=2 cellpadding=0 cellspacing=0 >";
			echo"<TR><TH>Преподаватель</TH><TH>Ученая степень</TH></TR>";
			while($row=mysql_fetch_array($result)){
			echo"<tr><td><a href=\"lectors_details.php?lectorId=".$row['lector_id']."\">".$row['lector_name']."</td><td>".$row['lector_position']."</td>
				</tr>";
			}
			echo"</table>";
		} else {//Незалогиненный
			echo"<table border=2 cellpadding=0 cellspacing=0 >";
			echo"<TR><TH>Преподаватель</TH><TH>Ученая степень</TH></TR>";
			while($row=mysql_fetch_array($result)){
				echo"<tr><td>".$row['lector_name']."</td><td>".$row['lector_position']."</td>
					</tr>";
			}
			echo"</table>";
		}