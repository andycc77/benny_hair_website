<?php
require_once( "./dbconfig.php" );
$contact = $_POST['contact'];
$sql = "update contact set contact ='".$contact."'";
mysql_query($sql);
$contactsql = mysql_fetch_assoc(mysql_query(" select contact from contact "));
$contact = $contactsql['contact'];
echo $contact;
?>