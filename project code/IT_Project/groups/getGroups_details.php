<?
	include('../connection.php');
	header('Content-Type: application/json; charset=utf-8');
	mysql_query('SET NAMES utf8');
  	$groupId=$_GET['groupId'];
	$getGroups_details_query = mysql_query("select * from groups where group_id=".$groupId);
	$getGroups_details_row_name = mysql_fetch_array($getGroups_details_query);
	$getGroups_details_queryStudent = mysql_query("Select * from students where group_id=".$groupId);
	$getGroups_details_count=mysql_num_rows($getGroups_details_queryStudent);
	for ($i=0; $i<$getGroups_details_count; $i++)
	{
		$getGroups_details_row = mysql_fetch_array($getGroups_details_queryStudent);
		$getGroups_details_obj[$i]=array('student_id'=>$getGroups_details_row['student_id'], 'group_id'=>$groupId,'student_name'=>$getGroups_details_row['student_name']);
	}
	echo json_encode($getGroups_details_obj);
?>

