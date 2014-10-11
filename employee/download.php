<?php
require_once "../scripts/prnd.inc";

if (isset($_POST['view'])){
	$employee_id = $_POST['id'];

	$q = mysql_query(
		"SELECT `surname`, `name`
		FROM `employees`
		WHERE `id` = $employee_id;");

	$name = mysql_result($q, 0, 1);
	$surname = mysql_result($q, 0, 0);

	$filename = $surname."_".$name.".txt";

	header("Cache-Control: ");
	header("Content-type: text/plain");
	header('Content-Disposition: attachment; filename="'.$filename.'"');

	Prnd($employee_id, true);
}

?>
