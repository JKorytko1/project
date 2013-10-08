<?
	include('connection.php');
	include('index.php');
	  $groupId=$_GET['groupId'];
	  
	  
	  $query = "select * from groups where group_id=".$groupId;
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		echo $row['group_name']; 
		echo "<table border = 1>";
		
		echo "<tr>";
	   echo "<td>";
	   echo  "<b>" ."Студенты" ."</b>";
	   echo "</td>";
	   echo "</tr>";
		$queryStudent = "Select * from students where group_id=".$groupId;
	    $result=mysql_query($queryStudent);
        
			while($row = mysql_fetch_array($result)){
				echo "<tr>";
				echo"<td>";
				echo "<a href=\"recordbook.php?studentId=".$row['student_id']."&groupId=".$row['group_id']."\">". $row['student_name']."</a>"; 	

				echo"</td>";
				echo "</tr>";
			}			
		
		echo "</table>";
?>