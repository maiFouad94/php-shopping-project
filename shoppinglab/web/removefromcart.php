<?php

session_start();

$arr=[];
$arr= $_SESSION['prodId'];
$arr= array_values($arr);
//print_r($arr);
for ($i = 0; $i < count($arr); $i++) {
    if($_POST['text']==$arr[$i]){
        //print_r('yes here');
        $_SESSION['total']-=$_POST['price'];
       unset($arr[$i]);
       break;
        
    }
   
}
$modified_array=[];
$modified_array=$arr;
//print_r($modified_array);
$_SESSION['prodId']=$modified_array;
$output=array();
$output = [$_SESSION['total']
   
];
//print_r($output);

echo json_encode($output);
    
    




