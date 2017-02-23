<?php
namespace app\psi\controller;
use think\Controller;
use think\Request;
use think\Session;

use app\psi\model\Content as ContentModel;
use app\psi\model\Species as SpeciesModel;
use app\psi\model\Genus as GenusModel;
use app\psi\model\Family as FamilyModel;

class Update extends Controller
{
    public function _initialize() {
        // Authorisation certification.
        if ( !Session::has('user.auth.can_upd','think') || Session::get('user.auth.can_upd','think') != true ) {
            echo 'Unauthorisation!Now script is terminated';
            exit();
        } else {
            echo 'Authorisation comfirm';
        }
    }
    public function index()
    {
        echo 'index of update';
    }
    public function updateViewContent( Request $request )
    {
        // request - database projection table 
        $table_project = [
            // request name => table name in database
            'index_intro' => 'index_intro',
            'index_about' => 'index_about',
            'index_copyright' => 'index_copyright',
            'index_credit' => 'index_credit'
        ];
        $veiw_content = ContentModel::get([
                'part' => $table_project[ $request->post('content_part')]
        ]);
        $veiw_content->content_en = $request->post('view_content');
        $veiw_content->save();
        return;
    }
    public function updateSpeciesById( Request $request )
    {
        $targetSpecies = SpeciesModel::get([
            'id' => $request->get( "spe_id" )
        ]);
        $targetSpecies->gen_id = $request->get("gen_id");
        $targetSpecies->spe_epi = $request->get("spe_epi");
        $targetSpecies->name_ch = $request->get("spe_name_ch");
        $targetSpecies->authority = $request->get("spe_auth");
        $targetSpecies->save();
    }
    public function updateGenusById( Request $request )
    {
        $targetGenus = GenusModel::get([
            'id' => $request->get( "gen_id" )
        ]);
        $targetGenus->fam_id = $request->get("fam_id");
        $targetGenus->name = $request->get("name");
        $targetGenus->name_ch = $request->get("name_ch");
        $targetGenus->save();
    }
    public function updateFamilyById( Request $request )
    {
        $targetFamily = FamilyModel::get([
            'id' => $request->get( "fam_id" )
        ]);
        $targetFamily->name = $request->get("name");
        $targetFamily->name_ch = $request->get("name_ch");
        $targetFamily->save();
    }
}
