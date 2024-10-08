<?php

namespace app\admin\controller;

use app\admin\AdminBase;
use app\admin\model\AdminModel;
use think\exception\ValidateException;
use think\facade\Cache;

class Tpl extends AdminBase
{
    /**
     * 无需权限判断的方法
     * @var array
     */
    protected $noNeedAuth = ['message', 'lockscreen', 'clear', 'theme'];

    /**
     * 消息
     * @return \think\response\View
     */
    public function message()
    {
        return view();
    }

    /**
     * 清理运行缓存
     */
    public function clear()
    {
        if (request()->isGet()) {
            Cache::tag('admin')->clear();
            $this->success('清理系统缓存成功！');
        } else {
            $this->error('清理系统缓存失败！');
        }
    }

    public function password()
    {
        if (request()->isPost()) {
            $data = get_params();
            try {
                $this->validate($data, 'Admin.editpassword');
            } catch (ValidateException $e) {
                // 验证失败 输出错误信息
                return to_assign(1, $e->getError());
            }
            $pwd = AdminModel::where('id', getAdminId())->find();
            if ($pwd['password'] !== set_password($data['oldPsw'], $pwd['salt'])) {
                return to_assign(1, '原始密码输入错误');
            } else {
                $salt = set_salt(20);
                $shuju = [
                    "salt" => $salt,
                    "password" => set_password($data['repassword'], $salt),
                    "id" => getAdminId(),
                ];
                $result = AdminModel::update($shuju);
                if ($result == true) {
                    return to_assign(0, '修改密码成功');
                } else {
                    return to_assign(1, '修改密码失败');
                }
            }
        } else {
            return view();
        }
    }
}