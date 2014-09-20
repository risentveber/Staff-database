<?php 
	require_once "../scripts/patterns.inc"; 
	require_once "../scripts/connection.inc"; 
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
			<form class="form-inline" action="add.php" method="post">
				<H4>Информация о деятельности:</H4>  

				<div class="input-group">
					<input placeholder="Название деятельности" class="form-control" autofocus required name="activity_name" size="45" type="text" <?php echo $name_pattern; ?> ><br>
				</div><br>
				<div class="input-group">	
					<div class="input-group-addon">Участник:</div>
					<select class="form-control" required name="employee_id" >
						<option></option>
						<?php
						$str ='';

							$q = mysql_query(
								"SELECT `id`, `name`, `surname`
								FROM `employees`
								ORDER BY `surname`, `name`;"
								);

							$rows = mysql_num_rows($q);
							$fields = mysql_num_fields($q);
							for ($c = 0; $c < $rows; $c++) {
								$str=$str.'<option value = "'.mysql_result($q, $c, 0).'">'.mysql_result($q, $c, 2).' '.mysql_result($q, $c, 1).'</option>';
							}
								echo $str;
						?>
					</select>
				</div>
				<br>
				<div class="input-group">	
					<div class="input-group-addon">Тип:</div>
					<select class="form-control" required name="type_id" >
						<option></option>
						<?php
						$str ='';

							$q = mysql_query(
								"SELECT `id`, `type_name`
								FROM `activity_types`
								ORDER BY `type_name`;"
								);

							$rows = mysql_num_rows($q);
							$fields = mysql_num_fields($q);
							for ($c = 0; $c < $rows; $c++) {
								$str=$str.'<option value = "'.mysql_result($q, $c, 0).'">'.mysql_result($q, $c, 1).'</option>';
							}
								echo $str;
						?>
					</select>
				</div>
				<br>
				<div class="input-group">
			 			<div class="input-group-addon">Количество участников:</div>
			 			<input class="form-control" required name="number" type="number" min="1" max="10">
				</div>
				<br>
				<br>		
				<input class="btn btn-default" name="b2" type="reset" value="Очистить">
				<input class="btn btn-success" name="add" type="submit" value="Добавить">
				<br>
				<br>
			</form>
		</div>
		</section>
		<footer class="panel-footer">
			<a href="mailto:risentveber@gmail.com"> Risent </a> &copy 
		</footer>
	</div>
</body>