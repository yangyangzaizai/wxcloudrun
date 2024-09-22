<?php

namespace app\admin\model;

use app\admin\model\Classify;
use think\Model;

class Software extends Model
{
    protected $name = 'Software';

    /**
     * @return \think\model\relation\HasMany
     */
    public function roles()
    {
        return $this->hasMany(Classify::class,'id','pid');
    }

    /**
     * @return \think\model\relation\HasMany
     */
    public function rolesi($id)
    {
        return $this->hasMany(Classify::class,'id','pid')->with('title');
    }
}