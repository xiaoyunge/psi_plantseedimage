<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    'psi/home'      => 'psi/normal/home',
    'psi/normal/home'      => 'psi/normal/home',
    'psi/search'     => 'psi/search/search',
    'psi/manage' => 'psi/manage/insert',
    'psi/manage/insert' => 'psi/manage/insert',
    'psi/manage/user' => 'psi/manage/user',
    'psi/manage/species' => 'psi/manage/species',
    'psi/manage/content' => 'psi/manage/content',
    'psi/manage/genus' => 'psi/manage/genus',
    'psi/manage/family' => 'psi/manage/family'
    /*
    'user/add'        => 'index/user/add',
    'user/add_list'   => 'index/user/addList',
    'user/update/:id' => 'index/user/update',
    'user/delete/:id' => 'index/user/delete',
    'user/:id'        => 'index/user/read',
     */
];
