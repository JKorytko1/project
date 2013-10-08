<?
   include('../connection.php');
   header('Content-Type: application/json; charset=utf-8');
   mysql_query('SET NAMES utf8');
  
    $query_students=mysql_query("Select * from students");
    $count_students=mysql_num_rows($query_students);
	for ($i = 0; $i < $count_students; $i++)
    {
		$row_students_mas = mysql_fetch_array($query_students);
		$query2_students=mysql_query("select group_name from groups where group_id=".$row_students_mas['group_id']);
		$group_students=mysql_fetch_array($query2_students);
		$obj_students[$i]=array('students_id'=>$row_students_mas['student_id'], 'student_name'=>$row_students_mas['student_name'],
		'student_notes'=>$row_students_mas['student_notes'],'student_email'=>$row_students_mas['student_email'],'group_name'=>$group_students['group_name']);
    }  
	echo json_encode($obj_students);
?>