<?php include_once("../../database.php"); ?>

<?php
  // This script gets the colors and types that can be assigned to a card for use on the 'insert' template.

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // SQL Statement, get all the owners that can own a card from the owners table.
  $query = "SELECT id, fname, lname FROM fp_owner;";
  $owners = mysqli_query($mysqli_handle, $query);

  mysqli_close($mysqli_handle);

?>
