<?php
	require_once "../connection.php";
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Просмотр подразделения</title>
	
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
        		<li><a class="not_active" href="/help.php" >Справка</a></li>
	        </ul>
		</nav>
		<section>
		<div class="container">
		<div class="col-md-8">
			<br>
			<?php
			
			if (isset($_REQUEST['unit_id'])){
				$unit_id = $_REQUEST['unit_id'];

				$q = mysql_query("SELECT `Название подразделения` FROM `Подразделения`
						WHERE `id` = $unit_id;");

				$title = mysql_result($q, 0, 0);
			
				echo '<h2>'.$title."</h2>\n";

				$q = mysql_query("SELECT `Название сектора`, `id` 
									FROM  `Сектора`
									WHERE `Подразделения_id`= $unit_id;");

				$rows = mysql_num_rows($q);
				if ($rows == 0){
					echo "В подразделении нет секторов";
				} else {
					$str = "<table>\n";
					$str=$str."<tr><th>Название</th></tr>\n";

					for ($c = 0; $c < $rows; $c++) {
						$str=$str.'<tr><td><a href="/sector/view.php?sector_id='.mysql_result($q, $c, 1).'">'.mysql_result($q, $c, 0)."</a></td></tr>\n";
					
						
					}
					$str=$str."</table>\n\n";
				
					echo $str;
				}
			}
			?>
		<br>
		</div>
		</div>
		</section>
		<footer class="panel-footer">
			<a href="mailto:risentveber@gmail.com"> Risent </a> &copy 
		</footer>
	</div>
	
</body>