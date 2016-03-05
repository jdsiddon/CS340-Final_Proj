<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // The deck to add cards to is in the get parameters of the url 'http://localhost:8888/Final_Project/views/deck/edit.php?id=XX'.
  if (isset($_GET['id'])) {
    $card_id = mysql_escape_string($_GET['id']);
  } else{
    $card_id = 0;
  }

  // Get card.
  $query_card = "SELECT
                  cd.id AS id,
                  cd.name AS card_name,
                  clr.name AS card_color,
                  t.name AS card_type,
                  cd.ability AS card_ability,
                  cd.power AS card_power,
                  cd.toughness AS card_power,
                  cd.flavor_text AS card_flavor_text,
                  cd.casting_cost AS card_casting_cost FROM fp_card AS cd
                    INNER JOIN fp_card_color AS cc ON cc.card_id = cd.id
                    INNER JOIN fp_color as clr ON clr.id = cc.color_id
                    INNER JOIN fp_card_type AS ct ON ct.card_id = cd.id
                    INNER JOIN fp_type AS t on t.id = ct.type_id
                    WHERE cd.id = '$card_id';";

  $card = mysql_query($query_card);

  $card = mysql_fetch_array($card);     // Get deck instance.

  // Get all of the card colors.
  $query_card_color = "SELECT clr.id, clr.name FROM fp_color AS clr INNER JOIN fp_card_color AS cc ON cc.card_id = '$card_id';";

  $card_colors = mysql_query($query_card_color);


  mysql_close($mysql_handle);

?>
