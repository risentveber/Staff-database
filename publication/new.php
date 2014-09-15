<?php 
	require_once "../scripts/patterns.inc";
	require_once "../scripts/connection.inc"; 
?>

<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Добавление публикации</title>

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
			<form  class="form-inline" action="add.php" method="post">
				<H4>Информация о публикации:</H4>

				<?php 
					if (isset($_POST['add'])){         
						$count = $_POST['count'];
						$count = 0 + $count;              
					}
					echo "\n";
					//***************************************************************************************
					$str ='<option></option>';

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
					$str=$str."</select></div><br>\n\n";
					//****************************************************************************************
					for ($c=1; $c<=$count; $c++){
						$tname = 'name'.(string)$c;
						echo '<div class="input-group">	<div class="input-group-addon">Автор '.(string)$c.':</div>';
						echo'<select class="form-control" required name="'.(string)$tname.'" >';
						echo $str;
					}
						
				?>
				<br>
				<div class="input-group">
					<div class="input-group-addon">Тип:</div>
					<span class="input-group-addon">
						<input type="radio" required name="preprint" value="true"> Препринт
					</span>
					<span class="input-group-addon">
						<input type="radio" required name="preprint" value="false"> Статья
					</span>
      			</div>		
				<br>
				<div class="input-group"> 
					<input class="form-control" required name="title" size="45" type="text" placeholder="Название" <?php echo $name_pattern; ?> ><br>
				</div><br>
				<div class="input-group">
		 			<div class="input-group-addon">Полное количество авторов:</div>
		 			<input class="form-control" required name="count_all" type="number" min=<?php echo "'$count'";?> max="50">
				</div>
				
				<div class="input-group">	
					<div class="input-group-addon">Издание: </div>
					<select class="form-control" required name="edition" >
					<?php
						$str ='<option></option>';

						$q = mysql_query(
							"SELECT `id`,`edition_name`
							FROM `editions`
							ORDER BY `edition_name`;"
							);
						$rows = mysql_num_rows($q);
						$fields = mysql_num_fields($q);
						for ($c = 0; $c < $rows; $c++) {
							$str=$str.'<option value = "'.mysql_result($q, $c, 0).'">'.mysql_result($q, $c, 1).'</option>';
						}
						$str=$str.'</select>'."\n\n";
						
						echo $str;
					?>
				</div>
				<div class="input-group">
		 			<div class="input-group-addon">Год издания:</div>
		 			<?php
					$str = '<input class="form-control" required name="year" type="number" min="1990" max="'.date("Y").'">';
					echo $str;
				?>
				</div>	<br>
				<div class="input-group">	
					<textarea class="form-control" name="info" rows="4" cols="40" placeholder="Полная библиографическая ссылка:"></textarea>
				</div>
				<br>
				<br>

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