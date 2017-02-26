<?php
namespace app\psi\model;

/**
 * Description of Species
 *
 * @author haitao
 */

use think\Model;

class Species extends Model{
    //put your code here
    protected $name = 'cate_spe';
    protected $type = [
    		'id' => 'integer',
    		'gen_id' => 'integer',
    ];
    protected function scopeThinkphp($query)
    {
    	$query->where('name','thinkphp')->field('id,name');
    }
}
