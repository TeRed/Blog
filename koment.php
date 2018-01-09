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
	<title>Nowy komentarz</title>
	<link rel="stylesheet" href="default.css" type="text/css" title="Default" />
	<link rel="stylesheet" href="additional.css" type="text/css" title="Additional" />
</head>
<body>
	<?php include 'menu.php'; ?>
  <?php
		//Check if everything was set in a from
		$fields = array('comment_type', 'content', 'author', 'wpis_id');

		$error = false;
		foreach($fields as $fieldname) {
			if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
				$error = true;
			}
		}

		if($error) {
			echo "<h1>Dodanie komentarza okazało się niemożliwe!</h1>";
			echo "<p>Uzupełnij wszystkie pola formularza!</p>";
			exit();
		}

		//Looking for proper blog post
		foreach(glob('./*', GLOB_ONLYDIR) as $dir) {
    	$dirname = basename($dir);

      $files = array_diff(scandir($dirname), array('.', '..', 'info'));
			foreach ($files as $file) {
				//Proper blog cause we found our blog post
				if($file === $_POST['wpis_id']) {

					//Create comment folder if no were added so far
          if(!file_exists($dirname . '/' . $_POST['wpis_id'] . '.k')) {
            mkdir($dirname . '/' . $_POST['wpis_id'] . '.k', 0755, true);
          }

					//Looking for proper comment file number
          $counter = 0;
          while(file_exists($dirname . '/' . $_POST['wpis_id'] . '.k/' . $counter)) {
						$counter++;
					}
					//Creating comment file
          $myfile = fopen($dirname . '/' . $_POST['wpis_id'] . '.k' . '/' . $counter, "w");

					//Saving data to comment file
					if($myfile) {
	          fwrite($myfile, $_POST['comment_type'] . "\n");
	          date_default_timezone_set('Europe/Warsaw');
	          $date = date('Y-m-d, H:i:s');
	          fwrite($myfile, $date . "\n");
	          fwrite($myfile, $_POST['author'] . "\n");
	          fwrite($myfile, $_POST['content']);
					}

					//Success
					echo "<h1>Dodano nowy komentarz!</h1>";

					//Closing file
          fclose($myfile);
        }
			}
		}
	?>

	<script src="style.js" type="text/javascript"></script>
</body>
</html>
