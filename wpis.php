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
	<title>Nowy wpis</title>
	<link rel="stylesheet" href="default.css" type="text/css" title="Default" />
	<link rel="alternate stylesheet" href="additional.css" type="text/css" title="Additional" />
</head>
<body>
	<?php include 'menu.php'; ?>
	<?php
		//Check if everything was set in a from
		$fields = array('user_name', 'password', 'content', 'date', 'time');

		$error = false;
		foreach($fields as $fieldname) {
			if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
				$error = true;
			}
		}

		if($error) {
			echo "<h1>Wpis okazał się niemożliwy!</h1>";
			echo "<p>Uzupełnij wszystkie pola formularza!</p>";
			exit();
		}

		//Looking for proper blog - user and password need to be the same
		foreach(glob('./*', GLOB_ONLYDIR) as $dir) {
    	$dirname = basename($dir);

			$handle = fopen($dirname . "/" . "info", "r");

			if($handle && !$error) {
				$owner = fgets($handle);
				$owner = trim($owner);
				$password = fgets($handle);
				$password = trim($password);

				if($owner === $_POST['user_name'] && $password === md5($_POST['password'])) {
					// $fields = array('user', 'password', 'desc', 'date', 'time');
					//Creating proper post file name
					$date = str_replace("-","",$_POST['date']);
					$time = str_replace(":","",$_POST['time']);
					$file_name = $dirname . "/" . $date . $time . date("s");
					//Post file name counter
					$counter = 0;
					while(file_exists($file_name . sprintf('%02d', $counter))) {
						$counter = $counter + 1;
					}
					//Final post file name - creating and writing in
					$file_name = $file_name . sprintf('%02d', $counter);
					$myfile = fopen($file_name, "w");
					fwrite($myfile, $_POST['content']);
					fclose($myfile);

					//============================================================
					//File Upload
					for($it = 1; $it <= sizeof($_FILES); $it++) { //sizeof -> count ???
						// if ($_FILES["fileToUpload" . $it]["size"] == 0 && $_FILES["fileToUpload" . $it]["error"] == 0) {
						//     continue;
						// }
						if($_FILES["fileToUpload" . $it]['name'] == "") {
							continue;
						}

						$target_file = basename($_FILES["fileToUpload" . $it]["name"]);
						$extension = "";
						$i = 0;
						for ($i = 0; $i < strlen($target_file); $i++){
	    				if($target_file[$i] == ".") break;
						}
						$i++;
						for (; $i < strlen($target_file); $i++){
	    				$extension = $extension . $target_file[$i];
						}
						$target_file = $file_name . $it . "." . $extension;


						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						// Check if image file is a actual image or fake image
						// if(isset($_POST["submit"])) {
						//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						//     if($check !== false) {
						//         echo "File is an image - " . $check["mime"] . ".";
						//         $uploadOk = 1;
						//     } else {
						//         echo "File is not an image.";
						//         $uploadOk = 0;
						//     }
						// }
						// Check if file already exists
						if (file_exists($target_file)) {
						    // echo "Sorry, file already exists.";
						    $uploadOk = 0;
						}
						// Check file size
						if ($_FILES["fileToUpload"]["size"] > 1024*1024) {
						    // echo "Sorry, your file is too large.";
						    $uploadOk = 0;
						}
						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) {
						    // echo "<h1>Sorry, your file was not uploaded.</h1>";
						// if everything is ok, try to upload file
						} else {
						    if (move_uploaded_file($_FILES["fileToUpload" . $it]["tmp_name"], $target_file)) {
						        // echo "The file ". basename( $_FILES["fileToUpload" . $it]["name"]). " has been uploaded.";
						    } else {
						        // echo "Sorry, there was an error uploading your file.";
						    }
						}
					}
					//End of file upload
					//======================================================================


					echo "<h1>Dodano nowy wpis na blogu!</h1>";
				}
			}
			fclose($handle);
		}
	?>

	<script src="style.js" type="text/javascript"></script>
</body>
</html>
