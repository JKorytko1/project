<?php
	include('../connection.php');
	header('Content-Type: application/json; charset=utf-8');
	mysql_query('SET NAMES utf8');
	$lectorId=$_GET['lectorId'];
	$lectors_detail_query = mysql_query("select * from lectors where lector_id=".$lectorId);
	$lectors_detail_row = mysql_fetch_array($lectors_detail_query);
	$lectors_detail_name_lectors=array('lectors_name'=>$lectors_detail_row['lector_name']);
	$lectors_detail_querySubject = "Select * from subjects where lector_id=".$lectorId;
	$lectors_detail_resultSubject=mysql_query($lectors_detail_querySubject);
	$lectors_detail_count_lectors=mysql_num_rows($lectors_detail_resultSubject);
	for ($i=0; $i<$lectors_detail_count_lectors; $i++)
	{
		$lectors_detail_rowSubject = mysql_fetch_array($lectors_detail_resultSubject);
		$mass_all[$i]=$lectors_detail_rowSubject['subject_title'];
		$lectors_detail_queryGroup = "SELECT subject_title, group_name FROM subjects as s JOIN
                   groups_subjects as gs on s.subject_id = gs.subject_id JOIN groups as g on gs.group_id = g.group_id WHERE s.lector_id=".$lectorId."";
		$lectors_detail_resultGroup=mysql_query($lectors_detail_queryGroup);
		$lectors_detail_rowGroup = mysql_fetch_array($lectors_detail_resultGroup);	
			$lectors_detail_querySemester = "SELECT * from groups_subjects where subject_id in(select subject_id from subjects where lector_id in(select lector_id from lectors where lector_id=".$lectorId."))";           
		$lectors_detail_resultSemester=mysql_query($lectors_detail_querySemester);	
		$lectors_detail_count=mysql_num_rows($lectors_detail_resultSemester);
			for ($j=0; $j<$lectors_detail_count; $j++)
			{
				$lectors_detail_rowSemester = mysql_fetch_array($lectors_detail_resultSemester);
						$lectors_detail_obj_lectors[$j]=array(
						'subject_title'=>$mass_all[$j],
						'group_name'=>$lectors_detail_rowGroup['group_name'],
						'semester'=>$lectors_detail_rowSemester['semester'],
						'group_id'=>$lectors_detail_rowSemester['group_id'],
						'subject_id'=>$lectors_detail_rowSemester['subject_id']
						);
			
			}
			
	}
	echo json_encode($lectors_detail_obj_lectors);
?>