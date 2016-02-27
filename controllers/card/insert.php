<?php include_once("../../database.php"); ?>

<?php

$errors = array();      // Place to put errors in.
$data = array();        // Place to pass back data to client.


// Get form values.
// Power and toughness not required.
if(empty($_POST['name']))
  $errors['name'] = 'Name required';
if(empty($_POST['color']))
  $errors['color'] = 'Color required';
if(empty($_POST['type']))
  $errors['type'] = 'Type required';
if(empty($_POST['ability']))
  $errors['ability'] = 'Ability required';
if(empty($_POST['flavor_text']))
  $errors['flavor_text'] = 'Flavor text required';
if(empty($_POST['casting_cost']))
  $errors['casting_cost'] = 'Casting cost required';


// We had some errors so make the post fail.
if(!empty($errors)) {
  $data['success'] = false;         // Success is false.
  $data['errors'] = $errors;        // Set errors to data errors attr.

} else {          // No errors so process form.

  $name = $_POST['name'];
  $color = $_POST['color'];
  $type = $_POST['type'];
  $ability = $_POST['ability'];
  $power = $_POST['power'];
  $toughness = $_POST['toughness'];
  $flavor_text = $_POST['flavor_text'];
  $casting_cost = $_POST['casting_cost'];

  $name = mysql_real_escape_string($name);                      // Clean submitted values.
  $color = mysql_real_escape_string($color);
  $type = mysql_real_escape_string($type);
  $ability = mysql_real_escape_string($ability);
  $power = mysql_real_escape_string($power);
  $toughness = mysql_real_escape_string($toughness);
  $flavor_text = mysql_real_escape_string($flavor_text);
  $casting_cost = mysql_real_escape_string($casting_cost);

  // SQL Statement
  $query = "INSERT INTO fp_card (name, type, ability, power, toughness, flavor_text, casting_cost)
              VALUES ('$name', '$type', '$ability', '$power', '$toughness', '$flavor_text', '$casting_cost');";

  $result1 = mysql_query($query);      // Insert the new card.

  $query = "INSERT INTO fp_card_color (card_id, color_id)
              VALUES (
                LAST_INSERT_ID(),
                (SELECT id FROM fp_color WHERE fp_color.name='$color' LIMIT 1)
              );";

  $result2 = mysql_query($query);      // Insert color relationship.


  // Insert was successful.
  if($result1 == 1 || $result2 == 1) {
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
