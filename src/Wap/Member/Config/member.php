<?php


return [
    /*
 * 公众号
 */
    'official_account' => [
        'default' => [
            'app_id' => env('MEMBER_WECHAT_OFFICIAL_ACCOUNT_APPID', 'your-laravel-shop-app-id'),         // AppID
            'secret' => env('MEMBER_WECHAT_OFFICIAL_ACCOUNT_SECRET', 'your-laravel-shop-app-secret'),    // AppSecret
            'token' => env('MEMBER_WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'your-laravel-shop-token'),           // Token
            'aes_key' => env('MEMBER_WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),                 // EncodingAESKey

            /*
             * OAuth 配置
             *
             * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
             * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
             */
            'oauth' => [
                'scopes' => array_map('trim', explode(',', env('MEMBER_WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))),
                'callback' => env('MEMBER_WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
            ],
        ],
    ],

    'auth' => [
        // 事先的动作,为了以后着想
        'controller' => Yuanrang\LaravelShop\Wap\Member\Http\Controllers\AuthorizationsController::class,
        // 当前使用的守卫,只是定义
        'guard' => 'member',

        'guards' => [
            'member' => [
                'driver' => 'session',
                'provider' => 'member',
            ],
        ],
        'providers' => [
            'member' => [
                'driver' => 'eloquent',
                'model' => Yuanrang\LaravelShop\Wap\Member\Models\User::class,
            ],
        ],
    ],
];

