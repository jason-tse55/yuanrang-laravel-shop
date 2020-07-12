<?php


return [
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

