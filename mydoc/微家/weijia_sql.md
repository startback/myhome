## sql文档


* 1、 [api_users(用户表)](#1)
* 2、 [api_homes(家园表)](#2)
* 3、 [api_region(区域表)](#3)
* 4、 [api_user_home(用户家园关系表)](#4)
* 5、 [api_home_level(家园等级分值表 后台定)](#5)
* 6、 [api_home_article(家园文章表)](#6)
* 7、 [api_home_notice(家园公告表)](#7)
* 8、 [api_message(个人信息表)](#8)
* 9、 [api_report(举报投诉表)](#9)
* 10、 [api_suggest(建议表)](#10)
* 11、 [api_comment(文章评论表)](#11)
* 12、 [api_report_type(举报类型表)](#12)

-----------------
<span id="1"/>
##### 1、 api_users(用户表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| user_id | int | - | key auto | 用户ID |
| home_id | int | 0 | - | 家园ID(一个用户可加入多个家园，设定一个显示 0为未有或不显示) |
| user_name | varchar(36) | - | - | 用户名可改可重复初始是手机号或第三方帐号昵称 |
| user_pass | binary(16) | - | - | 用户密码可改 |
| user_phone | char(11) | - | - | 手机 |
| user_email | varchar(64) | - | - | 邮箱 |
| user_sex | tinyint(1) | 0 | - | 性别 0未知 1男 2女 |
| user_head | varchar(128) | - | - | 用户头像 |
| user_birthday | date | - | - | 生日 |
| user_address | varchar(255) | - | - | 户籍地址 |
| user_now_address | varchar(255) | - | - | 现居地址 |
| user_reg_time | datetime | - | - | 注册时间 |
| user_login_time | datetime | - | - | 登录时间 |
| user_money | decimal(10,2) | - | - | 可用资金 |
| user_frozen_money | decimal(10,2) | - | - | 冻结资金 |
| user_qq_id | varchar(32) | - | - | QQ登录身份ID |
| user_weixin_id | varchar(32) | - | - | 微信登录身份ID |
| user_score | int | 0 | - | 用户积分 总值 |
| user_use_score | int | 0 | - | 用户积分 可用 |
| user_status | tinyint(1) | 0 | - | 用户状态 0正常 1禁言 2禁止登录 |



<span id="2"/>
##### 2、 api_homes(家园表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| home_id | int | - | key auto | 家园ID |
| home_name | varchar(36) | - | - | 家园名可改（间隔一个月以上） |
| home_desc | text | - | - | 家园描述 |
| home_builder_id | int | 0 | - | 创建者名字(一个用户只能建一个家园 暂时) |
| home_build_time | datetime | - | - | 建立时间 |
| home_logo | varchar(255) | - | - | 家园LOGO |
| home_background | varchar(255) | - | - | 家园背景图 |
| home_mod_time | datetime | - | - | 名字修改时间（初次为注册时间） |
| home_country | smallint | 0 | - | 国ID |
| home_province | smallint | 0 | - | 省ID |
| home_city | smallint | 0 | - | 市ID |
| home_district | smallint | 0 | - | 区ID |
| home_address | varchar(255) | - | - | 详细地址 |
| home_is_private | tinyint | 0 | - | 是否私有 0公共(所有可访问 ) 1私有(仅家园成员可访问) |
| home_is_close | tinyint | 0 | - | 是否开放申请 0可申请加入 1不可申请加入 |
| home_visitor_gag | tinyint | 0 | - | 禁止游客发言 0发言 1禁言 |
| home_level_id | tinyint | 0 | - | 家园等级 |
| home_is_vip | tinyint | 0 | - | 是否VIP |
| home_scroe | int | 0 | - | 家园分值 总值 |
| home_use_scroe | int | 0 | - | 家园分值 可用 |
| home_is_certification | tinyint | 0 | - | 官方认证 0未认证 1已认证 |



<span id="3"/>
##### 3、 api_region(区域表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| region_id | smallint | - | key auto | 区域ID |
| region_pid | smallint | - | - | 区域PID |
| region_name | varchar(36) | - | - | 区域名 |
| region_type | tinyint | - | - | 区域级别 0国级 1省级 2市级 3区级 |
| region_is_close | tinyint | 0 | - | 是否屏蔽 0公开 1屏蔽 |



<span id="4"/>
##### 4、 api_user_home(用户家园关系表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| user_id | int | - | key | 用户ID |
| home_id | int | - | key | 家园ID |
| role_id | tinyint | 0 | - | 扮演的角色ID |
| nick_name | varchar(36) | - | - | 用户别名 |
| add_time | datetime | - | - | 加入时间 |
| status | tinyint | 0 | - | 状态 0正常 1禁言 2禁止进入 |
| score | int | 0 | - | 在当前家园分值 总值|
| use_score | int | 0 | - | 在当前家园分值 可用|



<span id="5"/>
##### 5、 api_home_level(家园等级分值表 后台定)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| level_id | tinyint | 0 | key | 等级 |
| level_name | varchar(36) | - | - | 等级名 |
| level_min_score | int | 0 | - | 最小分值 |
| level_max_score | int | 0 | - | 最大分值 |
| level_is_used | tinyint | 0 | - | 是否启用 0否 1是 |



<span id="6"/>
##### 6、 api_home_article(家园文章表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| article_id | int | 0 | key auto | 文章ID |
| article_home_id | int | 0 | - | 家园ID |
| article_title | varchar(128) | - | - | 文章题目 |
| article_content | mediutext | - | - | 文章内容 |
| article_time | datetime | - | - | 文章发布时间 |
| article_user_id | int | - | - | 文章发布人 |
| article_type | tinyint | 0 | - | 文章类别 |
| article_is_open | tinyint | 1 | - | 文章是否公开 0否 1是 |
| article_is_out | tinyint | 0 | - | 文章是否游客可访问 0否 1是 |
| article_file_url | varchar(255) | - | - | 文章来源地址 |
| article_desc | varchar(255) | - | - | 文章描述 |
| article_click | int | 0 | - | 文章点击量 |
| article_reply | int | 0 | - | 文章回复数 |
| article_is_top | tinyint | 0 | - | 文章置顶 0否 1是 |
| article_is_good | tinyint | 0 | - | 文章精华 0否 1是 |
| article_is_recommend | tinyint | 0 | - | 文章推荐 0否 1是 |
| article_order_num | tinyint | 0 | - | 文章排序 越大越前(0-255) |
| article_is_delete | tinyint | 0 | - | 文章删除 0否 1是 |



<span id="7"/>
##### 7、 api_home_notice(家园公告表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| notice_id | int | 0 | key auto | 公告ID |
| notice_home_id | int | 0 | - | 家园ID |
| notice_title | varchar(128) | - | - | 公告头 |
| notice_content | text | - | - | 公告内容 |
| notice_time | datetime | - | - | 公告时间 |
| notice_author | int | - | - | 公告人 |
| notice_type | tinyint | 0 | - | 公告类型 紧急... |
| notice_is_top | tinyint | 0 | - | 置顶 0否 1是 |
| notice_is_delete | tinyint | 0 | - | 删除 0否 1是 |



<span id="8"/>
##### 8、 api_message(个人信息表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| message_id | int | 0 | key auto | 信息ID |
| message_title | varchar(60) | - | - | 信息头 |
| message_content | text | - | - | 信息内容 |
| message_time | datetime | - | - | 信息时间 |
| message_send_id | int | - | - | 信息发送人(0为系统发的信息不能回复) |
| message_admin_id | smallint | 0 | - | 如是系统发记录是哪一位发的 |
| message_get_id | int | - | - | 信息接收人 |
| message_status | tinyint | 0 | - | 信息状态 0未读 1已读 |



<span id="9"/>
##### 9、 api_report(举报投诉表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| report_id | int | 0 | key auto | 举报ID |
| report_user_id | int | 0 | - | 举报人ID |
| user_id | int | 0 | - | 被举报人ID |
| article_id | int | 0 | - | 被举报文章ID |
| report_time | datetime | 0 | - | 举报时间 |
| report_type | tinyint | 0 | - | 举报类型 |
| report_content | varchar(255) | - | - | 举报内容 |
| report_status | tinyint | 0 | - | 举报状态 0未读 1未处理 2已处理 3暂缓处理 4已删除 5已封号 |
| admin_id | smallint | 0 | - | 管理员ID |
| admin_time | datetime | 0 | - | 管理员处理时间 |



<span id="10"/>
##### 10、 api_suggest(建议表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| suggest_id | int | 0 | key auto | 建议ID |
| suggest_user_id | int | 0 | - | 建议人ID |
| suggest_time | datetime | 0 | - | 建议时间 |
| suggest_content | text | - | - | 建议内容 |
| suggest_status | tinyint | 0 | - | 建议状态 0未读 1未处理 2已处理未回复 3已处理已回复 4已处理不需回复 |
| admin_id | smallint | 0 | - | 管理员ID |
| admin_time | datetime | 0 | - | 管理员处理时间 |



<span id="11"/>
##### 11、 api_comment(文章评论表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| comment_id | int | 0 | key auto | 评论ID |
| comment_article_id | int | 0 | - | 文章ID |
| comment_home_id | int | 0 | - | 家园ID |
| comment_user_id | int | 0 | - | 评论人ID |
| comment_time | datetime | 0 | - | 评论时间 |
| comment_content | text | - | - | 评论内容 |
| comment_status | tinyint | 0 | - | 评论状态 0正常 1隐藏 |
| comment_is_delete | tinyint | 0 | - | 是否删除 0否 1是 |



<span id="12"/>
##### 12、 api_report_type(举报类型表)

| 字段名 | 类型 | 默认 | 主键 | 备注 |
|-------|------|------|-----|------|
| type_id | tinyint | 0 | key auto | 类型ID |
| type_name | varchar(36) | - | - | 类型名 |
| type_is_used | tinyint | 1 | - | 类型是否启用 0否 1是 |
| type_add_time | datetime | - | - | 添加时间 |
| type_admin_id | smallint | - | - | 添加管理员ID |