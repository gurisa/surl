<?php
	$username = "root";
	$password = "";
	$database = "gurisa_go";

	mysql_connect("localhost",$username,$password) or die (mysql_error());
	mysql_select_db($database) or die (mysql_error());
?>	
