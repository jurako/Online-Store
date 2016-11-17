<?php

include_once ROOT . '/models/Product.php';
include_once ROOT . '/models/User.php';

class MainController 
{
    
    public function actionIndex() 
    {   
        $newProducts = array();
        $newProducts = Product::getNewProducts();
        
        $popularProducts = array();
        $popularProducts = Product::getPopularProducts();
        
        require_once (ROOT . '/views/main/index.php');
        return true;
    }
    
    public function actionSearch() 
    {   
        $searchResult = Product::search();
        $searchString = Product::$searchString;
        
        require_once (ROOT . '/views/search/index.php');
        return true;
    }
    
    public function actionContact() 
    {   
        if (isset($_SESSION['userId']))
            $user = User::getUserById($_SESSION['userId']);
        
        $popularProducts = array();
        $popularProducts = Product::getPopularProducts();
        
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
            
        require_once (ROOT . '/views/contacts/index.php');
        return true;
    }    
}

?>
