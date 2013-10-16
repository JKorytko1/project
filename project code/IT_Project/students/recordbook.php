<?
	include('../connection.php');
	header('Content-Type: application/json; charset=utf-8');
	mysql_query('SET NAMES utf8');
	$groupId=$_GET['groupId'];
	$studentId=$_GET['studentId'];
	$queryGroup = "Select * from groups where group_id=".$groupId ;
	$result=mysql_query($queryGroup );
	$rowGroup = mysql_fetch_array($result);
	$queryStudent = "Select * from students where student_id=".$studentId ;
	$result=mysql_query($queryStudent );
	$rowStudent = mysql_fetch_array($result);	
	$querySubject = "Select * from subjects join groups_subjects on subjects.subject_id = groups_subjects.subject_id where group_id=".$groupId;
	$resultSubject=mysql_query($querySubject);
	$res_col=mysql_num_rows($resultSubject);
	for ($i=0; $i<$res_col; $i++)
		{	
		$grades=array();	
		$rowSubject= mysql_fetch_array($resultSubject);
		$mas_sub[$i]=$rowSubject['subject_title'];
		
				$queryModule = "select * from modules where subject_id=".$rowSubject['subject_id'];
				$resultModule = mysql_query($queryModule);
				$res_col_mod=mysql_num_rows($resultModule);
				$j=0;
				for ($j=0; $j<$res_col_mod; $j++)
				{
					$rowModule= mysql_fetch_array($resultModule);
					$queryGrades = "select * from grades where group_module_id in (select group_module_id from groups_modules where group_id = ".$groupId." and module_id = ".$rowModule['module_id'].")
									and student_id = ".$studentId;
					$resultGrades = mysql_query($queryGrades);
					$rowGrades = mysql_fetch_array($resultGrades);    
					$grades[$j]=array('module_name'=>$rowModule['module_name'], 'grade'=>$rowGrades['grade']);
				}
				$querySemester = "SELECT * FROM groups_subjects where group_id =".$groupId." AND subject_id =".$rowSubject['subject_id'];
				$resultSemester=mysql_query($querySemester);
				$rowSemestr= mysql_fetch_array($resultSemester);
				$queryLectors = "select * from lectors where lector_id = (select lector_id from subjects  where subject_id= ".$rowSubject['subject_id'].")";
				$resultLectors = mysql_query($queryLectors)or die (mysql_error());
				$rowLectors = mysql_fetch_array($resultLectors);
			$mass_all[$i]=array('student_name'=>$rowStudent['student_name'], 'group_name'=>$rowGroup['group_name'], 'subjects'=>$rowSubject['subject_title'], 'moduls'=>$grades,'semestr'=>$rowSemestr['semester'],'lectors'=>$rowLectors['lector_name']);
		}
	echo json_encode($mass_all);
?>