<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // The deck to add cards to is in the get parameters of the url 'http://localhost:8888/Final_Project/views/deck/edit.php?id=XX'.
  if(!empty($_POST['deck_id'])) {
    $deck_id = mysql_escape_string($_POST['deck_id']);
  } else{
    $errors['deck_id'] = "ID Required";
  }

  // Update Card in Owner's collection.
  $query = "DELETE FROM fp_deck WHERE id='$deck_id';";
  $result = mysql_query($query);


  // Insert was successful.
  if($result == 1) {
    $data['success'] = true;
    $data['message'] = 'Success!';

  } else {    // Insert Failed.
    $data['success'] = false;         // Success is false.
    $errors['sql'] = 'SQL Failed';
    $data['errors'] = $errors;        // Set errors to data errors attr.

  }

  echo json_encode($data);        // Send back to client.


  mysql_close($mysql_handle);

?>
