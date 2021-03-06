<?php include_once("../../database.php"); ?>

<?php

$errors = array();      // Place to put errors in.
$data = array();        // Place to pass back data to client.


// Get form values.
if(empty($_POST['name']))
  $errors['name'] = 'Name required';
if(empty($_POST['owner']))
  $errors['owner'] = 'Owner required';

// We had some errors so make the post fail.
if(!empty($errors)) {
  $data['success'] = false;         // Success is false.
  $data['errors'] = $errors;        // Set errors to data errors attr.

} else {          // No errors so process form.

  $name = $_POST['name'];
  $owner = $_POST['owner'];

  $name = mysqli_real_escape_string($mysqli_handle, $name);                      // Clean submitted values.
  $owner = mysqli_real_escape_string($mysqli_handle, $owner);

  // SQL Statement, Insert deck.
  $query = "INSERT INTO fp_deck (name) VALUES ('$name');";
  $result_deck = mysqli_query($mysqli_handle, $query);

  $new_deck_id = mysqli_insert_id();         // Get the id of the last inserted Deck.

  // SQL Statement, Insert owner/deck relationship.
  $deck_owner_query = "INSERT INTO fp_deck_owner (deck_id, owner_id) VALUES ('$new_deck_id', '$owner');";
  $result_deck_owner = mysqli_query($mysqli_handle, $deck_owner_query);


  // Insert was successful.
  if($result_deck == 1 || $result_deck_owner == 1) {
    $data['success'] = true;
    $data['message'] = 'Success!';

  } else {    // Insert Failed.
    $data['success'] = false;         // Success is false.
    $errors['sql'] = 'SQL Failed';
    $data['errors'] = $errors;        // Set errors to data errors attr.

  }

  echo json_encode($data);        // Send back to client.

}



mysqli_close($mysqli_handle);

?>
