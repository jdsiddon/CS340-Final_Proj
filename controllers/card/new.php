<?php include_once("../../database.php"); ?>

<?php
  // This script gets the colors and types that can be assigned to a card for use on the 'insert' template.

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // SQL Statement, get all the colors from the color table.
  $query = "SELECT id, name FROM fp_color;";
  $colors = mysql_query($query);

  // SQL Statement, get all the types from the type table.
  $query = "SELECT id, name FROM fp_type;";
  $types = mysql_query($query);

  mysql_close($mysql_handle);

?>
