<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>
<?php require_once( ROOT_DIR.'/controllers/card/edit.php' ); ?>

<? include "../header.php" ?>

    <h1>Edit Card</h1>
    <form action="/" method="post" id="edit">
      <?php
        echo '<input type="text" name="card_id" id="card_id" value="'.$card[id].'" hidden disabled>';
      ?>
      <div class="form-group">
        <label for="name">Name</label>
        <?php
          echo '<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="'.$card[card_name].'">';
        ?>
      </div>

      <div class="form-group">
        <label for="name">Owner</label>
        <select class="form-control" name="owner">
        <?php
          // Loop through each color.
          while ($owner = mysqli_fetch_array($owners)) {
            echo '<option value="'.$owner[id].'"';
            if($owner[id] == $card[card_owner]) {
              echo 'selected';
            }
            echo '>'.$owner[lname].', '.$owner[fname].'</option>';
          }
        ?>
        </select>
      </div>

      <div class="form-group">
        <label for="color">Color</label>
        <div class="checkbox" name="colors" id="colors" required>
        <?php
          // Loop through each color, if available color is same as set color of card, make it checked.
          while($color = mysqli_fetch_array($colors)) {
            echo '<label class="checkbox-inline"><input type="checkbox" value="'.$color[id].'" name="color" ';
            foreach ($card[colors] as $k => $cc) {
              if($color[id] == $cc[card_color_id]) {
                echo 'checked';
              }
            }
            echo '>'.$color[name].'</label>';
          }
        ?>
        </div>
      </div>

      <div class="form-group">
        <label for="type">Type</label>
        <div class="checkbox" name="types" id="types" required>
        <?php
          // Loop through each type, if available type is same as set type of card, make it checked.
          while ($type = mysqli_fetch_array($types)) {
            echo '<label class="checkbox-inline"><input type="checkbox" value="'.$type[id].'" name="type" ';
            foreach ($card[types] as $k => $ct) {
              if($type[id] == $ct[card_type_id]) {
                echo 'checked';
              }
            }
            echo '>'.$type[name].'</label>';
          }
        ?>
        </div>
      </div>

      <div class="form-group">
        <label for="ability">Ability</label>
        <textarea class="form-control" name="ability" id="ability" placeholder="Ability" rows="4" required><?php echo $card[card_ability]; ?></textarea>
      </div>

      <div class="form-group">
        <label for="power">Power</label>
        <?php
          echo '<input type="number" class="form-control" name="power" id="power" value="'.$card[card_power].'">';
        ?>
      </div>

      <div class="form-group">
        <label for="toughness">Toughness</label>
        <?php
          echo '<input type="number" class="form-control" name="toughness" id="toughness" value="'.$card[card_toughness].'">';
        ?>
      </div>

      <div class="form-group">
        <label for="flavor-text">Flavor Text</label>
        <textarea class="form-control" name="flavor-text" id="flavor-text" placeholder="Flavor text" rows="4"><?php echo $card[card_flavor_text]; ?></textarea>
      </div>

      <div class="form-group">
        <label for="casting-cost">Casting Cost</label>
        <?php
          echo '<input type="number" class="form-control" name="casting-cost" id="casting-cost" value="'.$card[card_casting_cost].'" required>';
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
        'card_id': $('input[name=card_id]').val(),
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
