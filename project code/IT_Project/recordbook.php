<?php
session_start();
require 'connection.php';
	
?>
<html>
<head>
<title>Project I-20б and I-29вс</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<center>
<div class="all">
<div class ="auth">
		<?
		session_start();
		if (!empty($_SESSION['id']))
		{
				echo '<div>';
				echo '<label>логин </label>';
			print_r ($_SESSION['login']);
			echo '</div>';
			echo '<a href="registration/logout.php">Завершить сеанс</a>';
			
		}
		else
		{
		echo '<form action="registration/form_auth.php" METHOD="POST">
			<div>
				<label>логин</label>
				<input name="login" type="text" />
			</div>
			<div>
				<label>пароль</label>
				<input name="password" type="password" />
			</div>
			<div>
				<input value="Войти" type="submit" />
				</div>
		</form>' ;
		}
		
		?>
</div>
<div class="links">
<a href="list.php?info=lectors">Lectors</a>
</div>
<div class="links">
<a href="list.php?info=subjects">Subjects</a>
</div>
<div class="links">
<a href="list.php?info=students">Students</a>
</div>
<div class="links">
<a href="list.php?info=groups">Groups</a>
</div>
<div class="links">
<a href="index.php">Home</a>
</div>
		<div>
		<?

		if($tmp=='lectors')
		{
			include('lectors.php');
		}
		if($tmp=='subjects')
		{
			include('subjects.php');
		}
		if($tmp=='students')
		{
			include('students.php');
		}
		if($tmp=='groups')
		{
			include('groups.php');
		}
echo "<div style ='margin-top:150px;'>";	
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
asort($semestersSet);

foreach($semestersSet as $semester){
    echo "<h2>Cеместр ".$semester."</h2>";

    $querySubject = "Select * from subjects join groups_subjects on subjects.subject_id = groups_subjects.subject_id where group_id=".$groupId." and semester=".$semester;
    $resultSubject=mysql_query($querySubject) or die(mysql_error());




    echo "<table border=1 width='100%'>";
    echo"<tr>";
    echo "<th>Предмет</th>";


    echo "<th>Модули</th>";
    echo "<th>Преподаватель</th>";
    echo"</tr>";
    while($rowSubject= mysql_fetch_array($resultSubject)){
        $queryModule = "select * from modules where subject_id=".$rowSubject['subject_id'];
        $resultModule = mysql_query($queryModule);

        echo "<tr>";
        echo "<td width='30%'>"
            .$rowSubject['subject_title'].
            "</td>";
        echo "<td width='40%'>
                <table border='0'>";
             echo "<tr>";
        while($rowModule= mysql_fetch_array($resultModule)) {
            $queryGrades = "select * from grades where group_module_id in (select group_module_id from groups_modules where group_id = ".$groupId." and module_id = ".$rowModule['module_id'].")
                            and student_id = ".$studentId;
            $resultGrades = mysql_query($queryGrades);
            $rowGrades = mysql_fetch_array($resultGrades);          
            echo "<td><a title=".$rowModule['module_name'].">".$rowGrades['grade']."</a></td>";
        }
			echo "</tr>";
        echo "</table></td>";
        $queryLectors = "select * from lectors where lector_id = (select lector_id from subjects  where subject_id= ".$rowSubject['subject_id'].")";
        $resultLectors = mysql_query($queryLectors)or die (mysql_error());
        $rowLectors = mysql_fetch_array($resultLectors);

        echo "<td>".
            $rowLectors['lector_name'].
            "</td>";





        echo "</tr>";
    }



    echo "</table>";
}



?>
		</div>
</center>
</body>
</html>
</html>
