<?php
	require_once "../scripts/connection.inc"
?>					
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Просмотр публикации</title>

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
				if (isset($_REQUEST['publication_id'])){
					$publication_id = $_REQUEST['publication_id'];

					$q = mysql_query(
						"SELECT `publication_name`,`year`, `edition_name`
						FROM `publications`
						LEFT JOIN `editions`
						ON `edition_id` = `editions`.`id`
						WHERE `publications`.`id` = $publication_id;"
						);

					$title = mysql_result($q, 0, 0);
					$year = mysql_result($q, 0, 1);
					$edition = mysql_result($q, 0, 2);
				
					echo "<h3>$title</h3>\n";
					echo "<h4>Год издания: $year</h4>\n";
					echo "<h4>Издательство: $edition</h4>\n";

					$q = mysql_query(
						"SELECT `name`,`surname`,`employee_id`
						FROM  `authors-publications`
						LEFT JOIN `employees`
						ON `id`= `employee_id`
						WHERE `publication_id`= $publication_id;"
						);

					$rows = mysql_num_rows($q);
					if ($rows == 0)
						echo "ERROR";
					$str = "<table><caption>Авторы - сотрудники института</caption>\n";
					$str = $str."<tr><th>Фамилия Имя</th></tr>\n";
					for ($c = 0; $c < $rows; $c++) {					
						$str=$str.'<tr><td><a href="/employee/view.php?employee_id='.mysql_result($q, $c, 2).'">'.mysql_result($q, $c, 1).' '.mysql_result($q, $c, 0)."</a></td></tr>\n";
					}
					$str = $str."</table>\n\n";
				
					echo $str;
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