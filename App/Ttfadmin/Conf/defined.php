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
                array('title'=>'pass',       'name' => '修改密码')
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
                array('title'=>'admin_log_list', 'name' => '管理员日志'),
            )
        )
    ),

	
	//左则显示栏
	'ADMIN_LEVEL_MENU'   =>   array(
		"index" => array(
			"name" =>  "基本设置",
			"l_icon" =>  "icon-user",
			"data" =>  array(
				"web_set" => array("网站设置","index.php?m=ttfadmin&c=index&a=info"),
				"pass" => array("修改密码","index.php?m=ttfadmin&c=index&a=pass"),
			),
		),
		"admin" => array(
			"name" =>  "权限管理",
			"l_icon" =>  "icon-key",
			"data" =>  array(
				"role_list" => array("角色权限","index.php?m=ttfadmin&c=admin&a=role_list"),
				"admin_list" => array("管理员列表","index.php?m=ttfadmin&c=admin&a=admin_list"),
				"admin_log_list" => array("管理员日志","index.php?m=ttfadmin&c=admin&a=admin_log_list"),
			)
		),	
	),	
	

    //允许访问的IP
    'IP_ALLOW'      =>   array(


    ),


    //超级用户
    'SUPER_USER'    =>   array(
        'admin',
    ),

);