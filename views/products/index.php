<?php include ROOT.'/views/layouts/header.php';?>
<!--middle-->
<div id="middle">
    <div id="content">
        <div id="left-part">
            <div id="products_container">
                <h2 class='right-title' style='margin: 20px 20px;'>Каталог товаров > <?php echo $categoryInfo[0]['category'];?></h2>
                <?php foreach ($products as $productItem):?>
                    <div class="single_product">
                        <div class="product_image">
                            <a class="img" href="<?php echo $categoryInfo[0]['category_name'].'/'.$productItem['id']; ?>" style="background: url(http://localhost/OnlineShop/templates/images/products/productID_<?php echo $productItem['id']?>.jpg) center center no-repeat #fff;">
                            </a>
                            <p style="margin: 10px 30px;font-size: 80%;">Доступность на складе:<?php if ($productItem['amount'] > 0) { 
                                                                                                        echo '<span style="color: green;" id="amount'; echo $productItem['id']; echo '"> '; 
                                                                                                        echo $productItem['amount']; 
                                                                                                        echo ' шт.</span>'; 
                                                                                                    }
                                                                                                    else {
                                                                                                        echo '<span style="color: red;" id="amount'; echo $productItem['id']; echo '"> не доступен</span>';
                                                                                                    }?> 
                        </div>
                        <div class="product_info">
                            <div class="prod-name">
                                <h2 style="margin-left: 5px;">
                                    <a href="<?php echo $categoryInfo[0]['category_name'].'/'.$productItem['id']; ?>" style="font-size: 55%;"><p style="line-height: 120%;"><?php echo $productItem['name'];?></p></a>
                                </h2>
                            </div>
                            <div class="prod_descr">
                                <?php echo $productItem['desc'];?>
                            </div>
                            <div class="prod_price">
                                <?php echo $productItem['price']; ?> €
                            </div>
                            <div class="addToCart_mainPage">
                                <form action="/OnlineShop/cart/add/<?php echo $productItem['id']; ?>" method="post">
                                    <input id="quantity<?php echo $productItem['id']?>" type="text" class="quantity" name="quantity" size="3" value="1">
                                    <input id="button<?php echo $productItem['id']?>" type="submit" value="КУПИТЬ" class="add_to_cart_btn" onclick="prodAval(this.id)">
                                </form>
                            </div>        
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="right-part">
            <div id="popular-prod-content">
                <h2 class="right-title" style="margin-left: 10px;">Фильтр товаров</h2>
                <?php if (!empty(Filter::$activeFilters)) { 
                    $filtersArray = [];
                        switch ($categoryInfo[0]['category_id']) {
                        case 1: 
                            $filtersArray = Filter::$notebookFilters;
                            break;
                        case 2:
                            $filtersArray = Filter::$pcFilters;
                            break;
                        case 3:
                            $filtersArray = Filter::$monitorFilters;
                            break;
                        case 4:
                            $filtersArray = Filter::$audiodeviceFilters;
                            break;
                        default:
                            break;
                    }   ?>
                        <h3 class="active-filters-header">Активные фильтры</h3>
                        <?php foreach (Filter::$activeFilters as $key => $value) {
                            switch ($key) {
                                case 'priceFrom':?>
                                    <div class="filter-element">
                                        <p class="active-filters-text">Цена от: <?php echo Filter::$activeFilters['priceFrom'] ?> €</p>
                                    </div>  
                        <?php   break;  
                                case 'priceTo': ?>
                                    <div class="filter-element">
                                        <p class="active-filters-text">Цена до: <?php echo Filter::$activeFilters['priceTo'] ?> €</p>
                                    </div>
                        <?php   break;
                                case 'product_name':?>
                                    <div class="filter-element">
                                        <p class="active-filters-text">Производители: <?php echo Filter::$activeFilters['product_name'] ?></p>
                                    </div>
                        <?php   break;
                                case 'availability':?>
                                    <div class="filter-element">
                                        <p class="active-filters-text">Доступность на складе: <?php if(Filter::$activeFilters['availability'] == 'available') echo 'доступен'; else echo 'не доступен'; ?></p>
                                    </div> 
                        <?php   break;
                            }
                            if (is_array($value))
                                foreach ($value as $key2 => $value2) { ?>
                                    <div class="filter-element">
                                        <p class="active-filters-text"><?php echo $filtersArray[$key]; ?> : <?php echo $value2 ?></p>
                                    </div> 
                    <?php   }
                        } ?>
                        <form method="post" action="<?php echo $categoryInfo[0]['category_name']; ?>">
                            <input name="destroyFilter" type="submit" class="filter-button remove-filter" value="Удалить фильтры">
                        </form>
                <?php } ?>
                <div class="filter-elem">
                    <p class="filter-title" style="text-decoration: none;">Диапазон цен</p>
                </div>
                <form method="post" action="<?php echo $categoryInfo[0]['category_name']; ?>">
                    <input id="price_from" class="price-filter-text" type="text" name="priceFrom" value="<?php if (!empty(Filter::$activeFilters['priceFrom'])) echo Filter::$activeFilters['priceFrom']; else echo '30.00'; ?>" onfocus="if(this.value=='<?php if (!empty(Filter::$activeFilters['priceFrom'])) echo Filter::$activeFilters['priceFrom']; else echo '30.00'; ?>'){this.value='';}" onblur="if(this.value==''){this.value='';}">€
                    <span style="margin: 0px 5px;">-</span>
                    <input id="price_to" class="price-filter-text" type="text" name="priceTo" value="<?php if (!empty(Filter::$activeFilters['priceTo'])) echo Filter::$activeFilters['priceTo']; else echo '100.00'; ?>" onfocus="if(this.value=='<?php if (!empty(Filter::$activeFilters['priceTo'])) echo Filter::$activeFilters['priceTo']; else echo '100.00'; ?>'){this.value='';}" onblur="if(this.value==''){this.value='';}">€
                    <div class="filter-elem">
                        <p class="filter-title" style="text-decoration: none;">Производитель</p>
                    </div>
                    <?php $productNames = Filter::getProductNames($categoryInfo[0]['category_id']);?>
                        <select id="prodNames" name="prodNames" class="prodNames">                      
                          <?php if (empty(Filter::$activeFilters['product_name'])) { ?><option value="default_value">--Производители--</option> <?php } ?>
                          <?php for ($i = 0; $i < count($productNames); $i++){ ?>
                          <option <?php if (!empty(Filter::$activeFilters['product_name'])) if (Filter::$activeFilters['product_name'] == $productNames[$i]) echo 'selected="selected"'; ?>value="<?php echo $productNames[$i] ?>"><?php echo $productNames[$i] ?></option>
                          <?php } ;?>
                        </select>                        
                    <div class="filter-elem">
                        <p class="filter-title" style="text-decoration: none;">Доступность на складе</p>
                    </div>
                        <input <?php if (!empty(Filter::$activeFilters['availability'])) if (Filter::$activeFilters['availability'] == 'available') echo 'checked="checked"'; ?> class="filter-radio-btn" id="available" type="radio" name="avail" value="available"><span class="radio-btn-text">Доступно</span><br>
                        <input <?php if (!empty(Filter::$activeFilters['availability'])) if (Filter::$activeFilters['availability'] == 'not_avalaible') echo 'checked="checked"'; ?> class="filter-radio-btn" id="not_avalaible" type="radio" name="avail" value="not_avalaible"><span class="radio-btn-text">Не доступно</span><br>
                    <?php switch ($categoryInfo[0]['category_id']) {
                            case 1: 
                                include ROOT.'/views/filters/notebook.php';
                                break;
                            case 2:
                                include ROOT.'/views/filters/pc.php';
                                break;
                            case 3:
                                include ROOT.'/views/filters/monitor.php';
                                break;
                            case 4:
                                include ROOT.'/views/filters/audiodevice.php';
                                break;
                            default:
                                break;
                        }   ?>
                        <input name="filter" type="submit" class="filter-button" value="Применить">
                </form>
               
            </div>
        </div>
    </div>
</div>
<!--!middle-->
<?php include ROOT.'/views/layouts/footer.php'; ?>
