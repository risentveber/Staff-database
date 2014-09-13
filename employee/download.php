<?php
require_once "../connection.php";

if (isset($_POST['view'])){
	$employee_id = $_POST['id'];

	$q = mysql_query(
		"SELECT `Фамилия`, `Имя`, `Отчество`, `Сектор_id`, `Коэффициент`
		FROM `Сотрудники`
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

	$q = mysql_query("SELECT `Название сектора`,`Название подразделения` 
					FROM `Сектора`
					LEFT JOIN `Подразделения`
					ON `Подразделения_id` = `Подразделения`.`id`
					WHERE `Сектора`.`id` = $sector_id;");
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
	
	$q = mysql_query(	"SELECT `Название публикации`, `Год публикации` ,`Полное название журнала`, `Коэффициент цитируемости`, `Число авторов`
						FROM `Авторы-Публикации`
						LEFT JOIN `Публикации`
						ON `Публикации_id` = `Публикации`.`id` 
						LEFT JOIN `Издания`
						ON `Издания_id` = `Издания`.`id`
						WHERE `Сотрудники_id` = $employee_id;"
						);
	/*if ($q)
		echo "УСПЕХ";
	else
		echo "ПИЧАЛЬ";*/

	$unit = mysql_result($q, 0, 0);

	$rows = mysql_num_rows($q);
	if ($rows == 0)
		echo "НЕТ ПУБЛИКАЦИЙ\n";
	else{
		$str = "Публикации\n";
		for ($c = 0; $c < $rows; $c++){
				$str=$str."\nНазвание: ".mysql_result($q, $c, 0);
				$str=$str."\n     Год: ".mysql_result($q, $c, 1);
				$str=$str."\n Издание: ".mysql_result($q, $c, 2);
				$prnd = (0+mysql_result($q, $c, 3))*(0+$k)/(0+mysql_result($q, $c, 4));
				$str=$str."\n    ПРНД: ".mysql_result($q, $c, 3)."*".$k."/".mysql_result($q, $c, 4)." = $prnd\n";
				
		}
		echo $str;

	}
}

?>
