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
            header ('Location: /OnlineShop');
        } else if ($user['Role'] == 2) {
            header ('Location: /OnlineShop/admin/products/add');
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
            $name = $_POST['userName'];
            $surname = $_POST['userSurname'];
            $email = $_POST['userEmail'];
            $phone = $_POST['userPhone'];
            $address = $_POST['userAddress'];
            $password = $_POST['userPassword']; 
            $role = $_POST['userRole'];
            
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
            header ('Location: /OnlineShop');
        }  
        
        $users = User::getUsers();
        
        require_once ROOT . '/views/admin/editUser.php';
        return true;
    }    
    
    public function actionViewUser($id) {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /OnlineShop');
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
            $name = $_POST['userName'];
            $surname = $_POST['userSurname'];
            $email = $_POST['userEmail'];
            $phone = $_POST['userPhone'];
            $address = $_POST['userAddress'];
            $password = $_POST['userPassword']; 
            $role = $_POST['userRole']; 
            
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
            header ('Location: /OnlineShop/admin/users/edit/');
            return true;
        }
        
        require_once ROOT . '/views/admin/viewUser.php';
        return true;
    }        
    
    public function actionAddProduct() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /OnlineShop');
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
            $name = $_POST['productName'];
            $price = $_POST['productPrice'];
            $charact = $_POST['productCharact'];
            $desc = $_POST['productDesc'];
            $amount = $_POST['productAmount'];
            $category = $_POST['productCategory']; 
            
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
            header ('Location: /OnlineShop');
        }  
        
        $products = Product::getProducts();
        
        require_once ROOT . '/views/admin/editProduct.php';
        return true;
    }    
    
    public function actionViewProduct($id) {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /OnlineShop');
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
            $name = $_POST['productName'];
            $price = $_POST['productPrice'];
            $charact = $_POST['productCharact'];
            $desc = $_POST['productDesc'];
            $amount = $_POST['productAmount'];
            $category = $_POST['productCategory']; 
            
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
            header ('Location: /OnlineShop/admin/products/edit/');
            return true;
        }
        
        require_once ROOT . '/views/admin/viewProduct.php';
        return true;
    }        
    
    public static function actionOrders() {
        
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /OnlineShop');
        }  
        
        $users = User::getUsers();
        
        require_once ROOT . '/views/admin/orders.php';
        return true;       
    }
    
    public static function actionViewOrder($id) {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['Role'] == 3) {
            header ('Location: /OnlineShop');
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