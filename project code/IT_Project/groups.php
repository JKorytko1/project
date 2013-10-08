<?
    include('connection.php');
	$query="Select * from groups";
    $result=mysql_query($query);
    echo"<table border=2 cellpadding=0 cellspacing=0>";
    echo"<TR><TH>Идентификатор</TH><TH>Группа</TH></TR>";
    while($row=mysql_fetch_array($result))//берем результаты из каждой строки
    {
    echo"<tr><td>".$row['group_id']."</td><td><a href=\"groups_details.php?groupId=".$row['group_id']."\"> ".$row['group_name']."</td></tr>";
    }
    echo"</table>";   
?>