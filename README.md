<p align="center">
<img src="https://banners.beyondco.de/SaaS%20skeleton.png?theme=light&packageManager=&packageName=&pattern=cutout&style=style_1&description=Build+with+Laravel+%26+Dcat+Admin&md=0&showWatermark=0&fontSize=100px&images=cube-transparent&widths=300&heights=300">
</p>

### 关于

本项目是基于[`Laravel`](https://github.com/laravel/laravel) 、 [`Dcat Admin`](https://github.com/jqhph/dcat-admin) 以及 [`archtechx/tenancy`](https://github.com/archtechx/tenancy) 构建的SAAS后台脚手架，支持`多数据库`、`多域名`，开箱即用，欢迎提交PR共同完善本项目，如果本项目对您有帮助，还请给个Star支持一下，谢谢。

- [Laravel中文文档](https://learnku.com/docs/laravel/8.5)
- [Dcat Admin中文文档](https://learnku.com/docs/dcat-admin)
- [多租户扩展文档](https://tenancyforlaravel.com/docs/v3/introduction/)

### 功能特性

- [x] 完全兼容Dcat Admin
- [x] 支持多数据库，每个租户拥有独立的数据库
- [x] 支持多域名，每个租户可以配置多个域名
- [x] 内置简单的租户管理功能
- [x] 内置系统配置模板，直接修改对应表单即可添加系统配置项
- [x] 自动检测租户是否已过期
- [x] 一键登陆至租户后台
- [ ] 集成在线支付功能，供租户自动续费

### 安装

```bash
# 克隆本项目
git clone https://github.com/Abbotton/saas-skeleton

# 进入目录并安装相关依赖
cd saas-skeleton && composer install

# 复制.env.example为.env
cp .env.example .env

# 修改.env中数据库以及APP_URL相关配置
vi .env

# 执行以下命令完成安装
php artisan admin:publish && php artisan admin:install && php artisan saas:init

# done !
```
### 管理

> **进行租户管理之前请确认域名解析完毕，建议进行泛域名解析。**
> 现在假设已完成`*.example.com`的解析。

- 访问 `http://example.com/central` 打开主控端登录页面，账号密码都是：`admin`；
- 点击左侧 `租户管理` 菜单添加一个租户，(假设域名是：`test.example.com`);
- 访问`http://test.example.com` 可以看到租户ID；
- 访问`http://test.example.com/admin` 可以打开租户对应后台，账号密码都是：`admin`；
- 为方便管理，在租户管理页面，点击任意租户右侧工具栏中的`登录后台`菜单，可以**无视租户管理员账号密码**，直接登陆至租户的后台；

### FAQ
1、**如何扩展租户表字段？**

新建一个迁移文件，添加新的字段，然后修改`app/Models/Tenant.php`，将新字段填写至`getCustomColumns()`方法中，再根据自己的业务逻辑修改`app/Central`目录中的文件即可。

2、**如何添加主控端的系统配置**

修改`app/Central/Forms/AdminSetting.php`文件即可。

2、**如何添加租户的系统配置**

修改`app/Admin/Forms/AdminSetting.php`文件即可。

### License

[The MIT License (MIT)](LICENSE).