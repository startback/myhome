## 塔塔峰api文档


- 1、 [一般情况](#1)
	- 1.1、 [注册](#1.1)
	- 1.2、 [登录](#1.2)
	- 1.3、 [地图信息(迷宫列表暂)](#1.3)
	- 1.4、 [背包物品信息](#1.4)
	- 1.5、 [角色列表](#1.5)
	- 1.6、 [角色详情](#1.6)
- 2、 [迷宫系统](#2)
	- 2.1、 [迷宫详情](#2.1)
	- 2.2、 [进入迷宫](#2.2)
	- 2.3、 [迷宫下一层](#2.3)
	- 2.4、 [迷宫结算](#2.4)
- 3、 [系统相关](#3)
	- 3.1、 [定时连接](#3.1)
- 4、 [技能升级系统](#4)
	- 4.1、 [角色技能状况](#4.1)
	- 4.2、 [升级技能](#4.2)
	- 4.3、 [技能替换](#4.3)
- 5、 [融合系统](#5)
 	 
-----------------
<span id="1"/>
#### 1，一般情况
<span id="1.1"/>
##### 1.1，注册

```post /user/register```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| user_phone | str | yes | 手机 |
| user_pass | str | yes | 密码 |
| code | str | yes | 验证码 |

返回：

```
{
  "code": 0,
  "msg":"返回信息",
  "data": {}
}

```

<span id="1.2"/>
##### 1.2，登录

```post /user/login```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| user_phone | str | yes | 手机 |
| user_pass | str | yes | 密码 |

返回：

```
{
  "code": 0,
  "msg":"返回信息",
  "data": {
    "user_id": 0,                   # 用户ID
    "user_name": "xiaoming",        # 用户名称
    "user_phone": "158118",         # 用户手机
    "user_sex": 0,             	    # 性别 0未知 1男 2女
    "user_head": "http://xxx",      # 头像
    "user_birthday": "2017-11-10",  # 生日
    "user_reg_time": "2017-11-...", # 注册时间
    "user_login_time": "2017-...",  # 登录时间
    "user_status": 0,               # 状态 0正常 1禁止登录
    "user_ttbi": 100,               # 塔币
    "user_gold": 33,                # 金币
    "user_vip": 0,                  # VIP等级ID
    "user_vip_name": 'v_name',      # VIP等级
    "user_role_id": 1,              # 默认出战角色
	"role_id": 1,                   # 角色ID
	"role_type": 1,                 # 角色类型
	"role_name": "xxx",             # 角色名
	"role_logo": "http://",         # 角色图像
    "user_desc": "xxx",             # 角色描述
  }
}

```

<span id="1.3"/>
##### 1.3，地图信息（迷宫列表暂）

```post /user/map_info```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| - | - | - | - |

返回：

```
{
  "code": 0,
  "msg":"返回信息",
  "data": {
    "mazes": {
		"1":{
			"maze_id":1,
			"maze_name":"你好",
			"maze_desc":"真好",
		},
		"2":{
			"maze_id":2,
			"maze_name":"你好2",
			"maze_desc":"真好2",
		},
	},                   			# 迷宫集
  }
}

```

<span id="1.4"/>
##### 1.4，背包物品信息

```post /user/pack_info```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| - | - | - | - |

返回：

```
{
  "code": 0,
  "msg":"返回信息",
  "data": {
    "goods": {
		"1":{
			"goods_id":1,
			"goods_name":"你好",
			"goods_num":"6",
		},
		"2":{
			"goods_id":2,
			"goods_name":"你好2",
			"goods_num":"62",
		},
	},   
    "other_goods": {
		"1":{
			"goods_id":1,
			"goods_name":"你好",
			"goods_num":"6",
		},
		"2":{
			"goods_id":2,
			"goods_name":"你好2",
			"goods_num":"62",
		},
	},                 
  }
}

```

<span id="1.5"/>
##### 1.5，角色列表

```post /user/role_list```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| - | - | - | - |

返回：

```
{
  "code": 0,
  "msg":"返回信息",
  "data": {
	"1":{
		"user_role_id":1,
		"role_id":1,
		"role_name":"你好",
		"role_desc":"真好",
	},
  }
}

```

<span id="1.6"/>
##### 1.6，角色详情

```post /user/role_info```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| id | int | yes | 角色ID |

返回：

```
{
  "code": 0,
  "msg":"返回信息",
  "data": {
	"user_role_id":1,
	"role_id":1,
	"role_name":"你好",
	"role_desc":"真好",
	...
  }
}

```


<span id="2"/>
#### 2，迷宫系统
<span id="2.1"/>
##### 2.1，迷宫详情

```post /maze/maze_info```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| user_id | int | yes | 用户ID |
| maze_id | int | yes | 迷宫ID |

返回：

```
{
  "code": 0,
  "msg":"返回信息",
  "data": {
	"maze_id":5,
	"maze_name":"asdfasdf",
	"maze_logo":"http://asdfasfda",
	"maze_desc":"asfsad"	
  }
}

```

<span id="2.2"/>
##### 2.2，进入迷宫

```post /maze/maze_in_one```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| user_id | int | yes | 用户ID |
| maze_id | int | yes | 迷宫ID |
| role_id | int | yes | 出战角色ID |
| other_role_ids | str | no | 其它角色ID |

返回：

```
{
  "code": 0,
  "msg":"返回信息",
  "data": {
	"maze_id":5,
	"maze_name":"asdfasdf",
	"maze_floor":5,
	"maze_monsters":{
	  1:{
		"monster_id":1,
		"monster_name":"dadfas",
		...,		
	  },
	},
	"maze_goods":{
	  1:{
		"goods_id":1,
		"goods_name":"dadfas",
		...,		
	  },
	}
  }
}

```

<span id="2.3"/>
##### 2.3，迷宫下一层

```post /maze/maze_in_next```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| user_id | int | yes | 用户ID |
| maze_id | int | yes | 迷宫ID |
| role_id | int | yes | 出战角色ID |
| other_role_ids | str | no | 其它角色ID |
| now_floor | int | yes | 现层数 |
| next_floor | int | yes | 下一层数 |
| get_goods | str | yes | 得到的物品 |
| kill_monsters | str | yes | 杀死的怪物 |

返回：

```
{
  "code": 0,
  "msg":"返回信息",
  "data": {
	"maze_id":5,
	"maze_name":"asdfasdf",
	"maze_floor":5,
	"maze_monsters":{
	  1:{
		"monster_id":1,
		"monster_name":"dadfas",
		...,		
	  },
	},
	"maze_goods":{
	  1:{
		"goods_id":1,
		"goods_name":"dadfas",
		...,		
	  },
	}
  }
}

```

<span id="2.4"/>
##### 2.4，迷宫结算

```post /maze/maze_out```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| user_id | int | yes | 用户ID |
| maze_id | int | yes | 迷宫ID |
| role_id | int | yes | 出战角色ID |
| other_role_ids | str | no | 其它角色ID |
| now_floor | int | yes | 现层数 |
| get_goods | str | yes | 得到的物品 |
| kill_monsters | str | yes | 杀死的怪物 |

返回：

```
{
  "code": 0,
  "msg":"返回信息",
  "data": {
	"maze_id":5,
	"maze_name":"asdfasdf",
	"max_floor":5,
	"get_goods":{
	  1:{
		"goods_id":1,
		"goods_name":"dadfas",
		...,		
	  },
	}
  }
}

```