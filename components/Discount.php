<?php

class Discount 
{
    public static function checkExists($discount) 
    {
        $db = Db::getConnection();
        
        $result = $db->query('SELECT * FROM discounts WHERE Discount_number="'.$discount.'"');  
        
        $discount = $result->fetch();

        if(empty($discount)) {
            return false;
        } else {
            return true;
        }
    }
    
    public static function checkStatus($discount) 
    {
        $db = Db::getConnection();
        
        $result = $db->query('SELECT * FROM discounts WHERE Discount_number="'.$discount.'"');  
        
        $discount = $result->fetch();

        if($discount['Status'] == '0') {
            return true;
        } else {
            return false;
        }
    }   
    
    public static function checkUser($discount, $userId) 
    {
        $db = Db::getConnection();
        
        $result = $db->query('SELECT * FROM discounts WHERE Discount_number="'.$discount.'"');  
        
        $discount = $result->fetch();

        if($discount['User_ID'] == $userId) {
            return true;
        } else {
            return false;
        }
    }      
    
    public static function markUsed($discount) 
    {
        $db = Db::getConnection();
        
        $result = $db->query('UPDATE discounts SET Status = 1 WHERE Discount_number="'.$discount.'"');  
    } 
    
    public static function giveDiscount($userID) 
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO discounts (User_ID, Status) VALUES ('.$userID.', 0)';
        
        $result = $db->prepare($sql);
        $result->execute();  
    }
    
    public static function getDiscountsByID($userID) 
    {
        $db = Db::getConnection();
        $discounts = [];
        
        $sql = 'SELECT * FROM discounts WHERE User_ID = "'.$userID.'"';
        
        $result = $db->prepare($sql);
        $result->execute();  
        
        $i = 0;
        while ($row = $result->fetch()) {
            $discounts[$i]['id'] = $row['Discount_number'];
            $discounts[$i]['status'] = $row['Status'];
            $i++;
        }
        
        return $discounts;
    }
            
}

?>