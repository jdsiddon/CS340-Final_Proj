<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // SQL Statement
  //$query = "SELECT id, name, ability, power, toughness, flavor_text, casting_cost FROM fp_card;";

  $query = "SELECT
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
                  ORDER BY cd.id desc;";

  $result = mysql_query($query);

  mysql_close($mysql_handle);

?>
