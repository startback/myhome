## 塔塔峰sql文档


* 1、 [ttf_user(用户表)](#1)
* 2、 [ttf_user_info(用户详细信息表)](#2)
* 3、 [ttf_province(省份表)](#3)
* 4、 [ttf_maze(迷宫)](#4)
* 5、 [ttf_role(角色)](#5)
* 6、 [ttf_role_skill(角色天赋技能)](#6)
* 7、 [ttf_type(类别)](#7)
* 8、 [ttf_common_skill(通用技能)](#8)
* 9、 [ttf_monster(怪物)](#9)
* 10、 [ttf_goods(物品)](#10)
* 11、 [ttf_user_role(用户角色)](#11)
* 12、 [ttf_user_monster(用户怪物)](#12)
* 13、 [ttf_user_goods(用户物品)](#13)
* 14、 [ttf_maze_monster_goods(迷宫怪物及物品设置)](#14)
* 15、 [ttf_role_maze_record(人物迷宫记录)](#15)
* a、 [ttf_admin(后台管理员)](#a)
* b、 [ttf_admin_log(后台管理员操作记录)](#b)
* c、 [ttf_admin_role(后台管理员角色)](#c)


-----------------
<span id="1"/>
##### 1、 ttf_user(用户表)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| user_id | int | - | key auto | 用户ID |
| user_name | varchar(36) | - | - | 用户名可改可重复初始是手机号或第三方帐号昵称 |
| user_pass | binary(16) | - | - | 用户密码可改 |
| user_phone | char(11) | - | - | 手机 |
| user_sex | tinyint(1) | 0 | - | 性别 0未知 1男 2女 |
| user_head | varchar(128) | - | - | 用户头像 |
| user_birthday | date | - | - | 生日 |
| user_reg_time | datetime | - | - | 注册时间 |
| user_login_time | datetime | - | - | 登录时间 |
| user_qq_id | varchar(32) | - | - | QQ登录身份ID |
| user_weixin_id | varchar(32) | - | - | 微信登录身份ID |
| user_status | tinyint(1) | 0 | - | 用户状态 0正常 1禁言 2禁止登录 |


<span id="2"/>
##### 2、 ttf_user_info(用户详细信息表)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| user_id | int | - | - | 用户ID |
| user_ttbi | int | 0 | - | 塔塔币 |
| user_gold | int | 0 | - | 金币 |
| user_vip | tinyint | 0 | - | vip等级 无-彩虹七色-黑白-混沌 |
| user_role_id | int | 0 | - | 用户出战角色 |


<span id="3"/>
##### 3、 ttf_province(省份表)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| province_id | tinyint | - | key auto | 省份ID |
| province_name | varchar(36) | - | - | 省份名 |
| province_logo | varchar(128) | - | - | 省份LOGO |


<span id="4"/>
##### 4、 ttf_maze(迷宫表)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| maze_id | smallint | - | key auto | 迷宫ID |
| maze_name | varchar(36) | - | - | 迷宫名 |
| maze_logo | varchar(128) | - | - | 迷宫LOGO |
| maze_desc | text | - | - | 迷宫描述 |
| maze_time | datetime | - | - | 迷宫建立时间 |


<span id="5"/>
##### 5、 ttf_role(角色表)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| role_id | smallint | - | key auto | 角色ID |
| role_type | smallint | 0 | - | 角色归属类别 |
| role_name | varchar(36) | - | - | 角色名 |
| role_logo | varchar(128) | - | - | 角色LOGO |
| role_desc | text | - | - | 角色描述 |
| role_time | datetime | - | - | 角色建立时间 |
| role_skill_id | smallint | 0 | - | 天赋技能 |
| role_attack | varchar(255) | - | - | 初始物攻 |
| role_magic | varchar(255) | - | - | 初始魔攻 |
| role_hp | varchar(255) | - | - | 初始生命值 |
| role_mp | varchar(255) | - | - | 初始魔法值 |
| role_attack_defense | varchar(255) | - | - | 初始物防 |
| role_magic_defense | varchar(255) | - | - | 初始魔防 |
| role_dodge | varchar(255) | - | - | 初始闪避值 |
| role_direct | varchar(255) | - | - | 初始命中值 |
| role_crit | varchar(255) | - | - | 初始暴击值 |



<span id="6"/>
##### 6、 ttf_role_skill(角色天赋技能表)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| role_skill_id | smallint | - | key auto | 技能ID |
| role_skill_name | varchar(36) | - | - | 技能名 |
| role_skill_logo | varchar(128) | - | - | 技能LOGO |
| role_skill_desc | text | - | - | 技能描述 |
| role_skill_time | datetime | - | - | 技能建立时间 |
| role_skill_attack | varchar(255) | - | - | 物攻 |
| role_skill_magic | varchar(255) | - | - | 魔攻 |
| role_skill_hp | varchar(255) | - | - | 生命值 |
| role_skill_mp | varchar(255) | - | - | 魔法值 |
| role_skill_attack_defense | varchar(255) | - | - | 物防 |
| role_skill_magic_defense | varchar(255) | - | - | 魔防 |
| role_skill_dodge | varchar(255) | - | - | 闪避值 |
| role_skill_direct | varchar(255) | - | - | 命中值 |
| role_skill_crit | varchar(255) | - | - | 暴击值 |
| role_skill_hp_regain | varchar(255) | - | - | 生命值恢复 |
| role_skill_mp_regain | varchar(255) | - | - | 魔法值恢复 |
| role_skill_gold_hurt | varchar(255) | - | - | 金系伤害增加百分比 |
| role_skill_wood_hurt | varchar(255) | - | - | 木系伤害增加百分比 |
| role_skill_water_hurt | varchar(255) | - | - | 水系伤害增加百分比 |
| role_skill_fire_hurt | varchar(255) | - | - | 火系伤害增加百分比 |
| role_skill_earth_hurt | varchar(255) | - | - | 土系伤害增加百分比 |


<span id="7"/>
##### 7、 ttf_type(类型表)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| type_id | smallint | - | key auto | 类型ID |
| type_pid | smallint | 0 | - | 类型ID |
| type_name | varchar(36) | - | - | 类型名 |
| type_logo | varchar(128) | - | - | 类型LOGO |
| type_desc | text | - | - | 类型描述 |


<span id="8"/>
##### 8、 ttf_common_skill(通用技能表)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| common_skill_id | smallint | - | key auto | 技能ID |
| common_skill_name | varchar(36) | - | - | 技能名 |
| common_skill_logo | varchar(128) | - | - | 技能LOGO |
| common_skill_desc | text | - | - | 技能描述 |
| common_skill_time | datetime | - | - | 技能建立时间 |
| common_skill_attack | varchar(255) | - | - | 物攻 |
| common_skill_magic | varchar(255) | - | - | 魔攻 |
| common_skill_hp | varchar(255) | - | - | 生命值 |
| common_skill_mp | varchar(255) | - | - | 魔法值 |
| common_skill_attack_defense | varchar(255) | - | - | 物防 |
| common_skill_magic_defense | varchar(255) | - | - | 魔防 |
| common_skill_dodge | varchar(255) | - | - | 闪避值 |
| common_skill_direct | varchar(255) | - | - | 命中值 |
| common_skill_crit | varchar(255) | - | - | 暴击值 |
| common_skill_hp_regain | varchar(255) | - | - | 生命值恢复 |
| common_skill_mp_regain | varchar(255) | - | - | 魔法值恢复 |
| common_skill_gold_hurt | varchar(255) | - | - | 金系伤害增加百分比 |
| common_skill_wood_hurt | varchar(255) | - | - | 木系伤害增加百分比 |
| common_skill_water_hurt | varchar(255) | - | - | 水系伤害增加百分比 |
| common_skill_fire_hurt | varchar(255) | - | - | 火系伤害增加百分比 |
| common_skill_earth_hurt | varchar(255) | - | - | 土系伤害增加百分比 |
| common_skill_keep_num | varchar(255) | - | - | 持续回合数 |


<span id="9"/>
##### 9、 ttf_monster(怪物表)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| monster_id | smallint | - | key auto | 怪物ID |
| monster_type | smallint | - | - | 怪物归属类别 |
| monster_level | smallint | 0 | - | 怪物等级 |
| monster_name | varchar(36) | - | - | 怪物名 |
| monster_logo | varchar(128) | - | - | 怪物LOGO |
| monster_desc | text | - | - | 怪物描述 |
| monster_time | datetime | - | - | 怪物建立时间 |
| monster_attack | smallint | 0 | - | 初始物攻 |
| monster_magic | smallint | 0 | - | 初始魔攻 |
| monster_hp | int | 0 | - | 初始生命值 |
| monster_mp | int | 0 | - | 初始魔法值 |
| monster_attack_defense | smallint | 0 | - | 初始物防 |
| monster_magic_defense | smallint | 0 | - | 初始魔防 |
| monster_dodge | smallint | 0 | - | 初始闪避值 |
| monster_direct | smallint | 0 | - | 初始命中值 |
| monster_crit | smallint | 0 | - | 初始暴击值 |
| monster_role_skill_id | varchar(255) | 0 | - | 怪物天赋技能及等级 |
| monster_common_skill_ids | varchar(255) | - | - | 怪物通用技能及等级集 |
| monster_goods | varchar(255) | - | - | 怪物身上物品及暴率 |


<span id="10"/>
##### 10、 ttf_goods(物品)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| goods_id | smallint | - | key auto | 物品ID |
| goods_type | smallint | 0 | - | 物品归属类别 |
| goods_name | varchar(36) | - | - | 物品名 |
| goods_logo | varchar(128) | - | - | 物品LOGO |
| goods_desc | text | - | - | 物品描述 |
| goods_time | datetime | - | - | 物品建立时间 |
| goods_attack | smallint | 0 | - | 物攻 |
| goods_magic | smallint | 0 | - | 魔攻 |
| goods_hp | int | 0 | - | 生命值 |
| goods_mp | int | 0 | - | 魔法值 |
| goods_attack_defense | smallint | 0 | - | 物防 |
| goods_magic_defense | smallint | 0 | - | 魔防 |
| goods_dodge | smallint | 0 | - | 闪避值 |
| goods_direct | smallint | 0 | - | 命中值 |
| goods_crit | smallint | 0 | - | 暴击值 |


<span id="11"/>
##### 11、 ttf_user_role(用户角色)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| user_role_id | int | - | key auto | 自增ID |
| user_id | int | 0 | - | 用户ID |
| role_id | smallint | 0 | - | 角色ID |
| add_time | datetime | - | - | 创建时间 |
| attack | smallint | 0 | - | 物攻 |
| magic | smallint | 0 | - | 魔攻 |
| hp | int | 0 | - | 生命值 |
| mp | int | 0 | - | 魔法值 |
| attack_defense | smallint | 0 | - | 物防 |
| magic_defense | smallint | 0 | - | 魔防 |
| dodge | smallint | 0 | - | 闪避值 |
| direct | smallint | 0 | - | 命中值 |
| crit | smallint | 0 | - | 暴击值 |
| skill_ids | varchar(255) | - | - | 技能集 |


<span id="12"/>
##### 12、 ttf_user_monster(用户怪物)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| id | int | - | key auto | 自增ID |
| user_id | int | 0 | - | 用户ID |
| monster_id | smallint | 0 | - | 怪物ID |
| add_time | datetime | - | - | 创建时间 |
| attack | smallint | 0 | - | 物攻 |
| magic | smallint | 0 | - | 魔攻 |
| hp | int | 0 | - | 生命值 |
| mp | int | 0 | - | 魔法值 |
| attack_defense | smallint | 0 | - | 物防 |
| magic_defense | smallint | 0 | - | 魔防 |
| dodge | smallint | 0 | - | 闪避值 |
| direct | smallint | 0 | - | 命中值 |
| crit | smallint | 0 | - | 暴击值 |
| skill_ids | varchar(255) | - | - | 技能集 |


<span id="13"/>
##### 13、 ttf_user_goods(用户物品)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| id | int | - | key auto | 自增ID |
| user_id | int | 0 | - | 用户ID |
| goods_id | int | 0 | - | 物品ID |
| add_time | datetime | - | - | 创建时间 |
| attack | smallint | 0 | - | 物攻 |
| magic | smallint | 0 | - | 魔攻 |
| hp | int | 0 | - | 生命值 |
| mp | int | 0 | - | 魔法值 |
| attack_defense | smallint | 0 | - | 物防 |
| magic_defense | smallint | 0 | - | 魔防 |
| dodge | smallint | 0 | - | 闪避值 |
| direct | smallint | 0 | - | 命中值 |
| crit | smallint | 0 | - | 暴击值 |
| skill_id | smallint | 0 | - | 技能 |


<span id="14"/>
##### 14、 ttf_maze_monster_goods(迷宫怪物及物品设置)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| id | int | - | key auto | 自增ID |
| maze_id | int | - | - | 迷宫ID |
| monster_ids | varchar(255) | - | - | 怪物ID集 |
| goods_ids | varchar(255) | - | - | 物品ID集 |


<span id="15"/>
##### 15、 ttf_role_maze_record(人物迷宫记录)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| id | int | - | key auto | 自增ID |
| user_id | int | 0 | - | 用户ID |
| maze_id | smallint | 0 | - | 迷宫ID |
| maze_now_floor | smallint | 1 | - | 当前迷宫层 |
| maze_now_monster_ids | varchar(255) | - | - | 当前迷怪物 |
| maze_now_goods_ids | varchar(255) | - | - | 当前迷宫物品 |
| begin_time | datetime | - | - | 迷宫开始时间 |
| maze_now_is_over | tinyint | 0 | - | 是否已结束 0未 1是 |
| max_height_floor | smallint | 1 | - | 最高层 |


<span id="a"/>
##### a、 ttf_admin(后台管理员)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| admin_id | smallint | - | key auto | 自增ID |
| admin_account | varchar(32) | - | - | 用户账号 |
| admin_pass | binary(16) | - | - | 密码 |
| admin_role_id | smallint | - | - | 角色ID |
| admin_name | varchar(32) | - | - | 别名 |
| admin_phone | char(11) | - | - | 手机 |
| admin_email | varchar(64) | - | - | 邮箱 |
| admin_sex | tinyint | 0 | - | 性别 0未知 1男 2女 |
| admin_birthday | date | - | - | 生日 |
| admin_register_time | datetime | - | - | 注册时间 |
| admin_login_time | datetime | - | - | 登录时间 |
| admin_tag | varchar(64) | - | - | tag |
| ip_address | varchar(15) | - | - | ip |


<span id="b"/>
##### b、 ttf_admin_log(后台管理员操作记录)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| log_id | int | - | key auto | 自增ID |
| log_time | datetime | - | - | 时间 |
| log_info | varchar(255) | - | - | 操作描述 |
| admin_id | smallint | 0 | - | 操作员 |
| ip_address | varchar(15) | - | - | ip |


<span id="c"/>
##### c、 ttf_admin_role(后台管理员角色)
| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| role_id | smallint | - | key auto | 自增ID |
| role_name | varchar(32) | - | - | 角色名 |
| role_desc | varchar(255) | - | - | 角色描述 |
| role_power | text | - | - | 角色权限 |
