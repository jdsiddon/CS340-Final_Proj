<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // SQL Statement
  $query = "SELECT
              cd.id AS id,
              cd.name AS card_name,
              cd.ability AS card_ability,
              cd.power AS card_power,
              cd.toughness AS card_power,
              cd.flavor_text AS card_flavor_text,
              cd.casting_cost AS card_casting_cost FROM fp_card AS cd
                  GROUP BY cd.id
                  ORDER BY cd.id desc;";

  $result = mysqli_query($mysqli_handle, $query);

  $data = array();        // $data is what the view will use.

  // Create own array so we have cards with colors.
  while ($card = mysqli_fetch_array($result)) {
    $key = $card[id];             // Make key the card id.
    if (!isset($data[$key])) {
      $data[$key] = array();      // Create an array for each individual card.
    }


    // COLORS
    $card[colors] = array();      // Create an array for the cards colors.

    // Get colors of individual card.
    $color_query = "SELECT clr.name AS card_color FROM fp_card_color AS cc
      INNER JOIN fp_color as clr ON clr.id = cc.color_id
      WHERE cc.card_id = '$card[id]';";

    $colors = mysqli_query($mysqli_handle, $color_query);

    // Add colors to card color subarray.
    while($color = mysqli_fetch_array($colors)) {
      array_push($card[colors], $color);
    }


    // TYPES
    $card[types] = array();      // Create an array for the cards colors.

    // Get types of individual card.
    $type_query = "SELECT t.name AS card_type FROM fp_card_type AS ct
      INNER JOIN fp_type AS t on t.id = ct.type_id
      WHERE ct.card_id = '$card[id]';";

    $types = mysqli_query($mysqli_handle, $type_query);

    // Add types to card type subarray.
    while($type = mysqli_fetch_array($types)) {
      array_push($card[types], $type);
    }

    // Add card to data.
    $data[$key] = $card;
  }

  mysqli_close($mysqli_handle);

?>
