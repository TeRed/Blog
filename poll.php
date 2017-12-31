<?php

// Set php runtime to unlimited
set_time_limit(0);

$data_source_file = "communicator.db";

while (true) {
  //Check if user send when he last received data, if no value then 0
  $last_ajax_call = isset($_GET["timestamp"]) ? (int)$_GET["timestamp"] : 0;

  //No cache to get latest file size
  clearstatcache();
  //Date of last change of file
  $last_change_in_data_file = filemtime($data_source_file);
  //Checking if there is already need to send data
  if ($last_change_in_data_file > $last_ajax_call) {

			//Open the File Stream
			$handle = fopen("communicator.db","r+");

			//Lock file
			if(flock($handle, LOCK_EX)) {
				$data = fread($handle, filesize("communicator.db"));
        fflush($handle);
				flock($handle, LOCK_UN);
			}

			//Close handle
			fclose($handle);

      //Data to be send back
      $result = array(
          "data" => ($data == false ? "" : $data),
          "timestamp" => $last_change_in_data_file
      );

      //Encode and echo data
      $json = json_encode($result);
      echo $json;

      //End of script
      break;
  } else {
    //Wait 1 sec to check again if sending data nedded
    sleep(1);
  }
}
?>
