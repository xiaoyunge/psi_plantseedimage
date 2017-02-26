<?php
namespace app\psi\controller;

// ThinkPHP framwork libraries
use think\Controller;
use think\Request;
use think\Loader;

// Custom modules.
use app\psi\_stuff\Config as CustomConfig;
use app\psi\src\data\Species;

// Model.
use app\psi\model\Content as CotentModel;
use app\psi\model\Species as SpeciesModel;


class Search extends Controller
{
	public $order_mapper = [
			/* Querying name => field name in database project to */
			'species' => 'spe_epi, spe_authority, gen_name, spe_name_ch',
			'genus' => 'gen_name, gen_name_ch',
			'family' => 'fam_name_ch, fam_name'
	];
    public function _initialize()
    {	
        $this->view->copyright = CotentModel::get( [
            'part' => 'index_copyright'
        ] )->content_en;
        CustomConfig::FrontInitialize($this->view);
        $this->view->title = 'Search page';
    }
    public function search( Request $request )
    {
    	// Get the query.
        $query = [
        	'search'=> $request->get('search'),
        	'perpage'=> $request->get('perpage'),
        	'order' => $request->get('order'),
        	'page' => $request->get('page')
        ];
        // Validate the query.
        $validate = Loader::validate('Search');
        if(!$result = $validate->check($query)){
        	dump($validate->getError());
        	$query['search'] = '';
        	$query['perpage'] = 10;
        	$query['order'] = 'species';
        	$query['page'] = 1;
		}
        // Query with model.
        $speices = new SpeciesModel;
        $species = Species::getMultiSpeciesBySearchWord(
        				$query['search'], 
        				array(
    						'search' => $query['search'],
    						'perpage' => $query['perpage'],
    						'order' => $query['order'] 
        				),
        				$this->order_mapper[$query['order']],
        				$query['perpage']
        			);
        $this->assign('count', $species->toArray()["total"]);
        $this->assign('pagination', $species);
        $this->assign('items', $species);
        // 
        $this->view->title = 'Search page';
        return $this->fetch();
    }
    public function index( Request $request )
    {   
    	if ( !is_null($request->get('fl')) && is_string($request->get('fl')) ) {
    		$search = $request->get('fl');
    	} else {
    		$search = '';
    	}
    	$order = 'species';
    	$perPage = 10;
    	$firstLetter = $request->get('fl');
    	$species = Species::getMultiSpeciesByFirstLetter(
    			$firstLetter,
    			array(
    					'search' => $request->get('search'),
    					'perpage' => $request->get('perpage'),
    					'order' => $request->get('order')
    			),
    			$this->order_mapper[$order],
    			$perPage
    			);
    	// dump($species);
    	$alphabet = [];
    	for ($alpha = 'a'; $alpha <= 'z'; $alpha++) {
    		if ($alpha == 'aa') {
    			break;
    		}
    		array_push($alphabet, $alpha);
    	}
    	$this->assign( 'alphabet', $alphabet );
        $this->assign( 'title', 'index page' );
        $this->assign('count', $species->toArray()["total"]);
        $this->assign('pagination', $species);
        $this->assign('items', $species);
        return $this->fetch();
    }
}
