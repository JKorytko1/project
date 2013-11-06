<?
include('index.php');
include('connection.php');
   mysql_query('SET NAMES utf8');
	$subjectId=$_GET['subjectId'];

    $querySubjects = "select * from subjects where subject_id=".$subjectId;
	$result = mysql_query($querySubjects);
	$row = mysql_fetch_array($result);
	echo $row['subject_title']; 
	echo "<table border = 1>";
  
    echo "<tr>";
	   echo "<td>";
	   echo  "Группа";
	   echo "</td>";
	   echo "<td>";
	   echo  "Семестр";
	   echo "</td>";
	   echo "<td>";
	   echo  "Преподаватель";
	   echo "</td>";
	   
	echo "</tr>";
	$queryGroup = "select * from groups where group_id in (select group_id from groups_subjects where subject_id in 
(select subject_id from subjects where subject_id=".$subjectId."))";
	$result = mysql_query($queryGroup);
	while($row = mysql_fetch_array($result)){
		echo "<tr>";
		echo"<td>".
	   "<a href=\"vedomost.php?subjectId=".$subjectId."&groupId=".$row['group_id']."\">".$row['group_name'] . "</a>"
	
	."</td>";
	
	$querySemester = "SELECT semester  FROM groups_subjects where subject_id=".$subjectId;
    
		$result=mysql_query($querySemester);
		
		$row = mysql_fetch_array($result);
		
		echo"<td>"
			.$row['semester']
			
			."</td>";
			
			$querylector = "SELECT lector_name FROM lectors where lector_id in (select lector_id from subjects where subject_id in (select subject_id from groups_subjects where subject_id=".$subjectId."))";
    
		$result=mysql_query($querylector);
		
		$row = mysql_fetch_array($result);
		
		echo"<td>"
			.$row['lector_name']
			
			."</td>";
			
			
	
	
			
			
	echo "</tr>";
	}
	
	
	
	echo "</table>";
?>
  