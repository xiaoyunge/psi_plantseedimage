<?php
namespace app\psi\controller;

use think\Controller;
use think\Request;

use app\psi\_stuff\Config as CustomConfig;
  
class File extends Controller{
    public function findAllSpeciesImages( Request $request){
        $speciesId = $request->get('spe_id');
        $serverAbsRootUrl = CustomConfig::$config['view']['__SERVER_ABS_ROOT_PATH__'];
        $speciesImageRootUrl = CustomConfig::$config['view']['__IMG_SPECIES__'];
        $dir = "$serverAbsRootUrl$speciesImageRootUrl/$speciesId/seed/";
        $imageUrls = [];
        if (is_dir($dir)) {
             if ($dh= opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ( $file != '.' && $file != '..' ) {
                        $complete_url = $dir.$file;
                        //echo 'abspath: ' . $dir.$file ."<br>";
                        array_push($imageUrls, $complete_url);
                    } 
                }
                closedir($dh);
            } else {
                return false;
            }
        } else {
               return false;
        }
        return $imageUrls;
    }
}
