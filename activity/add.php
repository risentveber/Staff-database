<?php
	require_once "../scripts/connection.inc";
	require_once "../scripts/functions.inc";
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Добавление деятельности</title>

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
				$activity_name = pre_string($_POST['activity_name']);                   
				$type_id = $_POST['type_id']; 
				$number = $_POST['number'];
       
				$q = mysql_query(
					"INSERT INTO `activities`
					(`activity_name`,`type_id`, `number_of_participants` )
					VALUES ($activity_name, $type_id, $number );"
					);

				if ($q){
					$count = 0;
					$activity_id = mysql_insert_id();
					while ( isset($_POST['name'.++$count]) ) {
						$employee_id = $_POST['name'.$count];
						$q = mysql_query(
							"INSERT INTO `authors-activities`
							(`employee_id`, `activity_id`)
							VALUES ($employee_id, $activity_id);"
							); 
					}					
					print_success_message("Публикация $title зарегестрирована в базе данных"); 
				}else
					print_error_message("Произошла ошибка ".mysql_errno()." ".mysql_error()."</p>"); 
					  
			}
		?>
		
		</div>
		</section>
		<footer class="panel-footer">
			<a href="mailto:risentveber@gmail.com"> Risent </a> &copy 
		</footer>
	</div>
	
</body>