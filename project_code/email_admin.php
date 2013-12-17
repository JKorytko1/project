<?
	include('connection.php');
	header('Content-Type: text/html; charset=utf-8');
    mysql_query('SET NAMES utf8');
	$query="SELECT lec.lector_name, sub.subject_title, gr.group_name, md.module_name, st.student_name, grm.dead_line 
			FROM (SELECT * FROM grades WHERE grade IS NULL) AS gn JOIN modules AS md JOIN subjects AS sub JOIN students AS st 
			JOIN lectors AS lec JOIN groups AS gr JOIN groups_modules AS grm
			ON gn.group_module_id=grm.group_module_id AND grm.module_id=md.module_id AND md.subject_id=sub.subject_id
			AND sub.lector_id=lec.lector_id AND gn.student_id=st.student_id AND st.group_id=gr.group_id 
			WHERE lec.lector_email IS NOT NULL
			ORDER BY lec.lector_name, sub.subject_title, gr.group_name, md.module_name, st.student_name";
    $result=mysql_query($query);
	$admquery="SELECT lector_email, lector_name FROM `lectors` WHERE role = 4 AND lector_email IS NOT NULL";
	$admresult=mysql_query($admquery);
	while($data[] = mysql_fetch_array($result));
	while($admdata[]= mysql_fetch_array($admresult));
	$count=mysql_num_rows($result);
	$k=0;
	$emptyarr=1;
	for ($i = 0; $i < $count; $i++)
	{
		if($data[$i]['dead_line']<=date("Y-m-d", time() - 8 * 24 * 60 * 60))
		{
			$emptyarr=0;
			//присваеваем начальное значение локальному массиву студентов, если он пустой
			if(!$newdata[$k]['student_name'])
					$newdata[$k]['student_name']="<br><i>".$data[$i]['student_name']."</i>";
			//условие добавления нового студента в локальный массив
			if(	$data[$i]['lector_name']==$data[$i+1]['lector_name']&&
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
				$name[]=$data[$i]['lector_name'];
				$k++;
			}
			
		}
	}
	for($i=0; $i < count($name); $i++)
	{
		if($i==0)
		{
			$newname[]=$name[$i];
			$newtext[]=$text[$i]."<br><br>";
		}
		else
		{
			if($name[$i-1]!=$name[$i])
			{
				$newname[]=$name[$i];
				$newtext[]=$text[$i]."<br><br>";
			}
			else $newtext[count($newname)-1].=$text[$i]."<br><br>";
		}
	}
	$header="<b>Уважаемый администратор сайта кафедры СПУ, ".$admdata[0]['lector_name']."!</b><br><br>
	Просим Вас обратить внимание, что на Вашей кафедре у студентов есть невыставленные оценки!<br><br>";
	$footer="<b><br>Напоминаем Вам, что как администратор Вы можете выставлять все оценки на портале</b>
	<a href='http://dev.myacademy.com.ua'>dev.myacademy.com.ua</a>!
	<br><br>Это письмо отправлено автоматически, отвечать на него не нужно.<br>
	Спасибо за понимание, Команда СПУ.<br><br><br>";
	if(!$emptyarr)
	{
		echo "//////".$admdata[0]['lector_email']."//////<br>";
		for($i=0; $i < count($newname); $i++)
		if($i==0)
			$admtext.= "<ul type='square'><li><b>У преподавателя&nbsp; <i>".$newname[$i]."</i>&nbsp; по предмету:</b></li></ul>".$newtext[$i];
		else $admtext.= "<br><ul type='square'><li><b>У преподавателя&nbsp; <i>".$newname[$i]."</i>&nbsp; по предмету:</b></li></ul>".$newtext[$i];
		$admtext.=$footer;
		echo $header.$admtext;
	}
	/*$headercoding = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
	if(!$emptyarr)
		mail ($admdata[0]['lector_email'], "Администратор", $header.$admtext, $headercoding);*/


?>