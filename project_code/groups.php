<?php
    include('connection.php');
	$query="Select * from groups";
	$result=mysql_query($query);
		
	$query1="(SELECT l.role FROM lectors l WHERE l.lector_login='".$_SESSION['login']."') UNION 
			 (SELECT s.role FROM students s WHERE s.student_email='".$_SESSION['login']."' OR s.parent_email='".$_SESSION['login']."')"; //Определяем роль		 ем роль		 
	
	$acess_result=mysql_query($query1);
	$acess= mysql_fetch_array($acess_result);
	$role=$acess['role'];
	if (!empty($_SESSION['login']) && $role==1){ // Преподаватель
		/*echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Группа</TH></TR>";
		
		
		$queryGroup="SELECT  DISTINCT g.group_name FROM subjects s
					 JOIN lectors l ON l.lector_login ='".$_SESSION['login']."' AND s.lector_id=l.lector_id
					 JOIN groups_subjects gs ON gs.subject_id=s.subject_id
					 JOIN groups g ON gs.group_id=g.group_id";
		
		$groupResult=mysql_query($queryGroup);
		$getGroup=mysql_fetch_array($groupResult);
		
		
		
		while($row=mysql_fetch_array($result)){ //берем результаты из каждой строки
		
			if ($getGroup['group_name']==$row['group_name']){
				
				echo"<tr><td><a href=\"groups_details.php?groupId=".$row['group_id']."\" style=\"color: red\"> ".$getGroup['group_name']."</td></tr>";

									$getGroup=mysql_fetch_array($groupResult);
				
			}
				else 
				echo"<tr><td>".$row['group_name']."</td></tr>";
		}
		echo"</table>"; */
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
			echo"<tr></td><td><a href=\"groups_details.php?groupId=".$row['group_id']."\"style=\"color: red\"> ".$row['group_name']."</td></tr>";
		}
		echo"</table>";   
	}
	elseif(!empty($_SESSION['login']) && $role==3){ //Студент и родители студента
		echo "<body link=\"#ffcc00\" vlink=\"#cecece\" alink=\"#ff0000\">";
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Группа</TH></TR>";
		
		 $query3="SELECT group_name FROM groups WHERE group_id IN (SELECT group_id FROM students WHERE student_email='".$_SESSION['login']."' OR parent_email='".$_SESSION['login']."')";
		 $result3=mysql_query($query3);
		 $rowgroup=mysql_fetch_array($result3);
			while($row = mysql_fetch_array($result)){
	
				if ($rowgroup['group_name']==$row['group_name']) {
						echo "<tr>";
						echo"<td>";
						echo "<tr></td><td><a href=\"groups_details.php?groupId=".$row['group_id']."\" style=\"color: red\">".$row['group_name']."</td></tr>"; 	
						echo"</td>";
						echo "</tr>";
						
						
				}else {
						echo "<tr>";
						echo"<td>";
						echo $row['group_name']; 	
						echo"</td>";
						echo "</tr>";
				}
			}			
		echo "</table>";
		echo "</body>";
	}	
	else{ //Незалогиненный пользователь
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Группа</TH></TR>";
		while($row=mysql_fetch_array($result)){
			echo"<tr><td>".$row['group_name']."</td></tr>";
		}
		echo"</table>";   
	}
