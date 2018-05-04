<?php
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/Product.php';
include '../model/Products.php';
error_reporting (E_ALL );
$errorName = $errorPrice= $errorCategory=  "";
if(!empty($_POST))
{
    if(!isset($_POST['name']) || !$_POST['name'])
    {
        $errorName .= "This Field required.";
    }
    
    
     if(!isset($_POST['price']) || !$_POST['price'])
    {
        $errorPrice .= "This Field required.";
    }
    if(!isset($_POST['category']) || !$_POST['category'])
    {
        $errorCategory .= "This Field required.";
    }
    if($errorName == "" && $errorPrice == "" && $errorCategory== "")
    {
        $product = new Product($conn);
      
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
    $product->save();

    header("Location: home.php");
    alert("product added");
    exit;
    }
    
}

?>
<html>
    <h4>
        Add New Product
    </h4>
<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="imgToUpload" id="imgToUpload">
    <br/>
    
  
    name<input name="name"  />
    <br/>
    <?php echo $errorName ?>
    <br/>
    description<input name="description"  />
    <br/>
    
    price<input name="price"  />
    <br/>
    <?php echo $errorPrice ?>
    <br/>
    
    category</br><input type="checkbox" name="category" value="1" />samsung
    </br>
    <input type="checkbox" name="category" value="2"/>iphone
    <br/>
    <input type="checkbox" name="category" value="3"/>nokia
    </br>
    <?php echo $errorCategory ?>
    </br>
    <button type="submit">add</button>
</form>
</html>
