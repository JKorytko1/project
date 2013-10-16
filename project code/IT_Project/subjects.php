<?
  include('connection.php');
	$query="Select * from subjects";
    $result=mysql_query($query);
	
	if ($_POST['login']==$_SESSION['login'] && $_SESSION['password']==$_POST['password']){ //Проверяем есть ли такой пользователь 
    echo"<table border=2 cellpadding=0 cellspacing=0>";
    echo"<TR><TH>Предмет</TH><TH>Преподаватель</TH></TR>";
    while($row=mysql_fetch_array($result))
    {
	$query2="select lector_name from lectors where lector_id=".$row['lector_id'];
	$resultlectors=mysql_query($query2);
	$rowlector=mysql_fetch_array($resultlectors);
	echo"<tr><td><a href=\"subjects_details.php?subjectId=".$row['subject_id']."\">".$row['subject_title']."</td><td>".$rowlector['lector_name']."</td></tr>";
    }
    echo"</table>";
	} else {
		echo"<table border=2 cellpadding=0 cellspacing=0>";
		echo"<TR><TH>Идентификатор</TH><TH>Предмет</TH><TH>Кредиты</TH><TH>Преподаватель</TH></TR>";
		while($row=mysql_fetch_array($result))
    {
	$query2="select lector_name from lectors where lector_id=".$row['lector_id'];
	$resultlectors=mysql_query($query2);
	$rowlector=mysql_fetch_array($resultlectors);
	echo"<tr><td>".$row['subject_id']."</td><td><a href=\"subjects_details.php?subjectId=".$row['subject_id']."\">".$row['subject_title']."</td><td>".$row['subject_credits']."</td><td>".$rowlector['lector_name']."</td></tr>";
    }
    echo"</table>";
	}
	
?>