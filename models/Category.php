<?php

class Category 
{
    public static function getCategories() 
    {
        $db = Db::getConnection();
        
        $categoryList = array();
        
        $result = $db->query('SELECT Category_ID, Name, NameLatin FROM categories');
        
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['Category_ID'];
            $categoryList[$i]['name'] = $row['Name'];
            $categoryList[$i]['name_latin'] = $row['NameLatin'];
            $i++;
        }
        return $categoryList;
    }
    
    
}

?>