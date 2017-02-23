<?php
namespace app\psi\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\psi\_stuff\Config as CustomConfig;
// Module
use app\psi\model\Content as CotentModel;
use app\psi\model\Species as SpeciesModel;

class Search extends Controller
{
    public function _initialize()
    {
        $this->view->copyright = CotentModel::get( [
            'part' => 'index_copyright'
        ] )->content_en;
        CustomConfig::FrontInitialize($this->view);
        $this->assign( 'page', 1 );
    }
    public function search( Request $request )
    {
        if ( !is_null($request->get('page')) && is_numeric($request->get('page'))) {
            $page = $request->get('page');
        } else {
            $page = 1;
        }
        if ( !is_null($request->get('ipp')) && is_numeric($request->get('ipp'))) {
            $itemsPerPage = $request->get('ipp');
        } else {
            $itemsPerPage = 10;
        }
        if ( !is_null($request->get('search')) && is_string($request->get('search')) ) {
            $search = $request->get('search');
        } else {
            $search = '';
        }
        if ( !is_null($request->get('order')) && is_string($request->get('order')) ) {
            $order = (String)$request->get('order');
        } else {
            $order = 'species';
        }
        $order_project = [
            /* Querying name => field name in database project to */
            'species' => 's.name_ch, s.binomial',
            'genus' => 'g.name_ch, g.name',
            'family' => 'f.name_ch, f.name'
        ];
        $this->view->title =  'Search page';
        $this->assign( 'search', $request->get('search') );
        $this->assign( 'ipp', $request->get('ipp') );
        $this->assign( 'order', $request->get('order') );
        
        // Main datatbase query snippet(!IMPORTANT)
        $speices = new SpeciesModel;
        $items = $speices->field(
                    ' s.id as "id", ' .
                    ' s.binomial as "binomial", ' .
                    ' s.name_ch as "spe_name_ch", ' .
                    ' g.name as "gen_name_la", ' .
                    ' g.name_ch as "gen_name_ch", ' .
                    ' f.name as "fam_name_la", ' . 
                    ' f.name_ch as "fam_name_ch" '
                    )
            ->alias('s')
            ->join('cate_gen g', 's.gen_id = g.id')
            ->join('cate_fam f', 'g.fam_id = f.id')
            ->where( 's.name_ch', 'like', "%$search%" )
            ->whereOr( 'g.name_ch', 'like', "%$search%" )
            ->whereOr( 'f.name_ch', 'like', "%$search%" )
            ->whereOr( 'binomial', 'like', "%$search%" )
            ->whereOr( 'g.name', 'like', "%$search%" )
            ->whereOr( 'f.name', 'like', "%$search%" )
            ->order($order_project[$order])
            ->page( $page, $itemsPerPage )
            ->select(); 
        $count = $speices->field(
                    ' s.id as "id", ' .
                    ' s.binomial as "binomial", ' .
                    ' s.name_ch as "spe_name_ch", ' .
                    ' g.name as "gen_name_la", ' .
                    ' g.name_ch as "gen_name_ch", ' .
                    ' f.name as "fam_name_la", ' . 
                    ' f.name_ch as "fam_name_ch" '
                    )
            ->alias('s')
            ->join('cate_gen g', 's.gen_id = g.id')
            ->join('cate_fam f', 'g.fam_id = f.id')
            ->where( 's.name_ch', 'like', "%$search%" )
            ->whereOr( 'g.name_ch', 'like', "%$search%" )
            ->whereOr( 'f.name_ch', 'like', "%$search%" )
            ->whereOr( 'binomial', 'like', "%$search%" )
            ->whereOr( 'g.name', 'like', "%$search%" )
            ->whereOr( 'f.name', 'like', "%$search%" )
            ->count();
        $this->view->assign('count', $count);
        $pagination = $speices->field(
                    ' s.id as "id", ' .
                    ' s.binomial as "binomial", ' .
                    ' s.name_ch as "spe_name_ch", ' .
                    ' g.name as "gen_name_la", ' .
                    ' g.name_ch as "gen_name_ch", ' .
                    ' f.name as "fam_name_la", ' . 
                    ' f.name_ch as "fam_name_ch" '
                    )
            ->alias('s')
            ->join('cate_gen g', 's.gen_id = g.id')
            ->join('cate_fam f', 'g.fam_id = f.id')
            ->where( 's.name_ch', 'like', "%$search%" )
            ->whereOr( 'g.name_ch', 'like', "%$search%" )
            ->whereOr( 'f.name_ch', 'like', "%$search%" )
            ->whereOr( 'binomial', 'like', "%$search%" )
            ->whereOr( 'g.name', 'like', "%$search%" )
            ->whereOr( 'f.name', 'like', "%$search%" )
            ->order($order_project[$order])
            ->paginate($request->get('ipp'), false,[
                'type'     => 'bootstrap',
                'var_page' => 'page',
                'query' => array(
                    'search' => $request->get('search'),
                     'ipp' => $request->get('ipp'),
                     'order' => $request->get('order')
                )
            ]);
        $this->assign('pagination', $pagination);
        $this->assign('items', $items);
        return $this->fetch();
    }
    public function index( Request $request )
    {   
        $this->assign( 'title', 'index page' );
        $this->assign( 'page', $request->get('page') );
        return $this->fetch();
    }
}
