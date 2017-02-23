<?php
namespace app\psi\controller;
use think\Controller;
use think\Request;
use think\Session;
use \app\psi\_stuff\Config as CustomConfig;

// use app\psi\model\Content as ContentModel;
use app\psi\model\Species as SpeciesModel;
use app\psi\model\Genus as GenusModel;
use app\psi\model\Family as FamilyModel;

class Insert extends Controller
{
    public function _initialize() {
        if ( !Session::has('user.auth.can_ins','think') || Session::get('user.auth.can_ins','think') != true ) {
            echo 'Unauthorisation\nNow script is terminated';
            exit();
        } else {
            echo 'Authorisation comfirm';
        }
    }
    public function insertNewSpecie( Request $request )
    {
        // Inistanize the model for create a new tuple.
        $newSpecie = new SpeciesModel;
        $currentId = SpeciesModel::get(function($query){
            $query->order('id desc')->limit(1);
        })->id + 1;
        // Declare the values of fields.
        $gen_name_la = GenusModel::get([
            'id' => $request->post('gen_id')
                ])->name;
        $binomial = sprintf("%s %s %s", 
                $gen_name_la, 
                $request->post('binomial_spe_epi'), 
                $request->post('binomial_auth')
                );
        $newSpecie->data([
            'id' => $currentId,
            'binomial' => $binomial,
            'name_ch' => $request->post('binomial_ch'),
            'gen_id' => $request->post('gen_id')
        ]);
        // Insert a new tuple.
        $newSpecie->save();
        // Get the auto increase id.
        // Get the upload files.
        $seedImage = request()->file('seed_img');
        $maturedImage = request()->file('matured_img');
        if ( $seedImage ) {
            $imagePath = CustomConfig::uploadInitialize()['species_image_upload_path'];
            $seedImagePath = sprintf('%s/%s/seed/', $imagePath, $currentId);
            $info_seedImage = $seedImage->move($seedImagePath);
            if ($info_seedImage){
                $this->success('sucess',  'think/index.php/psi/normal/home');
            } else {
                $this->error('fail');
            }
        } else {
                $this->success('sucess',  'think/index.php/psi/normal/home');
        }
        if ( $maturedImage ) {
            $imagePath = CustomConfig::uploadInitialize()['species_image_upload_path'];
            $maturedImagePath = sprintf('%s/%s/matured/', $imagePath, $currentId);
            $info_maturedImage = $maturedImage->move($maturedImagePath);
            if($info_maturedImage){
                $this->success('sucess',  'think/index.php/psi/normal/home');
            }else{
                $this->error('fail');
            }
        } else {
                $this->success('sucess',  'think/index.php/psi/normal/home');
        } 
    }
    public function insertNewFamily( Request $request )
    {
        $newFamily = new FamilyModel;
        $currentId = FamilyModel::get( function($query){
            $query->order('id desc')->limit(1);
        })->id + 1;
        $newFamily->data([
            'id' => $currentId,
            'name' => $request->get('fam_name'),
            'name_ch' => $request->get('fam_name_ch')
        ]);
        $newFamily->save();
    }
    public function insertNewGenus( Request $request )
    {
        $newGenus = new GenusModel;
        $currentId = GenusModel::get( function($query){
            $query->order('id desc')->limit(1);
        })->id + 1;
        $newGenus->data([
            'id' => $currentId,
            'name' => $request->get('gen_name'),
            'name_ch' => $request->get('gen_name_ch'),
            'fam_id' => $request->get('fam_id')
        ]);
        $newGenus->save();
    }
}
