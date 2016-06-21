<?php

class Filter {
    
    public static $activeFilters;
    
    public static $notebookFilters = array (
        "color" => "Цвет",
        "screen_size" => "Размер экрана",
        "screen_resolution" => "Разрешение экрана",
        "GHz" => "Частота процессора",
        "RAM" => "Объём оперативной памяти",
        "OS" => "Тип операционной системы"
    );
    
    public static $pcFilters = array (
        "cpu" => "Модель процессора",
        "GHz" => "Частота процессора",
        "cores" => "Количество ядер",
        "RAM" => "Обьём оперативной памяти",
        "HDD" => "Обьём жёсткого диска",
        "OS" => "Операционная система"
    );
            
    public static $monitorFilters = array (
        "screen_size" => "Размер экрана",
        "screen_type" => "Тип экрана",
        "max_resolution" => "Максимальное разрешение",
        "size" => "Соотношение сторон",
        "Brigthness" => "Яркость"
    );
            
    public static $audiodeviceFilters = array (
        "type" => "Тип колонок",
        "canals" => "Число каналов",
        "power" => "Суммарная мощность (RMS)",
        "Hz" => "Частотный диапазон"
    );

    public static function getProductNames ($category){
        $db = Db::getConnection();
        
        $productNames = array ();
        
        $sql = 'SELECT Name FROM products WHERE Category = :category';
        
        $fullNames = $db->prepare($sql);
        $fullNames->bindParam(':category', $category, PDO::PARAM_STR);
        $fullNames->execute();
        
        $i = 0;
        while ($row = $fullNames->fetch()) {
            $name = explode(' ', trim($row[$i]));
            if (!in_array($name[0], $productNames)) {
                $productNames[] = $name[0];
            }
        }
        return $productNames;     
    } 
    
    public static function getFilterParameters ($filterName, $category) {
        $db = Db::getConnection();
        
        $result = array();
        $finalResult = array();
        $descriptions = array();
        

        
        $sql = 'SELECT Characteristics FROM products WHERE Category = :category';
        
        $descriptions = $db->prepare($sql);
        $descriptions->bindParam(':category', $category, PDO::PARAM_STR);
        $descriptions->execute();
        
        $i = 0;
        while ($row = $descriptions->fetch()) {
            $result[$i] = $row['Characteristics'];
            $i++;
        }
        $j = 0;
        foreach ($result as $value) {
            $string = $value;
            $specs = array();
            preg_match_all('/(.*?):\s+(.*?); ?/i', $string, $matches, PREG_PATTERN_ORDER);
            for ($i = 0; $i < count($matches[1]); $i++) {
                $specs[$matches[1][$i]] = $matches[2][$i];
            }

            $finalResult[$j] = $specs[$filterName];
            $j++;
        }

        $finalResult = array_unique($finalResult);
        return $finalResult;
        
    }
    
    public static function filterProducts ($productsList, $category) {
        
        /**FILTER BY PRICE**/
        if (!empty($_POST['priceFrom']))
            Filter::$activeFilters['priceFrom'] = $_POST['priceFrom'];
        else 
            Filter::$activeFilters['priceFrom'] = 0;
        
        if (!empty($_POST['priceTo'])) 
            Filter::$activeFilters['priceTo'] = $_POST['priceTo'];
        else
            Filter::$activeFilters['priceTo'] = 0;
        
        foreach ($productsList as $subKey => $subArray) {
            if (!($subArray['price'] > Filter::$activeFilters['priceFrom'] && $subArray['price'] < Filter::$activeFilters['priceTo'])) {
                unset($productsList[$subKey]);
            }
        }   
        
        /**FILTER BY PRODUCT NAME**/
        if ($_POST['prodNames'] == "default_value") { } 
        else
        {
            if (!empty($_POST['prodNames'])) {
                Filter::$activeFilters['product_name'] = $_POST['prodNames'];
            }

            foreach ($productsList as $subKey => $subArray) {
                if (strpos($subArray['name'], Filter::$activeFilters['product_name']) === false) {
                    unset($productsList[$subKey]);
                }
            }  
        }
        
        /**FILTER BY PRODUCT AVAILABILITY**/
        if (isset($_POST['avail'])) {
            Filter::$activeFilters['availability'] = $_POST['avail'];
            
            if ($_POST['avail'] == 'available') {
                foreach ($productsList as $subKey => $subArray) {
                    if ($subArray['amount'] <= 0) {
                        unset($productsList[$subKey]);
                    }   
                }  
            } else {
                foreach ($productsList as $subKey => $subArray) {
                    if ($subArray['amount'] > 0) {
                        unset($productsList[$subKey]);
                    }   
                }  
            }  
        }
        
        /**OTHER FILTERS**/
        $array = [];
        switch ($category) {
            case 'notebook':
                $array = Filter::$notebookFilters;
                break;
            case 'pc':
                $array = Filter::$pcFilters;
                break;
            case 'monitor':
                $array = Filter::$monitorFilters;
                break;
            case 'audiodevice':
                $array = Filter::$audiodeviceFilters;
                break;
            default:
                break;       
        }
        
        $unsetKeys = [];
        foreach ($array as $key => $value) {
            if (isset($_POST[$key])) {
                foreach ($_POST[$key] as $value) {
                    Filter::$activeFilters[$key][$value] = $value;   
                }
                foreach ($productsList as $key2 => $value2) {
                    foreach ($_POST[$key] as $value3) {
                        if (strpos($value2['charact'], Filter::$activeFilters[$key][$value3]) === false) {
                            array_push($unsetKeys, $key2);
                        } else {
                            for ($i = 0; $i < count($unsetKeys); $i++) {
                                if ($unsetKeys[$i] == $key2) {
                                    unset($unsetKeys[$i]);
                                }
                            }
                            $unsetKeys = array_values($unsetKeys);
                            break; 
                        }                              
                    }
                }
            }
            foreach ($unsetKeys as $key3 => $value3) {
                unset ($productsList[$value3]);
            }                       
        }    
        return $productsList = array_values($productsList);
    }  
    
    
    public function destroyFilters() {
        header('Location: ' . basename($_SERVER['PHP_SELF']));
    }
}

?>