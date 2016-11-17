<?php include ROOT.'/views/layouts/header.php';?>
<!--middle-->
<div id="middle">
    <div id="content">
        <div id="left-part">
            <div id="products_container">
                <div class="product-left-side-container">
                    <div class="single-product-foto">                   
                        <img class="single-product-image" src="/templates/images/products/productID_<?php echo $singleProduct['id']; ?>.jpg" alt=""> 
                    </div>
                    <p style="margin-left:65px; font-size: 80%; float: left;">Доступность на складе:<?php if ($singleProduct['amount'] > 0) { 
                                                                                echo '<span style="color: green;" id="amount'; echo $singleProduct['id']; echo '"> '; 
                                                                                echo $singleProduct['amount']; 
                                                                                echo ' шт.</span>'; 
                                                                            }
                                                                            else {
                                                                                echo '<span style="color: red;" id="amount'; echo $singleProduct['id']; echo '"> не доступен</span>';
                                                                                }?></p> 
                    <div class="addToCart_mainPage" style="margin: 60px 65px;">
                        <form action="/cart/add/<?php echo $singleProduct['id']; ?>" method="post">
                            <input id="quantity<?php echo $singleProduct['id']?>" type="text" class="quantity" name="quantity" size="3" value="1">
                            <input id="button<?php echo $singleProduct['id']?>" type="submit" value="КУПИТЬ" class="add_to_cart_btn" onclick="prodAval(this.id)">
                        </form>
                    </div>  
                </div>
                    <div class="single-product-charact">
                        <h2 class="right-title" style="font-size: 170%; text-decoration: underline;"> <?php echo $singleProduct['name']; ?></h2>
                        <div class="charact-name">
                            <?php foreach ($charact as $key => $value): ?>
                                <p class="charact-elem"> <?php echo $key; ?> </p>
                            <?php endforeach; ?>
                        </div>
                        <div class="charact-info">
                            <?php foreach ($charact as $key => $value): ?>
                                <p class="charact-elem"> <?php echo $value; ?> </p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <div class="single-product-desc">
                    <h2 class="right-title">Описание</h2>
                    <p style="font-family: Arial; color: #797878; font-size: 75%; line-height: 170%;"> <?php echo $singleProduct['desc']; ?> </p>
                </div>
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
                                <img src="/templates/images/products/productID_<?php echo $product['id'] . '_small'?>.jpg" alt="<?php echo $product['name']; ?>">
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

