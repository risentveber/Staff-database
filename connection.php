<?php
	$hostname = 'localhost';
	$username = 'root';
	$password = 'rootp';
	$databasename = 'mydb';

	$connection = mysql_connect($hostname, $username, $password);
	
	if ($connection >= 0) {

		//echo "connection established<br>";
		mysql_select_db($databasename);
		mysql_query("SET NAMES 'utf8'");
		//echo "ERROR".mysql_errno()." ".mysql_error()."\n";
		
	}else{
		echo "error has occured";
		echo "<br>ERROR ".mysql_errno()." ".mysql_error()."\n";
	}

	function pre_string($str)
	{
		$str = trim($str);
		if ($str == ''){//регулярное выражение
			$str = "NULL";
		}
		else{
			$str = "'".$str."'";
		}
		return $str;
	};
?>