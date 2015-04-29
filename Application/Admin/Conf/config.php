<?php
return array(
	//'配置项'=>'配置值'

	    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX'    => 'yt_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型
    'URL_MODEL'            => 0, //URL模式 0普通 1 pathinfo模式 2 rewrite模式 3兼容模式
    'SHOW_PAGE_TRACE' =>TURE, // 显示页面Trace信息


    /* SESSION 和 COOKIE 配置 */
	'SESSION_AUTO_START' => true, //是否开启sessionn
    'SESSION_PREFIX' => 'yt_admin', //session前缀
    'COOKIE_PREFIX'  => 'yt_admin_', // Cookie前缀 避免冲突
    'VAR_SESSION_ID' => 'session_id',	//修复uploadify插件无法传递session_id的bug

	 /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/assets/img',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/assets/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/assets/js',
        '__PUBLIC__'=>__ROOT__.'/Public',
    ),

    /* 后台错误页面模板 */
   // 'TMPL_ACTION_ERROR'     =>  MODULE_PATH.'View/Public/error.html', // 默认错误跳转对应的模板文件
   // 'TMPL_ACTION_SUCCESS'   =>  MODULE_PATH.'View/Public/success.html', // 默认成功跳转对应的模板文件
   // 'TMPL_EXCEPTION_FILE'   =>  MODULE_PATH.'View/Public/exception.html',// 异常页面的模板文件

);