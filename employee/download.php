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
	
	$str = $str."Личная информация\n";
	$str = $str."#####################################\n";
	$str = $str."          Имя: ".$name."\n";
	$str = $str."      Фамилия: ".$surname."\n";
	$str = $str."     Отчество: ".$patronymic."\n";
	$str = $str."Подразделение: ".$unit_name."\n";
	$str = $str."       Сектор: ".$sector_name."\n";
	$str = $str."#####################################\n\n";
	echo $str;
	
	$q = mysql_query(
		"SELECT `publication_name`, `year` ,`edition_name`, `impact_factor`, `number_of_authors`
		FROM `authors-publications`
		LEFT JOIN `publications`
		ON `publication_id` = `publications`.`id` 
		LEFT JOIN `editons`
		ON `editon_id` = `editions`.`id`
		WHERE `employee_id` = $employee_id;"
		);

	$unit = mysql_result($q, 0, 0);

	$rows = mysql_num_rows($q);
	if ($rows == 0)
		echo "В публикационной деятельности замечен не был\n";
	else{
		$str = "Публикации\n";
		$sum = 0;
		$sum_str = "0";
		for ($c = 0; $c < $rows; $c++){
				$str=$str."\nНазвание: ".mysql_result($q, $c, 0);
				$str=$str."\n     Год: ".mysql_result($q, $c, 1);
				$str=$str."\n Издание: ".mysql_result($q, $c, 2);
				$prnd_str = mysql_result($q, $c, 3)."*".$k."/".mysql_result($q, $c, 4);
				$prnd = (0+mysql_result($q, $c, 3))*(0+$k)/(0+mysql_result($q, $c, 4));
				$str=$str."\n    ПРНД: $prnd_str = $prnd\n";
				$sum += $prnd;
				$sum_str += $prnd_str;
				
		}
		echo $str;
		echo "\nИтого ПРНД: $sum_str = $sum";

	}
}

?>
