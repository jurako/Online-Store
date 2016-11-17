<?php

include_once ROOT . '/models/User.php';
include_once ROOT . '/components/Cart.php';
include_once ROOT . '/components/Discount.php';
include_once ROOT . '/models/Order.php';
include_once ROOT . '/models/Product.php';

class OrderController {
    
    public function actionIndex() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        
        $name = $user['Name'];
        $surname = $user['Surname'];
        $email = $user['E_mail'];
        $address = $user['Address'];
        $phone = $user['Phone'];
        $discount = '';
        
        require_once ROOT . '/views/order/index.php';
        return true;
    }

    public function actionConfirm() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        
        $errors = false;
        $name = $user['Name'];
        $surname = $user['Surname'];
        $email = $user['E_mail'];
        $address = $user['Address'];
        $phone = $user['Phone'];
        $discount = '';
        $giveDiscount = false;
        
        if (isset($_POST['confirmOrder'])) {
            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $email = htmlspecialchars($_POST['email']);
            $address = htmlspecialchars($_POST['address']);
            $phone = htmlspecialchars($_POST['phone']);
            if (isset($_POST['delivery'])) {
                if ($_POST['delivery'] == 'po_pochte') {
                    $delivery = "po_pochte";
                } else {
                    $delivery = "kurjerom";
                }
            }
            $comment = htmlspecialchars($_POST['comment']);
            
            if (isset($_POST['discount']) && !empty($_POST['discount'])) {
                $discount = htmlspecialchars($_POST['discount']);
                if (Discount::checkExists($discount)) {
                    if (Discount::checkStatus($discount)) {
                        if (Discount::checkUser($discount, $_SESSION['userId'])) {
                            $giveDiscount = true;
                            Discount::markUsed($discount);
                        } else {
                            $giveDiscount = false;
                            $errors[] = "Неверный скидочный купон!";
                        }
                    } else {
                        $giveDiscount = false;
                        $errors[] = "Скидочный купон уже использован!";
                    }
                } else {
                    $giveDiscount = false;
                    $errors[] = "Неверный скидочный купон!";
                }
            }

            
            if (!isset($_POST['delivery'])) {
                $errors[] = "Выберите способ доставки!";
            }
            
            if ($errors == false) {
                Order::makeOrder($delivery, $comment, $giveDiscount);
                $orderID = Order::getLastOrder();
                Order::sendInvoiceToUser($orderID);
                
                
                foreach ($_SESSION['cart'] as $id => $quantity) {
                    Product::decreaseAmount($id, $quantity);
                    Product::checkAmountLeft($id, $quantity);
                }
                
                Order::saveOrderedItems($orderID);
                unset($_SESSION['cart'], $_SESSION['cartSum'], $_SESSION['cartCount']);
                Cart::deleteUserFromCart($_SESSION['userId']);
                
                header ('Location: /cabinet/orders/' . $orderID);
                return true; 
            }  else {
                require_once ROOT. '/views/order/index.php';
                return true; 
            }
        }
    }
    
    public function actionView($id) {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        $order = Order::getOrderById($id);
        $orderedItems = Order::getOrderedItems($order['Order_ID']);
        
        require_once ROOT . '/views/order/view.php';
        return true;
    }
    
}

?>