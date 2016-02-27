<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>

<? include "../header.php" ?>

    <h1>Insert Card</h1>
    <form action="/" method="post" id="insert">
      <div class="form-group">

        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name">

        <label for="color">Color</label>
        <select class="form-control" name="color" id="color">
          <option value="yellow">Yellow</option>
        </select>

        <label for="type">Type</label>
        <div class="checkbox" name="type">
          <label>
            <input type="checkbox" value="enchantment">
            Enchantment
          </label>
        </div>

        <label for="ability">Ability</label>
        <textarea class="form-control" name="ability" id="ability" placeholder="Ability" rows="4"></textarea>

        <label for="power">Power</label>
        <input type="number" class="form-control" name="power" id="power">

        <label for="toughness">Toughness</label>
        <input type="number" class="form-control" name="toughness" id="toughness">

        <label for="flavor-text">Flavor Text</label>
        <textarea class="form-control" name="flavor-text" id="flavor-text" placeholder="Flavor text" rows="4"></textarea>

        <label for="casting-cost">Casting Cost</label>
        <input type="number" class="form-control" name="casting-cost" id="casting-cost">

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
        'color': $('select[name=color]').val(),
        // /'type': $('checkbox[name=type]').val(),
        'type': 'enchantment',
        'ability': $('textarea[name=ability]').val(),
        'power': $('input[name=power]').val(),
        'toughness': $('input[name=toughness]').val(),
        'flavor_text': $('textarea[name=flavor-text]').val(),
        'casting_cost': $('input[name=casting-cost]').val()
      };

      var route = "<?php echo $controllers; ?>card/insert.php";      // Route to controllers folder.

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
