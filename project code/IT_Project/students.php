<?php
  include('connection.php');

	$query="Select * from students";
    $result=mysql_query($query);
	
	$query1="(SELECT l.role FROM lectors l WHERE lector_login='".$_SESSION['login']."') UNION 
			 (SELECT s.role FROM students s WHERE student_email='".$_SESSION['login']."' OR parent_email='".$_SESSION['login']."')"; //Определяем роль		 
	
	$acess_result=mysql_query($query1);
	$acess= mysql_fetch_array($acess_result);
	$role=$acess['role'];
	if (!empty($_SESSION['login']) && $role==1){ //Преподаватель
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TR><TH>Cтудент</TH><TH>Группа</TH><TH>Электронная почта</TH><TH>Заметки</TH></TR>";
		while($row=mysql_fetch_array($result)){
			$query2="select group_name from groups where group_id=".$row['group_id'];
			$resultgroups=mysql_query($query2);
			$rowgroup=mysql_fetch_array($resultgroups);
			echo"<tr><td><a href=\"student_detail.php?studentId=".$row['student_id']."\">".$row['student_name']."</a></td><td>".$rowgroup['group_name']."</td><td>".$row['student_email']."</td><td>".$row['student_notes']."</td>
				</tr>";
		}
		echo"</table>";
	}
	elseif(!empty($_SESSION['login']) && $role==2){ //Администратор
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TR><TH>Cтудент</TH><TH>Группа</TH><TH>Электронная почта</TH><TH>Заметки</TH></TR>";
		while($row=mysql_fetch_array($result)){
			$query2="select group_name from groups where group_id=".$row['group_id'];
			$resultgroups=mysql_query($query2);
			$rowgroup=mysql_fetch_array($resultgroups);
			echo"<tr><td><a href=\"student_detail.php?studentId=".$row['student_id']."\">".$row['student_name']."</a></td><td>".$rowgroup['group_name']."</td><td>".$row['student_email']."</td><td>".$row['student_notes']."</td>
			</tr>";
		}
		echo"</table>";
	}
	elseif(!empty($_SESSION['login']) && $role==3){ //Студент и родители
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TR><TH>Cтудент</TH><TH>Группа</TH><TH>Электронная почта</TH><TH>Заметки</TH></TR>";
		$query3="SELECT * FROM students WHERE student_email='".$_SESSION['login']."' OR parent_email='".$_SESSION['login']."'";
		$result3=mysql_query($query3);
		 while($row=mysql_fetch_array($result3)){
			$query2="select group_name from groups where group_id=".$row['group_id'];
			$resultgroups=mysql_query($query2);
			$rowgroup=mysql_fetch_array($resultgroups);
			echo"<tr><td><a href=\"student_detail.php?studentId=".$row['student_id']."\">".$row['student_name']."</a></td><td>".$rowgroup['group_name']."</td><td>".$row['student_email']."</td><td>".$row['student_notes']."</td>
			</tr>";
		 }
		
	}
	else { //Кто-то другой
		echo "<h2>У вас нет прав для просмотра этой страницы</h2>";
	}
