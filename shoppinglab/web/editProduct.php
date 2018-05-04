<?php
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/Product.php';
include '../model/Products.php';

session_start();
$productId = $_GET['id'];

$products = new Products($conn);
        $productsObj = $products->getProductById($productId);
$product = new Product($conn,$productsObj);

if(!empty($_POST))
{
    $filename = $_FILES['imgToUpload']['tmp_name'];
    $filePath = '/img/' . time() . '.png';
    $destination = __DIR__ . $filePath;
    if(!move_uploaded_file($filename, $destination))
    {
        die('cant upload');
       
    }
    $product->setPhoto($filePath);
    
    $product->setName($_POST['name']);
    $product->setDescription($_POST['description']);
    $product->setPrice($_POST['price']);
    $product->setCid($_POST['category']);
    $product->update();

    header("Location: Mobile.php?id=$productId");
    exit;
}
?>
<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="imgToUpload" id="imgToUpload">
    <br/>
    name<input name="name" value="<?= $product->getName() ?>" />
    <br/>
    description<input name="description" value="<?= $product->getDescription() ?>" />
    <br/>
    price<input name="price" value="<?= $product->getPrice() ?>" />
    <br/>
    category</br><input type="checkbox" name="category" value="1" checked/>samsung
    </br>
    <input type="checkbox" name="category" value="2"/>iphone
    <br/>
    <input type="checkbox" name="category" value="3"/>nokia
    </br>
    </br>
    <button type="submit">Update</button>
</form>