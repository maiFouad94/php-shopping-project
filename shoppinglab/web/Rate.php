<?php

header('Content-Type: application/json');
// Create connection
$conn = mysqli_connect('localhost', 'root', "12345", 'shoppinglab');
// Check connection
if(!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

$query = "select rate,count from product where id =".$_POST['prodID'];
 if ($result = $conn->query($query)) {
    $row = $result->fetch_assoc();
 
}
//print_r($row['count']);
$totalRate=$row['rate']+$_POST['rate'];
//print_r($_POST['rate']);
$totalCount=$row['count']+1;

$resultRate=$totalRate/$totalCount;


$queryy = "update `product` set `rate`={$totalRate}, `count`={$totalCount} where id = ".$_POST['prodID'];
mysqli_query($conn, $queryy) or die(mysqli_error($conn));

$output = [
    'success'  => true,
    'rate' => $resultRate
];

echo json_encode($output);

