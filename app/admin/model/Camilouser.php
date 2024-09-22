<?php

namespace app\admin\model;

use think\Model;

class Camilouser extends Model
{
// 字段设置类型自动转换
    protected $type = [
        'activate_time'  =>  'timestamp',
        'expiration_time'  =>  'timestamp',
        'login_time'  =>  'timestamp',
        'last_login_time'  =>  'timestamp',
    ];
}