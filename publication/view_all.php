<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Просмотр публикаций</title>
	
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
        		<li ><a class="not_active" href="/index.php">Управление</a></li>
        		<li><a class="not_active" href="/help.php">Справка</a></li>
	        </ul>
		</nav>
		<section>
			<div class="container">
				<H4>Публикации</H4>
				<div class="col-md-8">
					<?php
						include("../connection.php");
						$str ="\n".'<table border="1">'."\n";

						$q = mysql_query("SELECT `Название публикации`, `Полное название журнала`, `Публикации`.`id`
											FROM `Публикации`
											LEFT JOIN `Издания`
											ON `Публикации`.`Издания_id`= `Издания`.`id`
											ORDER BY `Название публикации`;");
						$rows = mysql_num_rows($q);

						$str=$str."<tr><th>Название</th><th>Издание</th></tr>\n";
						for ($c = 0; $c < $rows; $c++)
							$str = $str.'<tr><td><a href="/publication/view.php?publication_id='.mysql_result($q, $c, 2).'&add=add">'.mysql_result($q, $c, 0)."</a></td><td>".mysql_result($q, $c, 1)."</td></tr>\n";			
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