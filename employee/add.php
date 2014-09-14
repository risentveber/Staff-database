<?php
	require_once "../scripts/connection.inc";
	require_once "../scripts/functions.inc";
?>
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
        		<li><a class="not_active" href="/index.php">Управление</a></li>
        		<li><a class="not_active" href="/help.php">Справка</a></li>
	        </ul>
		</nav>
		<section>
		<div class="container">
		<br>
		<?php     
			if (isset($_POST['add'])){         
				$name_ru = pre_string($_POST['name_ru']);
				$surname_ru = pre_string($_POST['surname_ru']);         
				$patronymic_ru = pre_string($_POST['patronymic_ru']);         
				$name_en = pre_string($_POST['name_en']);         
				$surname_en = pre_string($_POST['surname_en']);
				$k = $_POST['k'];   
				$sector_id = $_POST['sector_id']; 
       
				$q = mysql_query(
					"INSERT INTO `employees`
					(`surname`, `name`, `patronymic`, `en_surname`, `en_name`, `coefficient`, `sector_id`)
					VALUES ($surname_ru, $name_ru, $patronymic_ru, $surname_en, $name_en, $k, $sector_id);"
					);
				
				if ($q)
					print_success_message("Спасибо, $surname_ru $name_ru зарегистрирован(а) в базе данных");  
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