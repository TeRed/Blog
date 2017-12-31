<?php
if(!isset($_POST["submit"])) {
	header("Location: blog.php");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Nowy Blog</title>
	<link rel="stylesheet" href="default.css" type="text/css" title="Default" />
	<link rel="alternate stylesheet" href="additional.css" type="text/css" title="Additional" />
</head>
<body>
	<?php include 'menu.php'; ?>

	<?php

		$fields = array('blog_name', 'user_name', 'password', 'description');

		$error = false;
		foreach($fields as $fieldname) {
			if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
				$error = true;
			}
		}

		if($error) {
			echo "<h1>Założenie bloga okazało się niemożliwe!</h1>";
			echo "<p>Uzupełnij wszystkie pola formularza!</p>";
			exit();
		}

		$name = $_POST['blog_name'];

		$files = array_diff(scandir('./'), array('.', '..'));
		foreach ($files as $file) {
			if(substr($file, -4) == ".php") continue;
			if(substr($file, -4) == ".css") continue;
			$handle = fopen($file . "/info", "r");
			if(trim(fgets($handle)) == $_POST['user_name']) {
				echo "<h1>Założenie bloga okazało się niemożliwe!</h1>";
				echo "<p>Istnieje już użytkownik o podanej nazwie.</p>";
				fclose($handle);
				exit();
			}
			fclose($handle);
		}

		if (!file_exists($name)) {
	    		mkdir($name, 0755, true);
		} else {
			echo "<h1>Założenie bloga okazało się niemożliwe!</h1>";
			echo "<p>Istnieje już blog o podanej nazwie.</p>";
			exit();
		}

		$myfile = fopen($name . "/" . "info", "w");

		fwrite($myfile, $_POST['user_name'] . "\n");

		fwrite($myfile, md5($_POST['password']) . "\n");

		fwrite($myfile, $_POST['description']);
		fclose($myfile);

		echo "<h1> Blog '" . $name . "' został założony!</h1>";
	?>

	<script src="style.js" type="text/javascript"></script>
</body>
</html>
