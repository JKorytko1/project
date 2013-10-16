<?
	include('../connection.php');
	header('Content-Type: application/json; charset=utf-8');
	mysql_query('SET NAMES utf8');
	$subjectId=$_GET['subjectId'];
    $getSubjects_details_querySubjects = mysql_query("select * from subjects where subject_id=".$subjectId);
	$getSubjects_details_row = mysql_fetch_array($getSubjects_details_querySubjects);
	$getSubjects_details_subjects=array('subject_title'=>$getSubjects_details_row['subject_title']);
	$getSubjects_details_queryGroup = mysql_query("select * from groups where group_id in (select group_id from groups_subjects where subject_id in 
	(select subject_id from subjects where subject_id=".$subjectId."))");
	$getSubjects_details_count=mysql_num_rows($getSubjects_details_queryGroup);
	for ($i=0; $i<$getSubjects_details_count; $i++)
	{
	$getSubjects_details_row = mysql_fetch_array($getSubjects_details_queryGroup);
	$getSubjects_details_querySemester = mysql_query("SELECT semester  FROM groups_subjects where subject_id=".$subjectId);		
	$getSubjects_details_row_semester = mysql_fetch_array($getSubjects_details_querySemester);
	$getSubjects_details_querylector = mysql_query("SELECT lector_name FROM lectors where lector_id in (select lector_id from subjects where subject_id in (select subject_id from groups_subjects where subject_id=".$subjectId."))");		
	$getSubjects_details_row_lectors = mysql_fetch_array($getSubjects_details_querylector);
	$getSubjects_details_obj[$i]=array('group_name'=>$getSubjects_details_row['group_name'], 'subject_id'=>$subjectId, 'group_id'=>$getSubjects_details_row['group_id'],'semester'=>$getSubjects_details_row_semester['semester'],'lector_name'=>$getSubjects_details_row_lectors['lector_name']);
	}
	
	echo json_encode($getSubjects_details_obj);
?>



