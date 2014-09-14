<?php 
	require_once "../connection.php"; 
?>
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
        		<li><a class="not_active" href="/index.php">Управление</a></li>
        		<li><a class="not_active" href="/help.php">Справка</a></li>
	        </ul>
		</nav>
		<section>
		<div class="container">
		<br>
		<?php 
			if (isset($_POST['add'])){

				$title = pre_string($_POST['title']);
				$year = $_POST['year'];
				$edition = $_POST['edition'];
				$info = pre_string($_POST['info']);
				$count_all = $_POST['count_all'];
				
				$q = mysql_query(
					"INSERT INTO `publications`
					(`edition_id`, `publication_name`, `year`, `full_bibliographic_reference`, `number_of_authors`)
					VALUES ($edition, $title, $year, $info, $count_all);"
					); 
				
				if ($q){
					$count = 0;
					$publication_id = mysql_insert_id();
					while ( isset($_POST['name'.++$count]) ) {
						$employee_id = $_POST['name'.$count];
						$q = mysql_query(
							"INSERT INTO `authors-publications`
							(`employee_id`, `publication_id`)
							VALUES ($employee_id, $publication_id);"
							); 
					}					
					print_success_message("Публикация $title зарегестрирована в базе данных")ж  
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