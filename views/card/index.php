<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>

<? include ROOT_DIR."/controllers/card/index.php" ?>

<? include "../header.php" ?>

    <h1>Card</h1>
    <table class="table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Color</th>
        <th>Type</th>
        <th>Ability</th>
        <th>Power</th>
        <th>Toughness</th>
        <th>Flavor Text</th>
        <th>Casting Cost</th>
      </tr>
<!-- cd.id, cd.name, clr.name, cd.ability, cd.power, cd.toughness, cd.flavor_text, cd.casting_cost -->
<!-- cd.id AS id,
cd.name AS card_name,
clr.name AS card_color,
cd.ability AS card_ability,
cd.power AS card_power,
cd.toughness AS card_power,
cd.flavor_text AS card_flavor_text,
cd.casting_cost AS card_casting_cost -->
    <?php
      while ($row = mysql_fetch_array($result)) {
        echo '<tr>';
          echo '<td>'.$row[id].'</td>';
          echo '<td>'.$row[card_name].'</td>';
          echo '<td>'.$row[card_color].'</td>';
          echo '<td>'.$row[card_type].'</td>';
          echo '<td>'.$row[card_ability].'</td>';
          echo '<td>'.$row[card_power].'</td>';
          echo '<td>'.$row[card_toughness].'</td>';
          echo '<td>'.$row[card_flavor_text].'</td>';
          echo '<td>'.$row[card_casting_cost].'</td>';
        echo '</tr>';
      }
    ?>
    </table>

<? include "../footer.php" ?>
