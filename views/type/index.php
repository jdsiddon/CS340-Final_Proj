<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>

<? include ROOT_DIR."/controllers/type/index.php" ?>

<? include "../header.php" ?>

    <h1>Types</h1>
    <table class="table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>&nbsp;</th>
      </tr>

    <?php
      while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
          echo '<td>'.$row[id].'</td>';
          echo '<td>'.$row[name].'</td>';
          echo '<td>';
          echo  '<a class="btn btn-default" href="'.$views.'type/edit.php?id='.$row[id].'">';
          echo   '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit';
          echo  '</a>';
          echo '</td>';
        echo '</tr>';
      }
    ?>
    </table>

<? include "../footer.php" ?>
