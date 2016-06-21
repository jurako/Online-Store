<?php

class Product 
{
    public static $searchString;

    public static function getNewProducts ()
    {
        $db = Db::getConnection();
        
        $newProductsList = array();
        
        $result = $db->query('SELECT Product_ID, Name, Price, Description, Amount, Category FROM products WHERE isNew="1"');
        
        $i = 0;
        while ($row = $result->fetch()) {
            $newProductsList[$i]['id'] = $row['Product_ID'];
            $newProductsList[$i]['name'] = $row['Name'];
            $newProductsList[$i]['price'] = $row['Price'];
            $newProductsList[$i]['desc'] = $row['Description'];
            $newProductsList[$i]['amount'] = $row['Amount'];
            
            $result2 = $db->query('SELECT NameLatin FROM categories WHERE Category_ID="'.$row['Category'].'"');
            $j = 0;
            while ($row2 = $result2->fetch()) {
                $newProductsList[$i]['categoryName'] = $row2['NameLatin'];
                $j++;
            }
            $i++;
        }
        return $newProductsList;
    }
    
    public static function getPopularProducts () {
        $db = Db::getConnection();
        
        $popularProducts = array();
        
        $result = $db->query('SELECT Product_ID, Name, Price, Category FROM products WHERE Popular!="0" LIMIT 5');
        
        $i = 0;
        while ($row = $result->fetch()) {
            $popularProducts[$i]['id'] = $row['Product_ID'];
            $popularProducts[$i]['name'] = $row['Name'];
            $popularProducts[$i]['price'] = $row['Price'];
            
            $result2 = $db->query('SELECT NameLatin FROM categories WHERE Category_ID="'.$row['Category'].'"');
            $j = 0;
            while ($row2 = $result2->fetch()) {
                $popularProducts[$i]['categoryName'] = $row2['NameLatin'];
                $j++;
            }
            $i++;
        }
        
        return $popularProducts;
    }
    
    public static function getCategoryOfProduct ($category) {
        $db = Db::getConnection();
        $categoryInfo = array ();
        
        $result = $db->query('SELECT Category_ID, Name, NameLatin FROM categories WHERE NameLatin="'.$category.'"');
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryInfo[$i]['category_id'] = $row['Category_ID'];
            $categoryInfo[$i]['category'] = $row['Name'];
            $categoryInfo[$i]['category_name'] = $row['NameLatin'];
            $i++;
        }
            
        return $categoryInfo; 
    }

    public static function getProductsByCategory ($category) {
        $db = Db::getConnection();
       
        $productsList = array();
        
        $catNum = $db->query('SELECT Category_ID FROM categories WHERE NameLatin="'.$category.'"');
        $catNum = $catNum->fetch();
        
        $result = $db->query('SELECT Product_ID, Name, Price, Characteristics, Description, Amount FROM products WHERE Category="'.$catNum[0].'"');
        
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['Product_ID'];
            $productsList[$i]['name'] = $row['Name'];
            $productsList[$i]['price'] = $row['Price'];
            $productsList[$i]['charact'] = $row['Characteristics'];
            $productsList[$i]['desc'] = $row['Description'];
            $productsList[$i]['amount'] = $row['Amount'];
            $i++;
        }
        
        /*Filter*/
        if (isset($_POST['filter'])) {
            $productsList = Filter::filterProducts($productsList, $category);
        }
        if (isset($_POST['destroyFilters'])) {
            Filter::destroyFilters();
        }
        return $productsList;
    }
    
    public static function getProductsByID ($category, $id) {
        $db = Db::getConnection();
       
        $product = array();

        $catNum = $db->query('SELECT Category_ID, Name FROM categories WHERE NameLatin="'.$category.'"');
        $catNum = $catNum->fetch();
        $result = $db->query('SELECT Product_ID, Name, Price, Characteristics, Description, Amount FROM products WHERE Product_ID="'.$id.'" AND Category="'.$catNum[0].'"');
        
        while ($row = $result->fetch()) {
            $product['id'] = $row['Product_ID'];
            $product['name'] = $row['Name'];
            $product['price'] = $row['Price'];
            $product['charact'] = $row['Characteristics'];
            $product['desc'] = $row['Description'];
            $product['amount'] = $row['Amount'];
            $product['category'] = $catNum[1];
        }
        if (empty($product))
            header('Location: http://localhost/OnlineShop/catalog/'.$category);
        else
            return $product;
    }
    
    public static function getProductCharacteristics ($charact) {
        $firstExplode = [];
        $secondExplode = [];
        $result = [];
        
        $firstExplode = explode(";", $charact);
        array_pop($firstExplode);
        
        foreach ($firstExplode as $key => $value) {
            $secondExplode = explode (":", $value);
            $result[$secondExplode[0]] = $secondExplode[1]; 
        }        
        return $result;
    }
    
    public static function search () {
        $resultArray = [];
        
        if (isset($_POST['searchBtn'])) {
            if($_POST['searchTextBox'] == "Поиск" || empty($_POST['searchTextBox'])) {
                $resultArray[0] = -1;
                return $resultArray;
            }
            else {
                $db = Db::getConnection();
                
                Product::$searchString = $_POST['searchTextBox'];
                $searchRes = $_POST['searchTextBox'];   
                $searchRes = '%' . $searchRes . '%';
                
                $sql = "SELECT Product_ID, Name, Price, Description, Amount, Category FROM products WHERE Name LIKE :searchRes";
        
                $result = $db->prepare($sql);
                $result->bindParam(':searchRes', $searchRes, PDO::PARAM_STR);
                $result->execute();
                
                $i = 0;
                while ($row = $result->fetch()) {
                    $resultArray[$i]['id'] = $row['Product_ID'];
                    $resultArray[$i]['name'] = $row['Name'];
                    $resultArray[$i]['price'] = $row['Price'];
                    $resultArray[$i]['desc'] = $row['Description'];
                    $resultArray[$i]['amount'] = $row['Amount'];
                    
                    $result2 = $db->query('SELECT NameLatin FROM categories WHERE Category_ID="'.$row['Category'].'"');
                    $j = 0;
                    while ($row2 = $result2->fetch()) {
                        $resultArray[$i]['categoryName'] = $row2['NameLatin'];
                        $j++;
                    }
                    $i++;
                } 
            }           
        }
        return $resultArray;
    }
    
    public static function checkName ($name) {
        if (!empty($name)) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function checkPrice ($price) {
        if (!empty($price) && $price > 0 && is_numeric($price)) {
            return true;
        } else {
            return false;
        }
    }    
    
    public static function checkAmount ($amount) {
        if (!empty($amount) && $amount > 0 && is_numeric($amount)) {
            return true;
        } else {
            return false;
        }
    }  

    public static function checkCategory ($category) {
        if (!empty($category) && $category != "--Категории--") {
            return true;
        } else {
            return false;
        }
    }    
    
    public static function addProduct ($name, $price, $charact, $desc, $amount, $category) {
        $db = Db::getConnection();
        
        $sql = 'SELECT Category_ID FROM categories WHERE NameLatin = :category';
        
        $result = $db->prepare($sql);
        $result->bindParam(':category', $category, PDO::PARAM_STR);
        $result->execute();
        
        $row = $result->fetch();
        $category = $row['Category_ID'];
        
        $sql = 'INSERT INTO products (Name, Price, Characteristics, Description, Amount, Category) VALUES (:name, :price, :charact, :desc, :amount, :category)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':price', $price, PDO::PARAM_STR);
        $result->bindParam(':charact', $charact, PDO::PARAM_STR);
        $result->bindParam(':desc', $desc, PDO::PARAM_STR);
        $result->bindParam(':amount', $amount, PDO::PARAM_STR);
        $result->bindParam(':category', $category, PDO::PARAM_STR);
        $result->execute();
        
    }
    
    public static function editProduct($id, $name, $price, $charact, $desc, $amount, $category) {
        $db = Db::getConnection();
        
        switch ($category) {
            case 'notebook':
                $category = 1;
                break;
            case 'pc':
                $category = 2;
                break;
            case 'monitor':
                $category = 3;
                break;
            case 'audiodevice':
                $category = 4;
                break;
        }
        
        $sql = 'UPDATE products SET Name = :name, Price = :price, Characteristics = :charact, Description = :desc, Amoun = :amount, Category = :category WHERE Product_ID = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':price', $price, PDO::PARAM_STR);
        $result->bindParam(':charact', $charact, PDO::PARAM_STR);
        $result->bindParam(':desc', $desc, PDO::PARAM_STR);
        $result->bindParam(':amount', $amount, PDO::PARAM_STR);
        $result->bindParam(':category', $category, PDO::PARAM_STR);
        $result->execute();     
    }    
    
    public static function deleteProduct($id) {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM products WHERE Product_ID = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();     
    }      
  
    public static function getProducts () {
        $db = Db::getConnection();
        
        $productsList = [];
        
        $result = $db->query('SELECT * FROM products');
        
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['Product_ID'];
            $productsList[$i]['name'] = $row['Name'];
            $i++;
        }
        
        return $productsList;
    }
    
    public static function getProduct ($id) {
        $db = Db::getConnection();
        
        $product = [];
        
        $result = $db->query('SELECT * FROM products WHERE Product_ID = "'.$id.'"');
        
        while ($row = $result->fetch()) {
            $product['id'] = $row['Product_ID'];
            $product['name'] = $row['Name'];
            $product['price'] = $row['Price'];
            $product['charact'] = $row['Characteristics'];
            $product['desc'] = $row['Description'];
            $product['amount'] = $row['Amount'];
            $product['category'] = $row['Category'];
        }
        
        $catNum = $db->query('SELECT Category_ID, NameLatin FROM categories WHERE Category_ID="'.$product['category'].'"');
        $catNum = $catNum->fetch();
        
        $product['cat_nam'] = $catNum[1];
        
        return $product;
    }    
    
    public static function decreaseAmount($id, $quantity) {
        $db = Db::getConnection();
        
        $product = Product::getProduct($id);
        
        $newAmount = $product['amount'] - $quantity;
        
        $sql = 'UPDATE products SET Amount = '.$newAmount.' WHERE Product_ID = '.$id; 
        $result = $db->prepare($sql);
        $result->execute();   
    }
    
    public static function checkAmountLeft($id, $quantity) {
        $db = Db::getConnection();
        
        $product = Product::getProduct($id);
        
        if ($product['amount'] == 0) {
            $admins = [];
            
            $sql = 'SELECT * FROM users WHERE Role = 1 OR Role = 2'; 
            $result = $db->prepare($sql);
            $result->execute();  
            
            $i = 0;
            while ($row = $result->fetch()) {
                $admins[$i]['name'] = $row['Name'];
                $admins[$i]['surname'] = $row['Surname'];
                $admins[$i]['email'] = $row['E_mail'];
                $i++;
            }
            
            foreach ($admins as $admin) {
                $to      = $admin['email'];
                $subject = 'Product '.$product['name'].' not left.';
                $message = 'Dear '.$admin['name'].' '.$admin['surname']
                        .'The product: '.$product['name']
                        .' amount is 0.';
                $headers = 'From: info@computerstore.lv' . "\r\n" .
                    'Reply-To: info@computerstore.lv' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);
            }
        } 
    }
}

?>
