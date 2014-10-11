<?php
require_once "../scripts/prnd.inc";

if (isset($_POST['view'])){
	$sector_id = $_POST['id'];

	$q = mysql_query(
		"SELECT `sector_name`
		FROM `sectors`
		WHERE `id` = $sector_id;");

	$sector_name = mysql_result($q, 0, 0);

	header("Cache-Control: ");
	header("Content-type: text/plain");
	header('Content-Disposition: attachment; filename="'.$sector_name.'.txt"');
	
	$q = mysql_query(
		"SELECT `id`
		FROM `employees`
		WHERE `sector_id` = $sector_id;");	

	$rows = mysql_num_rows($q);

	echo "Информация о подразделении\r\n";
	echo "##########################################################################\r\n";
	echo "              Название: $sector_name\r\n";
	echo "Количество сотрудников: $rows\r\n";
	echo "##########################################################################\r\n";

	$sum = 0;
	for ($c = 0; $c < $rows; $c++){
		$sum += Prnd(mysql_result($q, $c, 0));
	}

	echo "##########################################################################\r\n";
	echo "Суммарный ПРНД: $sum\r\n";
	echo "Средний ПРНД: ".$sum/$rows."\r\n";
	echo "##########################################################################\r\n";
}

?>
