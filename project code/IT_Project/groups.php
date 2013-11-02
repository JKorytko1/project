<?php
    include('connection.php');
	$query="Select * from groups";
	$result=mysql_query($query);
		
	$query1="(SELECT l.role FROM lectors l WHERE lector_login='".$_SESSION['login']."') UNION 
			 (SELECT s.role FROM students s WHERE student_email='".$_SESSION['login']."' OR parent_email='".$_SESSION['login']."')"; //Определяем роль		 
	
	$acess_result=mysql_query($query1);
	$acess= mysql_fetch_array($acess_result);
	$role=$acess['role'];
	if (!empty($_SESSION['login']) && $role==1){ // Преподаватель
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Группа</TH></TR>";
		while($row=mysql_fetch_array($result)){ //берем результаты из каждой строки
			echo"<tr></td><td><a href=\"groups_details.php?groupId=".$row['group_id']."\"> ".$row['group_name']."</td></tr>";
		}
		echo"</table>";   
	}
	elseif(!empty($_SESSION['login']) && $role==2){ //Администратор
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Группа</TH></TR>";
		while($row=mysql_fetch_array($result)){ //берем результаты из каждой строки
			echo"<tr></td><td><a href=\"groups_details.php?groupId=".$row['group_id']."\"> ".$row['group_name']."</td></tr>";
		}
		echo"</table>";   
	}
	elseif(!empty($_SESSION['login']) && $role==3){ //Студент и родители студента
		$query3="SELECT * FROM groups WHERE group_id IN (SELECT group_id FROM students WHERE student_email='".$_SESSION['login']."' OR parent_email='".$_SESSION['login']."')";
		$result3=mysql_query($query3);
	
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Группа</TH></TR>";
		while($row=mysql_fetch_array($result3)){ //берем результаты из каждой строки
			echo"<tr></td><td><a href=\"groups_details.php?groupId=".$row['group_id']."\"> ".$row['group_name']."</td></tr>";
		}
		echo"</table>";   
	}	
	else{ //Незалогиненный пользователь
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Группа</TH></TR>";
		while($row=mysql_fetch_array($result)){
			echo"<tr><td>".$row['group_name']."</td></tr>";
		}
		echo"</table>";   
	}
