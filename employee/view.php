<?php
	require_once "../scripts/connection.inc";
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Просмотр сотрудника</title>
	
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	<div class="container">
		<header >
			<h2>ИЯИ РАН <small>Сотрудники</small></h2>
		</header>
		<nav class="navbar navbar-inverse">
			<ul class="nav navbar-nav">
        		<li><a class="not_active" href="/index.php">Управление</a></li>
        		<li><a class="not_active" href="/help.php">Справка</a></li>
	        </ul>
		</nav>
		<section>
		<div class="container">
		<div class="col-md-8">
			<br>
			<?php
				if (isset($_REQUEST['employee_id'])){
					$employee_id = $_REQUEST['employee_id'];

					$q = mysql_query(
						"SELECT `surname`, `name`, `patronymic`, `sector_id`, `id` 
						FROM `employees`
						WHERE `id` = $employee_id;"
						);

					$name = mysql_result($q, 0, 1);
					$surname = mysql_result($q, 0, 0);
					$patronymic = mysql_result($q, 0, 2);
					$sector_id = mysql_result($q, 0, 3);
					$id = mysql_result($q, 0, 4);

					$q = mysql_query(
						"SELECT `sector_name`, `unit_name` 
						FROM `sectors`
						LEFT JOIN `units`
						ON `unit_id` =  `units`.`id`
						WHERE `sectors`.`id` = $sector_id;"
						);

					$unit = mysql_result($q, 0, 1);
					$sector = mysql_result($q, 0, 0);
					
					$str = "<table><caption>Личная информация</caption>\n";
					$str = $str."<tr><th>Имя</th><td>$name</td></tr>\n";
					$str = $str."<tr><th>Фамилия</th><td>$surname</td></tr>\n";
					$str = $str."<tr><th>Отчество</th><td>$patronymic</td></tr>\n";
					$str = $str."<tr><th>Отдел</th><td>$unit</td></tr>\n";
					$str = $str.'<tr><th>Лаборатория</th><td><a href="/sector/view.php?sector_id='.$sector_id.'"'.">$sector</a></td></tr>\n";
					$str = $str."</table>\n";
					echo $str;
					
					$q = mysql_query(
						"SELECT `publication_name`, `year`, `publication_id`
						FROM `authors-publications`
						LEFT JOIN `publications`
						ON `publication_id` = `id`
						WHERE `employee_id` = $employee_id;"
						);

					$unit = mysql_result($q, 0, 0);

					$str = "<br><table><caption>Публикации</caption>\n";
					$str = $str."<tr><th>Название</th><th>Год</th></tr>\n";

					$rows = mysql_num_rows($q);
					if ($rows == 0)
						echo "<br><p>В пуликационной деятельности замечен не был</p>\n";
					else{
	
						for ($c = 0; $c < $rows; $c++) {
							$str=$str.'<tr><td><a href="/publication/view.php?publication_id='.mysql_result($q, $c, 2).'">'.mysql_result($q, $c, 0).'</a></td><td>'.mysql_result($q, $c, 1)."</td></tr>\n";
						}
					
					$str = $str."\n</table>";
					echo $str;
					}
				}
			?>
			<br>
			<form class="form-inline" action="download.php" method="post">
				<input class="btn btn-success" name="view" type="submit" value="Скачать отчет">
				<input style="display:none" name="id" value=<?php echo '"'.$employee_id.'"';?>>
			</form>
			<br>
		</div>
		</div>
		</section>
		<footer class="panel-footer">
			<a href="mailto:risentveber@gmail.com"> Risent </a> &copy 
		</footer>
	</div>
	
</body>