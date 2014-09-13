<!DOCTYPE html>
<?php 
	include("../patterns.php"); 
	include("../connection.php");
?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Добавление сотрудника</title>

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
			<form class="form-inline" action="add.php" method="post">
			
				<H4>Персональная информация:</H4>
				<div class="input-group">              
					<input class="form-control" required name="name_ru" size="45" type="text" placeholder="Имя" <?php echo $name_ru_pattern; ?>>
				</div><br>
				<div class="input-group">
					<input class="form-control" required name="surname_ru" size="45" type="text" placeholder="Фамилия"<?php echo $name_ru_pattern; ?>>
				</div><br>
				<div class="input-group">
					<input class="form-control" required name="patronymic_ru" size="45" type="text" placeholder="Отчество"<?php echo $name_ru_pattern; ?>>
				</div><br>
				
				<div class="input-group">
					<input class="form-control" name="name_en" size="45" type="text" placeholder="Имя на английском"<?php echo $name_en_pattern; ?>>
				</div><br>
				<div class="input-group">
					<input class="form-control" name="surname_en" size="45" type="text" placeholder="Фамилия на английском"<?php echo $name_en_pattern; ?>>
			 	</div><br>
			 	<div class="input-group">
					<textarea class="form-control" name="info" rows="4" cols="44" placeholder="Дополнительная информация"></textarea><br>
				</div><br>
			 	
		 		<div class="input-group">
		 			<div class="input-group-addon">Коэффициент:</div>
					<input class="form-control" required name="k" type="number" step="0.5" min="1" max="2">
				</div>
			 	<div class="input-group">			
				<?php
					$unit_id = $_REQUEST['unit_id'];
		
					$str ="\n<option></option>\n";

					$q = mysql_query("SELECT `Сектора`.`id`, `Название сектора` 
										FROM `Сектора`
										LEFT JOIN `Подразделения`
										ON `Подразделения_id` = `Подразделения`.`id`
										WHERE `Подразделения`.`id` = $unit_id
										ORDER BY `Название сектора`;");
					$rows = mysql_num_rows($q);
					$fields = mysql_num_fields($q);
					for ($c = 0; $c < $rows; $c++) {
						$str=$str.'<option value = "'.mysql_result($q, $c, 0).'">'.mysql_result($q, $c, 1)."</option>\n";
					}
					$str=$str.'</select>'."\n\n";
					
					echo '  <div class="input-group-addon">Сектор</div>';
					echo '<select required name="sector_id" class="form-control">';
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
			RISENT &copy 
		</footer>
	</div>
</body>

