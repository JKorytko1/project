<?
	include('connection.php');
	header('Content-Type: text/html; charset=utf-8');
    mysql_query('SET NAMES utf8');
	$query="SELECT st.parent_email, st.student_name, gr.group_name, sub.subject_title, md.module_name, grm.dead_line 
			FROM (SELECT * FROM grades WHERE grade='1' OR grade='2F') AS g JOIN modules AS md 
			JOIN subjects AS sub JOIN students AS st JOIN groups AS gr JOIN groups_modules AS grm
			ON g.group_module_id=grm.group_module_id AND grm.module_id=md.module_id 
			AND md.subject_id=sub.subject_id AND g.student_id=st.student_id AND st.group_id=gr.group_id 
			WHERE st.parent_email!=''
			ORDER BY st.parent_email, st.student_name, sub.subject_title, grm.dead_line";
    $result=mysql_query($query);
	while($data[] = mysql_fetch_array($result));
	$count=mysql_num_rows($result);
	$k=0;
	$emptyarr=1;
	for ($i = 0; $i < $count; $i++)
	{
		if($data[$i]['dead_line']==date("Y-m-d", time() - 24 * 60 * 60) ||
		   $data[$i]['dead_line']==date("Y-m-d", time() - 8 * 24 * 60 * 60) ||
		   $data[$i]['dead_line']==date("Y-m-d", time() - 15 * 24 * 60 * 60) ||
		   $data[$i]['dead_line']==date("Y-m-d", time() - 22 * 24 * 60 * 60) ||
		   $data[$i]['dead_line']==date("Y-m-d", time() - 29 * 24 * 60 * 60)
		   )
		{
			$emptyarr=0;
			//присваеваем начальное значение локальному массиву студентов, если он пустой
			if(!$newdata[$k]['module_name'])
					$newdata[$k]['module_name']="<br><i>' ".$data[$i]['module_name']." '</i>";
			//условие добавления нового студента в локальный массив
			if( $data[$i]['parent_email']==$data[$i+1]['parent_email']&&
				$data[$i]['student_name']==$data[$i+1]['student_name']&&
				$data[$i]['group_name']==$data[$i+1]['group_name']&&
				$data[$i]['subject_title']==$data[$i+1]['subject_title']
				)
				$newdata[$k]['module_name'].="<br><i>' ".$data[$i+1]['module_name']." '</i>";
			else
			{
				$text[]="'<b>".$data[$i]['subject_title']
				."</b>' по модулю:<br>".$newdata[$k]['module_name'].".<br>_________________________";
				$email[]=$data[$i]['parent_email'];
				$name[]="<b>Уважаемые родители студента(-ки)&nbsp; <i>".$data[$i]['student_name']."</i>!</b>
				<br><br>Кафедра «Систем и процессов управления» НТУ «ХПИ» просит Вас обратить внимание на успеваемость студента <i>"
				.$data[$i]['student_name']."</i> группы ".$data[$i]['group_name']."!<br><br> Студент имеет задолженность по предметам:";
				$k++;
			}
			
		}
	}
	$k=0;
	$footer="<b>Имейте в виду, что студент, который не закроет предмет в кратчайшие сроки, может быть отчислен!</b>
	<br><br>Это письмо отправлено автоматически, отвечать на него не нужно.<br>
	Спасибо за понимание, Команда СПУ.<br><br>";
	for($i=0; $i < count($email); $i++)
	{
		if($i==0)
		{
			$newemail[]=$email[$i];
			$newname[]=$name[$i];
			$newtext[]=$text[$i]."<br><br>";
		}
		else
		{
			if($email[$i-1]!=$email[$i])
			{
				$newtext[$k].=$footer;
				$newemail[]=$email[$i];
				$newname[]=$name[$i];
				$newtext[]=$text[$i]."<br><br>";
				$k++;
			}
			else $newtext[count($newemail)-1].=$text[$i]."<br><br>";
		}
		if($i == count($email) - 1)
			$newtext[$k].=$footer;
	}
	if(!$emptyarr)
		for($i=0; $i < count($newemail); $i++)
			//echo "/////////////////////".$newemail[$i]."/////////////////////<br>".$newname[$i]."<br><br>".$newtext[$i]."<br>";
	$header = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
	$i = 0; 
	if(!$emptyarr)
		while( $i<count($newemail)) 
		{
			mail ($newemail[$i], "Родитель студента", $newname[$i]."<br><br>".$newtext[$i], $header);
			$i++; 
		}  

?>