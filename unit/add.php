<?php
	require_once "../scripts/connection.inc"; 
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Добавление Подразделения</title>

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
				if (isset($_POST['add'])){ 
					$name = pre_string($_POST['name']);       
					   
					$q = mysql_query(
						"INSERT INTO `units`
						(`unit_name`)
						VALUES ($name);"
						);

					if ($q)
						print_success_message("Спасибо, $name зарегистрировано в базе данных");  
					else
						print_error_message("Произошла ошибка ".mysql_errno()." ".mysql_error());
				}
			?>
		</div>
		</section>
		<footer class="panel-footer">
			<a href="mailto:risentveber@gmail.com"> Risent </a> &copy  
		</footer>
	</div>
	
</body>
