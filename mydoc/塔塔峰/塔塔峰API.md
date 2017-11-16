## api文档


* 1、 [注册](#1)
* 2、 [登录](#2)

-----------------
<span id="1"/>
##### 1，注册

```post /user/register```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| username | str | yes | - |
| userpass | str | yes | - |

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
    "user_vip": 0,                  # VIP等级
    "user_role_id": 1,              # 默认出战角色
	"role_id": 1,                   # 角色ID
	"role_type": 1,                 # 角色类型
	"role_name": "xxx",             # 角色名
	"role_logo": "http://",         # 角色图像
    "user_desc": "xxx",             # 角色描述
  }
}

```

