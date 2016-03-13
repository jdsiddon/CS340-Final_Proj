<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // The deck to add cards to is in the get parameters of the url 'http://localhost:8888/Final_Project/views/deck/edit.php?id=XX'.
  if (isset($_GET['id'])) {
    $card_id = mysqli_escape_string($_GET['id']);
  } else{
    $card_id = 0;
  }

  // SQL Statement
  $query = "SELECT
              cd.id AS id,
              cd.name AS card_name,
              cd.ability AS card_ability,
              cd.power AS card_power,
              cd.toughness AS card_toughness,
              cd.flavor_text AS card_flavor_text,
              cd.casting_cost AS card_casting_cost FROM fp_card AS cd
                  WHERE cd.id = '$card_id';";

  $result = mysqli_query($mysqli_handle, $query);

  $data = array();        // $data is what the view will use.

  // Create own array so we have cards with colors.
  $card = mysqli_fetch_array($result);

  // COLORS
  $card[colors] = array();      // Create an array for the cards colors.

  // Get colors of individual card.
  $color_query = "SELECT clr.name AS card_color, clr.id AS card_color_id FROM fp_card_color AS cc
    INNER JOIN fp_color as clr ON clr.id = cc.color_id
    WHERE cc.card_id = '$card[id]';";

  $card_colors = mysqli_query($mysqli_handle, $color_query);

  // Add colors to card color subarray.
  while($color = mysqli_fetch_array($card_colors)) {
    array_push($card[colors], $color);
  }

  // Get card owner.
  $card_owner_query = "SELECT own.id AS card_owner_id FROM fp_owner AS own
    INNER JOIN fp_collection as col ON col.owner_id = own.id
    WHERE col.card_id = '$card[id]';";

  $card_owner = mysqli_fetch_array(mysqli_query($mysqli_handle, $card_owner_query));

  $card[card_owner] = $card_owner[card_owner_id];
  // End individual owner.


  // TYPES
  $card[types] = array();      // Create an array for the cards colors.
  // Get types of individual card.
  $card_type_query = "SELECT t.name AS card_type, t.id AS card_type_id FROM fp_card_type AS ct
    INNER JOIN fp_type AS t on t.id = ct.type_id
    WHERE ct.card_id = '$card[id]';";

  $card_types = mysqli_query($mysqli_handle, $card_type_query);

  // Add types to card type subarray.
  while($type = mysqli_fetch_array($card_types)) {
    array_push($card[types], $type);
  }
  // End get card types.


  // SQL Statement, get all the colors from the color table.
  $query = "SELECT id, name FROM fp_color;";
  $colors = mysqli_query($mysqli_handle, $query);

  // SQL Statement, get all the types from the type table.
  $query = "SELECT id, name FROM fp_type;";
  $types = mysqli_query($mysqli_handle, $query);

  // SQL Statement, get all the owners that can own a card from the owners table.
  $query = "SELECT id, fname, lname FROM fp_owner;";
  $owners = mysqli_query($mysqli_handle, $query);

  mysqli_close($mysqli_handle);

?>
