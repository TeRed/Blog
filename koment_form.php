<?php
if(!isset($_POST["submit"])) {
	header("Location: blog.php");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Nowy komentarz - formularz</title>
	<link rel="stylesheet" href="default.css" type="text/css" title="Default" />
	<link rel="alternate stylesheet" href="additional.css" type="text/css" title="Additional" />
</head>
<body>
	<?php include 'menu.php'; ?>
	<h1>Nowy komentarz</h1>
  <form action="koment.php" method="post">

		<label for="comment_type">Rodzaj komentarza:</label><br />
		<select id="comment_type" name="comment_type">
			<option value="positive">Pozytywny</option>
			<option value="negative">Negatywny</option>
			<option value="neutral">Neutralny</option>
		</select><br />

		<label for="content">Komentarz:</label><br />
		<textarea id="content" name="content" cols="60" rows="5"></textarea><br />

		<label for="author">Autor:</label><br />
	  <input id="author" type="text" name="author" /><br />

    <input name="wpis_id" type="hidden" value="<?php echo $_POST['wpis_id']; ?>">

	  <input type="submit" name="submit" value="Wyślij">
	  <input type="reset" value="Wyczyść">
	</form>

	<script src="style.js" type="text/javascript"></script>
</body>
</html>
