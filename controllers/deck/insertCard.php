<?php include_once("../../database.php"); ?>

<?php

$errors = array();      // Place to put errors in.
$data = array();        // Place to pass back data to client.


// User can choose to not add any cards. So we aren't checking if they are in POST.
if(empty($_POST['deck_id']))
  $errors['deck_id'] = 'Deck required';

if(empty($_POST['cards']))
  $errors['cards'] = 'Cards required';

// We had some errors so make the post fail.
if(!empty($errors)) {
  $data['success'] = false;         // Success is false.
  $data['errors'] = $errors;        // Set errors to data errors attr.

} else {          // No errors so process form.
  $cards = array();

  $deck_id = $_POST['deck_id'];      // Clean params.
  $cards = json_decode($_POST['cards']);

  $deck_id = mysql_real_escape_string($deck_id);      // Clean params.


  // Insert Card Into Deck
  foreach ($cards as $card) {
    $card = mysql_real_escape_string($card);
    $result_card = mysql_query("INSERT INTO fp_deck_card (deck_id, card_id) VALUES ('$deck_id', '$card');");

    if($result_card != 1) {        // An error occured on insert.
      break;
    }
  }


  // Make sure all inserts were successful.
  if($result_card == 1) {
    $data['success'] = true;
    $data['message'] = 'Success!';

  } else {    // Insert Failed.
    $data['success'] = false;         // Success is false.
    $errors['sql'] = 'SQL Failed';
    $data['errors'] = $errors;        // Set errors to data errors attr.

  }

  echo json_encode($data);        // Send back to client.

}

mysql_close($mysql_handle);

?>
