<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // SQL Statement
  $query = "SELECT id, name FROM fp_deck;";
  $result = mysqli_query($query);

  mysqli_close($mysqli_handle);

?>
