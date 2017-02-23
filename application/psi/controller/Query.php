<?php
/**
 * This controller has not conrenposive 
 *
 * 
 */
namespace app\psi\controller;

// ThinkPHP official class import.
use think\Controller;
use think\Request;
// Custom model.
use app\psi\model\Species as SpeciesModel;
use app\psi\model\Content as ContentModel;
use app\psi\model\Genus as GenusModel;
use app\psi\model\Family as FamilyModel;

class Query  extends Controller
{
    //put your code here
    public function _initialize() {
    }
    public function query()
    {
        return;
    }
    public function queryViewContent( Request $request )
    {
        $table_project = [
            'index_intro' => 'index_intro',
            'index_about' => 'index_about',
            'index_copyright' => 'index_copyright',
            'index_credit' => 'index_credit'
        ];
        $viewContent = ContentModel::get([
            'part' => $table_project[ $request->get('content_part')] ]
        )->content_en;
        //dump($viewContent);
        return $viewContent;
    }
    public function queryAllFamily() {
        $families = FamilyModel::all();
        $list = array();
        /* @var $family type */
        foreach($families as $family){
            $tuple = [
                'id' => $family->id,
                'name' => $family->name,
                'name_ch' => $family->name_ch
            ];
            array_push($list, $tuple);
        }
        return  $list;
    }
    public function queryAllGenusByFamilyId() {
        $genus = GenusModel::all(
                function( $query ){
                    $request = Request::instance();
                    $query->field(
                        ' g.id as "id" , ' .
                        ' g.name as "name" , ' .
                        ' g.name_ch as "name_ch" , ' .
                        ' g.fam_id as "fam_id" '
                    )
                     ->alias( 'g' )
                    ->where( 'g.fam_id', '=', $request->get('fam_id') );
                }); // End of closure query.
        $return = [];
        foreach ($genus as $genus_item) {
            $genus_item = $genus_item->toArray();
            array_push($return, $genus_item);
        }
        //dump($return);
        return $genus;
    }
    public function querySpeciesById( ){
        $species = SpeciesModel::get(
                function ($query) {
                    $request = Request::instance();
                    $query->field(
                        ' s.spe_epi as "spe_epi", ' .
                        ' s.authority as "spe_authority", ' .
                        ' s.name_ch as "spe_name_ch", '.
                        ' g.id as "gen_id", ' .
                        ' g.name as "gen_name", ' .
                        ' g.name_ch as "gen_name_ch", '.
                        ' f.id as "fam_id", '.
                        ' f.name as "fam_name", '.
                        ' f.name_ch as "fam_name_ch" '
                    )
                     ->alias( 's' )
                     ->join( 'cate_gen g', 'g.id = s.gen_id' )
                     ->join( 'cate_fam f', 'f.id = g.fam_id' )
                    ->where( 's.id', '=', $request->get('spe_id') );
                });
        return $species;
    }
    public function queryGenusById( ){
        $genus = GenusModel::get(
                function($query){
                    $request = Request::instance();
                    $query->field(
                        ' g.id as "gen_id", ' .
                        ' g.name as "gen_name", ' .
                        ' g.name_ch as "gen_name_ch", ' .
                        ' f.id as "fam_id", ' .
                        ' f.name as "fam_name", ' .
                        ' f.name_ch as "fam_name_ch" '
                    )
                     ->alias( 'g' )
                     ->join( 'cate_fam f', 'f.id = g.fam_id' )
                    ->where( 'g.id', '=', $request->get('gen_id') );
                });
        return $genus;
    }
}
