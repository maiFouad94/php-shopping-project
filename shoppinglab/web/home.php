<?php
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/Product.php';
include '../model/Products.php';

session_start();
//$product = new Product($conn, $productId);
?>


<html>
    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
    
    </head>
        
    <body>
        <?php
        
        if(!isset($_SESSION['userId']) || !$_SESSION['userId']): 
            ?>
        
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php else:
            ?>
            <a href="logOut.php">Logout</a>
            <a href="account.php">Account</a>
        <?php endif; ?>
        <br/>
        <br/>
    
      <input type="text" placeholder="search for mobile" id="searchProduct"/>
      </br>
      </br>
      <a href="home.php" >All</a>
      <a href="home.php?catid=1">samsung</a>
      <a href="home.php?catid=2">iphone</a>
      <a href="home.php?catid=3">nokia</a>
        </br>
        </br>
        <?php if(isset($_SESSION['userId'])&&$_SESSION['userId']==1): ?>
                    <a href="addProduct.php">Add product</a>
                     <?php endif; ?>
       <?php if(isset($_SESSION['userId'])&&$_SESSION['userId']): ?>
                    <a href="checkout.php">Checkout</a>
                     <?php endif; ?>
        <?php
        if(!isset($_GET['catid']) || !$_GET['catid'])
        {
        $products = new Products($conn);
        $productsObj = $products->getProducts();
        }
        else
        {
            $products = new Products($conn);
        $productsObj = $products->getProductBycat($_GET['catid']);
        
        }
       // echo "<pre>";
       // print_r($_GET['catid']);
       // echo "</pre>";
        ?>
        <div id="productsDiv">
            <?php foreach($productsObj as $product): ?>
                <div class="product">
                   
                            
                     <img src="<?= $product->getPhoto()?>" width="100" height="100"/>
                     </br>
                     <h3><?= $products->getCategory($product->getCid())?></h3>
                    <h3>
                        <a href="Mobile.php?id=<?=$product->getId()?>"><?= $product->getName() ?></a></h3>
                    <h5>Price:<?= $product->getPrice() ?></h5>
                    <h6>Description:<?= substr($product->getDescription(),0,100) ?></h6>
                    
                    <h5>rate:<?= ($product->getRate())/($product->getCount()) ?></h5>
                    <?php if(isset($_SESSION['userId']) || $_SESSION['userId']): ?>
                    <button  id="<?php echo $product->getId(); ?>" class="addCart" >Add to cart</button>
                    <?php if($_SESSION['userId']==1): ?>
                    <button id="<?php echo $product->getId(); ?>" class="deleted">delete product</button>
                    <a href="editProduct.php?id=<?=$product->getId()?>">Edit</a>
                     <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="/js/filter.js"></script>       
       <script src="/js/cart2.js"></script>   
    
    </body>
    
</html>