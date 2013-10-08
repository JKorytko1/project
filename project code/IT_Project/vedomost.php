<?
  include('connection.php');
  include('index.php');
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


echo "<table border =1>";
     while($rowStudent = mysql_fetch_array($resultStudent)){

        echo "<tr>";
        echo "<td>".
            $rowStudent['student_name'].
         "</td>";


         while($rowModule = mysql_fetch_array($resultModule)){
             echo "<td>".
                 $rowModule['module_name'].
                 "</td>";
         }

        echo "</tr>";
     }
echo "</table>";

?>