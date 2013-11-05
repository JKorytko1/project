<?
  include('connection.php');
  include('index.php');
  $lectorId=$_GET['lectorId'];
  
  
  $query = "select * from lectors where lector_id=".$lectorId;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	echo "<table border = 1>";
	
	echo $row['lector_name']; 
	
	echo "<tr>";
	   echo "<td>";
	   echo  "<b>"."Предмет". "</b>";
	   echo "</td>";
	   echo "<td>";
	   echo  "<b>"."Группа"."</b>";
	   echo "</td>";
	   echo "<td>";
	   echo  "<b>"."Семестр"."</b>";
	   echo "</td>";
	   
	echo "</tr>";
	
	
	
	$querySemester = "SELECT subject_title, g.group_id, group_name, s.subject_id, semester FROM subjects as s join groups_subjects as
	gs on s.subject_id=gs.subject_id join groups as g on gs.group_id=g.group_id WHERE s.lector_id=".$lectorId;
	$resultSemester=mysql_query($querySemester);
	
	
           
		while ($rowSemester = mysql_fetch_array($resultSemester)){
		
		echo "<tr>";			
			 echo "<td>".
			"<a href= \"vedomost.php?groupId=".$rowSemester['group_id']."&subjectId=".$rowSemester['subject_id']."\">".$rowSemester['subject_title']."</a>"
			."</td>";		
		
		echo"<td>".
			 "<a href= \"vedomost.php?groupId=".$rowSemester['group_id']."&subjectId=".$rowSemester['subject_id']."\">".$rowSemester['group_name']."</a>"
			
			."</td>";
			
			
			
		echo"<td>".
			 "<a href= \"vedomost.php?groupId=".$rowSemester['group_id']."&subjectId=".$rowSemester['subject_id']."\">".$rowSemester['semester']."</a>"
			
			."</td>";
			
		echo "</tr>";
		}
	
	echo "</table>";
?>