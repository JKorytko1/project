<?
  include('connection.php');

   $query="Select * from students";
    $result=mysql_query($query);
	
	if ($_POST['login']==$_SESSION['login'] && $_SESSION['password']==$_POST['password'])
	{ //Проверяем есть ли такой пользователь 
    echo"<table border=2 cellpadding=0 cellspacing=0>";
    echo"<TR><TH>Cтудент</TH><TH>Группа</TH></TR>";
	while($row=mysql_fetch_array($result))//берем результаты из каждой строки
    {
	$query2="select group_name from groups where group_id=".$row['group_id'];
	$resultgroups=mysql_query($query2);
	$rowgroup=mysql_fetch_array($resultgroups);
    echo"<tr><td><a href=\"student_detail.php?studentId=".$row['student_id']."\">".$row['student_name']."</a></td><td>".$rowgroup['group_name']."</td>
	</tr>";
    }
    echo"</table>";
	}
	else
	{
	echo"<table border=2 cellpadding=0 cellspacing=0>";
    echo"<TR><TH>Идентификатор</TH><TH>Cтудент</TH><TH>Заметки</TH><TH>Электронная почта</TH><TH>Группа</TH></TR>";
    while($row=mysql_fetch_array($result))//берем результаты из каждой строки
    {
	$query2="select group_name from groups where group_id=".$row['group_id'];
	$resultgroups=mysql_query($query2);
	$rowgroup=mysql_fetch_array($resultgroups);
    echo"<tr><td>".$row['student_id']."</td><td><a href=\"student_detail.php?studentId=".$row['student_id']."\">".$row['student_name']."</a></td><td>".$row['student_notes']."</td><td>".$row['student_email']."</td><td>".$rowgroup['group_name']."</td>
	</tr>";
    }
    echo"</table>";
	}

 
?>