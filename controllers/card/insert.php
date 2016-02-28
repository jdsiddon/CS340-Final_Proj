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

  $owner = $_POST['owner'];
  $name = $_POST['name'];
  $colors = json_decode($_POST['colors']);
  $types = json_decode($_POST['types']);
  $ability = $_POST['ability'];
  $power = $_POST['power'];
  $toughness = $_POST['toughness'];
  $flavor_text = $_POST['flavor_text'];
  $casting_cost = $_POST['casting_cost'];

  $owner = mysql_real_escape_string($owner);
  $name = mysql_real_escape_string($name);                      // Clean submitted values.
  $ability = mysql_real_escape_string($ability);
  $power = mysql_real_escape_string($power);
  $toughness = mysql_real_escape_string($toughness);
  $flavor_text = mysql_real_escape_string($flavor_text);
  $casting_cost = mysql_real_escape_string($casting_cost);

  // Insert Card
  $query = "INSERT INTO fp_card (name, ability, power, toughness, flavor_text, casting_cost)
              VALUES ('$name', '$ability', '$power', '$toughness', '$flavor_text', '$casting_cost');";
  $result_card = mysql_query($query);      // Insert the new card.

  $card_insert = mysql_insert_id();    // Get last insert.

  // Insert Card Types
  foreach ($types as $type) {
    $type = mysql_real_escape_string($type);
    $result_card_type = mysql_query("INSERT INTO fp_card_type (type_id, card_id) VALUES ('$type', '$card_insert');");

    if($result_card_type != 1) {        // An error occured on insert.
      break;
    }
  }

  // Insert Card Color
  foreach ($colors as $color) {
    $color = mysql_real_escape_string($color);      // Clean string.
    $result_card_color = mysql_query("INSERT INTO fp_card_color (card_id, color_id) VALUES ('$card_insert',
      (SELECT id FROM fp_color WHERE fp_color.id='".$color."')
    );");

    if($result_card_color != 1) {       // An error occured during query.
      break;
    }
  }

  // Insert Card to an Owner's collection.
  $result_card_collection = mysql_query("INSERT INTO fp_collection (owner_id, card_id)
    VALUES ('$owner', '$card_insert');");

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

mysql_close($mysql_handle);

?>
