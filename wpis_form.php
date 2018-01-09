<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Nowy wpis - formularz</title>
	<link rel="stylesheet" href="default.css" type="text/css" title="Default" />
	<link rel="stylesheet" href="additional.css" type="text/css" title="Additional" />
</head>
<body>
	<?php include 'menu.php'; ?>
	<h1>Nowy wpis</h1>
	<form action="wpis.php" method="post" enctype="multipart/form-data">
		<label for="user_name">Nazwa użytkownika:</label><br />
		<input type="text" id="user_name" name="user_name" /><br />

		<label for="password">Hasło użytkownika:</label><br />
		<input type="password" id="password" name="password" /><br />

		<label for="content">Wpis:</label><br />
		<textarea id="content" name="content" cols="60" rows="5"></textarea><br />

		<label for="date">Data:</label><br />
		<input type="text" id="date" name="date" value=""/><br>
		<?php //echo date("Y-m-d");?>
		<!-- pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" -->

		<label for="time">Godzina:</label><br />
		<input type="text" id="time" name="time" /><br>
		<!-- pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])" -->

		<input type="file" name="fileToUpload1" /><br />

		<input type="button" value="Kolejny plik" id="nextFile"><br />

		<input type="submit" name="submit" value="Wyślij">
		<input type="reset" value="Wyczyść">
	</form>

	<script src="wpis_autohelp.js" type="text/javascript"></script>
	<script src="style.js" type="text/javascript"></script>
</body>
</html>
