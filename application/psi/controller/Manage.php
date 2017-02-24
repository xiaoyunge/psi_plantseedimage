<?php
namespace app\psi\controller;

use think\Controller;
use think\Session;
// use think\Url;

use app\psi\_stuff\Config as CustomConfig;
// Model
use app\psi\model\Content as CotentModel;
use app\psi\model\User as UserModel;
use app\psi\model\Species as SpeciesModel;
use app\psi\model\Genus as GenusModel;
use app\psi\model\Family as FamilyModel;

use app\psi\src\stuff\Stuff as NewStuffClass;

class Manage extends Controller
{
    public function _initialize()
    {
        if ( Session::has('user.hasLogin','think') && Session::get('user.hasLogin','think') == true) {
        } else {
            $this->error('fail', 'think/index.php/psi/normal/home');
        }
        $this->view->copyright = CotentModel::get( [
            'part' => 'index_copyright'
        ] )->content_en;
        $this->view->tab_name =  NULL;
        CustomConfig::FrontInitialize($this->view);
        $this->view->title =  'Manage page' ;
    }
    public function insert()
    {
        $this->view->tab_name =  'insert';
        return $this->fetch();
    }
    public function species()
    {
        $this->view->tab_name =  'tuple';
        $specieses = 
                SpeciesModel::field(
                    ' s.id as "id", ' .
                    ' s.spe_epi as "spe_epi", ' .
                    ' s.authority as "spe_authority", ' .
                    ' s.name_ch as "spe_name_ch", ' .
                    ' g.name as "gen_name_la", ' .
                    ' g.name_ch as "gen_name_ch", ' .
                    ' f.name as "fam_name_la", ' . 
                    ' f.name_ch as "fam_name_ch" '
                    )
            ->alias('s')
            ->join('cate_gen g', 's.gen_id = g.id')
            ->join('cate_fam f', 'g.fam_id = f.id')
            ->where( 's.id', '>', "0" )
            ->order('s.id')
            ->paginate(10);
        $speciesList = array();
            /* @var $value type */
        foreach ($specieses as $species) {
            $tuple = [
                'id' => $species->id,
                'fam_name_ch' => $species->fam_name_ch,
                'fam_name_la' => $species->fam_name_la,
                'gen_name_ch' => $species->gen_name_ch,
                 'gen_name_la' => $species->gen_name_la,
                'spe_name_ch' => $species->spe_name_ch,
                'spe_epi' => $species->spe_epi,
                'spe_authority' => $species->spe_authority
            ];
            array_push($speciesList, $tuple);
        }
        $page = $specieses->render();
        $this->view->assign('specieses', $speciesList);
        $this->view->assign('page', $page);
        return $this->fetch("manage/tuple/species");
    }
    public function content()
    {
        $this->view->tab_name =  'content';
        return $this->fetch();
    }
    public function genus(){
        $this->view->tab_name =  'tuple';
        $genuses = GenusModel::field(
                    ' g.id as id, '.
                    ' g.name as name_la, '.
                    ' g.name_ch as name_ch, '.
                    ' f.name as fam_name_la, '.
                    ' f.name_ch as fam_name_ch '
                ) ->alias('g')
            ->join('cate_fam f', 'g.fam_id = f.id')
            ->where( 'g.id', '>', "0" )
            ->order('g.id')
            ->paginate(10);
        $genusesList = array();
        foreach ($genuses as $genus) {
            $tuple = [
                'id' => $genus->id,
                'name_ch' => $genus->name_ch,
                'name_la' => $genus->name_la,
                'fam_name_ch' => $genus->fam_name_ch,
                'fam_name_la' => $genus->fam_name_la
            ];
            array_push($genusesList, $tuple);
        }
        $page = $genuses->render();
        $this->view->assign('genuses', $genusesList);
        $this->view->assign('page', $page);
        return $this->fetch("manage/tuple/genus");
    }
    public function family() {
        $this->view->tab_name =  'tuple';
        $families = FamilyModel::field(
                    ' f.id as id, '.
                    ' f.name as name_la, '.
                    ' f.name_ch as name_ch '
                ) ->alias('f')
            ->where( 'f.id', '>', "0" )
            ->order('f.id')
            ->paginate(10);
        $familiesList = array();
        foreach ($families as $family) {
            $tuple = [
                'id' => $family->id,
                'name_ch' => $family->name_ch,
                'name_la' => $family->name_la
            ];
            array_push($familiesList, $tuple);
        }
        $page = $families->render();
        $this->view->assign('families', $familiesList);
        $this->view->assign('page', $page);
        return $this->fetch("manage/tuple/family");
    }
    public function updateInfo() {
        if ( !is_null(NewStuffClass::readChangeLog()) ) {
            $changeLog = NewStuffClass::readChangeLog();
        } else {
            $changeLog = '';
        }
        $this->view->assign('changelog', $changeLog);
        $this->view->tab_name =  'updateinfo';
        return $this->fetch("manage/updateinfo");
    }
}
