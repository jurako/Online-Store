<?php include ROOT.'/views/layouts/header.php';?>
<!--middle-->
<div id="middle">
    <div id="content">
        <div id="left-part">
            <div id="products_container">
                <h2 class='right-title' style='margin: 20px 20px;'>Каталог товаров</h2>
                <?php foreach ($categories as $categoryItem): ?>         
                    <div class='category-item' >
                        <a class='category-pic' href='catalog/<?php echo $categoryItem['name_latin'] ?>'>
                            <img src='http://localhost/OnlineShop/templates/images/categories/categoryID_<?php echo $categoryItem['id'] ?>.jpg' alt='category_<?php echo $categoryItem['id'] ?>'>
                        </a>
                        <div class="aligner">                
                            <a class="item-name" href='catalog/<?php echo $categoryItem['name_latin'] ?>'><?php echo $categoryItem['name']?></a>
                        </div>
                    </div>
                <?php endforeach;?>
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
                                <img src="http://localhost/OnlineShop/templates/images/products/productID_<?php echo $product['id'] . '_small'?>.jpg" alt="<?php echo $product['name']; ?>">
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

