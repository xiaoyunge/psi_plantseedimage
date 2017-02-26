<?php
/**
 * Description of Species
 *
 * @author haitao
 */
namespace app\psi\src\data;

use app\psi\model\Species as SpeciesModel;

final class Species {
	public function __construct() {
		
	}
	/**
	 * Get multi species by keywords.
	 * @access public staic
	 * @param string	$searchWord	Keyword for searching.
	 * @param string	$urlquery URL query.
	 * @param number	$order Order by field names.
	 * @param number	$perPage Items number per page.
	 * @return mixed
	 */
    public final static function getMultiSpeciesBySearchWord( $search,$urlquery=[],$order="s.name_ch, s.spe_epi, s.authority", $perPage=10 ){
    	try {
    		$speciesModel = new SpeciesModel;
    		$speciesList = $speciesModel->field(
    						' s.id as "id", ' .
    						' s.spe_epi as "spe_epi", ' .
    						' s.name_ch as "spe_name_ch", ' .
    						' s.authority as "spe_authority",' . 
    						' g.name as "gen_name", ' .
    						' g.name_ch as "gen_name_ch", ' .
    						' f.name as "fam_name", ' .
    						' f.name_ch as "fam_name_ch" '
    					)
						->alias('s')
    					->join('cate_gen g', 's.gen_id = g.id')
    					->join('cate_fam f', 'g.fam_id = f.id')
    					// Species info
    					->where( 's.spe_epi', 'like', "%$search%" )
    					->whereOr( 's.authority', 'like', "%$search%" )
    					->whereOr( 's.name_ch', 'like', "%$search%" )
    					// Genus info
    					->whereOr( 'g.name', 'like', "%$search%" )
    					->whereOr( 'g.name_ch', 'like', "%$search%" )
    					// Family info
    					->whereOr( 'f.name_ch', 'like', "%$search%" )
    					->whereOr( 'f.name', 'like', "%$search%" )
    					->order( $order )
    					->paginate([
    							'list_rows' => $perPage,
    							'var_page' => 'page',
    							'query' => $urlquery
    						]);
    		return $speciesList;
    	} catch (Exception $e) {
    		return false;
    	}
    }	// End of function declaration.
    /**
     * Get multi species by keywords.
     * @access public staic
     * @param string	$id	Species id.
     * @param string	$urlquery URL query.
     * @return mixed
     */
    public final static function getSpeciesById( $id, $urlquery=[] ) {
    	try {
    		$speciesModel = new SpeciesModel();
    		$spcies = $speciesModel->field(
    						' s.id as "id", ' .
    						' s.spe_epi as "spe_epi", ' .
    						' s.name_ch as "spe_name_ch", ' .
    						' s.authority as "spe_authority",' . 
    						' g.id as "gen_id", ' .
    						' g.name as "gen_name", ' .
    						' g.name_ch as "gen_name_ch", ' .
    						' f.id as "fam_id", ' .
    						' f.name as "fam_name", ' .
    						' f.name_ch as "fam_name_ch" '
    					)
    					->alias('s')
    					->join('cate_gen g', 's.gen_id = g.id')
    					->join('cate_fam f', 'g.fam_id = f.id')
    					->where( 's.id', '=', $id )
    					->find()->toArray();
    		return $spcies;
    	} catch (Exception $e) {
    		return false;
    	}
    }	// End of function.
    public final static function getMultiSpeciesByGenusId( $genusId, $urlquery=[] ){
    	try {
    		$speciesModel = new SpeciesModel();
    		$spcies = $speciesModel->field(
    					' s.id as "id", ' .
    					' s.spe_epi as "spe_epi", ' .
    					' s.name_ch as "spe_name_ch", ' .
    					' s.authority as "spe_authority",' .
    					' g.id as "gen_id", ' .
    					' g.name as "gen_name", ' .
    					' g.name_ch as "gen_name_ch", ' .
    					' f.id as "fam_id, ' .
    					' f.name as "fam_name", ' .
    					' f.name_ch as "fam_name_ch" '
    				)
    				->alias('s')
    				->join('cate_gen g', 's.gen_id = g.id')
    				->join('cate_fam f', 'g.fam_id = f.id')
    				->where( 'g.id', '=', $genusId )
    				->select();
    		return $spcies;
    	} catch (Exception $e) {
    		return false;
    	}
    }
    public final static function getMultiSpeciesByFirstLetter( $firstLetter='', $urlquery=[], $order="s.name_ch, s.spe_epi, s.authority", $perPage=10 ) {
    	try {
    		$speciesModel = new SpeciesModel;
    		$speciesList = $speciesModel->field(
    				' s.id as "id", ' .
    				' s.spe_epi as "spe_epi" , ' .
    				' s.name_ch as "spe_name_ch" , ' .
    				' s.authority as "spe_authority" ,' .
    				' g.name as "gen_name" , ' .
    				' g.name_ch as "gen_name_ch" , ' .
    				' f.name as "fam_name" , ' .
    				' f.name_ch as "fam_name_ch" '
    				)
    				->alias('s')
    				->join('cate_gen g', 's.gen_id = g.id')
    				->join('cate_fam f', 'g.fam_id = f.id')
    				// Genus info
    				->where( 'g.name', 'like', "$firstLetter%" )
    				// Family info
    				->whereOr( 'f.name', 'like', "$firstLetter%" )
    				->order( $order )
    				->paginate([
    					'list_rows' => $perPage,
    					'var_page' => 'page',
    					'query' => $urlquery
    				]);
    		return $speciesList;
    	} catch (Exception $e) {
    		return false;
    	}
    }
}
