<?php include_once("../../database.php"); ?>

<?php

$errors = array();      // Place to put errors in.
$data = array();        // Place to pass back data to client.

// Get form values.

// Power and toughness not required.
if(empty($_POST['owner']))
  $errors['owner'] = 'Owner required';
if(empty($_POST['name']))
  $errors['name'] = 'Name required';
if(empty($_POST['colors']))
  $errors['colors'] = 'Color required';
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

  $owner = $_POST['owner'];
  $name = $_POST['name'];
  $colors = json_decode($_POST['colors']);
  $types = json_decode($_POST['types']);
  $ability = $_POST['ability'];
  $power = $_POST['power'];
  $toughness = $_POST['toughness'];
  $flavor_text = $_POST['flavor_text'];
  $casting_cost = $_POST['casting_cost'];

  $owner = mysqli_real_escape_string($mysqli_handle, $owner);
  $name = mysqli_real_escape_string($mysqli_handle, $name);                      // Clean submitted values.
  $ability = mysqli_real_escape_string($mysqli_handle, $ability);
  $power = mysqli_real_escape_string($mysqli_handle, $power);
  $toughness = mysqli_real_escape_string($mysqli_handle, $toughness);
  $flavor_text = mysqli_real_escape_string($mysqli_handle, $flavor_text);
  $casting_cost = mysqli_real_escape_string($mysqli_handle, $casting_cost);

  // Insert Card
  $query = "INSERT INTO fp_card (name, ability, power, toughness, flavor_text, casting_cost)
              VALUES ('$name', '$ability', '$power', '$toughness', '$flavor_text', '$casting_cost');";
  $result_card = mysqli_query($mysqli_handle, $query);      // Insert the new card.

  $card_insert = mysqli_insert_id($mysqli_handle);    // Get last insert.

  // Insert Card Types
  // foreach ((array)$types as $type) {
  //   $type = mysqli_real_escape_string($mysqli_handle, $type);
  //   $result_card_type = mysqli_query($mysqli_handle, "INSERT INTO fp_card_type (type_id, card_id) VALUES ($type, $card_insert);");
  //
  //   if($result_card_type != 1) {        // An error occured on insert.
  //     break;
  //   }
  // }


  // Insert Card Color
  // foreach ((array)$colors as $color) {
  //   $color = mysqli_real_escape_string($mysqli_handle, $color);      // Clean string.
  //   $result_card_color = mysqli_query($mysqli_handle, "INSERT INTO fp_card_color (card_id, color_id) VALUES ($card_insert, (SELECT id FROM fp_color WHERE fp_color.id=$color))");
  //
  //   if($result_card_color != 1) {       // An error occured during query.
  //     break;
  //   }
  // }

  // Insert Card to an Owner's collection.
  $result_card_collection = mysqli_query($mysqli_handle, "INSERT INTO fp_collection (owner_id, card_id)
    VALUES ($owner', $card_insert);");

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
