<?php
$db_hostname="localhost"; $db_username="root"; $db_password="benny55688"; $db_database="bennycom_db";

    if(!($dblink=mysql_connect($db_hostname,$db_username,$db_password))){ echo("mysql connect false"); exit(); }
    @ mysql_query("SET NAMES 'UTF8'");
    if (!mysql_select_db($db_database,$dblink)){ echo("select database false"); exit(); }
?>