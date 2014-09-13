<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Добавление Издания</title>
	
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
        		<li ><a class="not_active" href="/index.php">Управление</a></li>
        		<li><a class="not_active" href="/help.php">Справка</a></li>
	        </ul>
		</nav>
		<section>
		<div class="container">
		<br>
			<?php 
				include ("../connection.php");  
				if (isset($_REQUEST['add'])){ 
					$type = pre_string($_REQUEST['type']);
					$full_name = pre_string($_REQUEST['full_name']);
					$short_name = pre_string($_REQUEST['short_name']); 
					$k = $_REQUEST['k'];

					$sql_add = "INSERT INTO `Издания`
								(`Тип издания`, `Полное название журнала`, `Сокращенное название журнала`, `Коэффициент цитируемости`)
								VALUES ($type, $full_name, $short_name, $k);";         
					$q = mysql_query($sql_add);
					if ($q)
						echo '<div class="alert alert-success col-md-8""><p>Спасибо, издание сохранено в базе данных</p>';
					else
						echo '<div class="alert alert-danger col-md-8""><p>Произошла ошибка '.mysql_errno()." ".mysql_error().'</p>';
					echo "</div>";  
				}
			?>
		</div>
		</section>
		<footer class="panel-footer">
			<a href="mailto:risentveber@gmail.com"> Risent </a> &copy 
		</footer>
	</div>
	
</body>