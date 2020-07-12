<?php

namespace Yuanrang\LaravelShop\Wap\Member\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'sys_user';

    protected $fillable = [
        'nick_name', 'password', 'weixin_openid', 'image_head'
    ];

}