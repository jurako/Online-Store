<?php

include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Product.php';
include_once ROOT . '/components/Cart.php';
include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Order.php';

class AdminController {
    
    public function actionAddUser() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /');
        } else if ($user['Role'] == 2) {
            header ('Location: /admin/products/add');
        }
        
        $name = '';
        $surname = '';
        $email = '';
        $phone = '';
        $address = '';
        $password = '';
        $role = '';
        $result = false;
        
        if (isset($_POST['submitAddUser'])) {
            $name = htmlspecialchars($_POST['userName']);
            $surname = htmlspecialchars($_POST['userSurname']);
            $email = htmlspecialchars($_POST['userEmail']);
            $phone = htmlspecialchars($_POST['userPhone']);
            $address = htmlspecialchars($_POST['userAddress']);
            $password = htmlspecialchars($_POST['userPassword']); 
            $role = htmlspecialchars($_POST['userRole']);
            
            $errors = false;
            
            if (!User::checkName($name)) {
                $errors[] = "Имя не должно быть короче 2-х символов!";
            }
            
            if (!User::checkName($surname)) {
                $errors[] = "Фамилия не должна быть короче 2-х символов!";
            }
            
            if (!User::checkEmail($email)) {
                $errors[] = "E-mail введен не правильно!";
            }
            
            if (User::checkEmailExists($email)) {
                $errors[] = "Такой E-mail уже используется!";  
            }  
            
            if (!User::checkPassword($password)) {
                $errors[] = "Пароль не должен быть короче 6-ти символов!";
            }     
            
            if (User::checkPasswordExists($password)) {
                $errors[] = "Такой пароль уже используется!"; 
            }  

            if ($errors == false) {
                User::addUser($name, $surname, $email, $phone, $address, $password, $role);
                $result = true;
                $name = '';
                $surname = '';
                $email = '';
                $phone = '';
                $address = '';
                $password = '';
                $role = '';
            }                
        }
        
        require_once ROOT . '/views/admin/addUser.php';
        return true; 
    }
    
    public function actionEditUser() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /');
        }  
        
        $users = User::getUsers();
        
        require_once ROOT . '/views/admin/editUser.php';
        return true;
    }    
    
    public function actionViewUser($id) {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /');
        }  
        
        $viewedUser = User::getUserById($id);
        
        
        $name = $viewedUser['Name'];
        $surname = $viewedUser['Surname'];
        $email = $viewedUser['E_mail'];
        $phone = $viewedUser['Phone'];
        $address = $viewedUser['Address'];;
        $password = $viewedUser['Password'];
        $role = $viewedUser['Role'];    
        $result = false;
        
        if (isset($_POST['submitEditUser'])) {
            $name = htmlspecialchars($_POST['userName']);
            $surname = htmlspecialchars($_POST['userSurname']);
            $email = htmlspecialchars($_POST['userEmail']);
            $phone = htmlspecialchars($_POST['userPhone']);
            $address = htmlspecialchars($_POST['userAddress']);
            $password = htmlspecialchars($_POST['userPassword']); 
            $role = htmlspecialchars($_POST['userRole']); 
            
            $errors = false;
            
            if (!User::checkName($name)) {
                $errors[] = "Имя не должно быть короче 2-х символов!";
            }
            
            if (!User::checkName($surname)) {
                $errors[] = "Фамилия не должна быть короче 2-х символов!";
            }
            
            if (!User::checkEmail($email)) {
                $errors[] = "E-mail введен не правильно!";
            }
            
            if (User::checkEmailExists($email)) {
                $errors[] = "Такой E-mail уже используется!";  
            }  
            
            if (!User::checkPassword($password)) {
                $errors[] = "Пароль не должен быть короче 6-ти символов!";
            }     
            
            if (User::checkPasswordExists($password)) {
                $errors[] = "Такой пароль уже используется!"; 
            }  

            if ($errors == false) {
                User::editUser($id, $name, $surname, $email, $phone, $address, $password, $role);
                $result = true;
                $name = '';
                $surname = '';
                $email = '';
                $phone = '';
                $address = '';
                $password = '';
                $role = '';
            }                
        }
        
        if (isset($_POST['submitDeleteUser'])) {
            User::deleteUser($id);
            header ('Location: /admin/users/edit/');
            return true;
        }
        
        require_once ROOT . '/views/admin/viewUser.php';
        return true;
    }        
    
    public function actionAddProduct() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /');
        }
        $categories = Category::getCategories();
        
        $name = '';
        $price = '';
        $charact = '';
        $desc = '';
        $amount = '';
        $category = '';
        $result = false;
        
        if (isset($_POST['submitAddProduct'])) {
            $name = htmlspecialchars($_POST['productName']);
            $price = htmlspecialchars($_POST['productPrice']);
            $charact = htmlspecialchars($_POST['productCharact']);
            $desc = htmlspecialchars($_POST['productDesc']);
            $amount = htmlspecialchars($_POST['productAmount']);
            $category = htmlspecialchars($_POST['productCategory']); 
            
            $errors = false;
            
            if (!Product::checkName($name)) {
                $errors[] = "Имя не должно быть короче 2-х символов!";
            }
            
            if (!Product::checkPrice($price)) {
                $errors[] = "Не верное значение цены!";
            }
            
            if (!Product::checkAmount($amount)) {
                $errors[] = "Не верное значение количества!";
            }   
            
            if (!Product::checkCategory($category)) {
                $errors[] = "Не выбрана категория!";
            }            

            if ($errors == false) {
                Product::addProduct($name, $price, $charact, $desc, $amount, $category);
                $result = true;
                $name = '';
                $price = '';
                $charact = '';
                $desc = '';
                $amount = '';
                $category = '';
            }                
        }
        
        require_once ROOT . '/views/admin/addProduct.php';
        return true;             
    }

    public function actionEditProduct() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /');
        }  
        
        $products = Product::getProducts();
        
        require_once ROOT . '/views/admin/editProduct.php';
        return true;
    }    
    
    public function actionViewProduct($id) {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /');
        }  
        
        $product = Product::getProduct($id);
        
        $name = $product['name'];
        $price = $product['price'];
        $charact = $product['charact'];
        $desc = $product['desc'];
        $amount = $product['amount'];
        $category = $product['category'];
        $result = false;
        
        if (isset($_POST['submitEditProduct'])) {
            $name = htmlspecialchars($_POST['productName']);
            $price = htmlspecialchars($_POST['productPrice']);
            $charact = htmlspecialchars($_POST['productCharact']);
            $desc = htmlspecialchars($_POST['productDesc']);
            $amount = htmlspecialchars($_POST['productAmount']);
            $category = htmlspecialchars($_POST['productCategory']); 
            
            $errors = false;
            
            if (!Product::checkName($name)) {
                $errors[] = "Имя не должно быть короче 2-х символов!";
            }
            
            if (!Product::checkPrice($price)) {
                $errors[] = "Не верное значение цены!";
            }
            
            if (!Product::checkAmount($amount)) {
                $errors[] = "Не верное значение количества!";
            }   
            
            if (!Product::checkCategory($category)) {
                $errors[] = "Не выбрана категория!";
            }            

            if ($errors == false) {
                Product::editProduct($id, $name, $price, $charact, $desc, $amount, $category);
                $result = true;
                $name = '';
                $price = '';
                $charact = '';
                $desc = '';
                $amount = '';
                $category = '';
            }                
        }
        
        if (isset($_POST['submitDeleteProduct'])) {
            Product::deleteproduct($id);
            header ('Location: /admin/products/edit/');
            return true;
        }
        
        require_once ROOT . '/views/admin/viewProduct.php';
        return true;
    }        
    
    public static function actionOrders() {
        
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /');
        }  
        
        $users = User::getUsers();
        
        require_once ROOT . '/views/admin/orders.php';
        return true;       
    }
    
    public static function actionViewOrder($id) {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /');
        }  
        $viewedUser = User::getUserById($id);
        
        if(!empty($_POST['status']))
            foreach ($_POST['status'] as $checked) {
                Order::changeOrderStatus($checked, $viewedUser['User_ID']); 
            }
            
        $orders = Order::getUserOrders($id);
 
        require_once ROOT . '/views/admin/viewOrder.php';
        return true;       
    }    
 
}

?>