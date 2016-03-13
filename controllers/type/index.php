<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // SQL Statement
  $query = "SELECT id, name FROM fp_type;";
  $result = mysqli_query($mysqli_handle, $query);

  mysqli_close($mysqli_handle);

?>
