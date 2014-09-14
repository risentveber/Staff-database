<?php 
	require_once "../scripts/patterns.inc"; 
	require_once "../scripts/connection.inc";
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Добавление сектора</title>

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
			
				<H4>Сектор</H4>
				<div class="input-group">
				
				<input class="form-control" required name="sector_name" size="45" type="text" placeholder="Название"<?php echo $name_pattern; ?>>
				</div>
				<br>
			 	<div class="input-group">			
				<?php
					include();
		
					$str ="\n<option></option>\n";

					$q = mysql_query(
						"SELECT `id`, `unit_name`
						FROM `units`
						ORDER BY `unit_name`;"
						);

					$rows = mysql_num_rows($q);
					$fields = mysql_num_fields($q);
					for ($c = 0; $c < $rows; $c++) {
						$str=$str.'<option value = "'.mysql_result($q, $c, 0).'">'.mysql_result($q, $c, 1)."</option>\n";
					}
					$str=$str.'</select>'."\n\n";
					
					echo '<div class="input-group-addon">Подразделение:</div>';
					echo '<select required name="unit_id" class="form-control">';
					echo $str;
				?>
				</div>
				
				<br><br>				
				<input class="btn btn-default" name="b2" type="reset" value="Очистить">
				<input class="btn btn-success" name="add" type="submit" value="Добавить">				
			</form>
			<br> 
		</div>
		</section>
		<footer class="panel-footer">
			<a href="mailto:risentveber@gmail.com"> Risent </a> &copy 
		</footer>
	</div>
</body>

