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
	
	
	
	
	
	//$gradesQuery = "Select * from grades where lector_id=".$lectorId;
	//$resultSt=mysql_query($gradesQuery);
	
	$querySubject = "SELECT subject_title, g.group_id, group_name, s.subject_id, semester FROM subjects as s join groups_subjects as
  gs on s.subject_id=gs.subject_id join groups as g on gs.group_id=g.group_id WHERE s.lector_id=".$lectorId;
	$resultSubject=mysql_query($querySubject);
    while($rowSubject = mysql_fetch_array($resultSubject)){
		
		echo "<tr>";
		
		  echo "<td>"
			.$rowSubject['subject_title']
			
			."</td>";
			
			
			
  
		
		echo"<td>"
			.$rowSubject['group_name']
			
			."</td>";
			
		
		echo"<td>".
			 "<a href= \"vedomost.php?groupId=".$rowSubject['group_id']."&subjectId=".$rowSubject['subject_id']."\">".$rowSubject['semester']."</a>"
			
			."</td>";
			
		
		
		
		echo "</tr>";
		
	}
	
	echo "</table>";
?>