<?
   include('../connection.php');
   header('Content-Type: application/json; charset=utf-8');
   mysql_query('SET NAMES utf8');
   $query_lectors=mysql_query("Select * from lectors");
    $count_lectors=mysql_num_rows($query_lectors);
	for ($i = 0; $i < $count_lectors; $i++)
    {
		$row_lectors_mas = mysql_fetch_array($query_lectors);
		$obj_lectors[$i]=array('lector_id'=>$row_lectors_mas['lector_id'], 'lector_name'=>$row_lectors_mas['lector_name'],
		'lector_position'=>$row_lectors_mas['lector_position'],'lector_email'=>$row_lectors_mas['lector_email'],'lector_login'=>$row_lectors_mas['lector_login']);
    }  
	echo print_r($obj_lectors);
?>