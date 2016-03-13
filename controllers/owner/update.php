<?php include_once("../../database.php"); ?>

<?php

$errors = array();      // Place to put errors in.
$data = array();        // Place to pass back data to client.

// Get form values.
if(empty($_POST['id']))            // If ID was provided we are updating the card, not creating a new one.
  $errors['id'] = 'Error Updating';
if(empty($_POST['fname']))            // If ID was provided we are updating the card, not creating a new one.
  $errors['fname'] = 'Error Updating';
if(empty($_POST['lname']))            // If ID was provided we are updating the card, not creating a new one.
  $errors['lname'] = 'Error Updating';



// We had some errors so make the post fail.
if(!empty($errors)) {
  $data['success'] = false;         // Success is false.
  $data['errors'] = $errors;        // Set errors to data errors attr.

} else {          // No errors so process form.
  $owner_id = $_POST['id'];
  $owner_fname = $_POST['fname'];
  $owner_lname = $_POST['lname'];

  $owner_id = mysqli_real_escape_string($owner_id);
  $owner_fname = mysqli_real_escape_string($owner_fname);
  $owner_lname = mysqli_real_escape_string($owner_lname);

  // Update Card
  $query = "UPDATE fp_owner
              SET fname='$owner_fname', lname='$owner_lname'
              WHERE id=$owner_id;";

  $result_owner = mysqli_query($query);      // Insert the new card.

  if($result_owner == 1) {
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
