<?php

namespace RankingowiecBundle\Libs;


class Utils {

    //Metoda statyczna która z tekstu tworzy slug aby był poprawnym linkiem
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






    
}
