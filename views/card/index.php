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
        <th></th>
      </tr>

    <?php
      foreach ($data as $key => $card) {
        echo '<tr>';
          echo '<td>'.$card[id].'</td>';
          echo '<td>'.$card[card_name].'</td>';
          echo '<td>';
          foreach ($card[colors] as $k => $color) {
            if($color[card_color] == "Green") {
              echo' <span class="label label-success">';
            }
            if($color[card_color] == "Red") {
              echo' <span class="label label-danger">';
            }
            if($color[card_color] == "Black") {
              echo' <span class="label label-default">';
            }
            if($color[card_color] == "Blue") {
              echo' <span class="label label-primary">';
            }
            if($color[card_color] == "White") {
              echo' <span class="label label-warning">';
            }
            if($color[card_color] == "Colorless") {
              echo' <span class="label label-info">';
            }
            echo $color[card_color].'</span>';
            echo '<br>';
          }
          echo '</td>';
          echo '<td>';
          foreach ($card[types] as $k => $type) {
            echo $type[card_type].', ';
          }
          echo '</td>';
          echo '<td>'.$card[card_ability].'</td>';
          echo '<td>'.$card[card_power].'</td>';
          echo '<td>'.$card[card_toughness].'</td>';
          echo '<td>'.$card[card_flavor_text].'</td>';
          echo '<td>'.$card[card_casting_cost].'</td>';
          echo '<td>';
          echo  '<a class="btn btn-default" href="'.$views.'card/edit.php?id='.$card[id].'">';
          echo   '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit';
          echo  '</a>';
          echo '</td>';
        echo '</tr>';
      }
    ?>
    </table>

<? include "../footer.php" ?>
