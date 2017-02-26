<?php
namespace app\psi\model;

/**
 * Description of Species
 *
 * @author haitao
 */

use think\Model;

class Genus extends Model{
    //put your code here
    protected $name = 'cate_gen';
    public function species()
    {
    	return $this->hasMany('Species', 'gen_id', 'id');
    }
}
