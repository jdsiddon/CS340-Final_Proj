<?php include_once("../../database.php"); ?>

<?php

$errors = array();      // Place to put errors in.
$data = array();        // Place to pass back data to client.

// Get form values.
if(empty($_POST['card_id']))            // If ID was provided we are updating the card, not creating a new one.
  $errors['card_id'] = 'Error Updating';

// Power and toughness not required.
if(empty($_POST['owner']))
  $errors['owner'] = 'Owner required';
if(empty($_POST['name']))
  $errors['name'] = 'Name required';
if(empty($_POST['colors']))
  $errors['color'] = 'Color required';
if(empty($_POST['types']))
  $errors['types'] = 'Type required';
if(empty($_POST['ability']))
  $errors['ability'] = 'Ability required';
if(empty($_POST['casting_cost']))
  $errors['casting_cost'] = 'Casting cost required';


// We had some errors so make the post fail.
if(!empty($errors)) {
  $data['success'] = false;         // Success is false.
  $data['errors'] = $errors;        // Set errors to data errors attr.

} else {          // No errors so process form.
  $types = array();
  $colors = array();
  //
  $card_id = $_POST['card_id'];
  $owner = $_POST['owner'];
  $name = $_POST['name'];
  $colors = json_decode($_POST['colors']);
  $types = json_decode($_POST['types']);
  $ability = $_POST['ability'];
  $power = $_POST['power'];
  $toughness = $_POST['toughness'];
  $flavor_text = $_POST['flavor_text'];
  $casting_cost = $_POST['casting_cost'];

  $card_id = mysqli_real_escape_string($mysqli_handle, $card_id);
  $owner = mysqli_real_escape_string($mysqli_handle, $owner);
  $name = mysqli_real_escape_string($mysqli_handle, $name);                      // Clean submitted values.
  $ability = mysqli_real_escape_string($mysqli_handle, $ability);
  $power = mysqli_real_escape_string($mysqli_handle, $power);
  $toughness = mysqli_real_escape_string($mysqli_handle, $toughness);
  $flavor_text = mysqli_real_escape_string($mysqli_handle, $flavor_text);
  $casting_cost = mysqli_real_escape_string($mysqli_handle, $casting_cost);

  // Update Card
  $query = "UPDATE fp_card
              SET name='$name', ability='$ability', power='$power', toughness='$toughness', flavor_text='$flavor_text', casting_cost='$casting_cost'
              WHERE id=$card_id;";

  $result_card = mysqli_query($mysqli_handle, $query);      // Insert the new card.


  // Delete existing Card Types
  $existing_types = mysqli_query($mysqli_handle, "DELETE FROM fp_card_type WHERE card_id=$card_id;");

  foreach ($types as $type) {
    $type = mysqli_real_escape_string($mysqli_handle, $type);
    $result_card_type = mysqli_query($mysqli_handle, "INSERT INTO fp_card_type (type_id, card_id) VALUES ('$type', '$card_id');");

    if($result_card_type != 1) {        // An error occured on insert.
      break;
    }
  }

  // Delete existing Card colors
  $existing_colors = mysqli_query($mysqli_handle, "DELETE FROM fp_card_color WHERE card_id=$card_id;");

  // Insert Card Color
  foreach ($colors as $color) {
    $color = mysqli_real_escape_string($mysqli_handle, $color);      // Clean string.
    $result_card_color = mysqli_query($mysqli_handle, "INSERT INTO fp_card_color (card_id, color_id) VALUES ('$card_id',
      (SELECT id FROM fp_color WHERE fp_color.id='".$color."')
    );");

    if($result_card_color != 1) {       // An error occured during query.
      break;
    }
  }

  // Update Card in Owner's collection.
  $result_card_collection = mysqli_query($mysqli_handle, "UPDATE fp_collection
                                          SET owner_id='$owner'
                                          WHERE card_id=$card_id;");

  if($result_card_collection != 1) {       // An error occured during query.
    break;
  }


  // Make sure all inserts were successful.
  if($result_card == 1 || $result_card_type == 1 || $result_card_type == 1 || $result_card_collection == 1) {
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
