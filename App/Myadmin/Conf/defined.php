<?php
return array(

    //不需登录的
    'NO_LOGIN'      =>   array(
        'index/login',
        'index/get_code',
    ),

    //不需权限的
    'NO_LEVEL'  =>  array(
        'index/index',
        'index/login',
        'index/info',
        'index/logout',
        'index/get_code',
    ),

    //权限
    'ADMIN_LEVEL'   =>   array(
        array(
            'title'  => 'index',
            'name'   => '基本设置',
            'child'  =>  array(
                array('title'=>'web_set',    'name' => '网站设置'),
                array('title'=>'pass',       'name' => '修改密码'),
            )
        ),
        array(
            'title'  => 'article',
            'name'   => '文章管理',
            'child'  => array(
                array('title'=>'atype',       'name' => '分类列表'),
                array('title'=>'add_type',    'name' => '分类添加'),
                array('title'=>'edit_type',   'name' => '分类修改'),
                array('title'=>'del_type',    'name' => '分类删除'),
                array('title'=>'article_list','name' => '文章列表'),
                array('title'=>'article_add', 'name' => '文章添加'),
                array('title'=>'article_edit','name' => '文章修改'),
                array('title'=>'article_del', 'name' => '文章删除'),
            )
        ),
        array(
            'title'  => 'album',
            'name'   => '相片管理',
            'child'  => array(
                array('title'=>'atype',     'name' => '分类列表'),
                array('title'=>'add_type',  'name' => '分类添加'),
                array('title'=>'edit_type', 'name' => '分类修改'),
                array('title'=>'del_type',  'name' => '分类删除'),
                array('title'=>'album_list','name' => '相片列表'),
                array('title'=>'album_add', 'name' => '相片添加'),
                array('title'=>'album_edit','name' => '相片修改'),
                array('title'=>'album_del', 'name' => '相片删除'),
            )
        ),
        array(
            'title'  => 'admin',
            'name'   => '权限管理',
            'child'  => array(
                array('title'=>'role_list', 'name' => '角色列表'),
                array('title'=>'role_add',  'name' => '角色添加'),
                array('title'=>'role_edit', 'name' => '角色修改'),
                array('title'=>'role_del',  'name' => '角色删除'),
                array('title'=>'admin_list','name' => '管理员列表'),
                array('title'=>'admin_add', 'name' => '管理员添加'),
                array('title'=>'admin_edit','name' => '管理员修改'),
                array('title'=>'admin_del', 'name' => '管理员删除'),

            )
        )
    ),


    //允许访问的IP
    'IP_ALLOW'      =>   array(


    ),


    //超级用户
    'SUPER_USER'    =>   array(
        'admin',
    ),

);