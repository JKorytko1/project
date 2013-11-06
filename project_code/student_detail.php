<?
	include('connection.php');
	include('index.php');
	
	$studentId=$_GET['studentId'];
	//$query="Select * from students where student_id=".$studentId;
	//$result=mysql_query($query);
  
	$query = "select * from students where student_id=".$studentId;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	echo $row['student_name']; 
	echo "<table border = 1>";
	
	$queryStudent = "Select * from grades where student_id=".$studentId;
	$resultStudent=mysql_query($queryStudent);
	$rowStudent = mysql_fetch_array($resultStudent);
	echo "<tr>";
	echo"<td>"
		.$rowStudent['grade_first']
		.$rowStudent['grade_second']
		."</td>";
	
	
	//$query = "select * from group_modules where group_module_id = ".rowGradesResult['group_module_id'];
	echo "</tr>";
	echo "</table>";
  
  
?>