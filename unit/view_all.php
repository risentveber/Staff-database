<?php
	require_once "../scripts/connection.inc";
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Отделы</title>
	
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
				<H4>Отделы</H4>
				<div class="col-md-6">
					<?php

						$q = mysql_query(
							"SELECT `unit_name`, `id`
							FROM `units`
							ORDER BY `unit_name`;"
							);

						$rows = mysql_num_rows($q);

						for ($c = 0; $c < $rows; $c++){
							$unit_id = mysql_result($q, $c, 1);
							$q2 = mysql_query(
								"SELECT `sector_name`, `id`
								FROM `sectors`
								WHERE `unit_id`= $unit_id 
								ORDER BY `sector_name`;"
								);
							$rows2 = mysql_num_rows($q2);
							$str = "\n<table>\n";
							$str = $str."<caption>".mysql_result($q, $c, 0)."</caption>\n";
							for ($c2 = 0; $c2 < $rows2; $c2++)
								$str = $str.'<tr><td><a href="/sector/view.php?sector_id='.mysql_result($q2, $c2, 1).'">'.mysql_result($q2, $c2, 0)."<a></td></tr>\n";
							$str = $str."</table><br>\n\n";
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