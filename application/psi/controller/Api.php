<?php
namespace app\psi\controller;

use think\Controller;
use think\Request;
use app\psi\controller\query\User as UserQueryController;

class Api  extends Controller{
    public function _initialize() {
        parent::_initialize();
        echo  'api page<br>';
    }
    public function UserQuery() {
        return 'UserQuery<br>';
    }
}
