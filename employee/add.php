<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Добавление Сотрудника</title>

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
				$name_ru = pre_string($_REQUEST['name_ru']);
				$surname_ru = pre_string($_REQUEST['surname_ru']);         
				$patronymic_ru = pre_string($_REQUEST['patronymic_ru']);         
				$name_en = pre_string($_REQUEST['name_en']);         
				$surname_en = pre_string($_REQUEST['surname_en']);
				$k = $_REQUEST['k'];   
				$sector_id = $_REQUEST['sector_id'];        
				$sql_add = "INSERT INTO `Сотрудники`
							(`Фамилия`, `Имя`, `Отчество`, `Фамилия на английском`, `Имя на английском`, `Коэффициент`, `Сектор_id`)
							VALUES ($surname_ru, $name_ru, $patronymic_ru, $surname_en, $name_en, $k, $sector_id);";         
				$result = mysql_query($sql_add);
				if ($result)
					echo '<div class="alert alert-success col-md-8""><p>Спасибо, вы зарегистрированы в базе данных</p>';  
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