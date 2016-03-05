<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>
<?php require_once( ROOT_DIR.'/controllers/card/edit.php' ); ?>

<? include "../header.php" ?>

    <h1>Edit Card</h1>
    <form action="/" method="post" id="edit">

      <div class="form-group">
        <label for="name">Owner</label>
        <select class="form-control" name="owner">
        <?php
          // Loop through each color.
          while ($owner = mysql_fetch_array($owners)) {
            echo '<option value="'.$owner[id].'">'.$owner[lname].', '.$owner[fname].'</option>';
          }
        ?>
        </select>
      </div>


      <div class="form-group">
        <label for="name">Name</label>
        <?php
          echo '<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="'.$card[card_name].'">'; 
        ?>
      </div>


      <div class="form-group">
        <label for="color">Color</label>
        <div class="checkbox" name="colors" id="colors" required>
        <?php
          // Loop through each color.
          while ($color = mysql_fetch_array($colors)) {
            echo '<label class="checkbox-inline"><input type="checkbox" value="'.$color[id].'" name="color">'.$color[name].'</label>';
          }
        ?>
        </div>
      </div>

      <div class="form-group">
        <label for="type">Type</label>
        <div class="checkbox" name="types" id="types" required>
        <?php
          // Loop through each type.
          while ($type = mysql_fetch_array($types)) {
            echo '<label class="checkbox-inline"><input type="checkbox" value="'.$type[id].'" name="type">'.$type[name].'</label>';
          }
        ?>
        </div>
      </div>

      <div class="form-group">
        <label for="ability">Ability</label>
        <textarea class="form-control" name="ability" id="ability" placeholder="Ability" rows="4" required></textarea>
      </div>

      <div class="form-group">
        <label for="power">Power</label>
        <input type="number" class="form-control" name="power" id="power">
      </div>

      <div class="form-group">
        <label for="toughness">Toughness</label>
        <input type="number" class="form-control" name="toughness" id="toughness">
      </div>

      <div class="form-group">
        <label for="flavor-text">Flavor Text</label>
        <textarea class="form-control" name="flavor-text" id="flavor-text" placeholder="Flavor text" rows="4"></textarea>
      </div>

      <div class="form-group">
        <label for="casting-cost">Casting Cost</label>
        <input type="number" class="form-control" name="casting-cost" id="casting-cost" required>
      </div>

      <button type="submit" class="btn btn-default">Insert</button>
    </form>

<? include "../footer.php" ?>



<script>
  $(document).ready(function() {
    var form = document.getElementById('edit');

    // When form is submitted.
    $( "#insert" ).submit(function( event ) {
      var types = [];                                   // Array to hold all card types.
      var colors = [];

      $('input[name=type]:checked').each(function(idx) {    // Add each type to the types array.
        types.push($(this).val());
      })

      $('input[name=color]:checked').each(function(idx) {    // Add each type to the types array.
        colors.push($(this).val());
      })

      // get the form data
      var formData = {
        'owner': $('select[name=owner]').val(),
        'name': $('input[name=name]').val(),
        'colors': JSON.stringify(colors),
        'types': JSON.stringify(types),
        'ability': $('textarea[name=ability]').val(),
        'power': $('input[name=power]').val(),
        'toughness': $('input[name=toughness]').val(),
        'flavor_text': $('textarea[name=flavor-text]').val(),
        'casting_cost': $('input[name=casting-cost]').val()
      };

      var route = "<?php echo $controllers; ?>card/update.php";      // Route to controllers folder.

      console.log(formData);
      // POST form data.
      $.post( route, formData, function( data ) {
        var parsedData = JSON.parse(data);

        console.log(parsedData.success);
        console.log(parsedData.errors);

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
