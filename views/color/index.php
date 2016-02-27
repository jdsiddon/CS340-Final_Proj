<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>

<? include ROOT_DIR."/controllers/color/index.php" ?>

<? include "../header.php" ?>

    <h1>Colors</h1>
    <table class="table">
      <tr>
        <th>ID</th>
        <th>Name</th>
      </tr>

    <?php
      while ($row = mysql_fetch_array($result)) {
        echo '<tr>';
          echo '<td>'.$row[id].'</td>';
          echo '<td>'.$row[name].'</td>';
        echo '</tr>';
      }
    ?>
    </table>

<? include "../footer.php" ?>
