<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>

<? include ROOT_DIR."/controllers/owner/index.php" ?>

<? include "../header.php" ?>

    <h1>Owners</h1>
    <table class="table">
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Collection Size</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

    <?php
      while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
          echo '<td>'.$row[id].'</td>';
          echo '<td>'.$row[fname].'</td>';
          echo '<td>'.$row[lname].'</td>';
          echo '<td>'.$row[collection_size].'</td>';
          echo '<td>';
          echo  '<a class="btn btn-default" href="'.$views.'owner/edit.php?id='.$row[id].'">';
          echo   '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit';
          echo  '</a>';
          echo '</td>';
          echo '<td>';
          echo  '<a class="btn btn-danger" href="#" value="'.$row[id].'">';
          echo   '<span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span> Delete';
          echo  '</a>';
          echo '</td>';
        echo '</tr>';
      }
    ?>
    </table>

<? include "../footer.php" ?>

<script>
  $(document).ready(function() {
    // When form is submitted.
    $( "a.btn-danger" ).click(function() {
      // get the form data
      var formData = {
        'owner_id': $(this).attr("value")
      };

      var route = "<?php echo $controllers; ?>owner/delete.php";      // Route to controllers folder.

      // POST form data.
      $.post( route, formData, function( data ) {
        var parsedData = JSON.parse(data);
        location.reload();
        console.log(parsedData.success);

        if(parsedData.success) {        // Insert was successful.
          $( ".alert-success" ).html( parsedData.message );     // Set content.
          $(".alert-success").alert();

          // Fade success away.
          $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").alert('close');
          });

        } else {
          $( ".alert-danger" ).html( parsedData.message );     // Set content.
          $(".alert-danger").alert();

          // Fade failure away.
          $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-danger").alert('close');
          });
        }

      }).fail(function() {        // Total server error.
        $(".alert-danger").alert();
        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
          $(".alert-danger").alert('close');
        });
      })

      event.preventDefault();
    })

  })
</script>
