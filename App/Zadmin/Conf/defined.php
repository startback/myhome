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
                array('title'=>'statistics',       'name' => '统计信息'),
            )
        ),
        array(
            'title'  => 'action',
            'name'   => '直播管理',
            'child'  => array(
                array('title'=>'atype',       'name' => '分类列表'),
                array('title'=>'add_type',    'name' => '分类添加'),
                array('title'=>'edit_type',   'name' => '分类修改'),
                array('title'=>'del_type',    'name' => '分类删除'),
                array('title'=>'action_list','name' => '直播列表'),
                array('title'=>'action_add', 'name' => '直播添加'),
                array('title'=>'action_edit','name' => '直播修改'),
                array('title'=>'action_del', 'name' => '直播删除'),
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
				"web_set" => array("网站设置","index.php?m=zadmin&c=index&a=info"),
				"pass" => array("修改密码","index.php?m=zadmin&c=index&a=pass"),
				"statistics" => array("统计信息","index.php?m=zadmin&c=index&a=statistics"),
			),
		),
		"action" => array(
			"name" =>  "直播管理",
			"l_icon" =>  "icon-pencil-square-o",
			"data" =>  array(
				"atype" => array("直播分类","index.php?m=zadmin&c=action&a=atype"),
				"action_list" => array("直播列表","index.php?m=zadmin&c=action&a=action_list"),
				"action_add" => array("发布直播","index.php?m=zadmin&c=action&a=action_add")
			)
		),
		"admin" => array(
			"name" =>  "权限管理",
			"l_icon" =>  "icon-key",
			"data" =>  array(
				"role_list" => array("角色权限","index.php?m=zadmin&c=admin&a=role_list"),
				"admin_list" => array("管理员列表","index.php?m=zadmin&c=admin&a=admin_list"),
				"admin_log_list" => array("管理员日志","index.php?m=zadmin&c=admin&a=admin_log_list"),
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