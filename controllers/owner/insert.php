<?php include_once("../../database.php"); ?>

<?php

$errors = array();      // Place to put errors in.
$data = array();        // Place to pass back data to client.


// Get form values.
if(empty($_POST['fname']))
  $errors['fname'] = 'First Name required';
if(empty($_POST['lname']))
  $errors['lname'] = 'Last Name required';

// We had some errors so make the post fail.
if(!empty($errors)) {
  $data['success'] = false;         // Success is false.
  $data['errors'] = $errors;        // Set errors to data errors attr.

} else {          // No errors so process form.

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];

  $fname = mysqli_real_escape_string($fname);                      // Clean submitted values.
  $lname = mysqli_real_escape_string($lname);                      // Clean submitted values.

  // SQL Statement
  $query = "INSERT INTO fp_owner (fname, lname) VALUES ('$fname', '$lname');";
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

}



mysqli_close($mysqli_handle);

?>
