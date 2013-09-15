<?
    $host="127.0.0.1";
	$user="root";
	$password="";
	$db ="project_bd";
	if(!mysql_connect($host, $user, $password))
	{
	       echo mysql_errno() . ": " . mysql_error() . "\n";
		   exit;
	}
	if(! mysql_select_db($db)){
	        echo mysql_errno() . ": " . mysql_error() . "\n";
			exit;
	}
	
	mysql_query("SET NAMES cp1251");
?>