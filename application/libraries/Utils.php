<?php

class Utils {
    
    public static function generateHash($Length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $Length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public static function getMonth($Month){
        $ma = array(
            '01' => 'Ianuarie',
            '02' => 'Februarie',
            '03' => 'Martie',
            '04' => 'Aprilie',
            '05' => 'Mai',
            '06' => 'Iunie',
            '07' => 'Iulie',
            '08' => 'August',
            '09' => 'Septembrie',
            '10' => 'Octombrie',
            '11' => 'Noiembrie',
            '12' => 'Decembrie',
        );
        return $ma[$Month];
    }
    
    public static function slugify($text){
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');
        
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        
        // lowercase
        $text = strtolower($text);
        
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        
        if (empty($text))
        {
            return 'n-a';
        }
        
        return $text;
    }
    
}