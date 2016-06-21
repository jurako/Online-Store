<?php

include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Order.php';
include_once ROOT . '/components/Discount.php';

class CabinetController {
    
    public function actionOrders() {
    
        $userId = User::checkLogged();
        
        $user = User::getUserById($userId);
        
        $orders = Order::getUserOrders($userId);
        
        require_once ROOT . '/views/cabinet/orders.php';
        return true;
    }
    
    public function actionContact() {
        
        $userId = User::checkLogged(); 
        $user = User::getUserById($userId);
        
        $name = $user['Name'];
        $surname = $user['Surname'];
        $email = $user['E_mail'];
        $address = $user['Phone'];
        $phone = $user['Address'];
        $password = '';
        $result = false;
        
        if (isset($_POST['editPersonalData'])) {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];

            $errors = false;
            
            if (!User::checkName($name)) {
                $errors[] = "Имя не должно быть короче 2-х символов!";
            }
            
            if (!User::checkName($surname)) {
                $errors[] = "Фамилия не должна быть короче 2-х символов!";
            }
            
            if (!User::checkPassword($password)) {
                $errors[] = "Пароль не должен быть короче 6-ти символов!";
            }   
            
            if (!User::checkEmail($email)) {
                $errors[] = "E-mail введен не правильно!";
            }            
            
            if ($errors == false) {
                User::editMyInfo($name, $surname, $email, $address, $phone, $password);
                $result = true;
            }  
        }

        require_once ROOT . '/views/cabinet/contactinfo.php';
        return true;
    }
   
    public function actionDiscount() {
        
        $userId = User::checkLogged();
        
        $user = User::getUserById($userId);
        
        $discounts = Discount::getDiscountsByID($userId);
        
        require_once ROOT . '/views/cabinet/discounts.php';
        return true;
    }    

    public function actionContactshop() {
        
        $userId = User::checkLogged();
        
        $user = User::getUserById($userId);
        
        $result = false;
        $feedback = '';
        
        if (isset($_POST['submitFeedback'])) {
            $feedback = $_POST['feedback'];
            $email = $_POST['email'];
            
            $errors = false;
            
            if (!User::checkEmail($_POST['email'])) {
                $errors[] = "E-mail введен не правильно!";
            }
            
            if ($errors == false) {
                $result = true;
                $feedback = '';
                
                $to      = 'info@computerstore.lv';
                $subject = 'Feedback from '.$email;
                $message = $feedback;
                $headers = 'From: ' . $email . "\r\n" .
                    'Reply-To: info@computerstore.lv' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);
            }
        }
           
        require_once ROOT . '/views/cabinet/contactshop.php';
        return true;
    }   
    
}

?>