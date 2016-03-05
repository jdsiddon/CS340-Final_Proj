<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>
<?php require_once( ROOT_DIR.'/controllers/deck/edit.php' ); ?>

<? include "../header.php" ?>

    <h1>Add Cards To: <strong><?php echo $deck[name] ?></strong></h1>
    <form action="/" method="post" id="insert">

      <label for="cards">Cards In Your Collection:</label>
      <div class="checkbox" name="cards" id="cards">
        <div class="row">

            <?php
              // Loop through each color.
              $inc = 1;
              while ($card = mysql_fetch_array($cards)) {
                if($inc % 6 == 0) {
                  echo '</div>';             // Start a new row after 6 cards have been on one row.
                  echo '<div class="row">';
                }
                echo '<div class="col-md-2">';
                echo  '<label class="checkbox-inline"><input type="checkbox" value="'.$card[id].'" name="card">'.$card[name].'</label>';
                echo '</div>';
                $inc++;
              }
            ?>

        </div>
      </div>

      <button type="submit" class="btn btn-default">Insert</button>
    </form>

<? include "../footer.php" ?>

<script>
  $(document).ready(function() {
    var form = document.getElementById('insert');

    // When form is submitted.
    $( "#insert" ).submit(function( event ) {
      var cards = [];

      $('input[name=card]:checked').each(function(idx) {    // Add each selected card to the cards array.
        cards.push($(this).val());
      })

      // get the form data
      var formData = {
        'deck_id': "<?php echo $deck[id] ?>",
        'cards': JSON.stringify(cards)
      };

      var route = "<?php echo $controllers; ?>deck/insertCard.php";      // Route to controllers folder.

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
