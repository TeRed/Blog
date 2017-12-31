<?php
//Max dialogs kept for communicator
$max = 7;

//Open the File Stream
$handle = fopen("communicator.db","r+");

//Lock File
if(flock($handle, LOCK_EX)) {

    //Number lines - to check if under max
    $linecount = 0;
    while(!feof($handle)){
      fgets($handle);
      $linecount++;
    }

    //Back to beggining
    rewind($handle);

    //If more than max - delete line
    while($linecount > $max) {
      //Read file
      $data = fread($handle, filesize("communicator.db"));

      //Erase file
      rewind($handle);
      file_put_contents("communicator.db", "");

      //Delete beginning line
      $data = substr($data, strpos($data, "\n") + 1);

      //Add data again to file
      file_put_contents("communicator.db", $data);

      $linecount--;
    }

    //Go to end of file
    while(!feof($handle)){
      fgets($handle);
    }

    //Add received data to db
    fwrite($handle, $_GET["user_name"] . ": " . $_GET["content"] . "\n");
    fflush($handle);
    flock($handle, LOCK_UN);
}

//Close file handle
fclose($handle);

?>
