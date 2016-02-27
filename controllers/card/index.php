<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // SQL Statement
  $query = "SELECT id, name, type, ability, power, toughness, flavor_text, casting_cost FROM fp_card;";

  $result = mysql_query($query);

  mysql_close($mysql_handle);

?>
