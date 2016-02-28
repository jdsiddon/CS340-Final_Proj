<?php include "../../controllers/deck/edit.php" ?>
<?php include "../../config.php" ?>
<?php require_once( ROOT_DIR.'/routes.php' ); ?>

<? include "../header.php" ?>

    <h1>Add Cards To: <?php echo $deck[name] ?></h1>
    <form action="/" method="post" id="insert">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
      </div>
      <button type="submit" class="btn btn-default">Insert</button>
    </form>

<? include "../footer.php" ?>
