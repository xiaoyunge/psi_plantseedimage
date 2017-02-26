<?php
namespace app\psi\model;

/**
 * Description of Species
 *
 * @author haitao
 */

use think\Model;

class Family extends Model{
    //put your code here
    protected $name = 'cate_fam';
    public function genus()
    {
    	return $this->hasMany('Genus', 'fam_id', 'id');
    }
}
