<?php

namespace RankingowiecBundle\Libs;


class Utils {
    
    static public function sluggify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return NULL;
        }

        return $text;
    }

    static function restyle_text($input){
        $input = number_format($input);
        $input_count = substr_count($input, ',');
        if($input_count != '0'){
            if($input_count == '1'){
                return substr($input, 0, -4).' tyś';
            } else if($input_count == '2'){
                return substr($input, 0, -8).' mil';
            } else if($input_count == '3'){
                return substr($input, 0,  -12).' mld';
            } else {
                return;
            }
        } else {
            return $input;
        }
    }
    
}
