<?php 
	require_once "../patterns.php"; 
?>

<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Добавление издания</title>
	
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
				<H4>Информация о издании:</H4>  

				<div class="input-group">
					<input placeholder="Тип издания" class="form-control" name="type" size="45" type="text" <?php echo $name_pattern; ?> ><br>
				</div><br>
				<div class="input-group">
					<input placeholder="Полное название журнала" class="form-control" autofocus required name="full_name" size="45" type="text" <?php echo $name_pattern; ?> ><br>
				</div><br>
				<div class="input-group">
					<input placeholder="Сокращенное название журнала" class="form-control" name="short_name" size="45" type="text" <?php echo $name_pattern; ?> >
				</div>
				<br>
				<div class="input-group">
					<div class="input-group-addon">Коэффициент цитируемости:</div>
					<input class="form-control" required name="k" type="number" min="1" max="100" >
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