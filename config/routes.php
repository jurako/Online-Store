<?php
return array (
    'admin/orders/([0-9]+)' => 'admin/viewOrder/$1', // actionAddUser v AdminController    
    'admin/orders' => 'admin/orders', // actionAddUser v AdminController
    'admin/users/edit/([0-9]+)' => 'admin/viewUser/$1', // actionAddUser v AdminController
    'admin/users/add' => 'admin/addUser', // actionAddUser v AdminController
    'admin/users/edit' => 'admin/editUser', // actionAddUser v AdminController
    'admin/users' => 'admin/users', // actionUsers v AdminController
    'admin/products/edit/([0-9]+)' => 'admin/viewProduct/$1', // actionViewProduct v AdminController
    'admin/products/add' => 'admin/addProduct', // actionAdd v AdminController
    'admin/products/edit' => 'admin/editProduct', // actionEdit v AdminController
    'admin/products' => 'admin/addProduct', // actionAdd v AdminController
    
    'search' => 'main/search', // actionSearch v MainController
    
    'cart/remove/([0-9]+)' => 'cart/remove/$1', // actionRemove v CartController
    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd v CartController
    'cart/order' => 'cart/order', //actionOrder v CartController
    'cart' => 'cart/index', // actionIndex v CartController
    
    'catalog/([a-z]+)/([0-9]+)' => 'product/view/$1/$2', // actionView v ProductController  
    'catalog/([a-z]+)' => 'product/index/$1', // actionIndex v ProductController  
    'catalog' => 'catalog/index', // actionIndex v CatalogController
    
    'cabinet/orders/([0-9]+)' => 'order/view/$1', // actionView v OrderController 
    'cabinet/orders' => 'cabinet/orders', // actionOrders v cabinetController
    'cabinet/contactinfo' => 'cabinet/contact', // actionOrders v cabinetController
    'cabinet/discounts' => 'cabinet/discount', // actionDiscount v cabinetController
    'cabinet/contactshop' => 'cabinet/contactshop', // actionContactshop v cabinetController
         
    'order/confirm' => 'order/confirm', // actionConfirm v OrderController    
    'order' => 'order/index', // actionIndex v OrderController
    
    'cabinet/contact' => 'cabinet/contactshop', // actionContactshop v CabinetController
    'contact' => 'main/contact', // actionContact v MainController
    
    'user/register' => 'user/register', //actionRegister v UserController
    'user/login' => 'user/login', //actionLogin v UserController
    'user/logout' => 'user/logout', //actionLogout v UserController
    
    'OnlineShop' => 'main/index', // actionIndex в MainController
);

?>
