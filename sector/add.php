<?php
	require_once "../connection.php"; 
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Добавление Сектора</title>

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
		<br>
			<?php 
				 
				if (isset($_REQUEST['add'])){ 
					$sector_name = pre_string($_REQUEST['sector_name']);
					$unit_id = $_REQUEST['unit_id'];    
					$sql_add = "INSERT INTO `Сектора`
									(`Название сектора`, `Подразделения_id`)
								VALUES ($sector_name, $unit_id);";      
					        
					$q = mysql_query($sql_add);
					if ($q)
						print('<div class="alert alert-success col-md-8""><p>Спасибо, сектор зарегестрирован в базе данных</p>');  
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
