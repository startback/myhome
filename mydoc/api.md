## api文档


* 1、 [我-我的](#1)
    * 1.1 [我的](#1.1)
    * 1.2 [设置](#1.2)
        * 1.2.1 [意见反馈](#1.2.1)
        * 1.2.2 [黑名单管理](#1.2.2)
    * 1.3 [动态](#1.3)
        * 1.3.1 [动态](#1.3.1)
* 2、 [我-兑奖](#2)
    * 2.1 [奖品列表](#2.1)






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
<span id="1.2"/>
##### 设置

<span id="1.2.1"/>
##### 意见反馈
```post  /user/send_suggesstion```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| message | str | yes | 建议内容 |

返回：

```
{
  "msg": "邮件发送成功",
  "code": 0
}
```

<span id="2"/>
### 2, 我-兑奖
-----------------
<span id="2.1"/>
##### 奖品列表

```get /prize/show_prize_list```

| 参数名 | 类型 | 是否必须 | 说明 |
|-------|------|---------|-------|
| prize_type | int | yes | 奖品类型， 0全部，1数码，2虚拟，3美妆，4家居 |

返回：

```
{
  "code": 0,
  "data": [
    {
      "prize_id": 3,  # 奖品id
      "image": "http://7xt8dm.com2.z0.glb.qiniucdn.com/1385941.jpg",  # 奖品图片url
      "type": 1,  # 奖品类型
      "name": "Canon数码相机",  # 奖品名称
      "value": 20000  # 奖品金币值
    },
    {
      "prize_id": 4,
      "image": "http://7xt8dm.com2.z0.glb.qiniucdn.com/1385941.jpg",
      "type": 1,
      "name": "iPhone6 Plus",
      "value": 40000
    }
  ]
}
```




