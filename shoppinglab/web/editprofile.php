<?php
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/User.php';

session_start();
$userId = $_SESSION['userId'];

$user = new User($conn, $userId);

if(!empty($_POST))
{
    $filename = $_FILES['fileToUpload']['tmp_name'];
    $filePath = '/img/' . time() . '.png';
    $destination = __DIR__ . $filePath;
    if(!move_uploaded_file($filename, $destination))
    {
        die('cant upload');
       
    }
    $user->setPhoto($filePath);
    $user->setUsername($_POST['username']);
    $user->setName($_POST['name']);
    $user->setPhone($_POST['phone']);
    $user->setEmail($_POST['email']);
    $user->update();

    header("Location: account.php");
    exit;
}
?>
<html>
    <body>
        <h2>Edit your profile</h2>
        <br/>
        
<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br/>
    <br/>
    Username<input name="username" value="<?= $user->getUsername() ?>" />
    <br/>
    <br/>
    Email<input name="email" value="<?= $user->getEmail() ?>" />
    <br/>
    <br/>
    Phone<input name="phone" value="<?= $user->getPhone() ?>" />
    <br/>
    <br/>
    Name<input name="name" value="<?= $user->getName() ?>" />
    <br/>
    <br/>

    <button type="submit">Update</button>
</form>
    </body>
</html>