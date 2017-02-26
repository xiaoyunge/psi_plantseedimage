<?php
namespace app\psi\validate;

use think\Validate;

class Search extends Validate
{
	protected $rule = [
		'search' => 'require',
		'page' => 'integer',
		'perpage' => 'integer',
		'order' => [ 'regex' => '/^(species|genus|family)$/i' ]
	];
}