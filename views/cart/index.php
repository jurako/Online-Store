<?php include ROOT.'/views/layouts/header.php';
$notavailable = [];?>
<!--middle-->
<div id="middle">
    <style>
        body {
            background-image: url(http://localhost/OnlineShop/templates/images/body_bg_image.png);
            background-position: center left;
            background-repeat: repeat;
            background-attachment: scroll;
            background-color: #FAFAFA;
        }
    </style>
    <div id="content">
        <div id="left-part" style="width: 980px; min-height: 590px;">
            <div id="products_container" style="min-height:262px;">
                <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])):
                          echo "<h2 class='right-title' style='margin: 20px 20px;'>Корзина пуста.</h2>";
                      else :
                          $db = Db::getConnection();
                          foreach ($_SESSION['cart'] as $id => $quantity) {
                              $product = [];
                              $result1 = $db->query('SELECT Name, Price, Category, Amount FROM products WHERE Product_ID="'.$id.'"');
                              while ($row = $result1->fetch()) {
                                  $result2 = $db->query('SELECT NameLatin FROM categories WHERE Category_ID="'.$row['Category'].'"');
                                  $row2 = $result2->fetch();
                                  $product['name'] = $row['Name'];
                                  $product['price'] = $row['Price'];
                                  $product['category_name'] = $row2['NameLatin'];
                                  $product['amount'] = $row['Amount'];
                              } ?>
                            <div class="cart-item">
                                <div class="cart-item-pic">
                                    <img src="http://localhost/OnlineShop/templates/images/products/productID_<?php echo $id;?>.jpg" alt="prod<?php echo $id;?>">
                                </div>
                                <div class="cart-item-name">
                                    <a href="catalog/<?php echo $product['category_name'].'/'.$id; ?>" class="right-title" style=" font-weight: bold; display: inline-block; margin-top: 70px; font-size: 100%; line-height: 110%;"><?php echo $product['name']; ?></a>
                                </div>
                                <div class="cart-item-price">
                                    <h2 class="right-title" style="margin-top: 70px; font-size: 100%; line-height: 110%;"> <?php echo $product['price']; ?> € </h2>
                                </div>
                                <div class="cart-item-quantity">
                                    <span style="font-size: 160%; margin-top: 70px; color: #333333; line-height: 15px; float: left;">×</span>
                                    <h2 class="right-title" style="margin-top: 70px; margin-left: 10px; font-size: 100%; line-height: 110%; float: left;"> <?php echo $quantity; ?> </h2>
                                    <span style="font-size: 160%; margin-top: 70px; margin-left: 10px; color: #333333; line-height: 17px; float: left;">=</span>
                                </div>
                                <div class="cart-item-remove">
                                    <a href="/OnlineShop/cart/remove/<?php echo $id; ?>" style="margin-top: 70px; margin-left: 10px; font-size: 100%; line-height: 110%; float: left; color: #CC5656; text-decoration: none">×</a>
                                </div>                                
                                <div class="cart-item-totalprice">
                                    <h2 class="right-title" style="margin-top: 70px; margin-left: 10px; font-size: 100%; line-height: 110%; float: left;"> <?php echo $product['price'] * $quantity; ?> €  </h2>
                                </div>
                            </div>
                            <?php 
                            if ($quantity > $product['amount']) {
                                array_push ($notavailable, $id);
                            }
                        } 
                            if (!empty($notavailable)):
                                $db = Db::getConnection();
                                echo '<div style="background-color: #f3c7c7; color: #c7271f;padding: 5px 5px; margin-bottom: 15px;">';
                                echo '<ul>';
                                foreach ($notavailable as $id) {
                                    $result = $db->query('SELECT * FROM products WHERE Product_ID="'.$id.'"');
                                    $row = $result->fetch();
                                    echo '<li>'.$row['Name'].' - оставшееся количество на складе: '.$row['Amount'].' ед.</li>';
                                }
                                echo '</ul>';
                                echo '</div>';
                             endif;?>  
                        <div class="buy-cart">
                            <div class="addToCart_mainPage" style="float:right;">
                                <form action="/OnlineShop/order" method="post">
                                    <input style="width: 140px;"name="makeOrder" id="button" type="submit" value="ОФОРМИТЬ" class="add_to_cart_btn" onclick="prodAval(this.id)">
                                </form>
                            </div>
                            <h2 class="right-title" style="float:right; margin-top: 30px; margin-right: 30px;font-size: 145%;font-weight: bold;color: #1D96E2;"> <?php echo $_SESSION['cartSum'];?> €</h2>
                            <h2 class="right-title" style="float:right; margin-top: 31px; margin-right: 10px;font-weight: normal;">Итог: </h2>
                        </div>
            <?php endif;?>
            </div>
        </div>
    </div>
</div>
<!--!middle-->
<?php include ROOT.'/views/layouts/footer.php';?>
