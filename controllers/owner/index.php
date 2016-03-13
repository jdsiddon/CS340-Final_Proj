<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // SQL Statement
  $query = "SELECT o.id, o.fname, o.lname, IFNULL(COUNT(cl.card_id), 0) AS collection_size FROM fp_collection AS cl
              RIGHT JOIN fp_owner AS o ON o.id=cl.owner_id
              GROUP BY o.id;";
  $result = mysqli_query($query);

  mysqli_close($mysqli_handle);

?>
