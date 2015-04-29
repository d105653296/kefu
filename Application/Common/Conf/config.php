<?php

return array(
    	/*支付宝即时到帐*/
	'alipay_partner' => '',
	'alipay_key' => 'adxg1allzjbef8l3zxl78tvf1bwq1a1o',
	'alipay_seller_email' => 'tv0311@126.com',

    /* URL配置 */
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_ROUTER_ON'   => true,
    'URL_MODEL'            => 0, //URL模式 0普通 1 pathinfo模式 2 rewrite模式 3兼容模式
    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符

     /* 数据缓存设置 */
    'TMPL_CACHE_ON'=>false,      // 默认开启模板缓存
    'HTML_CACHE_ON'     =>    FALSE, // 开启静态缓存
    'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀

    'DATA_CACHE_PREFIX'    => 'yt_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型
    'SHOW_PAGE_TRACE' =>FALSE, // 显示页面Trace信息

    /* 全局过滤配置 */
    'DEFAULT_FILTER' => '', //全局过滤函数

    /* SESSION 和 COOKIE 配置 */
    'SESSION_AUTO_START' => true, //是否开启sessionn
    'SESSION_PREFIX' => 'yt_admin', //session前缀
    'COOKIE_PREFIX'  => 'yt_admin_', // Cookie前缀 避免冲突
    'VAR_SESSION_ID' => 'session_id',	//修复uploadify插件无法传递session_id的bug



    /* 数据库配置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'kefu', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'yt_', // 数据库表前缀
    'USER_AUTH_KEY'=>'authId',
);