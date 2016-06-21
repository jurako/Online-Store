<?php

include_once ROOT . '/models/User.php';
include_once ROOT . '/components/Cart.php';

class CartController {
    
    public function actionAdd($id) {
        
        if (isset($_POST['quantity']))
            Cart::addProduct($id);
        $_SESSION['cartSum'] = Cart::getSum();
        $_SESSION['cartCount'] = Cart::countItems();
              
        $referer = $_SERVER['HTTP_REFERER'];
        header ("Location: $referer");        
    }
    
    public function actionIndex() {
        
        require_once ROOT . '/views/cart/index.php';
        return true; 
    }
    
    public function actionRemove($id) {
        
        Cart::removeProduct($id);
        $_SESSION['cartSum'] = Cart::getSum();
        $_SESSION['cartCount'] = Cart::countItems();
        
        require_once ROOT.'/views/cart/index.php';
        return true; 
    }

    public function actionOrder() {

        if (isset($_SESSION['userId'])) {
            $available = Cart::checkAvailable();
            if ($available)
                header ('Location: /OnlineShop/views/order/index.php');
            else {
                require_once ROOT.'/views/cart/index.php';
                return true;
            }
        } else
            header ('Location: /OnlineShop/user/login');
    }
    
}

?>