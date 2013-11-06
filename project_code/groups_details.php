<?php
	include('connection.php');
	include('index.php');
	  $groupId=$_GET['groupId'];
		$query1="(SELECT l.role FROM lectors l WHERE lector_login='".$_SESSION['login']."') UNION 
			 (SELECT s.role FROM students s WHERE student_email='".$_SESSION['login']."' OR parent_email='".$_SESSION['login']."')"; //Определяем роль		 
	
		$acess_result=mysql_query($query1);
		$acess= mysql_fetch_array($acess_result);
		$role=$acess['role'];
	  
		$query = "SELECT * FROM groups WHERE group_id=".$groupId;
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		echo $row['group_name']; 
		if ($role==1){
		echo "<table border = 1>";
		
		echo "<tr>";
	   echo "<td>";
	   echo  "<b>" ."Студенты" ."</b>";
	   echo "</td>";
	   echo "</tr>";
		$queryStudent = "SELECT * FROM students WHERE group_id='".$groupId."'";
	    $result=mysql_query($queryStudent);

			while($row = mysql_fetch_array($result)){	
				echo "<tr>";
				echo"<td>";
				echo "<a href=\"recordbook.php?studentId=".$row['student_id']."&groupId=".$row['group_id']."\">". $row['student_name']."</a>"; 	
				echo"</td>";
				echo "</tr>";
			}		
				
		
		echo "</table>";
		}
		if ($role==2){
		echo "<table border = 1>";
		
		echo "<tr>";
	   echo "<td>";
	   echo  "<b>" ."Студенты" ."</b>";
	   echo "</td>";
	   echo "</tr>";
		$queryStudent = "SELECT * FROM students WHERE group_id='".$groupId."'";
	    $result=mysql_query($queryStudent);

			while($row = mysql_fetch_array($result)){	
				echo "<tr>";
				echo"<td>";
				echo "<a href=\"recordbook.php?studentId=".$row['student_id']."&groupId=".$row['group_id']."\">". $row['student_name']."</a>"; 	
				echo"</td>";
				echo "</tr>";
			}		
				
		
		echo "</table>";
		}
		if ($role==3){
		echo "<table border = 1>";
		
		echo "<tr>";
	   echo "<td>";
	   echo  "<b>" ."Студенты" ."</b>";
	   echo "</td>";
	   echo "</tr>";
		$queryStudent = "SELECT * FROM students WHERE (group_id='".$groupId."' AND student_email='".$_SESSION['login']."' OR parent_email='".$_SESSION['login']."')";
	    $result=mysql_query($queryStudent);

			while($row = mysql_fetch_array($result)){	
				echo "<tr>";
				echo"<td>";
				echo "<a href=\"recordbook.php?studentId=".$row['student_id']."&groupId=".$row['group_id']."\">". $row['student_name']."</a>"; 	
				echo"</td>";
				echo "</tr>";
			}		
				
		
		echo "</table>";
		}
?>