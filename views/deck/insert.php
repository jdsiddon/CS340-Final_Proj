<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>
<?php require_once( ROOT_DIR.'/controllers/card/new.php' ); ?>

<? include "../header.php" ?>

    <h1>Create Deck</h1>
    <form action="/" method="post" id="insert">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
      </div>

      <div class="form-group">
        <label for="name">Owner</label>
        <select class="form-control" name="owner">
        <?php
          // Loop through each color.
          while ($owner = mysqli_fetch_array($owners)) {
            echo '<option value="'.$owner[id].'">'.$owner[lname].', '.$owner[fname].'</option>';
          }
        ?>
        </select>
      </div>

      <button type="submit" class="btn btn-default">Insert</button>
    </form>

<? include "../footer.php" ?>



<script>
  $(document).ready(function() {
    var form = document.getElementById('insert');

    // When form is submitted.
    $( "#insert" ).submit(function( event ) {

      // get the form data
      var formData = {
        'name': $('input[name=name]').val(),
        'owner': $('select[name=owner]').val()
      };

      var route = "<?php echo $controllers; ?>deck/insert.php";      // Route to controllers folder.

      console.log(formData);
      // POST form data.
      $.post( route, formData, function( data ) {
        var parsedData = JSON.parse(data);

        console.log(parsedData.success);

        if(parsedData.success) {        // Insert was successful.
          $( ".alert-success" ).html( parsedData.message );     // Set content.
          $(".alert-success").alert();

          // Fade success away.
          $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").alert('close');
          });

          // Post was successful so clear all form input.
          for(var i=0; i < form.elements.length; i++){
            var e = form.elements[i];
            e.value = '';
          }

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
