<?
  include('connection.php');
  include('index.php');
   echo "<ul id=\"breadcrumbs\">
        <li><a href=\"index.php\">Home</a></li>
        <li><a href=\"list.php?info=lectors\">Lectors</a></li>
		<li><a href=\"lectors_details.php?lectorId=".$_GET['lectorId']."\">Lectors details</a></li>
		<li><a href=\"vedomost.php?groupId=".$_GET['groupId']."&subjectId=".$_GET['subjectId']."\">Subject Sheet</a></li>
		
    </ul>";
  $groupId=$_GET['groupId'];
  $subjectId=$_GET['subjectId'];
  
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
			/*echo "<th>".$rowModule['module_name']."<br>"*/
			echo "<th>".$rowModule['module_name']."<br>Dead_line - ".$rowDead['dead_line']."</th>";
			
			
			
			
			//echo "<th>Dead_line</th>";
		}
		/*while($rowDead = mysql_fetch_array($resultDead)){
			/*echo "<th>".$rowModule['module_name']."<br>"*/
			/*echo "<th> Dead_line - ".$rowDead['dead_line']." </th>";}*/
		
		
		
	echo"</tr>";
		while($rowStudent = mysql_fetch_array($resultStudent))
		{
			echo "<tr>";
			echo "<td>".$rowStudent['student_name']."</td>";
				//$resultModuled = $result=mysql_query($queryModuled );
				$resultModuled =mysql_query($queryModuled );
				while($rowModuled = mysql_fetch_array($resultModuled))
				{
					$queryGrades = "select * from grades where group_module_id in (select group_module_id from groups_modules where group_id = ".$groupId." and module_id = ".$rowModuled['module_id'].")
									and student_id = ".$rowStudent['student_id'];
					$resultGrades = mysql_query($queryGrades) or die(mysql_query());
					
					$rowGrades = mysql_fetch_array($resultGrades);
					echo "<td>".$rowGrades['grade']."</td>";
					
					 
					
				}				 	
				echo "</tr>";
				
		//
		}
		
		//if(($_SESSION['role'])==2){
		
			echo "<form action='vedomost_grades.php' method='GET'>
			<input type='hidden' value=".$groupId." name='groupId'>
			<input type='hidden' value=".$subjectId." name='subjectId'>
			
			<input type='submit' value='Grades'>
			</form>";
			
		
echo "</table>";

?>