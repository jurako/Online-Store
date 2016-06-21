<?php

include_once ROOT . '/components/Discount.php';

class Order 
{
    public static function makeOrder($delivery, $comment, $giveDiscount) 
    {
        $db = Db::getConnection();

        $userId = $_SESSION['userId'];
        $totalPrice = $_SESSION['cartSum'];
        $discountUsed = 'No';
        if ($delivery == 'po_pochte') {
            $totalPrice += 1;
        } else if ($delivery == 'kurjerom')
            $totalPrice += 10;
        if ($giveDiscount) {
            $discount = $totalPrice / 5;
            $totalPrice = $totalPrice - $discount;
            $discountUsed = 'Yes';
        }
        
        $status = 'not_paid';
        $date = date("m/d/Y h:i:s a", time());
  
        $sql = 'INSERT INTO orders (User_ID, Delivery_method, Comment, Total_price, Discount_used, Status, Order_date)'
                . 'VALUES (:id, :delivery, :comment, :total_price, :discount_used, :status, :order_date)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_STR);
        $result->bindParam(':delivery', $delivery, PDO::PARAM_STR);
        $result->bindParam(':comment', $comment, PDO::PARAM_STR);
        $result->bindParam(':total_price', $totalPrice, PDO::PARAM_STR);
        $result->bindParam(':discount_used', $discountUsed, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        $result->bindParam(':order_date', $date, PDO::PARAM_STR);
        $result->execute();  
    }
    
    public static function getOrderById($id) {        
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM orders WHERE Order_ID = :id';  
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();
        
        $order = $result->fetch();
        
        return $order; 
    }
    
    public static function getUserOrders($id) {        
        $db = Db::getConnection();
        $orderList = [];
        
        $result = $db->query('SELECT * FROM orders WHERE User_ID = "'.$id.'"');  
        
        $i = 0;
        while ($row = $result->fetch()) {
            $orderList[$i]['order_id'] = $row['Order_ID'];
            $orderList[$i]['total_price'] = $row['Total_price'];
            $orderList[$i]['status'] = $row['Status'];
            $orderList[$i]['order_date'] = $row['Order_date'];
            $i++;
        }
        
        return $orderList; 
    }    
    
    public static function getLastOrder() {
        $db = Db::getConnection();

        $result = $db->query('SELECT Order_ID FROM orders ORDER BY Order_ID DESC LIMIT 1;');  
        
        $lastId = $result->fetch();
        
        return $lastId['Order_ID'];
    }
    
    public static function saveOrderedItems($orderID) {
        $db = Db::getConnection();
        
        foreach ($_SESSION['cart'] as $id => $quantity) {
            $sql = 'INSERT INTO ordered_items (Order_ID, Product_ID, Count)'
            . 'VALUES (:order_id, :product_id, :count)';

            $result = $db->prepare($sql);
            $result->bindParam(':order_id', $orderID, PDO::PARAM_STR);
            $result->bindParam(':product_id', $id, PDO::PARAM_STR);
            $result->bindParam(':count', $quantity, PDO::PARAM_STR);

            $result->execute(); 
        }

    }    
    
    public static function getOrderedItems($orderID) {
        $db = Db::getConnection();
        $orderedItems = array();
        
        $result = $db->query('SELECT Product_ID, Count FROM ordered_items WHERE Order_ID="'.$orderID.'"');
        
        $i = 0;
        while ($row = $result->fetch()) {
            $orderedItems[$i]['product_id'] = $row['Product_ID'];
            $orderedItems[$i]['count'] = $row['Count'];
            $i++;
        }
        
        $i = 0;
        foreach ($orderedItems as $key => $value) {
            $result = $db->query('SELECT Name, Price FROM products WHERE Product_ID="'.$value['product_id'].'"');

            $row = $result->fetch();
            $orderedItems[$i]['name'] = $row['Name'];
            $orderedItems[$i]['price'] = $row['Price'];
            $i++;    
        }
        
        return $orderedItems;
    }    

    public static function changeOrderStatus($orderID, $userID) {
        $db = Db::getConnection();
        
        $sql = 'UPDATE orders SET Status = 1 WHERE Order_ID = "'.$orderID.'"';
        
        $result = $db->prepare($sql);             
        $result->execute();    
        
        $order = [];
        $order = Order::getOrderById($orderID);
        
        if ($order['Total_price'] > 1000)
            Discount::giveDiscount ($userID);
        
    }    
    
    public static function sendInvoiceToUser($orderID) {
        $order = Order::getOrderById($orderID);
        $ordered_items = Order::getOrderedItems($orderID);
        $user = User::getUserById($_SESSION['userId']);
        
        require ("fpdf/fpdf.php");
        $pdf = new FPDF();
        $pdf->AddPage();
        
        $pdf->SetFont("Arial", "B", 16);
        $pdf->Cell(0,10,"Invoice Nr. ".$order['Order_ID'],0,0,'C');
        $$content = $pdf->Output('doc2.pdf','F');

    }      
    
    
    
}

?>