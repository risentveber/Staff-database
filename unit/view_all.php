<?php
	require_once "../scripts/connection.inc";
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Просмотр подразделений</title>
	
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
				<H4>Подразделения</H4>
				<div class="col-md-6">
					<?php
						$str = "\n<table border='1'>\n";
						$str = $str."<tr><th>Название подразделения</th></tr>\n";

						$q = mysql_query(
							"SELECT `unit_name`, `id`
							FROM `units`
							ORDER BY `unit_name`;"
							);

						$rows = mysql_num_rows($q);

						for ($c = 0; $c < $rows; $c++)
							$str = $str.'<tr><td><a href="/unit/view.php?unit_id='.mysql_result($q, $c, 1).'">'.mysql_result($q, $c, 0)."<a></td></tr>\n";
						$str = $str."</table>\n\n";
					
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