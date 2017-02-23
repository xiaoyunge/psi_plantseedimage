<?php
namespace app\psi\controller;
use think\Controller;
use think\Request;
use think\Session;

use app\psi\model\Content as ContentModel;
use app\psi\model\Species as SpeciesModel;
use app\psi\model\Genus as GenusModel;
use app\psi\model\Family as FamilyModel;

class Delete extends Controller
{
    public function _initialize() {
        if ( Session::has('user.hasLogin','think') && Session::get('user.hasLogin','think') == true) {
        } else {
            $this->error('fail', 'think/index.php/psi/normal/home');
        }
    }
    public function deleteSpecieById( Request $request )
    {
        $targetSpeices = SpeciesModel::get([
            'id' => $request->get('spe_id')
            ]);
        $targetSpeices->delete();
        return;
    }
    public function deleteGenusById( Request $request )
    {
        $targetGenus = GenusModel::get([
            'id' => $request->get('gen_id')
            ]);
        $targetGenus->delete();
        return;
    }
    public function deleteNewFamilyById( Request $request )
    {
        $targetFamily = FamilyModel::get([
            'id' => $request->get('fam_id')
            ]);
        $targetFamily->delete();
        return;
    }
}
