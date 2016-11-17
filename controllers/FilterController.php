<?php

include_once ROOT . '/components/Filter.php';

class FilterController 
{
    
    public function actionIndex($category) 
    {   
        $filteredProducts = array();
        $filteredProducts = Filter::filterItems($curr_Product, $category);
        
        header ('Location: ', ROOT . '/views/products/index.php');
        return true;
    }
}

?>
