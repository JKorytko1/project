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
		echo"<TR><TH>Cтудент</TH><TH>Группа</TH><TH>Заметки</TH></TR>";
		while($row=mysql_fetch_array($result)){
			$query2="select group_name from groups where group_id=".$row['group_id'];
			$resultgroups=mysql_query($query2);
			$rowgroup=mysql_fetch_array($resultgroups);
			echo"<tr><td>".$row['student_name']."</td><td>".$rowgroup['group_name']."</td><td>".$row['student_notes']."</td>
			</tr>";
		}
		echo"</table>";
	}
	elseif(!empty($_SESSION['login']) && $role==2){ //Администратор
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TR><TH>Cтудент</TH><TH>Группа</TH></TR>";
		while($row=mysql_fetch_array($result)){
			$query2="select group_name from groups where group_id=".$row['group_id'];
			$resultgroups=mysql_query($query2);
			$rowgroup=mysql_fetch_array($resultgroups);
			echo"<tr><td><a href=\"student_detail.php?studentId=".$row['student_id']."\">".$row['student_name']."</a></td><td>".$rowgroup['group_name']."</td>
			</tr>";
		}
		echo"</table>";
	}
	elseif(!empty($_SESSION['login']) && $role==3){ //Студент и родители
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TR><TH>Cтудент</TH><TH>Группа</TH></TR>";
		echo "<body link=\"#ffcc00\" vlink=\"#cecece\" alink=\"#ff0000\">";
		 $queryStudent = "SELECT * FROM students";
	     $result=mysql_query($queryStudent);
			//echo $row['student_email']=$_SESSION['login'];
					$query2="select * from groups ";
					$resultgroups=mysql_query($query2);
					$rowgroup=mysql_fetch_array($resultgroups);
			while($row = mysql_fetch_array($result)){	
		//	echo $row['student_email']=$_SESSION['login'];
				if ($row['student_email']==$_SESSION['login'] || $row['parent_email']==$_SESSION['login'] ){
						echo "<tr>";
						echo"<td>";
						echo "<a href=\"recordbook.php?studentId=".$row['student_id']."&groupId=".$row['group_id']."\" style=\"color: red\">". $row['student_name']."</a>"; 	
						echo"</td>";
						echo"<td>";
						echo $rowgroup['group_name']; 	
						echo"</td>";
						echo "</tr>";
				}else {
					$query2="select group_name from groups where group_id=".$row['group_id'];
					$resultgroups=mysql_query($query2);
					$rowgroup=mysql_fetch_array($resultgroups);
						echo "<tr>";
						echo"<td>";
						echo $row['student_name']; 	
						echo"</td>";
						echo"<td>";
						echo $rowgroup['group_name']; 	
						echo"</td>";
						echo "</tr>";
				}
			
			}		
				
		
		echo "</table>";
		echo "</body>";
		
	}
	else { //Кто-то другой
		echo "<h2>У вас нет прав для просмотра этой страницы</h2>";
	}