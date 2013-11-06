<?php 
	include('connection.php');
	
	$query="SELECT * FROM subjects";
    $result=mysql_query($query);
	
	$query1="(SELECT l.role FROM lectors l WHERE lector_login='".$_SESSION['login']."') UNION 
			 (SELECT s.role FROM students s WHERE student_email='".$_SESSION['login']."' OR parent_email='".$_SESSION['login']."')"; //Определяем роль		 
	
	$acess_result=mysql_query($query1);
	$acess= mysql_fetch_array($acess_result);
	$role=$acess['role'];
	
	if (!empty($_SESSION['login']) && $role==1){ //Преподаватель
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Предмет</TH><TH>Кредиты</TH><TH>Преподаватель</TH></TR>";
		while($row=mysql_fetch_array($result)){
			$query2="select lector_name from lectors where lector_id=".$row['lector_id'];
			$resultlectors=mysql_query($query2);
			$rowlector=mysql_fetch_array($resultlectors);
			echo"<tr><td><a href=\"subjects_details.php?subjectId=".$row['subject_id']."\">".$row['subject_title']."</td><td>".$row['subject_credits']."</td><td>".$rowlector['lector_name']."</td></tr>";
		}
		echo"</table>";
	} elseif(!empty($_SESSION['login']) && $role==2) {//Админ
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Предмет</TH><TH>Кредиты</TH><TH>Преподаватель</TH></TR>";
		while($row=mysql_fetch_array($result)){
			$query2="select lector_name from lectors where lector_id=".$row['lector_id'];
			$resultlectors=mysql_query($query2);
			$rowlector=mysql_fetch_array($resultlectors);
			echo"<tr><td><a href=\"subjects_details.php?subjectId=".$row['subject_id']."\">".$row['subject_title']."</td><td>".$row['subject_credits']."</td><td>".$rowlector['lector_name']."</td></tr>";
		}
		echo"</table>";
	} elseif (!empty($_SESSION['login']) && $role==3){ //Студент и родители
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Предмет</TH><TH>Кредиты</TH><TH>Преподаватель</TH></TR>";
		while($row=mysql_fetch_array($result)){
			$query2="select lector_name from lectors where lector_id=".$row['lector_id'];
			$resultlectors=mysql_query($query2);
			$rowlector=mysql_fetch_array($resultlectors);
			echo"<tr><td><a href=\"subjects_details.php?subjectId=".$row['subject_id']."\">".$row['subject_title']."</td><td>".$row['subject_credits']."</td><td>".$rowlector['lector_name']."</td></tr>";
		}
	} else{//Незалогиненный
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Предмет</TH><TH>Кредиты</TH><TH>Преподаватель</TH></TR>";
		while($row=mysql_fetch_array($result)){
			$query2="select lector_name from lectors where lector_id=".$row['lector_id'];
			$resultlectors=mysql_query($query2);
			$rowlector=mysql_fetch_array($resultlectors);
			echo"<tr><td>".$row['subject_title']."</td><td>".$row['subject_credits']."</td><td>".$rowlector['lector_name']."</td></tr>";
		}
		echo"</table>";
	}