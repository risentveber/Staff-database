<?php 
	require_once "../connection.php";
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Просмотр сотрудников</title>
	
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	<div class="container">
		<header>
			<h2>ИЯИ РАН <small>Сотрудники</small></h2>
		</header>
		<nav class="navbar navbar-inverse" role="navigation">
			<ul class="nav navbar-nav" >
        		<li><a class="not_active" href="/index.php">Управление</a></li>
        		<li><a class="not_active" href="/help.php">Справка</a></li>
	        </ul>
		</nav>
		<section>
		<div class="container">
			<H4>Сотрудники</H4>
			<div class="col-md-8">
				<?php
					$str ="\n".'<table border="1">'."\n";

					$q = mysql_query("SELECT `Фамилия`, `Имя`, `Название сектора`, `Сотрудники`.`id`, `Сектора`.`id`, `Название подразделения`,`Подразделения`.`id`
										FROM `Сотрудники`
										LEFT JOIN `Сектора`
										ON `Сотрудники`.`Сектор_id`= `Сектора`.`id`
										LEFT JOIN `Подразделения`
										ON `Подразделения_id` = `Подразделения`.`id`
										ORDER BY `Фамилия`,`Имя`;");
					$rows = mysql_num_rows($q);
					if ($rows == 0)
						echo "error_log(message)";

					$str=$str."<tr><th>Фамилия Имя</th><th>Подразделения</th><th>Сектора</th></tr>\n";
					for ($c = 0; $c < $rows; $c++){
						$str=$str.'<tr><td><a href="/employee/view.php?employee_id='.mysql_result($q, $c, 3).'">';
						$str=$str.mysql_result($q, $c, 0)." ".mysql_result($q, $c, 1)."</a></td><td>";
						$str=$str.mysql_result($q, $c, 5)."</td><td>";
						$str=$str.'<a href="/sector/view.php?sector_id='.mysql_result($q, $c, 4).'">'.mysql_result($q, $c, 2)."</a></td></tr>\n";
					}
					$str=$str."</table>\n\n";
				
					echo $str;
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