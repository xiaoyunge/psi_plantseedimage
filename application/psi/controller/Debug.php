<?php
namespace app\psi\controller;

use think\Controller;
use think\Request;
use think\Db;

use app\psi\_stuff\Config as CustomConfig;
use app\psi\model\Content as CotentModel;
use app\psi\src\data\Species;
use app\psi\src\validate\ValueProccess;

class Debug extends Controller
{
    public function _initialize()
    {
        $this->view->copyright = CotentModel::get( [
            'part' => 'index_copyright'
        ] )->content_en;
        CustomConfig::FrontInitialize($this->view);
        $this->assign( 'page', 1 );
    }
	public function _validate( Request $request) {
		var_dump($request->get('is_male'));
	}
}
