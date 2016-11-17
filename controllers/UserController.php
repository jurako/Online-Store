<?php
include_once ROOT . '/models/User.php';
include_once ROOT . '/components/Cart.php';

class UserController {
    
    public function actionRegister() {
        $name = '';
        $surname = '';
        $email = '';
        $address = '';
        $phone = '';
        $password = '';
        $result = false;
        
        if (isset($_POST['registerSubmit'])) {
            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $email = htmlspecialchars($_POST['email']);
            $address = htmlspecialchars($_POST['address']);
            $phone = htmlspecialchars($_POST['phone']);
            $password = htmlspecialchars($_POST['password']);

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
            
            if (User::checkEmailExists($email)) {
                $errors[] = "Такой E-mail уже используется!";                
            }
            
            if (User::checkPasswordExists($password)) {
                $errors[] = "Такой пароль уже используется!";                
            }
            
            if ($errors == false) {
                $result = User::register($name, $surname, $email, $phone, $address, $password);
            }  
        }
        
        require_once ROOT. '/views/user/register.php';
        return true; 
    }
    
     public function actionLogin() {
        $email = '';
        $password = '';
        
        if (isset($_POST['submit'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            
            $errors = false;
            
            if (!User::checkPassword($password)) {
                $errors[] = "Пароль не должен быть короче 6-ти символов!";
            }   
            
            if (!User::checkEmail($email)) {
                $errors[] = "E-mail введен не правильно!";
            }
            
            $userId = User::checkUserData($email, $password);
            
            if ($userId == false) {
                $errors[] = "Неправильные данные для входа на сайт!";
            } else {
                User::auth($userId);
                $role = User::getRole($userId);
                
                switch ($role) {
                    case 1:
                        header('Location: /admin/users/add');
                        break;
                    case 2:
                        header('Location: /admin/products/add');
                        break;
                    case 3:
                        Cart::getCart($userId);
                        $_SESSION['cartSum'] = Cart::getSum();
                        $_SESSION['cartCount'] = Cart::countItems();

                        header('Location: /cabinet/orders');
                        break;
                    default:
                        break;
                }

            }
        }
         
        require_once ROOT . '/views/user/login.php';
        return true;
    }
    
    public function actionLogout() {
        Cart::saveCart();
        unset($_SESSION['userId']);
        header ('Location: /');
    }
}

?>