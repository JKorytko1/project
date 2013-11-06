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
	
	$querySubject = "Select * from subjects where lector_id=".$lectorId;
	$resultSubject=mysql_query($querySubject);
    while($rowSubject = mysql_fetch_array($resultSubject)){
		
		echo "<tr>";
		
		  echo "<td>"
			.$rowSubject['subject_title']
			
			."</td>";
			
			
			
    $queryGroup = "SELECT subject_title, group_name FROM subjects as s JOIN
                   groups_subjects as gs on s.subject_id = gs.subject_id JOIN groups as g on gs.group_id = g.group_id WHERE s.lector_id=".$lectorId."";
		$resultGroup=mysql_query($queryGroup);
		$rowGroup = mysql_fetch_array($resultGroup);
		
		echo"<td>"
			.$rowGroup['group_name']
			
			."</td>";
			
			$querySemester = "SELECT * from groups_subjects where subject_id in(select subject_id from subjects where lector_id in(select lector_id from lectors where lector_id=".$lectorId."))";
           
		$resultSemester=mysql_query($querySemester);
		
		$rowSemester = mysql_fetch_array($resultSemester);
		
		echo"<td>".
			 "<a href= \"vedomost.php?groupId=".$rowSemester['group_id']."&subjectId=".$rowSemester['subject_id']."\">".$rowSemester['semester']."</a>"
			
			."</td>";
			
		
		
		
		echo "</tr>";
		
	}
	
	echo "</table>";
?>