<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); 
define('DB_PASS', ''); 
define('DB_NAME', 'project_bd');
error_reporting(0);
mysql_query("SET character_set_client='utf8'");
mysql_query("SET character_set_connection='utf8'");
mysql_query("SET character_set_results='utf8'");
if (!$conn = mysql_connect(DB_HOST,DB_USER,DB_PASS)) 
{
    echo 'не могу подключиться к серверу БД';
        exit;
}
if (!mysql_select_db(DB_NAME)) 
{
    echo 'не могу подключить БД';
        exit;
}
session_start (); 
?>