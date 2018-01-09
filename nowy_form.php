<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Nowy Blog - Formularz</title>
	<link rel="stylesheet" href="default.css" type="text/css" title="Default" />
	<link rel="stylesheet" href="additional.css" type="text/css" title="Additional" />
</head>
<body>
	<?php include 'menu.php'; ?>
	<h1>Nowy blog</h1>
	<form action="nowy.php" method="post">
	  <label for="blog_name">Nazwa bloga:</label><br />
	  <input type="text" id="blog_name" name="blog_name" /><br />

	  <label for="user_name">Nazwa użytkownika:</label><br />
	  <input type="text" id="user_name" name="user_name" /><br />

	  <label for="password">Hasło użytkownika:</label><br />
	  <input type="password" id="password" name="password" /><br />

	  <label for="description">Opis:</label><br />
	  <textarea id="description" name="description" cols="60" rows="5"></textarea><br />

	  <input type="submit" name="submit" value="Wyślij"><br />
	  <input type="reset" value="Wyczyść">
	</form>

	<script src="style.js" type="text/javascript"></script>
</body>
</html>
