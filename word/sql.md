## myhome数据库

* 1、 [管理员表(my_admin)](#1)
* 2、 [权限角色表(my_role)](#2)
* 3、 [文章类别(my_article_type)](#3)
* 4、 [文章(my_article)](#4)
* 5、 [相册类别(my_album_type)](#5)
* 6、 [相册(my_album)](#6)


<span id="1"/>
### 1, 管理员表

```my_admin```

| 字段名 | 类型 | 默认 | 说明 | 备注 |
|-------|------|---------|-------|
| admin_id | int | - | key 自增 | - |
| admin_account | varchar(32) | - | 帐号 | - |
| admin_pass | binary(16) | - | 密码 | - |
| admin_role_id | smallint | 0 | 角色ID | 权限方面 |
| admin_name | varchar(32) | - | 名字 | - |
| admin_phone | char(11) | - | 手机 | - |
| admin_email | varchar(64) | - | 邮箱 | - |
| admin_sex | tinyint | 0 | 性别 | 0未知 1男 2女 |
| admin_birthday | date | - | 生日 | - |
| admin_register_time | datetime | - | 注册时间 | - |
| admin_login_time | datetime | - | 登录时间 | - |
| admin_tag | varchar(64) | - | 标签 | - |


<span id="2"/>
### 2, 管理员表

```my_role```

| 字段名 | 类型 | 默认 | 说明 | 备注 |
|-------|------|---------|-------|
| role_id | smallint | - | key 自增 | - |
| role_name | varchar(32) | - | 角色名 | - |
| role_desc | varchar(255) | - | 角色描述 | - |
| role_power | text | - | 角色权限 | - |


<span id="3"/>
### 3, 文章类别

```my_article_type```

| 字段名 | 类型 | 默认 | 说明 | 备注 |
|-------|------|---------|-------|
| type_id | smallint | - | key 自增 | - |
| type_name | varchar(32) | - | 类别名 | - |
| type_desc | varchar(64) | - | 类别描述 | - |
| is_show | tinyint | 0 | 是否展示 | 0否 1是 |


<span id="4"/>
### 4, 文章

```my_article```

| 字段名 | 类型 | 默认 | 说明 | 备注 |
|-------|------|---------|-------|
| article_id | int | - | key 自增 | - |
| article_title | varchar(64) | - | 标题 | - |
| article_img | varchar(128) | - | 文章图片 | - |
| article_desc | varchar(255) | - | 简述 | - |
| article_content | text | - | 内容 | - |
| article_time | datetime | - | 发表时间 | - |
| author_id | int | - | 作者 | - |
| article_tag | varchar(64) | - | 标签 | - |
| type_id | smallint | - | 类别 | - |
| top_order | tinyint | 0 | 置顶顺序 | - |
| is_top | tinyint | 0 | 置顶 | - |
| is_hot | tinyint | 0 | 热门 | - |
| is_show | tinyint | 0 | 显示 | - |
| is_recommend | tinyint | 0 | 推荐 | - |
| read_num | int | 0 | 点击数 | - |
| comment_num | int | 0 | 评论数 | - |



<span id="5"/>
### 5, 相册类别

```my_album_type```

| 字段名 | 类型 | 默认 | 说明 | 备注 |
|-------|------|---------|-------|
| type_id | smallint | - | key 自增 | - |
| type_name | varchar(32) | - | 类别名 | - |
| type_desc | varchar(64) | - | 类别描述 | - |
| is_show | tinyint | 0 | 是否展示 | 0否 1是 |


<span id="6"/>
### 6, 相册

```my_album```

| 字段名 | 类型 | 默认 | 说明 | 备注 |
|-------|------|---------|-------|
| album_id | int | - | key 自增 | - |
| album_name | varchar(32) | - | 相片名 | - |
| album_origin_url | varchar(128) | - | 相片原图url | - |
| album_thumb_url | varchar(128) | - | 相片缩略图url | - |
| album_desc | varchar(255) | - | 相片描述 | - |
| album_time | datetime | - | 发布时间 | - |
| author_id | int | - | 作者ID | - |
| album_tag | varchar(64) | - | 标签 | - |
| type_id | smallint | - | 类别 | - |
| top_order | tinyint | 0 | 置顶顺序 | - |
| is_top | tinyint | 0 | 置顶 | - |
| is_hot | tinyint | 0 | 热门 | - |
| is_show | tinyint | 0 | 展示 | - |
| is_recommend | tinyint | 0 | 推荐 | - |
| read_num | int | 0 | 点击数 | - |
| prize_num | int | 0 | 点赞数 | - |