<?php
	function pre_string($str)
	{
		$str = trim($str);
		if ($str == ''){
			$str = "NULL";
		}else{
			$str = "'".$str."'";
		}
		return $str;
	};
	
	function print_success_message($success_message='')
	{
		echo "<div class='alert alert-success col-md-8'>\n";
		echo "<p>$success_message</p>\n";
		echo "</div>";
	}

	function print_error_message($error_message='')
	{
		echo "<div class='alert alert-danger col-md-8'>\n";
		echo "<p>$error_message</p>\n";
		echo "</div>";
	}
?>