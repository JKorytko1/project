<?
   include('../connection.php');
   header('Content-Type: application/json; charset=utf-8');
   mysql_query('SET NAMES utf8');
    $query1=mysql_query("Select * from groups");
    $test=mysql_num_rows($query1);
	for ($i = 0; $i < $test; $i++)
    {
		$row_group_mas = mysql_fetch_array($query1);
		$object[$i]=array('group_id'=>$row_group_mas['group_id'], 'group_name'=>$row_group_mas['group_name']);
    }  
	echo json_encode($object);
?>