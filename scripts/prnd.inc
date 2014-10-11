<?php
require_once "../scripts/connection.inc";

function Prnd($employee_id, $print=false)
{
	$q = mysql_query(
		"SELECT `surname`, `name`, `patronymic`, `sector_id`, `coefficient`
		FROM `employees`
		WHERE `id` = $employee_id;");

	$name = mysql_result($q, 0, 1);
	$surname = mysql_result($q, 0, 0);
	$patronymic = mysql_result($q, 0, 2);
	$sector_id = mysql_result($q, 0, 3);
	$employee_k = mysql_result($q, 0, 4);


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
	
	$q = mysql_query(
		"SELECT `publication_name`, `year` ,`edition_name`, `impact_factor`, `number_of_authors`,`preprint`,`foreign`
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
	$sum = 0;
	$sum_str = "";

	if ($rows == 0){
		$str = $str."В публикационной деятельности замечен не был\r\n\r\n";
	}else{
		$str = $str."##########################################################################\r\n";
		$str = $str."Публикации\r\n";
		$str = $str."##########################################################################\r\n";
		
		$sum_str = "";

		for ($c = 0; $c < $rows; $c++){
				$number_of_authors = (0+mysql_result($q, $c, 4));
				$str = $str."\r\n     Название: ".mysql_result($q, $c, 0);
				$str = $str."\r\n          Год: ".mysql_result($q, $c, 1);
				$str = $str."\r\n      Издание: ".mysql_result($q, $c, 2);
				$str = $str."\r\nЧисло авторов: ".$number_of_authors;

				$impact_factor = mysql_result($q, $c, 3);
				$is_low = false;

				if(mysql_result($q, $c, 6) == '1'){
					$str=$str."\r\n  Тип издания: зарубежное";
					$pk=30;
					if ($impact_factor < 0.27 )
						$is_low = true;
				} else {
					$str=$str."\r\n  Тип издания: отечественное";
					$pk=60;
					if ($impact_factor < 0.133 )
						$is_low = true;
				}
				
				
				if (mysql_result($q, $c, 5) == '1'){//preprint
					$str = $str."\r\nТип материала: препринт\r\n";
					$prnd_str = "4/".$number_of_authors;
					$prnd = 4/$number_of_authors;
					$prnd = round($prnd, 3);
					$str = $str."\r\nПРНД: $prnd_str = $prnd\r\n";
				} else{
					$str=$str."\r\nТип материала: статья\r\n";
					if( $is_low){
						$prnd_str = "8/".$number_of_authors;
						$prnd = 8/$number_of_authors;
						$prnd = round($prnd, 3);
						$str = $str."\r\nПРНД: $prnd_str = $prnd\r\n";
					} else{
						$prnd_str = mysql_result($q, $c, 3)."*".$pk."/".$number_of_authors;
						$prnd = (0+mysql_result($q, $c, 3))*$pk/$number_of_authors;
						$prnd = round($prnd, 3);
						$str = $str."\r\nПРНД: $prnd_str = $prnd\r\n";
					}						
				}
				
				$sum += $prnd;
				if ($first)
					$first = false;
				else
					$sum_str = $sum_str." + ";
				$sum_str = $sum_str."$prnd";
				$str = $str."--------------------------------------------------------------------------\r\n";
				
				
		}
	}
	//************************************************************************************************************
	$q = mysql_query(
		"SELECT `activity_name`, `number_of_participants` ,`type_name`, `activity_coefficient`
		FROM `authors-activities`
		LEFT JOIN `activities`
		ON `activity_id` = `activities`.`id`
		LEFT JOIN `activity_types`
		ON `type_id` = `activity_types`.`id`
		WHERE `employee_id` = $employee_id;"
		);

	$rows = mysql_num_rows($q);

	if ($rows == 0){
		$str = $str."В прочей деятельности замечен не был\r\n";
	}else{
		$str = $str."##########################################################################\r\n";
		$str = $str."Другие виды деятельности\r\n";
		$str = $str."##########################################################################\r\n";

		for ($c = 0; $c < $rows; $c++){
			$number = (0+mysql_result($q, $c, 1));
			$prnd_str = mysql_result($q, $c, 3)."/".$number;
			$prnd = (0+mysql_result($q, $c, 3))/$number;
			$prnd = round($prnd, 3);

			$str = $str."\r\n        Название: ".mysql_result($q, $c, 0);
			$str = $str."\r\n             Тип: ".mysql_result($q, $c, 2);
			$str = $str."\r\nЧисло участников: ".$number;			
			$str = $str."\r\n\r\nПРНД: $prnd_str = $prnd\r\n";						
			
			$sum += $prnd;
			if ($first)
				$first = false;
			else
				$sum_str = $sum_str." + ";
			$sum_str = $sum_str."$prnd";
				
		}
	}
	$str = $str."--------------------------------------------------------------------------\r\n";
	
	$str = $str."\r\nВсего ПРНД: $sum_str = $sum";
	$str = $str."\r\nС учетом личного коэффициента:";
	$str = $str."\r\nИтого ПРНД: $sum*$employee_k = ".($sum*$employee_k);
	if($print)
		echo $str;
	else {

		echo "     Имя: ".$name."\r\n";
		echo " Фамилия: ".$surname."\r\n";
		echo "Отчество: ".$patronymic."\r\n";
		echo "    ПРНД: ".$sum*$employee_k."\r\n";
		echo "--------------------------------------------------------------------------\r\n";

	}
	return $sum*$employee_k;
}
?>