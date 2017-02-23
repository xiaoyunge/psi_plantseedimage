<?php
/**
 * Description of home
 *
 * @author haitao
 */
namespace app\gamer\controller;

use think\Controller;
use think\Request;
use think\Db;

class Normal extends controller {
    //put your code here
    public function _initialize() 
    {
         $this->view->replace([
            '__PUBLIC__'    =>  '/psi/public/static',
            '__NPMREPO__'    =>  '/psi/public/static/js/vendor/node_modules'
        ]);
        $this->view->title =  'untitled page' ;
    }
    public function Home()
    {
        return $this->fetch();
    }    
}
