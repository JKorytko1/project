<?
include('index.php');
include('connection.php');
	echo "<ul id=\"breadcrumbs\">
        <li><a href=\"index.php\">Home</a></li>
        <li><a href=\"list.php?info=subjects\">Subjects</a></li>
		<li><a href=\"subjects_details.php?subjectId=".$_GET['subjectId']."\">Subjects details</a></li>
    </ul>";
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
		$querySemester = "SELECT semester  FROM groups_subjects where subject_id=".$subjectId;
    
		$result1=mysql_query($querySemester);
		
		$row1 = mysql_fetch_array($result1);
		
		$querylector = "SELECT lector_name FROM lectors where lector_id in (select lector_id from subjects where subject_id in (select subject_id from groups_subjects where subject_id=".$subjectId."))";
    
		$result2=mysql_query($querylector);
		
		$row2 = mysql_fetch_array($result2);
		echo "<tr>";
		echo"<td><a href=\"vedomost.php?subjectId=".$subjectId."&groupId=".$row['group_id']."\">".$row['group_name']."</a>"."</td>".
			"<td><a href=\"vedomost.php?subjectId=".$subjectId."&groupId=".$row['group_id']."\">".$row1['semester']."</a>"."</td>".
			"<td><a href=\"vedomost.php?subjectId=".$subjectId."&groupId=".$row['group_id']."\">".$row2['lector_name']."</a>"."</td>";
		 
		echo "</tr>";
	}
	
	
	
	echo "</table>";
?>
  