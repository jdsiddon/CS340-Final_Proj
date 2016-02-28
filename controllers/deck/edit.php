<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // The deck to add cards to is in the get parameters of the url 'http://localhost:8888/Final_Project/views/deck/edit.php?id=XX'.
  if (isset($_GET['id'])) {
    $deck_id = mysql_escape_string($_GET['id']);
  } else{
    $deck_id = 0;
  }

  // SQL Statement, get deck
  $query = "SELECT id, name FROM fp_deck WHERE fp_deck.id = '$deck_id' limit 1;";       // Get deck with id that user requested in url string.
  $result = mysql_query($query);

  $deck = mysql_fetch_array($result);     // Get deck instance.


  // SQL Statement, get cards owner has.
  // $query = "SELECT id, name FROM fp_deck WHERE fp_deck.id = '$deck_id' limit 1;";       // Get deck with id that user requested in url string.
  // $result = mysql_query($query);




  mysql_close($mysql_handle);


?>
