<?php
	require_once "../scripts/connection.inc";
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Просмотр подразделения</title>
	
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
        		<li><a class="not_active" href="/help.php" >Справка</a></li>
	        </ul>
		</nav>
		<section>
		<div class="container">
		<div class="col-md-6">
			<br>
			<?php
			
			if (isset($_REQUEST['sector_id'])){
				$sector_id = $_REQUEST['sector_id'];

				$q = mysql_query(
					"SELECT `sector_name`, `unit_name`
					FROM `sectors`
					LEFT JOIN `units`
					ON `units`.`id` = `unit_id`
					WHERE `sectors`.`id` = $sector_id;"
					);

				$sector_name = mysql_result($q, 0, 0);
				$unit_name = mysql_result($q, 0, 1);
				
				echo '<h3>'.$unit_name."</h3>\n";
				echo '<h4>'.$sector_name."</h4>\n";

				$q = mysql_query(
					"SELECT `name`, `surname`, `id`
					FROM  `employees`
					WHERE `sector_id` = $sector_id;"
					);

				$rows = mysql_num_rows($q);
				if ($rows == 0){
					echo "В подразделении нет сотрудников";
				} else {
					$str = "<table>\n";
					$str = $str."<tr><th>Фамилия Имя</th></tr>\n";
					for ($c = 0; $c < $rows; $c++) {
						$str = $str.'<tr><td><a href="/employee/view.php?employee_id='.mysql_result($q, $c, 2).'">'.mysql_result($q, $c, 1).' '.mysql_result($q, $c, 0)."</a></td></tr>\n";
					}
					$str = $str."</table>\n\n";
				
					echo $str;
				}
			}
			?>
		<br>
		</div>
		</div>
		</section>
		<footer class="panel-footer">
			<a href="mailto:risentveber@gmail.com"> Risent </a> &copy 
		</footer>
	</div>
	
</body>