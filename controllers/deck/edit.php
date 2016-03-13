<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // The deck to add cards to is in the get parameters of the url 'http://localhost:8888/Final_Project/views/deck/edit.php?id=XX'.
  if (isset($_GET['id'])) {
    $deck_id = mysqli_escape_string($_GET['id']);
  } else{
    $deck_id = 0;
  }

  // SQL Statement, get deck
  $query = "SELECT id, name FROM fp_deck WHERE fp_deck.id = '$deck_id' limit 1;";       // Get deck with id that user requested in url string.
  $result = mysqli_query($query);

  $deck = mysqli_fetch_array($result);     // Get deck instance.

  // SQL Statement, get deck owner owner has.
  $query = "SELECT do.owner_id AS id, o.fname, o.lname FROM fp_deck_owner AS do
              LEFT JOIN fp_owner AS o ON o.id=do.owner_id;"; // Get deck owner.
  $deck_owner = mysqli_fetch_array(mysqli_query($query));


  // SQL Statement, get cards owner has.
  $query = "SELECT c.id, c.name, dc.deck_id, cl.owner_id FROM fp_card AS c
              LEFT JOIN fp_deck_card AS dc ON dc.card_id=c.id
              LEFT JOIN fp_collection AS cl ON cl.card_id=c.id
              WHERE cl.owner_id='$deck_owner[id]'
              GROUP BY c.id;";       // Get deck with id that user requested in url string.
  $cards = mysqli_query($query);



  mysqli_close($mysqli_handle);


?>
