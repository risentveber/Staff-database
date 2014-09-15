<?php
require_once "../scripts/connection.inc";

if (isset($_POST['view'])){
	$employee_id = $_POST['id'];

	$q = mysql_query(
		"SELECT `surname`, `name`, `patronymic`, `sector_id`, `coefficient`
		FROM `employees`
		WHERE `id` = $employee_id;");

	$name = mysql_result($q, 0, 1);
	$surname = mysql_result($q, 0, 0);
	$patronymic = mysql_result($q, 0, 2);
	$sector_id = mysql_result($q, 0, 3);
	$k = mysql_result($q, 0, 4);

	$filename = $surname."_".$name.".txt";

	header("Cache-Control: ");
	header("Content-type: text/plain");
	header('Content-Disposition: attachment; filename="'.$filename.'"');

	$q = mysql_query(
		"SELECT `sector_name`,`unit_name` 
		FROM `sectors`
		LEFT JOIN `units`
		ON `unit_id` = `units`.`id`
		WHERE `sectors`.`id` = $sector_id;"
		);

	$sector_name = mysql_result($q, 0, 0);
	$unit_name = mysql_result($q, 0, 1);
	
	$str = $str."##########################################################################\r\n";
	$str = $str."Личная информация\r\n";
	$str = $str."##########################################################################\r\n";
	$str = $str."          Имя: ".$name."\r\n";
	$str = $str."      Фамилия: ".$surname."\r\n";
	$str = $str."     Отчество: ".$patronymic."\r\n";
	$str = $str."        Отдел: ".$unit_name."\r\n";
	$str = $str."  Лаборатория: ".$sector_name."\r\n";
	$str = $str."\r\n";
	echo $str;
	
	$q = mysql_query(
		"SELECT `publication_name`, `year` ,`edition_name`, `impact_factor`, `number_of_authors`
		FROM `authors-publications`
		LEFT JOIN `publications`
		ON `publication_id` = `publications`.`id` 
		LEFT JOIN `editions`
		ON `edition_id` = `editions`.`id`
		WHERE `employee_id` = $employee_id;"
		);

	$unit = mysql_result($q, 0, 0);

	$rows = mysql_num_rows($q);
	$first = true;

	if ($rows == 0)
		echo "В публикационной деятельности замечен не был\r\n";
	else{
		$str = "##########################################################################\r\n";
		$str = $str."Публикации\r\n";
		$str = $str."##########################################################################\r\n";
		$sum = 0;
		$sum_str = "";

		for ($c = 0; $c < $rows; $c++){
				$str=$str."\r\nНазвание: ".mysql_result($q, $c, 0);
				$str=$str."\r\n     Год: ".mysql_result($q, $c, 1);
				$str=$str."\r\n Издание: ".mysql_result($q, $c, 2);
				$prnd_str = mysql_result($q, $c, 3)."*".$k."/".mysql_result($q, $c, 4);
				$prnd = (0+mysql_result($q, $c, 3))*(0+$k)/(0+mysql_result($q, $c, 4));
				$prnd = round($prnd, 3);
				$str=$str."\r\n    ПРНД: $prnd_str = $prnd\r\n";
				$sum += $prnd;
				if ($first)
					$first = false;
				else
					$sum_str = $sum_str." + ";
				$str = $str."--------------------------------------------------------------------------\r\n";
				$sum_str = $sum_str."$prnd";
				
		}
		echo $str;
		echo "\r\nИтого ПРНД: $sum_str = $sum";

	}
}

?>
