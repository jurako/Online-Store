<?php

class User {
 
    public static function getUserById($id) {
        
        if ($id) {    
            $db = Db::getConnection();

            $sql = 'SELECT * FROM users WHERE User_ID = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_STR);
            
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();  
        }
    }    
    
        public static function register($name, $surname, $email, $phone, $address, $password) {
            $db = Db::getConnection();

            $sql = 'INSERT INTO users (Name, Surname, E_mail, Phone, Address, Password, Role) '
                    . 'VALUES (:name, :surname, :email, :phone, :address, :password, 4)';

            $result = $db->prepare($sql);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':surname', $surname, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':phone', $phone, PDO::PARAM_STR);
            $result->bindParam(':address', $address, PDO::PARAM_STR);
            $result->bindParam(':password', $password, PDO::PARAM_STR);

            return $result->execute();        

        }
    
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }    
    
    public static function checkEmailExists($email) {
        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM users WHERE E_mail = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        
        if ($result->fetchColumn())
            return true;
        return false;
    }
    
    public static function checkPasswordExists($password) {
        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM users WHERE Password = :password';
        
        $result = $db->prepare($sql);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        
        if ($result->fetchColumn())
            return true;
        return false;   
    }
    
    public static function checkUserData($email, $password) {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM users WHERE E_Mail = :email AND Password = :password';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);        
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        
        $user = $result->fetch();
        if($user) {
            return $user['User_ID'];
        }
        return false;
    }    
    
    public static function auth($userID) {
         $_SESSION['userId'] = $userID;
    }
    
    public static function checkLogged() {
         if (isset($_SESSION['userId'])) {
             return $_SESSION['userId'];
         }
         
         header ('Location: /user/login');
    }    
    
    public static function isGuest() {
         if (isset($_SESSION['userId'])) {
             return false;
         }
         return true;     
    }    
    
    public static function editMyInfo($name, $surname, $email, $address, $phone, $password) {
        $db = Db::getConnection();
        
        $sql = 'UPDATE users SET Name = :name, Surname = :surname, E_Mail = :email, Address = :address, Phone = :phone, Password = :password '
                . 'WHERE User_ID = :id';
        
        $result = $db->prepare($sql);             
        $result->bindParam(':id', $_SESSION['userId'], PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);        
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);        
        $result->bindParam(':address', $address, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);        
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
    }    
        
    public static function getRole($id) {
        $db = Db::getConnection();
        
        $sql = 'SELECT Role FROM users WHERE User_ID = :id';
        
        $result = $db->prepare($sql);             
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();
        
        $userRole = $result->fetch();
        
        return $userRole['Role'];
    }
    
    public static function addUser($name, $surname, $email, $phone, $address, $password, $role) {
        $db = Db::getConnection();

        $sql = 'INSERT INTO users (Name, Surname, E_mail, Phone, Address, Password, Role) VALUES (:name, :surname, :email, :phone, :address, :password, :role)';

        $result = $db->prepare($sql);             
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);        
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);        
        $result->bindParam(':address', $address, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);        
        $result->bindParam(':role', $role, PDO::PARAM_STR);
        $result->execute();
    }   
    
    public static function editUser($id, $name, $surname, $email, $phone, $address, $password, $role) {
        $db = Db::getConnection();
        
        $sql = 'UPDATE users SET Name = :name, Surname = :surname, E_Mail = :email, Address = :address, Phone = :phone, Password = :password, Role = :role '
                . 'WHERE User_ID = :id';
        
        $result = $db->prepare($sql);             
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);        
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);        
        $result->bindParam(':address', $address, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);        
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':role', $role, PDO::PARAM_STR);
        $result->execute();
    }     
    
    public static function deleteUser($id) {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM users WHERE User_ID = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();     
    }      
    
    public static function getUsers() {
        $db = Db::getConnection();

        $usersList = [];
        
        $result = $db->query('SELECT * FROM users');
        
        $i = 0;
        while ($row = $result->fetch()) {
            $usersList[$i]['id'] = $row['User_ID'];
            $usersList[$i]['name'] = $row['Name'];
            $usersList[$i]['surname'] = $row['Surname'];
            $i++;
        }
        
        return $usersList;
    }      
}

?>