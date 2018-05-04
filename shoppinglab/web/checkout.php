<?php

error_reporting (E_ALL & ~E_NOTICE);
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/Product.php';
include '../model/Products.php';

session_start();
//print_r($_SESSION['prodId']);

$prod=new Products($conn);


$total=0;
?>
<html>
    <body>
        <br/><a href="home.php">home</a><br/>
        <h1>Your cart</h1>
        
        
         <div id="productscart">
            <?php foreach($_SESSION['prodId'] as $productId):?>
              <?=             print_r(" ");
                $product=$prod->getProductById($productId);?>
             
                <div class="product">
                   
                            
                     <img src="<?= $product['photo']?>" width="100" height="100"/>
                     </br>
                     <h3><?= $prod->getCategory($product['cid'])?></h3>
                    <h3>
                        <a href="Mobile.php?id=<?=$product['id']?>"><?= $product['name'] ?></a></h3>
                    <h5>price:<?= $product['price'] ?></h5>
                    <h6>description:<?= substr($product['description'],0,100) ?></h6>
                   
                    <button  id="<?php echo $product['id']; ?>" class="removeCart" price="<?php echo $product['price']; ?>">remove from cart</button>
                    <?php $total+=$product['price']; ?>
                   
                    
                     
                </div>
            <?php endforeach; ?>
        </div>
        <?php $_SESSION['total']=$total;?>
         <span id="tot">Total=<?= $_SESSION['total']?></span>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/js/cart2.js"></script>
    </body>
     
</html>
