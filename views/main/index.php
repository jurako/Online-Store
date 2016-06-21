<?php include ROOT.'/views/layouts/header.php';?>
<?php include ROOT.'/components/Cart.php';?>

<script type='text/javascript'>
    function prodAval (id) {
        var buttonID = id;
        var buttonNum = buttonID.replace(/\D/g,'');
        var elemID = "amount" + buttonNum;
        var amountString = document.getElementById(elemID).innerHTML;
        elemID = "quantity" + buttonNum; 
        var quantityString = document.getElementById(elemID).value;
        var amount = amountString.replace(/\D/g,'');
        var quantity = quantityString.replace(/\D/g,'');
    }

</script>
<!--middle-->
<div id="middle">
    <div id="content">
        <div id="left-part">
            <div id="slider">
                <img id="slide" src="templates/images/slider_image_2.jpg" alt="slider_image_2">
            </div>
            <div id="products_container">
                <?php foreach ($newProducts as $newProductItem):?>
                    <div class="single_product">
                        <div class="product_image">
                            <a class="img" href="catalog/<?php echo $newProductItem['categoryName'].'/'.$newProductItem['id']?>" style="background: url(templates/images/products/productID_<?php echo $newProductItem['id']?>.jpg) center center no-repeat #fff;">
                            </a>
                            <p style="margin: 10px 30px;font-size: 80%;">Доступность на складе:<?php if ($newProductItem['amount'] > 0) { 
                                                                                                        echo '<span style="color: green;" id="amount'; echo $newProductItem['id']; echo '"> '; 
                                                                                                        echo $newProductItem['amount']; 
                                                                                                        echo ' шт.</span>'; 
                                                                                                    }
                                                                                                    else {
                                                                                                        echo '<span style="color: red;" id="amount'; echo $newProductItem['id']; echo '"> не доступен</span>';
                                                                                                        }?></p> 
                        </div>
                        <div class="product_info">
                            <div class="prod-name">
                                <h2 style="margin-left: 5px;">
                                    <a href="catalog/<?php echo $newProductItem['categoryName'].'/'.$newProductItem['id']?>" style="font-size: 55%; line-height: 120%;"><?php echo $newProductItem['name'];?></a>
                                </h2>
                            </div>
                            <div class="prod_descr">
                                <?php echo $newProductItem['desc'];?>
                            </div>
                            <div class="prod_price">
                                <?php echo $newProductItem['price']; ?> €
                            </div>
                            <div class="addToCart_mainPage">
                                <form action="cart/add/<?php echo $newProductItem['id']; ?>" method="post">
                                    <input id="quantity<?php echo $newProductItem['id']?>" type="text" class="quantity" name="quantity" size="3" value="1">
                                    <input name="addToCartSubmit" id="button<?php echo $newProductItem['id']?>" type="submit" value="КУПИТЬ" class="add_to_cart_btn" onclick="prodAval(this.id)">
                                </form>
                            </div>        
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="right-part">
            <div id="popular-prod-content">
                <h2 class="right-title">Популярные товары</h2>  
                <ul class="pop-prod-list">
                    <?php foreach ($popularProducts as $product) { ?>
                        <li>
                            <a class="title" href="catalog/<?php echo $product['categoryName'].'/'.$product['id']?>"><?php echo $product['name']; ?></a>
                            <a class="img" href="catalog/<?php echo $product['categoryName'].'/'.$product['id']?>">
                                <img src="templates/images/products/productID_<?php echo $product['id'] . '_small'?>.jpg" alt="<?php echo $product['name']; ?>">
                            </a>
                            <p class="price"><?php echo $product['price']; ?> €</p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--!middle-->
<?php include ROOT.'/views/layouts/footer.php';?>
