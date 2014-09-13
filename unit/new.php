<?php include("../patterns.php"); ?>

<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Сотрудники ИЯИ РАН</title>
	
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
			<form class="form-inline" action="add.php" method="post">
				<H4>Информация о подразделении:</H4>
				<div class="input-group">
				
				<input class="form-control" required name="name" size="45" type="text" placeholder="Название"<?php echo $name_pattern; ?>><br>
				</div>
				<br>
				<br>
				<input class="btn btn-default" name="b2"  type="reset"  value="очистить">
				<input class="btn btn-success" name="add" type="submit" value="добавить">
			</form>
			<br>
		</div> 
		</section>
		<footer class="panel-footer">
			<a href="mailto:risentveber@gmail.com"> Risent </a> &copy 
		</footer>
	</div>
	
		
  	
</body>