<?php

session_start();

header('Content-Type: application/json');
// Create connection
$conn = mysqli_connect('localhost', 'root', "12345", 'shoppinglab');
// Check connection
if(!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

$query = "INSERT INTO `comment` (`id`, `user_id`, `comment`,`prod_id`, `created_at`) VALUES (NULL, '{$_SESSION['userId']}', '{$_POST['text']}','{$_POST['prodID']}', NOW())";
mysqli_query($conn, $query) or die(mysqli_error($conn));

$username =$_SESSION['username'] ;
$time = date("Y-m-d H:i:s");
$output = [
    'success'  => true,
    'username' => $username,
    'date'     => $time,
    'text'     => $_POST['text']
];

echo json_encode($output);
