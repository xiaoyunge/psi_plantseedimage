<?php
/**
 * Description of newPHPClass
 *
 * @author haitao
 */
namespace app\psi\src\stuff;

class Stuff {
    public static function readChangeLog() {
        $file = APP_PATH  . "psi/_stuff/changelog.txt";
        $fcontent = "";
        if ( !file_exists($file) ) {
             return false;
        }
        $fh = fopen($file, "r");
        while ( $line = fgets($fh) ) {
            $fcontent .= $line;
        }
        fclose($fh);
        return $fcontent;
    }
}

