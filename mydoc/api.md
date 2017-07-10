## api文档


* 1、 [我-我的](#1)
* 2、 [我-兑奖](#2)

<span id="1"/>
### 1, 我-我的
-----------------
<span id="1.1"/>
##### 我的

```get /user/get_user_all```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| user_id | int | yes | - |

返回：

```
{
  "code": 0,
  "data": {
    "prize_num": 0,            # 兑换奖品数量
    "gold": 1000000,           # 金币值
    "moment_num": 20,          # 动态数量
    "gift_num": 0,             # 领取礼物数量
    "is_authed": false,        # 是否认证
    "photo_num": 30,           # 私照数量
    "charm_level": 1,          # 魅力值
    "wealth_level": 1,         # 财气值
    "strength": 1212567,       # 体力值
    "gender": 1,               # 性别
    "age": 33,                 # 年龄
    "avatar": null,            # 头像url
    "vip_level": 1,            # vip等级
    "charm_wealth_next": 500,  # 距离下一魅力或财气等级需要体力值
    "charm_wealth_whole": 1000,  # 距离下一魅力或财气等级需要的全部体力值
    "nickname": "from_id",      # 昵称
    "status": "online"   # 在线状态
  }
}

```

