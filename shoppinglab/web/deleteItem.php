<?php




header('Content-Type: application/json');
// Create connection
$conn = mysqli_connect('localhost', 'root', "12345", 'shoppinglab');
// Check connection
if(!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

$query = "DELETE FROM `product` WHERE `product`.`id` = ".$_POST['text'];
mysqli_query($conn, $query) or die(mysqli_error($conn));

$output = array(
    'success'  => true,
);

echo json_encode($output);


$output = array(
    'success'  => true,
);

echo json_encode($output);
