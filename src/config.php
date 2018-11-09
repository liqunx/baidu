<?php

return [
    /*
     * 默认配置，将会合并到各模块中
     */
    'defaults' => [
        /*
         * 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
         */
        'response_type' => 'array',

        /*
         * 使用 Laravel 的缓存系统
         */
        'use_laravel_cache' => true,

        /*
         * 日志配置
         *
         * level: 日志级别，可选为：
         *                 debug/info/notice/warning/error/critical/alert/emergency
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level' => env('BAIDU_LOG_LEVEL', 'debug'),
            'file' => env('BAIDU_LOG_FILE', storage_path('logs/baidu.log')),
        ],

        'secret' => env('BAIDU_SECRET', 'your-app-secret'),    // secret
        'api_key' => env('BAIDU_API_KEY', 'your-api-key'),           //api_key
    ],


    /*
     * 百度 AI 模块
     */
    'aip' => [
        'default' => [
            'app_id' => env('BAIDU_AIP_APPID', 'your-app-id'),         // AppID
            'secret' => env('BAIDU_AIP_SECRET', env('BAIDU_SECRET', 'your-app-secret')),    // AppSecret
            'api_key' => env('BAIDU_API_KEY', env('BAIDU_API_KEY', 'your-api-key')),           // Token
        ]
    ],

    /*
     * 其他模块正在整理中...
     */

];
