<?
   include('../connection.php');
   header('Content-Type: application/json; charset=utf-8');
   mysql_query('SET NAMES utf8');
  
    $query_subjects=mysql_query("Select * from subjects");
    $count_subjects=mysql_num_rows($query_subjects);
	for ($i = 0; $i < $count_subjects; $i++)
    {
		$row_subjects_mas = mysql_fetch_array($query_subjects);
		$query2_subjects=mysql_query("select * from groups where group_id=".$row_subjects_mas['group_id']);
		$subjects_lectors=mysql_fetch_array($query2_subjects);
		$obj_subjects[$i]=array('subject_id'=>$row_subjects_mas['subject_id'], 'subject_title'=>$row_subjects_mas['subject_title'],
		'subject_credits'=>$row_subjects_mas['subject_credits'],'lector_name'=>$subjects_lectors['lector_name']);
    }  
	echo json_encode($obj_subjects);
?>