<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // SQL Statement
  $query = "SELECT o.id, o.fname, o.lname, COUNT(cl.card_id) AS collection_size FROM fp_collection AS cl
              INNER JOIN fp_owner AS o ON o.id=cl.owner_id
              GROUP BY o.id;";
  $result = mysql_query($query);

  mysql_close($mysql_handle);

?>
