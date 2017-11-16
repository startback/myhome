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
            'title'  => 'currency',
            'name'   => '通用类品',
            'child'  => array(
                array('title'=>'type', 'name' => '类型'),
                array('title'=>'type_add',  'name' => '类型添加'),
                array('title'=>'type_edit', 'name' => '类型修改'),
                array('title'=>'type_del',  'name' => '类型删除'),			
                array('title'=>'goods', 'name' => '物品列表'),
                array('title'=>'goods_add',  'name' => '物品添加'),
                array('title'=>'goods_edit', 'name' => '物品修改'),
                array('title'=>'goods_del',  'name' => '物品删除'),
                array('title'=>'skill','name' => '技能列表'),
                array('title'=>'skill_add', 'name' => '技能添加'),
                array('title'=>'skill_edit','name' => '技能修改'),
                array('title'=>'skill_del', 'name' => '技能删除'),
                array('title'=>'monster','name' => '怪兽列表'),
                array('title'=>'monster_add', 'name' => '怪兽添加'),
                array('title'=>'monster_edit','name' => '怪兽修改'),
                array('title'=>'monster_del', 'name' => '怪兽删除'),				
            )
        ),		
		
        array(
            'title'  => 'usermanage',
            'name'   => '用户管理',
            'child'  => array(					
                array('title'=>'user', 'name' => '用户列表'),
                array('title'=>'user_add',  'name' => '用户添加'),
                array('title'=>'user_edit', 'name' => '用户修改'),
                array('title'=>'user_del',  'name' => '用户删除'),
                array('title'=>'user_role','name' => '用户角色'),
                array('title'=>'user_role_add', 'name' => '用户角色添加'),
                array('title'=>'user_role_edit','name' => '用户角色修改'),
                array('title'=>'user_role_del', 'name' => '用户角色删除'),
                array('title'=>'user_goods','name' => '用户物品'),
                array('title'=>'user_goods_add', 'name' => '用户物品添加'),
                array('title'=>'user_goods_edit','name' => '用户物品修改'),
                array('title'=>'user_goods_del', 'name' => '用户物品删除'),		
                array('title'=>'user_monster','name' => '用户怪物'),
                array('title'=>'user_monster_add', 'name' => '用户怪物添加'),
                array('title'=>'user_monster_edit','name' => '用户怪物修改'),
                array('title'=>'user_monster_del', 'name' => '用户怪物删除'),					
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
			"l_icon" =>  "icon-home",
			"data" =>  array(
				"web_set" => array("网站设置","index.php?m=ttfadmin&c=index&a=info"),
				"pass" => array("修改密码","index.php?m=ttfadmin&c=index&a=pass"),
			),
		),
		
		"currency" => array(
			"name" =>  "通用类品",
			"l_icon" =>  "icon-th-large",
			"data" =>  array(
				"type" => array("类型设置","index.php?m=ttfadmin&c=currency&a=type"),
				"goods" => array("物品","index.php?m=ttfadmin&c=currency&a=goods"),
				"skill" => array("技能","index.php?m=ttfadmin&c=currency&a=skill"),
				"monster" => array("怪物","index.php?m=ttfadmin&c=currency&a=monster"),
			),
		),		
		
		"usermanage" => array(
			"name" =>  "用户管理",
			"l_icon" =>  "icon-user",
			"data" =>  array(
				"user" => array("用户列表","index.php?m=ttfadmin&c=usermanage&a=user"),
				"user_role" => array("用户角色","index.php?m=ttfadmin&c=usermanage&a=user_role"),
				"user_goods" => array("用户物品","index.php?m=ttfadmin&c=usermanage&a=user_goods"),
				"user_monster" => array("用户怪物","index.php?m=ttfadmin&c=usermanage&a=user_monster"),
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