<?php

include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/Products.php';
include '../model/Product.php';
include '../model/User.php';

include '../model/Reviews.php';
include '../model/Review.php';
session_start();
$obj=$_SESSION['username'];

//print_r($obj);
if(isset($_GET['id']) && $_GET['id'])
{
    $productId = $_GET['id'];
}
$products = new Products($conn);
        $productsObj =new Product($conn, $products->getProductById($productId));
 //       print_r($productsObj);
?>
<html>
    <body>
<h1>Product Info</h1>
<img src="<?= $productsObj->getPhoto() ?>" width="100" height="100" />
<h3>Name: <?= $productsObj->getName() ?></h3>
<h3>Description: <?= $productsObj->getDescription() ?></h3>
<h3>Category: <?= $products->getCategory($productsObj->getCid()) ?></h3>
<h3>Price: <?= $productsObj->getPrice() ?></h3>
<span id="rateDiv" >rate: <?= ($productsObj->getRate())/($productsObj->getCount()) ?></span>
 
<br/>
<?php if(isset($_SESSION['userId']) || $_SESSION['userId']): ?>
add comment<input id="addComment"  name="comment" />
<button id="<?=$productsObj->getId();?>" class="comment" >comment</button>
<br/>
Rate:
<br/>
    <input type="checkbox" name="rate" value="1" />1
    
    <input type="checkbox" name="rate" value="2"/>2
    
    <input type="checkbox" name="rate" value="3"/>3
   
    <input type="checkbox" name="rate" value="4"/>4
    
    <input type="checkbox" name="rate" value="5"/>5
    <button id="<?=$productsObj->getId();?>" class="rating" >submit rate</button>
    <br/>
    <?php    endif; ?>
    <?php
        $reviews = new Reviews($conn);
        $reviewsObj = $reviews->getReviews($productsObj->getId());
//        echo "<pre>";
 //       print_r($reviewsObj);
//        echo "</pre>";
        ?>
        <div id="comments">
            <?php foreach($reviewsObj as $review): ?>
                <div class="tweet">
                    <h3><?= $review->getUserId()->getUsername() ?></h3>
                    <h5><?= $review->getText() ?></h5>
                    <h6><?= $review->getCreatedAt() ?></h6>
                 </div>
            <?php endforeach; ?>
        </div>

    </body>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/js/cart2.js"></script>
</html>