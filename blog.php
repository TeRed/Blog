<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Blog</title>
	<link rel="stylesheet" href="default.css" type="text/css" title="Default" />
	<link rel="stylesheet" href="additional.css" type="text/css" title="Additional" />
</head>
<body>
	<?php include 'menu.php'; ?>
	<?php
    //Blog name not set
    if(!isset($_GET["nazwa"]) || empty($_GET["nazwa"])) {
      echo "<h1>Dostępne Blogi</h1>";
      echo "<ul>";

      //List all availaible directories/blogs
      foreach(glob('./*', GLOB_ONLYDIR) as $dir) {
      	$dirname = basename($dir);
        echo'<li><a href="blog.php?nazwa=' . $dirname . '">' . $dirname . '</li></a>';
				echo "<p>Opis bloga `$dirname`: ";
				$handle = fopen($dirname . "/info", "r");
				$tmp = fgets($handle);
				$tmp = fgets($handle);
				while(! feof($handle)) {
					echo fgets($handle);
				}
				fclose($handle);
      }

      echo "</ul>";
    }
    //Blog name set
    else {

      //Blog exist
      if(file_exists($_GET["nazwa"])) {
        echo "<h1>" . $_GET["nazwa"] . "</h1>";

        $files = array_diff(scandir($_GET["nazwa"]), array('.', '..', 'info'));
        foreach ($files as $file) {
          if (strpos($file, ".") !== false) continue; //Kick out comments folders
          $handle = fopen($_GET["nazwa"] . "/" . $file, "r");
          echo '<div class="blog-post">';
          echo "<h2>Wpis:</h2>";
          echo '<p>';
          while(! feof($handle)) {
            echo fgets($handle);
          }
          echo '</p>';
					fclose($handle);

					$uploadedFiles = array_diff(scandir($_GET["nazwa"]), array('.', '..', 'info'));

					echo "<h3>Pliki:</h3>";
					foreach($uploadedFiles as $upload){
						if(strpos($upload, ".") === false) continue;
						if(substr($upload, -2) == ".k") continue;
						$uploadName = substr($upload, 0, 16);
						if($uploadName == $file) {
							// echo $uploadName . "<br />";
							$uploadPath = $_GET["nazwa"] . '/'  . $upload;
							// echo $uploadPath . "<br />";
							echo '<a href="' . $uploadPath . '">LINK</a>' . "<br />";
						}
					}

					//Wypisywanie komentarzy
					echo "<h3>Komentarze:</h3>";
					$comments = array_diff(scandir($_GET["nazwa"] . "/" . $file . ".k"), array('.', '..', 'info'));

					foreach($comments as $comment) {
						$handle = fopen($_GET["nazwa"] . "/" . $file . ".k/" . $comment, "r");
						echo "<p>Rodzaj: " . fgets($handle) . "</p>"; //Rodzaj
						echo "<p>Data oraz godzina: " . fgets($handle) . "</p>"; // Godzina i data
						echo "<p>Autor: " . fgets($handle) . "</p>"; // Autor

						//Treść
						echo "<p>Treść: ";
						while(! feof($handle)) {
            	echo fgets($handle);
          	}
						echo "</p>";
						echo "<hr />";
						fclose($handle);
					}

          //echo '<a href="koment_form.php?wpis_id='. $file .'">Napisz kometarz</a>';
					echo <<<_END
					<form action="koment_form.php" method="post">
						<input name="wpis_id" type="hidden" value="$file">
						<input type="submit" name="submit" value="Dodaj komentarz">
					</form>
_END;
          echo "</div>";

        }

      }
      //Blog not exist
      else {
        echo "<h1>Nie znaleziono szukanego bloga</h1>";
        echo '<a href="blog.php">Zobacz dostępne blogi!</a>';
      }
    }
  ?>

	<form id="communicator">
		<fieldset>
			<legend>Komunikator</legend>
			<label for="activated">Aktywuj komunikator:</label>
			<input type="checkbox" id="activated" /><br /><br />

			<textarea id="communicatorText" cols="60" rows="10"></textarea><br /><br />

			<label for="user_name">Nazwa użytkownika:</label>
			<input type="text" id="user_name" /><br />

			<label for="content">Treść komunikatu:</label>
			<input type="text" id="content" /><br /><br />

			<input type="submit" value="Wyślij" />
		</fieldset>
	</form>

	<script src="communicator.js" type="text/javascript"></script>
	<script src="style.js" type="text/javascript"></script>
</body>
</html>
