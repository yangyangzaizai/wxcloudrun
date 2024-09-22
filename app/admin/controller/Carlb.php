<?php

namespace app\admin\controller;

use app\admin\AdminBase;
use app\admin\model\Card;
use app\admin\model\Software;
use think\facade\Db;

class Carlb extends AdminBase
{
    /**
     * 卡类管理
     * @return \think\response\View
     */
    public function index()
    {
        if (request()->isPost()) {
            $data = input('param.');
            $data = Card::where(['id'=>$data['id']])->find();
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
        $list = Card::paginate($limit);
        //$list = Db::name('card')->where('status',1)->order('id', 'desc')->select()->toArray();
        foreach ($list as $key => $value) {
            $rj = Db::name('software')->where(['id'=>$value['pid']])->find();
            $list[$key]['belongs'] = $rj['title'];
        }
        return to_assign(0, '获取成功', $list);
    }

    public function software()
    {
        $list = Software::select();
        return to_assign(0, '获取成功', $list);
    }

    public function post_submit()
    {
        if (request()->isPost()) {
            $param = input('param.');
            if ($param['id'] > 0) {

                $result = Card::update($param, ['id' => $param['id']]);
                if ($result == true) {
                    return to_assign(0, '卡类编辑成功');
                } else {
                    return to_assign(1, '卡类编辑失败');
                }
            }else{

                $result = Card::create($param);
                if ($result == true) {
                    return to_assign(0, '卡类添加成功');
                } else {
                    return to_assign(1, '卡类添加失败');
                }
            }
        }
    }

    /**
     * 删除卡类
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
            $result = Card::destroy($ids);
            if ($result == true) {
                return to_assign(0, '卡类删除成功');
            } else {
                return to_assign(1, '卡类删除失败');
            }
        }
    }
}