<?php
/**
 * Description of Config
 *
 * @author haitao
 */
namespace app\psi\_stuff;
use think\Lang;

class Config {
    //put your code here
    public static $config = [
        'view' => [
            '__PUBLIC__' => '/think/public/static',
            '__PRIVATECSS__' => '/think/public/static/css/psi',
            '__PRIVATEJS__' => '/think/public/static/js/custom/psi',
            '__NPMREPO__' => '/think/public/static/js/vendor/node_modules',
            '__VUETPL__' => '/think/public/static/js/custom/vue_template/psi',
            '__APPPATH__' => APP_PATH,
            '__BOWERCOMP__' => '/think/public/static/js/vendor/bower_components',
            // The images of 
            '__IMG_SPECIES__' => '/think/public/static/img/psi/species',
            // Path which can access the website
            '__ACESSPATH__' => '/think/index.php/psi',
            '__SERVER_ABS_ROOT_PATH__' => 'd:/xampp/htdocs'
            // The public static resource directory of website,including CSS files,JavaScript  files and images.
            ],
            'upload' => [
                'species_image_upload_path' => '/think/public/static/img/species'
            ]
       ];
    public static function FrontInitialize( $view ) {
        /*
         *  @PARAM $view: the member "view" of controller
         */
        $view->replace(self::$config['view']);
        // $view->title =  self::$config[ 'deufaltPageTitle' ] ;
        Lang::setAllowLangList(['zh-cn', 'en-us', 'jp']);
    }
    public static function uploadInitialize( ) {
        /*
         *  @PARAM $view: the member "view" of controller
         */
        return self::$config['upload'];
    }
}
