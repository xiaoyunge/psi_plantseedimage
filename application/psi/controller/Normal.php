<?php
/*
 *  @author: Kaitou ou
 *  @
 */
namespace app\psi\controller;

// ThinkPHP official class
use think\Controller;
use think\Request;
// use think\View;
// Custom modual
use app\psi\_stuff\Config as CustomConfig;
use app\psi\_stuff\Stuff;

// Model be used
use app\psi\model\Content as CotentModel;
use app\psi\model\Species as SpeciesModel;

class Normal extends Controller
{
    public function _initialize()
    {   
        $this->view->copyright = CotentModel::get( [
            'part' => 'index_copyright'
        ] )->content_en;
        CustomConfig::FrontInitialize($this->view);
    }
    public function home()
    {   
        // Define the request varibles
        /* 
         * TODO
         */
        $this->view->total_species_number = SpeciesModel::where('id','>',0)->count('id');
        if ( is_null($this->view->total_species_number) ) {
            $this->view->total_species_number = '1072+';
        }
         $this->view->intro = CotentModel::get( [
            'part' => 'index_intro'
        ] )->content_en;
        $this->view->about = CotentModel::get([
            'part' => 'index_about'
        ])->content_en;
        $this->view->credit = CotentModel::get([
            'part' => 'index_credit'
        ])->content_en;
         
        // Stuff
       $carouselUrls = Stuff::generateSpeciesId();
       $this->view->carouselUrls = $carouselUrls;
       $this->view->title = 'Home page';
        // Template output
        return $this->fetch();
    }
    public function about() {
        $this->view->replace([
            '__PUBLIC__'    =>  '/psi/public/static'
        ]);
        $this->assign('name', 'Amuro');
        $this->assign('item', 'gundam');
        $this->assign( 'title', 'search page' );
        $this->assign( 'hobby', 'maid cafe' );
        
        //return $this->fetch();
    }
    public function help() {
       $this->view->replace([
            '__PUBLIC__'    =>  '/psi/public/static',
        ]);
       $this->assign('title', 'help page');
        $this->assign( 'name', 'help');
        return $this->fetch();
    }
    /*
     *  Private funcitons
     */
    // Database model query
    private function showContents()
    {   
        $index_intro = CotentModel::get( [
            'part' => 'index_intro'
        ] );
        $index_about = CotentModel::get([
            'part' => 'index_about'
        ]);
        $index_credit = CotentModel::get([
            'part' => 'index_credit'
        ])->content_en;
        $this->assign('index_about', $index_about->content_en);
        $this->assign('index_credit', $index_credit);
    }
    public function test() {
        $species = SpeciesModel::get([
            'id' => '1'
            ]);
        $species = $species->toArray();
        $binomial = $species[ "binomial" ];
        dump( $binomial );
        $binomial_splited = preg_split("/\s+/", $binomial);
        dump( $binomial_splited );
    }
}
