<?php

class Cart {
    
    public static function addProduct($id) {
        $id = intval($id);
        if (isset($_POST['quantity'])) {
            if ($_POST['quantity'] <= 0 && !ctype_digit($_POST['quantity'])) {
                $amount = 0;
            } else {
                $amount = $_POST['quantity']; 
            }
        }
        
        $productsInCart = array ();
        
        if (isset($_SESSION['cart'])) {
            $productsInCart = $_SESSION['cart'];
        }
        
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] += $amount;
        } else if ($amount == 0){

        } else 
            $productsInCart[$id] = $amount;
        
        $_SESSION['cart'] = $productsInCart;
        print_r($_SESSION['cart']);
    }
    
    public static function removeProduct($id) {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        } else {
            $cartItems = $_SESSION['cart'];
            unset($cartItems[$id]);
            $_SESSION['cart'] = $cartItems;
        }
    }

    public static function countItems() {
        if (isset($_SESSION['cart'])) {
            $count = 0;
            foreach ($_SESSION['cart'] as $id => $quantity) {
                $count += $quantity;
            }
            return $count;
        } else {
            return 0;
        } 
    }

    public static function getSum() {
        $sum = 0;
        
        if (isset($_SESSION['cart'])) { 
            $db = Db::getConnection();
            $prices =[];
            
            foreach ($_SESSION['cart'] as $id => $quantity) {
                $sql = "SELECT Price FROM products WHERE Product_ID = :id";
                
                $result = $db->prepare($sql);
                $result->bindParam(':id', $id, PDO::PARAM_STR);
                $result->execute();
                
                while ($row = $result->fetch()) {
                    $prices[$id] = $row['Price'];
                }
            }
            foreach ($_SESSION['cart'] as $id => $quantity) {
                $sum += $prices[$id] * $quantity;
            }
            
        }
        return $sum;
    }
    
    public static function getCart () {
        $db = Db::getConnection();
        
        $userId = $_SESSION['userId'];
        $cartItems = [];
        $productsInCart = [];
        
        $result1 = $db->query('SELECT * FROM cart WHERE User_ID="'.$userId.'"');
        $result2 = $result1->fetchAll();
        $db->query('DELETE FROM cart WHERE User_ID="'.$userId.'"');
        
        foreach ($result2 as $item) {
            $cartItems[$item['Product_ID']] = $item['Count'];
        }
        
        if (!isset($_SESSION['cart'])) {
            if (!empty($cartItems))
                $_SESSION['cart'] = $cartItems;
            else
                $_SESSION['cart'] = array ();
        } else {
            $productsInCart = $_SESSION['cart'];
            
            if (!empty($cartItems)) {
                foreach ($cartItems as $id => $quantity) {
                    if (array_key_exists($id, $productsInCart)) {
                        $productsInCart[$id] += $quantity;
                    } else 
                        $productsInCart[$id] = $quantity;
                }
            }
        }
        $_SESSION['cart'] = $productsInCart;

    }      
    
    public static function saveCart () {
        $db = Db::getConnection();
        $userId = $_SESSION['userId'];
        $insertNewRow = true;
        
        $result1 = $db->query('SELECT * FROM cart WHERE User_ID="'.$userId.'"');
        $cartItems = $result1->fetchAll();

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $quantity) {
                
                if (!empty($cartItems)) {
                    foreach ($cartItems as $item) {
                        if ($item['Product_ID'] == $id && $item['User_ID'] == $userId) {
                            $newAmount = $quantity + $item['Count'];
                            $sql = "UPDATE cart SET Count = :newAmount WHERE Record_ID = :recordId";

                            $result = $db->prepare($sql);
                            $result->bindParam(':newAmount', $newAmount, PDO::PARAM_STR);
                            $result->bindParam(':recordId', $item['Record_ID'], PDO::PARAM_STR);
                            $result->execute();
                            $insertNewRow = false;
                        }
                    }
                }
                if ($insertNewRow == true) {
                    $productId = $id;
                    $amount = $quantity;

                    $sql = "INSERT INTO cart (User_ID, Product_ID, Count) VALUES (:id, :product_id, :amount)";

                    $result = $db->prepare($sql);
                    $result->bindParam(':id', $userId, PDO::PARAM_STR);
                    $result->bindParam(':product_id', $productId, PDO::PARAM_STR);
                    $result->bindParam(':amount', $amount, PDO::PARAM_STR);
                    $result->execute();                    
                }
            }
            unset($_SESSION['cart']);
            unset($_SESSION['cartSum']);
            unset($_SESSION['cartCount']);
        }   
    }
    
    public static function checkAvailable() {
        $db = Db::getConnection();
        $product = [];
        $results = [];
        $flag = true;
        foreach ($_SESSION['cart'] as $id => $quantity) {
            $result = $db->query('SELECT * FROM products WHERE Product_ID ="'.$id.'"');
            
            while ($row = $result->fetch()) {
                $product['amount'] = $row['Amount'];            
            }
            
            if ($quantity > $product['amount']) {
                $flag =  false;
                break;
            }
        }
        return $flag;
    }
    
    public static function deleteUserFromCart($userId) {
        $db = Db::getConnection();

        $db->query('DELETE FROM cart WHERE User_ID="'.$userId.'"');
    }    
}
?>