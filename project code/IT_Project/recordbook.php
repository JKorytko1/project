<?
  include('connection.php');
  $groupId=$_GET['groupId'];
  $studentId=$_GET['studentId'];
$queryGroup = "Select * from groups where group_id=".$groupId ;
$result=mysql_query($queryGroup );  
			$rowGroup = mysql_fetch_array($result);
$queryStudent = "Select * from students where student_id=".$studentId ;
	    $result=mysql_query($queryStudent );   
			$rowStudent = mysql_fetch_array($result);
				echo "<h1> Зачетка студента ". $rowStudent['student_name']. " группы " .  $rowGroup['group_name'] ."</h1>";
$querySemester = "SELECT * FROM groups_subjects where group_id =".$groupId ;
$resultSemester=mysql_query($querySemester);
$semestersArray = array();
while($rowSemester = mysql_fetch_array($resultSemester)){
    $semestersArray[] = $rowSemester['semester'];
}
$semestersSet = array_unique($semestersArray); //множество семестров
sort($semestersSet);

foreach($semestersSet as $semester){
    echo "<h2>Cеместр ".$semester."</h2>";

    $querySubject = "Select * from subjects join groups_subjects on subjects.subject_id = groups_subjects.subject_id where group_id=".$groupId." and semester=".$semester;
    $resultSubject=mysql_query($querySubject) or die(mysql_error());




    echo "<table border=1>";

    while($rowSubject= mysql_fetch_array($resultSubject)){
        echo "<tr>";
        echo "<td>"
            .$rowSubject['subject_title'].
            "</td>";



        echo "</tr>";
    }



    echo "</table>";
}


?>