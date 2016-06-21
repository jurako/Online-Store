<?php

include_once ROOT . '../models/Product.php';

class ProductController {
    
    public function actionIndex ($category) {
        
        $products = array();
        $products = Product::getProductsByCategory($category);
        
        $categoryInfo = array();
        $categoryInfo = Product::getCategoryOfProduct($category);
        
        require_once ROOT.'/views/products/index.php';
        return true;
    }
    
    public function actionView ($category, $id) {

        $singleProduct = array();
        $singleProduct = Product::getProductsByID($category, $id);
        
        $popularProducts = array();
        $popularProducts = Product::getPopularProducts();
        
        $charact = Product::getProductCharacteristics($singleProduct['charact']);

        require_once ROOT.'/views/products/view.php';
        return true;
    }
}

?>
