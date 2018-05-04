<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../classes/config.php';
include '../model/BaseEntity.php';

include '../model/User.php';
include '../model/Users.php';

$error = "";
if(!empty($_POST))
{
   
    if(!isset($_POST['username']) || !$_POST['username'])
    {

        $error .= "No Username given<br>";
    }

    if(!isset($_POST['password']) || !$_POST['password'])
    {

        $error .= "No Password given<br>";
    }

 
    if($error == "")
    {
        $loggedIn = false;
        $users = new Users($conn);
        $usersObj = $users->allUsers();
        foreach($usersObj as $user)
        {
            if($user->getUsername() == $_POST['username'] && $user->getPassword() == $_POST['password'])
            {    
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['username']=$user->getUsername();
                $_SESSION['userId']=$user->getId();
                print_r($_SESSION['userId']);
                $loggedIn = true;
                break;
            }
        }
        if($loggedIn)
        {
          
            header('Location: home.php');
            exit;
        }
        else
        {
            //error
            $error .= "Erorr username and password";
        }
    }
}
?>
<style>
    .error{
        color: red;
    }
</style>
<h1>Please Login to your account</h1>
<div class="error">
    <?php echo $error ?>
</div>
<form method="post">
    <input name="username" type="text" />
    <br/>
    <br/>
    <input name="password" type="password" />
    <br/>
    <br/>
    <button type="submit">Login</button>
</form>