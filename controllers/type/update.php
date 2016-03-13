<?php include_once("../../database.php"); ?>

<?php

$errors = array();      // Place to put errors in.
$data = array();        // Place to pass back data to client.

// Get form values.
if(empty($_POST['id']))            // If ID was provided we are updating the card, not creating a new one.
  $errors['id'] = 'Error Updating';
if(empty($_POST['name']))            // If ID was provided we are updating the card, not creating a new one.
  $errors['name'] = 'Error Updating';

// We had some errors so make the post fail.
if(!empty($errors)) {
  $data['success'] = false;         // Success is false.
  $data['errors'] = $errors;        // Set errors to data errors attr.

} else {          // No errors so process form.
  $type_id = $_POST['id'];
  $type_name = $_POST['name'];

  $type_id = mysqli_real_escape_string($mysqli_handle, $type_id);
  $type_name = mysqli_real_escape_string($mysqli_handle, $type_name);

  // Update Card
  $query = "UPDATE fp_type
              SET name='$type_name'
              WHERE id=$type_id;";

  $result_type = mysqli_query($mysqli_handle, $query);      // Insert the new card.

  if($result_type == 1) {
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
