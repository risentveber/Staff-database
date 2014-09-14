<?php
	$hostname = 'localhost';
	$username = 'root';
	$password = 'rootp';
	$databasename = 'staff_database';

	$connection = mysql_connect($hostname, $username, $password);
	
	if ($connection >= 0) {
		mysql_select_db($databasename);
		mysql_query("SET NAMES 'utf8'");		
	}else{
		echo "error has occured";
		echo "<br>ERROR ".mysql_errno()." ".mysql_error()."\n";
	}
?>