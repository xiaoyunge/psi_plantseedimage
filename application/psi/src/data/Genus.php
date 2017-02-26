<?php
namespace app\psi\src\data;

use app\psi\model\Genus as GenusModel;

final class Genus {
	public function getMultiGenusBySearchWord() {
		$genusModel = new GenusModel;
		try {
			$genusList = $genusModel->field(
						' g.id as "gen_id", ' .
						' g.name as "gen_name", ' .
						' g.name_ch as "gen_name_ch", ' .
						' f.name as "fam_name", ' .
						' f.name_ch as "fam_name_ch" '
					)
					->alias('g')
					->join('cate_fam f', 'g.fam_id = f.id')
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
			return $genusList;
		} catch (Exception $e) {
			return false;
		}
	}
}