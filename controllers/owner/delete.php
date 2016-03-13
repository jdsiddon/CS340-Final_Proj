<?php include_once("../../database.php"); ?>

<?php

  $errors = array();      // Place to put errors in.
  $data = array();        // Place to pass back data to client.

  // The deck to add cards to is in the get parameters of the url 'http://localhost:8888/Final_Project/views/deck/edit.php?id=XX'.
  if(!empty($_POST['owner_id'])) {
    $owner_id = mysqli_escape_string($_POST['owner_id']);
  } else{
    $errors['owner_id'] = "ID Required";
  }

  // Update Card in Owner's collection.
  $query = "DELETE FROM fp_owner WHERE id='$owner_id';";
  $result = mysqli_query($query);


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


  mysqli_close($mysqli_handle);

?>
