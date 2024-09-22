<?php

namespace app\admin\controller;

use app\admin\AdminBase;
use app\admin\model\Classify;
use think\exception\ValidateException;

class ClassifyImpl extends AdminBase
{
    /**
     * 分类管理
     * @return \think\response\View
     */
    public function index()
    {
        if (request()->isPost()) {
            $data = input('param.');
            $data = Classify::where(['id'=>$data['id']])->find();
            return to_assign(0, '获取成功', $data);
        }else{
            return view();
        }
    }

    /**
     * 返回Json格式的数据
     * @param int $limit
     * @throws \think\db\exception\DbException
     */
    public function datalist($limit=15)
    {
        $list = Classify::paginate($limit);
        return to_assign(0, '获取成功', $list);
    }

    public function post_submit()
    {
        if (request()->isPost()) {
            $param = input('param.');
            if ($param['id'] > 0) {
                if(!empty($param['title'])){
                    try {
                        $this->validate($param, 'Classify');
                    } catch (ValidateException $e) {
                        // 验证失败 输出错误信息
                        return to_assign(1, $e->getError());
                    }
                }
                $result = Classify::update($param, ['id' => $param['id']]);
                if ($result == true) {
                    return to_assign(0, '分类编辑成功');
                } else {
                    return to_assign(1, '分类编辑失败');
                }
            }else{
                try {
                    $this->validate($param, 'Role');
                } catch (ValidateException $e) {
                    // 验证失败 输出错误信息
                    return to_assign(1, $e->getError());
                }
                $result = Classify::create($param);
                if ($result == true) {
                    return to_assign(0, '分类添加成功');
                } else {
                    return to_assign(1, '分类添加失败');
                }
            }
        }
    }

    /**
     * 删除角色
     */
    public function del($id)
    {
        if (request()->isPost()) {
            $data = input('param.');
            if(empty($id)){
                $ids = explode(',', $data['ids']);
            }else{
                $ids = $id;
            }
            $result = Classify::destroy($ids);
            if ($result == true) {
                return to_assign(0, '分类删除成功');
            } else {
                return to_assign(1, '分类删除失败');
            }
        }
    }
}