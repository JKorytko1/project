<?
	include('connection.php');
	header('Content-Type: text/html; charset=utf-8');
    mysql_query('SET NAMES utf8');
	$query="SELECT lec.lector_email, lec.lector_name, sub.subject_title, gr.group_name, md.module_name, st.student_name, grm.dead_line 
			FROM (SELECT * FROM grades WHERE grade IS NULL) AS gn JOIN modules AS md JOIN subjects AS sub JOIN students AS st 
			JOIN lectors AS lec JOIN groups AS gr JOIN groups_modules AS grm
			ON gn.group_module_id=grm.group_module_id AND grm.module_id=md.module_id AND md.subject_id=sub.subject_id
			AND sub.lector_id=lec.lector_id AND gn.student_id=st.student_id AND st.group_id=gr.group_id 
			WHERE lec.lector_email IS NOT NULL
			ORDER BY lec.lector_email, sub.subject_title, gr.group_name, md.module_name, st.student_name";
    $result=mysql_query($query);
	while($data[] = mysql_fetch_array($result));
	$count=mysql_num_rows($result);
	$k=0;
	$emptyarr=1;
	for ($i = 0; $i < $count; $i++)
	{
		if($data[$i]['dead_line']<=date("Y-m-d", time() - 24 * 60 * 60))
		{
			$emptyarr=0;
			//присваеваем начальное значение локальному массиву студентов, если он пустой
			if(!$newdata[$k]['student_name'])
					$newdata[$k]['student_name']="<br><i>".$data[$i]['student_name']."</i>";
			//условие добавления нового студента в локальный массив
			if( $data[$i]['lector_email']==$data[$i+1]['lector_email']&&
				$data[$i]['lector_name']==$data[$i+1]['lector_name']&&
				$data[$i]['subject_title']==$data[$i+1]['subject_title']&&
				$data[$i]['group_name']==$data[$i+1]['group_name']&&
				$data[$i]['module_name']==$data[$i+1]['module_name']
				)
				$newdata[$k]['student_name'].="<br><i>".$data[$i+1]['student_name']."</i>";
			else
			{
				$text[]="'<b>".$data[$i]['subject_title']
				."</b>' группы <b>".$data[$i]['group_name']."</b> по модулю '<b>".$data[$i]['module_name']
				."</b>':<br>".$newdata[$k]['student_name'].",<br><br>по состоянию на <b>".$data[$i]['dead_line']
				."</b>.<br>_________________________";
				$email[]=$data[$i]['lector_email'];
				$name[]="<b>Уважаемый преподователь кафедры СПУ, ".$data[$i]['lector_name']
				."!</b><br><br>Истек срок выставления оценок!<br>Просим Вас обратить внимание на то, что у некоторых студентов не выставлены оценки
				по Вашим предметам:";
				//echo $email[$k]."<br>";
				//echo $text[$k]."<br>";
				$k++;
			}
			
		}
	}
	$k=0;
	$footer="<b>Выставите оценки, пожалуйста, в ближайшее время!</b><br><br>Это письмо отправлено автоматически, отвечать на него не нужно.<br>
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
			echo "////".$newemail[$i]."////<br>".$newname[$i]."<br><br>".$newtext[$i]."<br>";
	/*$header = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
	$i = 0; 
	if(!$emptyarr)
		while( $i<count($newemail)) 
		{
			mail ($newemail[$i], "Преподователь", $newname[$i]."<br><br>".$newtext[$i], $header);
			$i++; 
		}  */

?>