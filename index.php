<?php
	require_once "./authorize.php";
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<title>Сотрудники ИЯИ РАН</title>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	<div>
		<p></p>
	</div>
	<div class="container">
		<header >
			<h2>ИЯИ РАН <small>Сотрудники</small></h2>
		</header>
		<nav class="navbar navbar-inverse">
			<ul class="nav navbar-nav">
        		<li class="active"><a>Управление</a></li>
        		<li><a class="not_active" href="/help.php">Справка</a></li>
	        </ul>
		</nav>
		<section>
			<div class="container">
				<br>
				<div class="btn-group-vertical">
					<a class="btn btn-default" href="/employee/new_pre.php">Добавить сотрудника</a>
					<a class="btn btn-default" href="/unit/new.php">Добавить подразделение</a>
					<a class="btn btn-default" href="/publication/new_pre.php">Добавить публикацию</a>
					<a class="btn btn-default" href="/edition/new.php">Добавить издание</a>
					<a class="btn btn-default" href="/sector/new.php">Добавить сектор</a>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-default" href="/employee/view_all.php">Все сотрудники</a>
					<a class="btn btn-default" href="/unit/view_all.php">Все подразделения</a>
					<a class="btn btn-default" href="/edition/view_all.php">Все издания</a>
					<a class="btn btn-default" href="/publication/view_all.php">Все публикации</a>
				</div>
				<br>
				<br>		
			</div>
		</section>
		<footer class="panel-footer">
			<a href="mailto:risentveber@gmail.com"> Risent </a> &copy 
		</footer>
	</div>
</body>
