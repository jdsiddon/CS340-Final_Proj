<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // The deck to add cards to is in the get parameters of the url 'http://localhost:8888/Final_Project/views/deck/edit.php?id=XX'.
  if (isset($_GET['id'])) {
    $type_id = mysql_escape_string($_GET['id']);
  } else{
    $type_id = 0;
  }

  // Update Card in Owner's collection.
  $query = "SELECT id, name FROM fp_type WHERE id=$type_id limit 1;";
  $result = mysql_query($query);
  $type = mysql_fetch_array($result);


  mysql_close($mysql_handle);

?>
