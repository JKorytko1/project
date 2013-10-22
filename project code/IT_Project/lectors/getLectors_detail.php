<?
	include('../connection.php');
	header('Content-Type: application/json; charset=utf-8');
	mysql_query('SET NAMES utf8');
	$lectorId=$_GET['lectorId'];
	print_r($lectorId);
	exit;
	$query = "select * from lectors where lector_id=".$lectorId;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$obj_name_lectors=array('lectors_name'=>row['lector_name']);
	echo $obj_name_lectors;
	exit;
	$querySubject = "Select * from subjects where lector_id=".$lectorId;
	$resultSubject=mysql_query($querySubject);
    while($rowSubject = mysql_fetch_array($resultSubject))
	{
		$queryGroup = "SELECT subject_title, group_name FROM subjects as s JOIN
                   groups_subjects as gs on s.subject_id = gs.subject_id JOIN groups as g on gs.group_id = g.group_id WHERE s.lector_id=".$lectorId."";
		$resultGroup=mysql_query($queryGroup);
		$rowGroup = mysql_fetch_array($resultGroup);	
			$querySemester = "SELECT * from groups_subjects where subject_id in(select subject_id from subjects where lector_id in(select lector_id from lectors where lector_id=".$lectorId."))";           
		$resultSemester=mysql_query($querySemester);		
		$rowSemester = mysql_fetch_array($resultSemester);	
		$obj_lectors[$i]=array('subject_title'=>$rowSubject['subject_title'], 'group_name'=>$rowGroup['group_name'],'semester'=>$rowSemester['semester']);
	}
		echo ($obj_lectors);
?>