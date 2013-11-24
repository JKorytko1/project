<?php

include('connection.php');
include('index.php');
echo "<ul id=\"breadcrumbs\">
        <li><a href=\"index.php\">Home</a></li>
        <li><a href=\"list.php?info=lectors\">Lectors</a></li>
		<li><a href=\"lectors_details.php?lectorId=".$_GET['lectorId']."\">Lectors details</a></li>
		<li><a href=\"vedomost.php?groupId=".$_GET['groupId']."&subjectId=".$_GET['subjectId']."\">Vedomost</a></li>
		<li><a href=\"vedomost_grades.php?groupId=".$_GET['groupId']."&subjectId=".$_GET['subjectId']."\">Vedomost grades</a></li>
    </ul>";
$groupId=$_GET['groupId'];
$subjectId=$_GET['subjectId'];

if(isset($_POST['Grade'])) {
        $queryTake = "Update( grades  join groups_modules on grades.group_module_id=groups_modules.group_module_id 
		join modules as m on groups_modules.module_id=m.module_id )  set grade = '" . $_POST['Grade'].
		"' where group_id=".$_POST['groupId']. " and subject_id=".$_POST['subjectId']. " and student_id=".$_POST['studentId'] . " and m.module_id=".$_POST['moduleId'];
		echo $queryTake;
        $resultTake = mysql_query($queryTake) or die(mysql_error());
        $rowTake = mysql_fetch_array($resultTake);
		
		
		
		
		}

$queryGroup = "Select * from groups where group_id=".$groupId ;
$result=mysql_query($queryGroup );
$rowGroup = mysql_fetch_array($result);

$querySubject = "Select * from subjects where subject_id=".$subjectId ;
$result=mysql_query($querySubject );
$rowSubject = mysql_fetch_array($result);

echo "<h1> Ведомость группы ". $rowGroup['group_name']. " по предмету " .  $rowSubject['subject_title'] ."</h1>";

$queryStudent = "Select * from students where group_id=".$groupId;
$resultStudent = $result=mysql_query($queryStudent );

$queryModule = "Select * from modules where subject_id=".$subjectId;
$resultModule = $result=mysql_query($queryModule ) ;
$queryModuled = "Select * from modules where subject_id=".$subjectId;


/*$queryDead = "Select * from groups_modules join modules on groups_modules.module_id = modules.module_id where group_id=".$groupId;
$resultDead =mysql_query($queryDead );
$rowDead = mysql_fetch_array($resultDead);*/

$queryDead = "Select * from groups_modules join modules on groups_modules.module_id = modules.module_id where group_id=".$groupId;
$resultDead =mysql_query($queryDead );



echo "<table border =1>";
echo"<tr>";
echo "<th>Cтуденты</th>";
while($rowModule = mysql_fetch_array($resultModule))
{

    $rowDead = mysql_fetch_array($resultDead);
    echo "<th>".$rowModule['module_name']."</th>";//<br>Dead_line - ".$rowDead['dead_line']."</th>";
}






echo"</tr>";
	while($rowStudent = mysql_fetch_array($resultStudent))
		{
			echo "<tr>";
			echo "<td>".$rowStudent['student_name']."</td>";
			
				$resultModuled =mysql_query($queryModuled );
				while($rowModuled = mysql_fetch_array($resultModuled))
				{
					$queryGrades = "select * from grades where group_module_id in (select group_module_id from groups_modules where group_id = ".$groupId." and module_id = ".$rowModuled['module_id'].")
									and student_id = ".$rowStudent['student_id'];
					$resultGrades = mysql_query($queryGrades) or die(mysql_query());
					$rowGrades = mysql_fetch_array($resultGrades);
					echo "<form action='vedomost_grades.php' method='POST'><td><select name='Grade'>";
					
					
					
					echo  "<option value='" . "1" . "'>". '1'."</option>";
					echo  "<option value='" . "2Fx" . "'>". '2Fx'."</option>";
					echo  "<option value='" . "3E" . "'>" . "3E". "</option>";
					echo  "<option value='" . "3D" . "'>" . "3D". "</option>";
					echo  "<option value='" . "4C". "'>" . "4C". "</option>";
					echo  "<option value='" . "4B" . "'>" . "4B". "</option>";
					echo  "<option value='" . "5B" . "'>" . "5B". "</option>";
					echo  "<option value='" . "5A" . "'>" . "5A". "</option>";
					
					 echo "</select>";
					 echo "<input type='hidden' value=".$groupId." name='groupId'>";
					 echo "<input type='hidden' value=".$subjectId." name='subjectId'>";
					 echo "<input type='hidden' value=".$rowGrades['student_id']." name='studentId'>";
					 
					 
					 
					 echo "<input type='hidden' value=".$rowModuled['module_id']." name='moduleId'>";
					 echo  "<input type='submit' value='Обновить оценку'>";
					
					 echo "</td>";
					  echo "</form>";
					
				}				 	
				echo "</tr>";
				
		}

$queryModule = "Select * from modules where subject_id=".$subjectId;
$resultModule = $result=mysql_query($queryModule ) ;


echo "</table>";
echo "</br>";

echo "<table border =1>";
echo"<tr>";
echo "<th>Модули</th>";
echo "<th>Dead_line</th>";
echo "</tr>";
while($rowModule = mysql_fetch_array($resultModule)){


    $rowDead = mysql_fetch_array($resultDead);

	
    echo "<td>".$rowModule['module_name']."</td>";
	echo "<td>".$rowDead['dead_line']."</td>";
	echo "</tr>";

}
echo "</table>";
?>