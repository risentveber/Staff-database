<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Добавление Публикации</title>

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
		<br>
		<?php 
			include ("../connection.php");    
			if (isset($_REQUEST['add'])){

				$title = pre_string($_REQUEST['title']);
				$year = $_REQUEST['year'];
				$edition = $_REQUEST['edition'];
				$info = pre_string($_REQUEST['info']);
				$count_all = $_REQUEST['count_all'];
				
				$sql_add = "INSERT INTO `Публикации`
								(`Издания_id`, `Название публикации`, `Год публикации`, `Полная библиографическая ссылка`, `Число авторов`)
							VALUES ($edition, $title, $year, $info, $count_all);"; 
				$result = mysql_query($sql_add); 
				
				if ($result){
					$count = 0;
					$publication_id = mysql_insert_id();
					while ( isset($_REQUEST['name'.++$count]) ) {
						$employee_id = $_REQUEST['name'.$count];
						$sql_add = "INSERT INTO `Авторы-Публикации`
								(`Сотрудники_id`, `Публикации_id`)
							VALUES ($employee_id, $publication_id);"; 
						$result = mysql_query($sql_add); 
					}					
					echo '<div class="alert alert-success col-md-8""><p>Спасибо, вы зарегистрированы в базе данных</p>';   
				}else
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