<?
	include('../connection.php');
	header('Content-Type: application/json; charset=utf-8');
	mysql_query('SET NAMES utf8');
	$studentId=$_GET['studentId'];
	$getStudents_detail_query = "select * from students where student_id=".$studentId;
	$getStudents_detail_result = mysql_query($getStudents_detail_query);
	$getStudents_detail_row= mysql_fetch_array($getStudents_detail_result);
	$getStudents_detail_queryStudent = "Select * from grades where student_id=".$studentId;
	$getStudents_detail_resultStudent=mysql_query($getStudents_detail_queryStudent);
	$getStudents_detail_rowStudent = mysql_fetch_array($getStudents_detail_resultStudent);
	$getStudents_detail_mas=array('student_name'=>$getStudents_detail_row['student_name'], 'grade_first'=>$getStudents_detail_rowStudent['grade_first'],'grade_second'=>$getStudents_detail_rowStudent['grade_second']);
	echo $getStudents_detail_mas;
?>