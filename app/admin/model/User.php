<?php

namespace app\admin\model;

use think\Model;

class User extends Model
{
// 字段设置类型自动转换
    protected $type = [
        'expiration_time'  =>  'timestamp',
        'login_time'  =>  'timestamp',
        'last_login_time'  =>  'timestamp',
    ];
}