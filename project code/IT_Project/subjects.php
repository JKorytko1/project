<?
  include('connection.php');
  if (empty($_GET['page']))
  {$_GET['page'] = "subjects.php";
  include("index.php");
  } else
    {
  $query="Select * from subjects";
    $result=mysql_query($query);
	
    echo"<table border=2 cellpadding=0 cellspacing=0>";
    echo"<TR><TH>Идентификатор</TH><TH>Предмет</TH><TH>Кредиты</TH><TH>Преподаватель</TH></TR>";
    while($row=mysql_fetch_array($result))//берем результаты из каждой строки
    {
	$query2="select lector_name from lectors where lector_id=".$row['lector_id'];
	$resultlectors=mysql_query($query2);
	$rowlector=mysql_fetch_array($resultlectors);
   echo"<tr><td>".$row['subject_id']."</td><td>".$row['subject_title']."</td><td>".$row['subject_credits']."</td><td>".$rowlector['lector_name']."</td></tr>";
    }
    echo"</table>";
	}
?>