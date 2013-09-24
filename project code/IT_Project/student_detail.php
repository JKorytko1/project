<?
	include('connection.php');
	$studentId=$_GET['studentId'];
	//$query="Select * from students where student_id=".$studentId;
	//$result=mysql_query($query);
  
	$query = "select * from students where student_id=".$studentId;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	echo $row['student_name']; 
	echo "<table border = 1>";
	$gradesQuery = "Select * from grades where student_id=".$studentId;
	$resultSt=mysql_query($gradesQuery);

	$rowGradesResult = mysql_fetch_array($resultSt);
	echo "<tr>";
	echo"<td>"
		.$rowGradesResult['grade_first']
		.$rowGradesResult['grade_second']
		."</td>";
	
	
	//$query = "select * from group_modules where group_module_id = ".rowGradesResult['group_module_id'];
	echo "</tr>";
	echo "</table>";
  
  
?>