<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>
<?php require_once( ROOT_DIR.'/controllers/owner/edit.php' ); ?>

<? include "../header.php" ?>

    <h1>Edit Owner</h1>
    <form action="/" method="post" id="edit">
      <?php
        echo '<input type="text" name="id" id="id" value="'.$owner[id].'" hidden disabled>';
      ?>
      <div class="form-group">
        <label for="name">First Name</label>
        <?php
          echo '<input type="text" class="form-control" name="fname" id="fname" value="'.$owner[fname].'">';
        ?>
        <label for="name">Last Name</label>
        <?php
          echo '<input type="text" class="form-control" name="lname" id="lname" value="'.$owner[lname].'">';
        ?>
      </div>

      <button type="submit" class="btn btn-default">Update</button>
    </form>

<? include "../footer.php" ?>



<script>
  $(document).ready(function() {
    var form = document.getElementById('edit');

    // When form is submitted.
    $( "#edit" ).submit(function( event ) {
      // get the form data
      var formData = {
        'id': $('input[name=id]').val(),
        'fname': $('input[name=fname]').val(),
        'lname': $('input[name=lname]').val()
      };

      var route = "<?php echo $controllers; ?>owner/update.php";      // Route to controllers folder.

      console.log(formData);
      console.log(route);
      // POST form data.
      $.post( route, formData, function( data ) {
        var parsedData = JSON.parse(data);

        console.log(parsedData);
        console.log(parsedData);

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
