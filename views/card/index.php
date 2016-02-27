<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>

<? include ROOT_DIR."/controllers/card/index.php" ?>

<? include "../header.php" ?>

    <h1>Card</h1>
    <table class="table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Ability</th>
        <th>Power</th>
        <th>Toughness</th>
        <th>Flavor Text</th>
        <th>Casting Cost</th>
      </tr>

    <?php
      while ($row = mysql_fetch_array($result)) {
        echo '<tr>';
          echo '<td>'.$row[id].'</td>';
          echo '<td>'.$row[name].'</td>';
          echo '<td>'.$row[type].'</td>';
          echo '<td>'.$row[ability].'</td>';
          echo '<td>'.$row[power].'</td>';
          echo '<td>'.$row[toughness].'</td>';
          echo '<td>'.$row[flavor_text].'</td>';
          echo '<td>'.$row[casting_cost].'</td>';
        echo '</tr>';
      }
    ?>
    </table>

<? include "../footer.php" ?>
