<?php 
	require_once "../patterns.php";
	require_once "../connection.php"; 
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
        		<li ><a class="not_active" href="/index.php">Управление</a></li>
        		<li><a class="not_active" href="/help.php">Справка</a></li>
	        </ul>
		</nav>
		<section>
		
		<div class="container">
			<form  class="form-inline" action="add.php" method="post">
				<H4>Информация о публикации:</H4>

				<?php 
					if (isset($_REQUEST['add'])){         
						$count = $_REQUEST['count'];
						$count = 0 + $count;              
					}
					echo "\n";
					//***************************************************************************************
					$str ='<option></option>';

					$q = mysql_query("SELECT `id`,`Имя`, `Фамилия`
									FROM `Сотрудники`
									ORDER BY `Фамилия`, `Имя`;");//ожидается список авторов <id> <имя> <фамилия>
					$rows = mysql_num_rows($q);
					$fields = mysql_num_fields($q);
					for ($c = 0; $c < $rows; $c++) {
						$str=$str.'<option value = "'.mysql_result($q, $c, 0).'">'.mysql_result($q, $c, 2).' '.mysql_result($q, $c, 1).'</option>';
					}
					$str=$str.'</select></div><br>'."\n\n";
					//****************************************************************************************
					for ($c=1; $c<=$count; $c++){
						$tname = 'name'.(string)$c;
						//echo 'автор '.(string)$c.': <br><input name="'.(string)$tname.'" size="45" type="text"><br>'."\n";
						echo '<div class="input-group">	<div class="input-group-addon">Автор '.(string)$c.':</div>';
						echo'<select class="form-control" required name="'.(string)$tname.'" >';
						echo $str;
						}
						//echo'<input name="'.(string)$tname.'" />'
				?>
				<br>
				
				<div class="input-group"> 
					<input class="form-control" required name="title" size="45" type="text" placeholder="Название" <?php echo $name_pattern; ?> ><br>
				</div><br>
				<div class="input-group">
		 			<div class="input-group-addon">Полное количество авторов:</div>
		 			<input class="form-control" required name="count_all" type="number" min="1" max="50">
				</div>
				<div class="input-group">
		 			<div class="input-group-addon">Год издания:</div>
		 			<?php
					$str = '<input class="form-control" required name="year" type="number" min="1990" max="'.date("Y").'">';
					echo $str;
				?>
				</div>			
				
				<div class="input-group">	
					<div class="input-group-addon">Издание: </div>
					<select class="form-control" required name="edition" >
					<?php
						$str ='<option></option>';

						$q = mysql_query("SELECT `id`,`Полное название журнала`
											FROM `Издания`
											ORDER BY `Полное название журнала`;");//ожидается список изданий <id> <издание>
						$rows = mysql_num_rows($q);
						$fields = mysql_num_fields($q);
						for ($c = 0; $c < $rows; $c++) {
							$str=$str.'<option value = "'.mysql_result($q, $c, 0).'">'.mysql_result($q, $c, 1).'</option>';
						}
						$str=$str.'</select>'."\n\n";
						
						echo $str;
					?>
				</div><br>
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